// Wait for the DOM to fully load before running the script
document.addEventListener("DOMContentLoaded", function () {
    // Get elements related to wishlist total, item count, and other dynamic contents
    const wishlistTotal = document.getElementById("wishlist-total");
    const itemCountHeader = document.getElementById("item-count-header");
    const itemLabel = document.getElementById("item-label");
    const disclaimer = document.querySelector(".disclaimer");
    const quantityInputs = document.querySelectorAll(".quantity");
    const priceCells = document.querySelectorAll(".price");

    // Function to update the totals for the wishlist
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

        // Update the wishlist total and item count display
        wishlistTotal.textContent = totalPrice.toFixed(2);
        itemCountHeader.textContent = totalItems;

        // Update the item label based on the number of items
        if (totalItems === 1) {
            itemLabel.textContent = "item";
        } else {
            itemLabel.textContent = "items";
        }

        // If the wishlist is empty, display an empty wishlist message
        if (totalItems === 0) {
            document.querySelector(".wishlist-container").innerHTML =
                "<p>Your wishlist is empty</p><p>When you add items they'll appear here.</p>";
            document.querySelector(".total-box p").textContent = "";
            document.querySelector(".checkout-btn").style.display = "none";
        }
    }

    // Add event listeners to update totals when quantity input changes
    quantityInputs.forEach((input) => {
        input.addEventListener("input", updateTotals);
    });

    // Initial call to update totals
    updateTotals();
});
