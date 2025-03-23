// Wait for the DOM to fully load before running the script
document.addEventListener("DOMContentLoaded", function () {
    // Select all quantity input fields and price elements
    const quantityInputs = document.querySelectorAll(".quantity");
    const priceCells = document.querySelectorAll(".price");
    let currentItem; // Variable to store the item being removed

    // Function to update total price and items in the wishlist
    function updateTotals() {
        let totalPrice = 0;
        let totalItems = 0;

        // Iterate through each quantity input field
        quantityInputs.forEach((input, index) => {
            const quantity = parseFloat(input.value); // Get the quantity value
            const price = parseFloat(
                priceCells[index].textContent.replace("£", "")
            ); // Get the price value
            const total = quantity * price; // Calculate total price for this item
            totalPrice += total; // Add to overall total price
            totalItems += quantity; // Add to overall total items
        });

        // If wishlist is empty, display an empty wishlist message
        if (totalItems === 0) {
            displayEmptyWishlistMessage();
        }
    }

    // Function to display a message when the wishlist is empty
    function displayEmptyWishlistMessage() {
        document.querySelector(".wishlist-content").innerHTML = ` 
            <div class="empty-wishlist"> 
                <p>Your wishlist is empty</p> 
                <p>When you add items they'll appear here</p> 

                
                <a href="HomePage.html" class="continue-shopping">Continue shopping</a> 
            </div>`;

        document.querySelector("h2").style.display = "none"; // Hide the wishlist header
    }

    // Add event listeners to update totals when quantity input changes
    quantityInputs.forEach((input) => {
        input.addEventListener("input", updateTotals);
    });

    // Initial call to update totals
    updateTotals();
});

// Function to show the remove item popup
function showRemovePopup(element) {
    currentItem = element.closest(".wishlist-item"); // Get the closest wishlist item element
    document.getElementById("remove-popup").style.display = "flex"; // Show the popup
}

// Function to remove an item from the wishlist
function removeItem() {
    // Clear the wishlist content
    displayEmptyWishlistMessage();
    document.getElementById("remove-popup").style.display = "none"; // Hide the popup
}

// Function to close the remove item popup
function closePopup() {
    document.getElementById("remove-popup").style.display = "none"; // Hide the popup
}

// Function to display a message when the wishlist is empty
function displayEmptyWishlistMessage() {
    document.querySelector(".wishlist-content").innerHTML = ` 
        <div class="empty-wishlist"> 
            <p>Your wishlist is empty</p> 
            <p>When you add items they'll appear here</p> 
            <a href="HomePage.html" class="continue-shopping">Continue shopping</a> 
        </div>`;

    document.querySelector("h2").style.display = "none"; // Hide the wishlist header
}
