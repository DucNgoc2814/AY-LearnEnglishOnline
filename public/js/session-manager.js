/**
 * Session Manager
 *
 * This manages browser-based session control with the following goals:
 * 1. Only one browser can be logged in at a time
 * 2. When all tabs are closed for 30 seconds, the account is released for login on other browsers
 * 3. Switching tabs within the same browser does not log the user out
 */

document.addEventListener('DOMContentLoaded', function() {
    // Only initialize if user is logged in
    if (document.body.classList.contains('user-logged-in')) {
        initSessionManager();
    }
});

function initSessionManager() {
    // Configuration
    const BROWSER_CLOSED_TIMEOUT = 1000; // 30 seconds after closing browser to release account
    const HEARTBEAT_INTERVAL = 1000000;     // 15 seconds between server checks
    const ACTIVITY_EVENTS = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'];

    // State management
    let heartbeatTimer;
    let isActive = true;

    // Generate a unique browser ID if one doesn't exist
    if (!localStorage.getItem('browser_id')) {
        localStorage.setItem('browser_id', generateUniqueId());
    }
    const browserId = localStorage.getItem('browser_id');

    // Track this tab in session storage
    const tabId = generateUniqueId();

    // Initialize and start processes
    registerTab(tabId);
    startHeartbeat();
    setupEventListeners();

    // Use a shared worker if available to handle background logout
    createBackgroundWorker();

    // Immediately check if we're restoring a closed session
    checkForRestoredSession();

    // Check for stale force logout data
    checkForStaleLogoutData();

    /**
     * Check if we're reopening a closed session
     */
    function checkForRestoredSession() {
        const closedAt = parseInt(localStorage.getItem('browser_closed_at') || '0', 10);
        if (closedAt > 0) {
            const timeSinceClosed = Date.now() - closedAt;

            if (timeSinceClosed >= BROWSER_CLOSED_TIMEOUT) {
                // Session should be expired already - verify with server
                checkSessionStatus(true);
            } else {
                // We're back within the allowed time - cancel any pending logout
                fetch('/cancel-logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-Browser-ID': browserId,
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    credentials: 'same-origin'
                }).catch(error => {
                    console.error('Error canceling logout:', error);
                });

                // Clear the closed timestamp
                localStorage.removeItem('browser_closed_at');
            }
        }
    }

    /**
     * Set up background worker for logout when all tabs are closed
     */
    function createBackgroundWorker() {
        if ('serviceWorker' in navigator && window.SharedWorker) {
            try {
                navigator.serviceWorker.register('/service-worker.js').then((registration) => {
                    console.log('Service worker registered for session management');

                    // Notify the service worker about our browser ID
                    navigator.serviceWorker.controller?.postMessage({
                        type: 'IDENTIFY_BROWSER',
                        browserId: browserId
                    });
                });
            } catch (error) {
                console.error('Service worker registration failed:', error);
            }
        } else {
            // Fallback to using localStorage-based tracking
            console.log('Service Worker not supported, using localStorage fallback');
        }
    }

    /**
     * Set up all event listeners
     */
    function setupEventListeners() {
        // Tab visibility changes (switching tabs)
        document.addEventListener('visibilitychange', handleVisibilityChange);

        // Browser closing
        window.addEventListener('beforeunload', handleBeforeUnload);

        // Track user activity
        ACTIVITY_EVENTS.forEach(event => {
            document.addEventListener(event, recordActivity);
        });

        // Handle storage events (communication between tabs)
        window.addEventListener('storage', handleStorageEvent);

        // Use a periodic check to detect closed tabs even if not reopened
        // This ensures logout happens even if the browser is running but minimized
        setInterval(checkClosedStatus, 5000);

        // Also check logout status periodically
        setInterval(checkLogoutStatus, 10000);
    }

    /**
     * Check if all tabs have been closed for longer than the timeout
     */
    function checkClosedStatus() {
        const closedAt = parseInt(localStorage.getItem('browser_closed_at') || '0', 10);
        if (closedAt > 0 && Date.now() - closedAt >= BROWSER_CLOSED_TIMEOUT) {
            performLogout();
        }
    }

    /**
     * Handle visibility change (tab switching)
     */
    function handleVisibilityChange() {
        if (document.visibilityState === 'hidden') {
            // Tab is now hidden (switched away)
            isActive = false;
            unregisterTab(tabId);

            // If this was the last tab, record when browser was closed
            if (getActiveTabs().length === 0) {
                startLogoutCountdown();
            }
        } else {
            // Tab is now visible again
            isActive = true;
            registerTab(tabId);
            cancelLogoutCountdown();

            // Take over heartbeat if needed
            if (getActiveTabs()[0] === tabId) {
                startHeartbeat();
            }

            // Refresh status immediately
            checkSessionStatus(true);
        }
    }

    /**
     * Start the countdown to logout
     */
    function startLogoutCountdown() {
        localStorage.setItem('browser_closed_at', Date.now().toString());

        // Send a scheduled logout request to the server
        // This ensures the account is released even if browser isn't reopened
        navigator.sendBeacon('/schedule-logout?delay=30&force=1&browser_id=' + browserId);

        // Also force a background logout after 30 seconds via service worker
        // This is a safety measure in case sendBeacon fails
        const logoutData = {
            type: 'FORCE_LOGOUT_AFTER_CLOSE',
            timestamp: Date.now(),
            browserId: browserId
        };
        localStorage.setItem('force_logout_data', JSON.stringify(logoutData));

        console.log('Logout countdown started at', new Date());
    }

    /**
     * Cancel the logout countdown
     */
    function cancelLogoutCountdown() {
        localStorage.removeItem('browser_closed_at');
    }

    /**
     * Handle browser/tab closing
     */
    function handleBeforeUnload(e) {
        // Unregister this tab
        unregisterTab(tabId);

        console.log('Tab unloaded, remaining tabs:', getActiveTabs().length);

        // If this was the last tab, start the logout countdown
        if (getActiveTabs().length === 0) {
            // More aggressively trigger logout with shorter delay
            localStorage.setItem('browser_closed_at', Date.now().toString());
            navigator.sendBeacon('/schedule-logout?delay=15&force=1&browser_id=' + browserId);
            console.log('Last tab closed, scheduling immediate logout');
        }
    }

    /**
     * Handle storage events (for cross-tab communication)
     */
    function handleStorageEvent(e) {
        if (e.key === 'active_tabs') {
            // Tabs list changed - check if we need to take over heartbeat duties
            const tabs = getActiveTabs();
            if (tabs.length > 0 && tabs[0] === tabId && isActive) {
                startHeartbeat();
            }

            // If tabs list is empty, start logout countdown
            if (tabs.length === 0) {
                startLogoutCountdown();
            } else {
                // Otherwise cancel any pending logout
                cancelLogoutCountdown();
            }
        } else if (e.key === 'logout_triggered') {
            // Another tab triggered logout
            redirectToLoginWithAutoLogout();
        }
    }

    /**
     * Redirect to login page with auto logout state
     * Uses sessionStorage instead of URL parameter to avoid it staying in URL
     */
    function redirectToLoginWithAutoLogout() {
        // Set a flag in sessionStorage that we'll check on login page
        sessionStorage.setItem('auto_logout', '1');
        window.location.href = '/dang-nhap';
    }

    /**
     * Record user activity
     */
    function recordActivity() {
        localStorage.setItem('last_activity', Date.now().toString());

        // Since there's activity, ensure any logout countdown is canceled
        if (parseInt(localStorage.getItem('browser_closed_at') || '0', 10) > 0) {
            cancelLogoutCountdown();
        }
    }

    /**
     * Register this tab as active
     */
    function registerTab(id) {
        const tabs = getActiveTabs();
        if (!tabs.includes(id)) {
            tabs.push(id);
            setActiveTabs(tabs);
        }
    }

    /**
     * Unregister this tab
     */
    function unregisterTab(id) {
        const tabs = getActiveTabs().filter(tabId => tabId !== id);
        setActiveTabs(tabs);
    }

    /**
     * Get list of active tabs
     */
    function getActiveTabs() {
        const tabsJson = localStorage.getItem('active_tabs');
        return tabsJson ? JSON.parse(tabsJson) : [];
    }

    /**
     * Set list of active tabs
     */
    function setActiveTabs(tabs) {
        localStorage.setItem('active_tabs', JSON.stringify(tabs));
    }

    /**
     * Start heartbeat to server
     */
    function startHeartbeat() {
        // Clear any existing heartbeat
        clearTimeout(heartbeatTimer);

        // Only the first active tab should handle heartbeats
        const tabs = getActiveTabs();
        if (tabs.length === 0 || tabs[0] !== tabId || !isActive) {
            return;
        }

        heartbeatTimer = setTimeout(() => {
            checkSessionStatus();
        }, HEARTBEAT_INTERVAL);
    }

    /**
     * Update the server about session status
     */
    function checkSessionStatus(immediate = false) {
        fetch('/session-status', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-Browser-ID': browserId
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (!data.active) {
                // Session is invalid
                console.log('Session is invalid:', data.reason);

                // Refresh the page if requested by the server
                if (data.reload) {
                    window.location.reload();
                    return;
                }

                // Execute script if provided (for redirects)
                if (data.script) {
                    const scriptElement = document.createElement('div');
                    scriptElement.innerHTML = data.script;
                    document.body.appendChild(scriptElement);
                    return;
                }

                // If device mismatch or other error, force logout
                performLogout(data.reason === 'device_mismatch');
            }
        })
        .catch(error => {
            console.error('Error checking session status:', error);
        });
    }

    /**
     * Perform a logout (locally and on server)
     */
    function performLogout(wasLoggedOutFromElsewhere = false) {
        // Notify other tabs we're logging out
        localStorage.setItem('logout_triggered', Date.now().toString());

        // Clear all session state
        localStorage.removeItem('browser_closed_at');
        setActiveTabs([]);

        console.log('Logging out');

        // If we were logged out from elsewhere, we don't need to call the server
        if (wasLoggedOutFromElsewhere) {
            redirectToLoginWithAutoLogout();
            return;
        }

        // Otherwise do a proper server-side logout
        fetch('/dang-xuat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-Browser-ID': browserId,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'same-origin'
        })
        .then(response => {
            // Always redirect to login page, regardless of response
            redirectToLoginWithAutoLogout();
        })
        .catch(error => {
            console.error('Error during logout:', error);
            // Still redirect to login page
            redirectToLoginWithAutoLogout();
        });
    }

    /**
     * Generate a unique ID
     */
    function generateUniqueId() {
        return Math.random().toString(36).substring(2, 15) +
               Math.random().toString(36).substring(2, 15) +
               Date.now().toString(36);
    }

    /**
     * Display notification and redirect to login page
     *
     * @param {string} message - Message to display
     * @param {string} type - Type of notification (warning, info, error)
     * @param {string} title - Title of the notification
     */
    function showLogoutNotification(message, type = 'warning', title = 'Thông báo đăng nhập') {
        // Create modal or notification
        const modalHtml = `
            <div class="modal fade show" id="auth-notification-modal" style="display: block; background: rgba(0,0,0,0.5);">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-${type}">
                            <h5 class="modal-title">${title}</h5>
                        </div>
                        <div class="modal-body">
                            <p>${message}</p>
                            <p>Bạn sẽ được chuyển đến trang đăng nhập trong <span id="countdown">5</span> giây.</p>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Insert modal
        const modalElement = document.createElement('div');
        modalElement.innerHTML = modalHtml;
        document.body.appendChild(modalElement);

        // Clear any session storage
        sessionStorage.removeItem('temp_password');

        // Auto-hide the modal after 10 seconds
        setTimeout(() => {
            const modal = document.getElementById('auth-notification-modal');
            if (modal) {
                // Fade-out effect
                modal.style.transition = 'opacity 1s ease';
                modal.style.opacity = '0';
            }
        }, 10000); // 10 seconds

        // Countdown timer for redirect
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        const countdownTimer = setInterval(() => {
            countdown--;
            if (countdownElement) {
                countdownElement.textContent = countdown;
            }
            if (countdown <= 0) {
                clearInterval(countdownTimer);
                redirectToLoginWithAutoLogout();
            }
        }, 1000);
    }

    /**
     * Check for stale force logout data that might indicate a browser close/crash
     * that didn't properly clean up
     */
    function checkForStaleLogoutData() {
        const logoutData = localStorage.getItem('force_logout_data');
        if (logoutData) {
            try {
                const data = JSON.parse(logoutData);
                const now = Date.now();
                const age = now - data.timestamp;

                // If the logout data is older than 5 minutes, it's likely from
                // a previous session that didn't clean up properly
                if (age > 300000) { // 5 minutes
                    console.log('Found stale logout data, clearing device state');

                    // Clear the device state on the server to fix the system
                    fetch('/schedule-logout?delay=0&force=1&browser_id=' + browserId, {
                        method: 'GET',
                        headers: {
                            'X-Browser-ID': browserId
                        }
                    }).catch(error => {
                        console.error('Error clearing stale device state:', error);
                    });

                    // Clear the data
                    localStorage.removeItem('force_logout_data');
                }
            } catch (e) {
                console.error('Error parsing force logout data:', e);
                localStorage.removeItem('force_logout_data');
            }
        }
    }

    /**
     * Periodically check if the user has been logged out by another browser or the server
     */
    function checkLogoutStatus() {
        const lastCheck = parseInt(localStorage.getItem('last_logout_check') || '0', 10);
        const now = Date.now();

        // Only check at most once every 10 seconds to prevent too many requests
        if (now - lastCheck < 10000) {
            return;
        }

        localStorage.setItem('last_logout_check', now.toString());

        fetch('/check-auth', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-Browser-ID': browserId
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (!data.authenticated) {
                console.log('User is not authenticated, performing logout');
                performLogout(true);
            }
        })
        .catch(error => {
            console.error('Error checking authentication status:', error);
        });
    }
}
