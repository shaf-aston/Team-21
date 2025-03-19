document.addEventListener("DOMContentLoaded", function () {
    // Constants
    const INTEREST_RATE = 19.9 / 100;
    const PAYMENT_MONTHS = 36;

    // DOM Elements
    const monthlyPayment = document.getElementById("monthly-payment");
    const buyLaterDate = document.getElementById("buy-later-date");
    const disclaimer = document.querySelector(".disclaimer");
    const paymentRadios = document.querySelectorAll(".payment-radio");
    const paymentDetails = document.querySelector(".payment-details");

    // Payment method selection handler
    function initializePaymentMethods() {
        paymentDetails.style.display = 'none';
    
        paymentRadios.forEach((radio) => {
            radio.addEventListener("change", function () {
                const isSpreadCost = this.value === 'spread_cost';
                paymentDetails.style.display = isSpreadCost ? 'block' : 'none';
                
                if (isSpreadCost) {
                    updatePaymentInformation(getCurrentBasketTotal());
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