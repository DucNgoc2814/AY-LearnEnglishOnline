/**
 * Service Worker for session management
 */

// Browser ID for the current browser
let browserId = null;
let lastClientCount = null;
let noClientsSince = null;
let logoutScheduled = false;

// Handle install event
self.addEventListener('install', (event) => {
  // Skip waiting to activate immediately
  self.skipWaiting();
  console.log('Service Worker installed');
});

// Handle activation
self.addEventListener('activate', (event) => {
  // Claim clients to control all pages
  event.waitUntil(clients.claim());
  console.log('Service Worker activated');
});

// Handle messages from the client
self.addEventListener('message', (event) => {
  if (event.data.type === 'IDENTIFY_BROWSER') {
    browserId = event.data.browserId;
    console.log('Service Worker identified browser:', browserId);

    // Reset logout state when identifying a browser
    logoutScheduled = false;
  } else if (event.data.type === 'CANCEL_LOGOUT') {
    logoutScheduled = false;
    console.log('Service Worker: logout canceled');
  }
});

// Set up a periodic check for stale sessions
setInterval(() => {
  if (!browserId) {
    return; // No browser ID yet, can't proceed
  }

  self.clients.matchAll().then(clients => {
    const clientCount = clients.length;

    // Log the current state
    console.log(`Service Worker check: ${clientCount} clients, browser ID: ${browserId}, logoutScheduled: ${logoutScheduled}`);

    // If we have no clients (all tabs closed)
    if (clientCount === 0) {
      // If this is the first time with no clients, record the time
      if (lastClientCount > 0) {
        noClientsSince = Date.now();
        console.log('Service Worker: All tabs closed at', new Date(noClientsSince));

        // Send an immediate notification to schedule logout
        if (!logoutScheduled) {
          logoutScheduled = true;

          // Use a very short delay to force logout quickly
          fetch('/schedule-logout?delay=5&force=1&browser_id=' + browserId, {
            method: 'GET',
            headers: {
              'X-Browser-ID': browserId
            }
          }).then(() => {
            console.log('Service Worker: Scheduled logout initiated');
          }).catch(error => {
            console.error('Error scheduling logout from service worker:', error);
            logoutScheduled = false;
          });
        }
      }
      // If it's been more than 3 seconds with no clients, force logout
      else if (!logoutScheduled && (Date.now() - noClientsSince > 3000)) {
        console.log('Service Worker: Forcing immediate logout after extended closure');
        logoutScheduled = true;

        // Send the most aggressive logout request possible
        fetch('/schedule-logout?delay=0&force=1&browser_id=' + browserId, {
          method: 'GET',
          headers: {
            'X-Browser-ID': browserId
          }
        }).then(() => {
          console.log('Service Worker: Immediate logout initiated');
        }).catch(error => {
          console.error('Error forcing logout from service worker:', error);
          logoutScheduled = false;
        });
      }
    } else {
      // We have clients, reset the no-clients timer and logout state
      noClientsSince = null;

      // If tabs are open and logout was scheduled, try to cancel it
      if (logoutScheduled && clients.length > 0) {
        fetch('/cancel-logout?browser_id=' + encodeURIComponent(browserId), {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Browser-ID': browserId,
            'X-Requested-With': 'XMLHttpRequest'
          }
        }).then(() => {
          console.log('Service Worker: Cancelled scheduled logout');
          logoutScheduled = false;
        }).catch(error => {
          console.error('Error canceling logout from service worker:', error);
        });
      }
    }

    lastClientCount = clientCount;
  });
}, 2000); // Check every 2 seconds

// Handle fetch events if needed
self.addEventListener('fetch', (event) => {
  // Pass through, no modification needed
});
