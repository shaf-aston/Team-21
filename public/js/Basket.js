let currentItem;

document.addEventListener("DOMContentLoaded", function () {
    // Constants
    const INTEREST_RATE = 19.9;
    const PAYMENT_MONTHS = 36;
    const DEBOUNCE_DELAY = 500;
    const BUY_LATER_MONTHS = 12;

    // DOM Elements
    const quantityInputs = document.querySelectorAll(".quantity");
    const priceCells = document.querySelectorAll(".price");
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const popup = document.getElementById("remove-popup");
    const paymentCheckboxes = document.querySelectorAll(".payment-checkbox");
    const paymentDetails = document.querySelector(".payment-details");
    const buyLaterDate = document.getElementById("buy-later-date");
    const monthlyPayment = document.getElementById("monthly-payment");
    const disclaimer = document.querySelector(".disclaimer");

    // Event Listeners
    initializeEventListeners();

    function initializeEventListeners() {
        // Popup close events
        window.addEventListener("click", (e) => {
            if (e.target === popup) closePopup();
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closePopup();
        });

        // Quantity input handlers
        quantityInputs.forEach((input) => {
            let timeout;
            input.addEventListener("input", () => {
                handleQuantityChange(input, timeout);
            });
        });

        // Payment method selection
        paymentCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () => {
                handlePaymentMethodChange(checkbox);
            });
        });
    }

    // Quantity Handling
    function handleQuantityChange(input, timeout) {
        // Minimum quantity validation
        if (parseInt(input.value) < 1) {
            input.value = 1;
        }

        // Debounce the update
        clearTimeout(timeout);
        timeout = setTimeout(async () => {
            const totals = updateTotals();
            const itemId = input.closest(".basket-item").dataset.itemId;
            await updateBasketItem(itemId, input.value);
            updatePaymentOptions(totals.totalPrice);
        }, DEBOUNCE_DELAY);
    }

    // Payment Methods
    function handlePaymentMethodChange(checkbox) {
        if (checkbox.checked) {
            // Uncheck other checkboxes
            paymentCheckboxes.forEach((otherCheckbox) => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });

            // Show/hide payment details
            const isSpreadCost = checkbox
                .closest("label")
                .textContent.includes("Spread the cost");
            paymentDetails.style.display = isSpreadCost ? "block" : "none";

            if (isSpreadCost) {
                updatePaymentOptions(getCurrentTotal());
            }
        }
    }

    // Total and Price Updates
    function updateTotals() {
        let totalPrice = 0;
        let totalItems = 0;

        quantityInputs.forEach((input, index) => {
            const quantity = parseInt(input.value) || 0;
            const priceText = priceCells[index].textContent
                .replace("£", "")
                .replace(",", "");
            const price = parseFloat(priceText) || 0;
            totalPrice += quantity * price;
            totalItems += quantity;
        });

        updateDisplayTotals(totalPrice, totalItems);
        return { totalPrice, totalItems };
    }

    function updateDisplayTotals(totalPrice, totalItems) {
        const basketTotal = document.getElementById("basket-total");
        if (basketTotal) {
            basketTotal.textContent = formatPrice(totalPrice);
            basketTotal.dataset.initialTotal = totalPrice;
        }

        updateItemCount(totalItems);

        if (totalItems === 0) {
            displayEmptyBasketMessage();
        }
    }

    function updateItemCount(totalItems) {
        const itemCountHeader = document.getElementById("item-count-header");
        const itemLabel = document.getElementById("item-label");

        if (itemCountHeader) {
            itemCountHeader.textContent = totalItems;
        }
        if (itemLabel) {
            itemLabel.textContent = totalItems === 1 ? "item" : "items";
        }
    }

    // Payment Calculations
    function updatePaymentOptions(total) {
        const monthlyAmount = calculateMonthlyPayment(total);
        updateMonthlyPaymentDisplay(monthlyAmount);
        updateBuyLaterDate();
        updatePaymentDisclaimer(total, monthlyAmount);
    }

    function calculateMonthlyPayment(total) {
        return ((total * (1 + INTEREST_RATE / 100)) / PAYMENT_MONTHS).toFixed(
            2
        );
    }

    function updateMonthlyPaymentDisplay(monthlyAmount) {
        if (monthlyPayment) {
            monthlyPayment.textContent = `From £${monthlyAmount} for ${PAYMENT_MONTHS} months`;
        }
    }

    function updateBuyLaterDate() {
        if (buyLaterDate) {
            const date = new Date();
            date.setMonth(date.getMonth() + BUY_LATER_MONTHS);
            const formattedDate = formatDate(date);
            buyLaterDate.textContent = `Pay as much as you'd like for ${BUY_LATER_MONTHS} months, settle in full by ${formattedDate} and pay no interest`;
        }
    }

    function updatePaymentDisclaimer(total, monthlyAmount) {
        if (disclaimer) {
            const totalPayable = (monthlyAmount * PAYMENT_MONTHS).toFixed(2);
            disclaimer.innerHTML = generateDisclaimerText(
                total,
                monthlyAmount,
                totalPayable
            );
        }
    }

    // API Interactions
    async function updateBasketItem(itemId, quantity) {
        try {
            const response = await fetch(`/basket/update/${itemId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                },
                body: JSON.stringify({ quantity }),
            });

            if (!response.ok) throw new Error("Network response was not ok");
            return await response.json();
        } catch (error) {
            console.error("Error updating basket:", error);
            showError("Failed to update basket. Please try again.");
        }
    }

    // Popup Management
    function showRemovePopup(element) {
        currentItem = element.closest(".basket-item");
        popup.style.display = "flex";
        popup.querySelector("button.remove-button").focus();
    }

    function removeItem() {
        if (!currentItem) return;

        const form = currentItem.querySelector("form");
        if (form) {
            form.submit();
        } else {
            console.error("Remove form not found");
        }

        closePopup();
    }

    function closePopup() {
        popup.style.display = "none";
        currentItem = null;
    }

    // Utility Functions
    function formatPrice(price) {
        return price.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatDate(date) {
        return date.toLocaleDateString("en-GB", {
            day: "numeric",
            month: "long",
            year: "numeric",
        });
    }

    function getCurrentTotal() {
        const basketTotal = document.getElementById("basket-total");
        return parseFloat(basketTotal.dataset.initialTotal) || 0;
    }

    function generateDisclaimerText(total, monthlyAmount, totalPayable) {
        return `
            <strong>Illustrative example:</strong> Credit amount £${formatPrice(
                total
            )}. 
            Pay ${PAYMENT_MONTHS} monthly payments of £${monthlyAmount}. 
            Total amount payable £${totalPayable}. 
            The interest rate for this purchase is ${INTEREST_RATE}%.<br>
            <strong>Representative example:</strong> Rate of interest ${INTEREST_RATE}% (variable). 
            ${INTEREST_RATE}% APR representative (variable). 
            Assumed Credit Limit £1,200.
        `;
    }

    function displayEmptyBasketMessage() {
        document.querySelector(".basket-content").innerHTML = `
            <div class="empty-basket">
                <p>Your basket is empty</p>
                <p>When you add items they'll appear here</p>
                <a href="{{ url('/products') }}" class="continue-shopping">Continue shopping</a>
            </div>`;
        document.querySelector(".basket-title").style.display = "none";
    }

    function showError(message) {
        const errorDiv = document.createElement("div");
        errorDiv.className = "error-message";
        errorDiv.textContent = message;
        document.querySelector(".basket-container").prepend(errorDiv);
        setTimeout(() => errorDiv.remove(), 3000);
    }

    // Initialize
    updateTotals();
    updatePaymentOptions(getCurrentTotal());

    // Make functions globally available
    window.showRemovePopup = showRemovePopup;
    window.removeItem = removeItem;
    window.closePopup = closePopup;
});
