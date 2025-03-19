// Global variable to store the item being removed
let currentItem;

// Wait for the DOM to fully load before running the script
document.addEventListener("DOMContentLoaded", function () {
    // Select all quantity input fields and price elements
    const quantityInputs = document.querySelectorAll(".quantity");
    const priceCells = document.querySelectorAll(".price");
    const token = document.querySelector('meta[name="csrf-token"]');

    // Function to update total price and items in the wishlist
    function updateTotals() {
        let totalPrice = 0;
        let totalItems = 0;

        // Iterate through each quantity input field
        quantityInputs.forEach((input, index) => {
            const quantity = parseInt(input.value) || 0;
            const priceText = priceCells[index].textContent
                .replace("£", "")
                .replace(",", "");
            const price = parseFloat(priceText) || 0;
            const total = quantity * price;

            totalPrice += total;
            totalItems += quantity;
        });

        // Update the total display with proper formatting
        const wishlistTotal = document.getElementById("wishlist-total");
        if (wishlistTotal) {
            wishlistTotal.textContent = formatPrice(totalPrice);
        }

        // Update item count in header
        const itemCountHeader = document.getElementById("item-count-header");
        if (itemCountHeader) {
            itemCountHeader.textContent = totalItems;
        }

        // Update item label (singular/plural)
        const itemLabel = document.getElementById("item-label");
        if (itemLabel) {
            itemLabel.textContent = totalItems === 1 ? "item" : "items";
        }

        // If wishlist is empty, display message
        if (totalItems === 0) {
            displayEmptyWishlistMessage();
        }
    }

    // Add debounced quantity input handlers
    quantityInputs.forEach((input) => {
        let timeout;
        let originalValue = input.value;

        input.addEventListener("input", function() {
            // Ensure quantity is at least 1
            const newQuantity = Math.max(parseInt(this.value) || 1, 1);
            this.value = newQuantity;
            
            // Update totals immediately for responsive UI
            updateTotals();
            
            // Update the Add to Basket form quantity
            const basketForm = this.closest('.product-details-row')
                .querySelector('form input[name="quantity"]');
            if (basketForm) {
                basketForm.value = newQuantity;
            }
            
            // Debounce the server update
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const itemId = this.getAttribute('data-item-id');
                if (itemId) {
                    updateWishlistItemQuantity(itemId, newQuantity);
                }
            }, 500);
        });

        // Handle blur event for invalid inputs
        input.addEventListener("blur", function() {
            if (!this.value || parseInt(this.value) < 1) {
                this.value = 1;
                updateTotals();
                
                const itemId = this.getAttribute('data-item-id');
                if (itemId) {
                    updateWishlistItemQuantity(itemId, 1);
                }
            }
        });
    });

    // Function to update wishlist item quantity via AJAX
    async function updateWishlistItemQuantity(itemId, quantity) {
        if (!token) {
            showMessage('CSRF token not found', 'error');
            return;
        }

        try {
            const response = await fetch(`/wishlist/update/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token.content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();
            showMessage('Quantity updated successfully', 'success');
        } catch (error) {
            console.error('Error updating quantity:', error);
            showMessage('Failed to update quantity', 'error');
        }
    }

    // Function to display empty wishlist message
    function displayEmptyWishlistMessage() {
        document.querySelector(".wishlist-content").innerHTML = `
            <div class="empty-wishlist">
                <p>Your wishlist is empty</p>
                <p>When you add items they'll appear here</p>
                <a href="/products" class="continue-shopping">Continue shopping</a>
            </div>`;
        
        const header = document.querySelector(".wishlist-title");
        if (header) header.style.display = "none";
    }

    // Function to format price with commas and 2 decimal places
    function formatPrice(price) {
        return price.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Function to show status messages
    function showMessage(message, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        messageDiv.textContent = message;
        
        document.querySelector('.wishlist-page').prepend(messageDiv);
        
        setTimeout(() => messageDiv.remove(), 3000);
    }

    // Remove item functionality
    window.removeItem = function() {
        if (!currentItem) return;
        
        const form = currentItem.querySelector('.hidden-form');
        if (form) {
            try {
                form.submit();
            } catch (error) {
                console.error('Error submitting form:', error);
                showMessage('Failed to remove item', 'error');
            }
        } else {
            console.error('Remove form not found');
            showMessage('Failed to remove item', 'error');
        }
        
        closePopup();
    };

    // Show remove popup
    window.showRemovePopup = function(element) {
        currentItem = element.closest(".wishlist-item");
        const popup = document.getElementById("remove-popup");
        if (popup) {
            popup.style.display = "flex";
            popup.querySelector("button.remove-button").focus();
        }
    };

    // Close popup
    window.closePopup = function() {
        const popup = document.getElementById("remove-popup");
        if (popup) {
            popup.style.display = "none";
        }
        currentItem = null;
    };

    // Initialize totals on page load
    updateTotals();
});