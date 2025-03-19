document.addEventListener("DOMContentLoaded", function () {
    // Constants
    const INTEREST_RATE = 19.9 / 100;
    const PAYMENT_MONTHS = 36;

    // DOM Elements
    const monthlyPayment = document.getElementById("monthly-payment");
    const buyLaterDate = document.getElementById("buy-later-date");
    const disclaimer = document.querySelector(".disclaimer");
    const paymentCheckboxes = document.querySelectorAll(".payment-checkbox");
    const paymentDetails = document.querySelector(".payment-details");

    // Payment method selection handler
    function initializePaymentMethods() {
        paymentCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                if (this.checked) {
                    // Uncheck other checkboxes
                    paymentCheckboxes.forEach((otherCheckbox) => {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;
                        }
                    });
                    
                    // Show/hide payment details based on selection
                    if (this.closest('label').textContent.includes('Spread the cost')) {
                        paymentDetails.style.display = 'block';
                        updatePaymentInformation(getCurrentBasketTotal());
                    } else {
                        paymentDetails.style.display = 'none';
                    }
                }
            });
        });
    }

    // Update payment information
    function updatePaymentInformation(totalPrice) {
        updateMonthlyPayment(totalPrice);
        updateBuyLaterDate();
        updateDisclaimer(totalPrice);
    }

    function updateMonthlyPayment(totalPrice) {
        const monthly = ((totalPrice * (1 + INTEREST_RATE)) / PAYMENT_MONTHS).toFixed(2);
        monthlyPayment.textContent = `From £${monthly} for ${PAYMENT_MONTHS} months`;
        return monthly;
    }

    function updateBuyLaterDate() {
        const now = new Date();
        const laterDate = new Date(now.setMonth(now.getMonth() + 12));
        const formattedDate = laterDate.toLocaleDateString("en-GB", {
            year: "numeric",
            month: "long",
            day: "numeric",
        });
        buyLaterDate.textContent = `Pay as much as you'd like for 12 months, settle in full by ${formattedDate} and pay no interest`;
    }

    function updateDisclaimer(totalPrice) {
        const monthly = updateMonthlyPayment(totalPrice);
        const totalAmountPayable = (monthly * PAYMENT_MONTHS).toFixed(2);
        disclaimer.innerHTML = `<strong>Illustrative example:</strong> Credit amount £${totalPrice.toFixed(2)}. 
            Pay ${PAYMENT_MONTHS} monthly payments of £${monthly}. 
            Total amount payable £${totalAmountPayable}. 
            The interest rate for this purchase is ${INTEREST_RATE * 100}%.<br>
            <strong>Representative example:</strong> Rate of interest ${INTEREST_RATE * 100}% (variable). 
            ${INTEREST_RATE * 100}% APR representative (variable). 
            Assumed Credit Limit £1,200.`;
    }

    function getCurrentBasketTotal() {
        const basketTotal = document.getElementById("basket-total");
        return basketTotal ? parseFloat(basketTotal.textContent) : 0;
    }

    // Initialize payment methods
    initializePaymentMethods();
});