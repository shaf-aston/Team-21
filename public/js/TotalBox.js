// Wait for the DOM to fully load before running the script
document.addEventListener("DOMContentLoaded", function () {
    // Since we already have these functions in Wishlist.js, we'll avoid
    // duplicating them here. This file can be kept for backward compatibility
    // or can be merged with Wishlist.js in the future.

    // Ensure this only runs if Wishlist.js hasn't already defined these functions
    if (typeof window.updateWishlistTotals !== "function") {
        // Get elements related to wishlist total, item count, and other dynamic contents
        const wishlistTotal = document.getElementById("wishlist-total");
        const itemCountHeader = document.getElementById("item-count-header");
        const itemLabel = document.getElementById("item-label");
        const quantityInputs = document.querySelectorAll(".quantity");
        const priceCells = document.querySelectorAll(".price");
        const checkoutBtn = document.querySelector(".btn-success");

        // Function to update the totals for the wishlist
        window.updateWishlistTotals = function () {
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
            if (wishlistTotal) {
                wishlistTotal.textContent = totalPrice.toFixed(2);
            }

            if (itemCountHeader) {
                itemCountHeader.textContent = totalItems;
            }

            // Update the item label based on the number of items
            if (itemLabel) {
                itemLabel.textContent = totalItems === 1 ? "item" : "items";
            }

            // If the wishlist is empty, display an empty wishlist message
            if (
                totalItems === 0 &&
                document.querySelector(".wishlist-container")
            ) {
                document.querySelector(".wishlist-container").innerHTML =
                    "<p>Your wishlist is empty</p><p>When you add items they'll appear here.</p>";

                if (document.querySelector(".total-box p")) {
                    document.querySelector(".total-box p").textContent = "";
                }

                if (checkoutBtn) {
                    checkoutBtn.style.display = "none";
                }
            }
        };

        // Add event listeners to update totals when quantity input changes
        quantityInputs.forEach((input) => {
            input.addEventListener("input", window.updateWishlistTotals);
        });

        // Initial call to update totals
        window.updateWishlistTotals();
    }
});
