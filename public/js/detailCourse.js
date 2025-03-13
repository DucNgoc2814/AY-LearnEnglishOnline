(function() {
    document.addEventListener("DOMContentLoaded", function() {
        // Modal elements
        const modal = document.getElementById("buyNowModal");
        const openModalBtn = document.getElementById("openBuyNowModal");
        const closeModalBtn = document.getElementById("closeModal");
        const modalOverlay = document.querySelector(".custom-modal-overlay");
        const checkoutBtn = document.querySelector(".custom-modal-checkout-btn");

        // Coupon elements
        const couponInput = document.querySelector(".custom-modal-coupon-input");
        const applyCouponBtn = document.querySelector(".custom-modal-coupon-btn");
        const totalPriceElement = document.querySelector(".custom-modal-total-price");
        const originalPriceElement = document.querySelector(".custom-modal-original-price");
        const salePriceElement = document.querySelector(".custom-modal-sale-price");
        const voucherDiscountElement = document.querySelector(".voucher-discount");
        const voucherDiscountAmountElement = document.querySelector(".custom-modal-voucher-discount");

        // Original price for reset purposes
        const originalPrice = parseFloat(salePriceElement?.textContent.replace(/[^\d]/g, '') || 0);

        // Thêm hàm format số với dấu phẩy
        function formatCurrency(number) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'decimal',
                maximumFractionDigits: 0,
                minimumFractionDigits: 0
            }).format(number).replace(/\./g, ',');
        }

        // Apply coupon function
        async function applyCoupon() {
            const couponCode = couponInput?.value.trim();
            if (!couponCode) {
                showNotification('Vui lòng nhập mã giảm giá!', 'error');
                return;
            }

            // Kiểm tra CSRF token
            const metaTag = document.querySelector('meta[name="csrf-token"]');
            if (!metaTag) {
                showNotification('Lỗi bảo mật: Không tìm thấy CSRF token', 'error');
                return;
            }

            const csrfToken = metaTag.getAttribute('content');
            if (!csrfToken) {
                showNotification('Lỗi bảo mật: CSRF token trống', 'error');
                return;
            }

            try {
                const courseSlug = window.location.pathname.split('/').pop();
                if (!courseSlug) {
                    showNotification('Không tìm thấy ID khóa học', 'error');
                    return;
                }

                const response = await fetch('/api/apply-coupon', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        coupon_code: couponCode,
                        slug: courseSlug,
                        amount: originalPrice
                    })
                });

                const data = await response.json();

                if (data.status) {
                    voucherDiscountElement.style.display = 'flex';
                    const discountAmount = data.data.discount_amount;
                    voucherDiscountAmountElement.textContent = `-${formatCurrency(discountAmount)}đ`;
                    const finalPrice = originalPrice - discountAmount;
                    totalPriceElement.textContent = `${formatCurrency(finalPrice)}đ`;
                    document.querySelector('input[name="amount"]').value = finalPrice;
                    document.querySelector('input[name="discount_amount"]').value = discountAmount;
                    showNotification('Áp dụng mã giảm giá thành công!', 'success');
                } else {
                    showNotification(data.message, 'error');
                    resetPrices();
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Có lỗi xảy ra khi áp dụng mã giảm giá', 'error');
                resetPrices();
            }
        }

        // Reset prices function
        function resetPrices() {
            const originalPrice = parseFloat(salePriceElement?.textContent.replace(/[^\d]/g, '') || 0);
            
            voucherDiscountElement.style.display = 'none';
            voucherDiscountAmountElement.textContent = '-0đ';
            totalPriceElement.textContent = `${formatCurrency(originalPrice)}đ`;
            
            document.querySelector('input[name="amount"]').value = originalPrice;
            document.querySelector('input[name="discount_amount"]').value = 0;
            couponInput.value = '';
        }

        // Modal functions
        function openModal(e) {
            e.preventDefault();
            modal.classList.add("active");
            document.body.style.overflow = "hidden";
        }

        function closeModal() {
            modal.classList.remove("active");
            document.body.style.overflow = "";
            // Reset coupon input and price when closing modal
            couponInput.value = '';
            resetPrices();
        }

        // Event listeners
        openModalBtn.addEventListener("click", openModal);
        closeModalBtn.addEventListener("click", closeModal);
        modalOverlay.addEventListener("click", closeModal);
        
        document.querySelector(".custom-modal-content").addEventListener("click", function(e) {
            e.stopPropagation();
        });

        // Apply coupon when clicking button
        applyCouponBtn.addEventListener("click", applyCoupon);

        // Apply coupon when pressing Enter in input
        couponInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                applyCoupon();
            }
        });

        // Checkout button
        checkoutBtn.addEventListener("click", function() {
            window.location.href = checkoutBtn.dataset.checkoutUrl;
        });

        // Close with ESC key
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape" && modal.classList.contains("active")) {
                closeModal();
            }
        });
    });
})();
