// Wait for the DOM to fully load before running the script
document.addEventListener("DOMContentLoaded", function () {
    // Get elements related to basket total, item count, and other dynamic contents
    const basketTotal = document.getElementById("basket-total");
    const itemCountHeader = document.getElementById("item-count-header");
    const itemLabel = document.getElementById("item-label");
    const monthlyPayment = document.getElementById("monthly-payment");
    const buyLaterDate = document.getElementById("buy-later-date");
    const disclaimer = document.querySelector(".disclaimer");
    const quantityInputs = document.querySelectorAll(".quantity");
    const priceCells = document.querySelectorAll(".price");
    const paymentCheckboxes = document.querySelectorAll(".payment-checkbox");
    const interestRate = 19.9 / 100; // 19.9% interest rate
    const months = 36; // 36 months for the calculation

    // Function to update the totals for the basket
    function updateTotals() {
        let totalPrice = 0;
        let totalItems = 0;

        // Iterate over each quantity input to calculate totals
        quantityInputs.forEach((input, index) => {
            const quantity = parseFloat(input.value); // Get the quantity value
            const price = parseFloat(
                priceCells[index].textContent.replace("£", "")
            ); // Get the price value
            const total = quantity * price; // Calculate total price for this item
            totalPrice += total; // Add to overall total price
            totalItems += quantity; // Add to overall total items
        });

        // Update the basket total and item count display
        basketTotal.textContent = totalPrice.toFixed(2);
        itemCountHeader.textContent = totalItems;

        // Update the item label based on the number of items
        if (totalItems === 1) {
            itemLabel.textContent = "item";
        } else {
            itemLabel.textContent = "items";
        }

        // If the basket is empty, display an empty basket message
        if (totalItems === 0) {
            document.querySelector(".basket-container").innerHTML =
                "<p>Your basket is empty</p><p>When you add items they'll appear here.</p>";
            document.querySelector(".total-box p").textContent = "";
            document.querySelector(".checkout-btn").style.display = "none";
        } else {
            // Calculate monthly payment with interest
            const monthly = (
                (totalPrice * (1 + interestRate)) /
                months
            ).toFixed(2);
            monthlyPayment.textContent = `From £${monthly} for 36 months`;

            // Calculate the buy later date
            const now = new Date();
            const laterDate = new Date(now.setMonth(now.getMonth() + 12));
            const formattedDate = laterDate.toLocaleDateString("en-GB", {
                year: "numeric",
                month: "long",
                day: "numeric",
            });
            buyLaterDate.textContent = `Pay as much as you'd like for 12 months, settle in full by ${formattedDate} and pay no interest`;

            // Update the disclaimer dynamically
            const totalAmountPayable = (monthly * months).toFixed(2);
            disclaimer.innerHTML = `<strong>Illustrative example:</strong> Credit amount £${totalPrice.toFixed(
                2
            )}. Pay 36 monthly payments of £${monthly}. Total amount payable £${totalAmountPayable}. The interest rate for this purchase is 19.9%.<br><strong>Representative example:</strong> Rate of interest 19.9% (variable). 19.9% APR representative (variable). Assumed Credit Limit £1,200.`;
        }
    }

    // Add event listeners to update totals when quantity input changes
    quantityInputs.forEach((input) => {
        input.addEventListener("input", updateTotals);
    });

    // Ensure only one payment checkbox can be selected at a time
    paymentCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            if (this.checked) {
                paymentCheckboxes.forEach((otherCheckbox) => {
                    if (otherCheckbox !== this) {
                        otherCheckbox.checked = false;
                    }
                });
            }
        });
    });

    // Initial call to update totals
    updateTotals();
});
