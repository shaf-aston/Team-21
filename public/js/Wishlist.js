let currentItem;
let activeRequests = {};

// Wait for the DOM to fully load before running the script
document.addEventListener("DOMContentLoaded", function () {
    const quantityInputs = document.querySelectorAll(".quantity");
    const priceCells = document.querySelectorAll(".price");
    const token = document.querySelector('meta[name="csrf-token"]');
    const wishlistPage = document.querySelector(".wishlist-page");

    const popup = document.getElementById("remove-popup");
    if (popup) {
        popup.setAttribute("role", "dialog");
        popup.setAttribute("aria-modal", "true");
        popup.setAttribute("aria-labelledby", "remove-popup-title");

        if (!popup.querySelector('[id="remove-popup-title"]')) {
            const titleElement = popup.querySelector(".popup-content p");
            if (titleElement) {
                titleElement.id = "remove-popup-title";
            }
        }
    }

    // Function to update total price and items in the wishlist
    function updateTotals() {
        let totalPrice = 0;
        let totalItems = 0;

        quantityInputs.forEach((input, index) => {
            if (!input || !priceCells[index]) return;

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
        if (totalItems === 0 && document.querySelector(".wishlist-container")) {
            displayEmptyWishlistMessage();
        }

        return { totalPrice, totalItems };
    }

    // Add debounced quantity input handlers with request cancellation
    quantityInputs.forEach((input) => {
        let timeout;

        input.addEventListener("input", function () {
            // Ensure quantity is at least 1
            const newQuantity = Math.max(parseInt(this.value) || 1, 1);
            this.value = newQuantity;

            // Update totals immediately for responsive UI
            updateTotals();

            // Update the Add to Basket form quantity
            const basketForm = this.closest(
                ".product-details-row"
            )?.querySelector('form input[name="quantity"]');
            if (basketForm) {
                basketForm.value = newQuantity;
            }

            // Debounce the server update with request cancellation
            const itemId = this.getAttribute("data-item-id");
            if (!itemId) return;

            clearTimeout(timeout);

            // Cancel previous request for this item if it exists
            if (activeRequests[itemId]) {
                activeRequests[itemId].abort();
                delete activeRequests[itemId];
            }

            timeout = setTimeout(() => {
                updateWishlistItemQuantity(itemId, newQuantity);
            }, 500);
        });

        // Handle blur event for invalid inputs
        input.addEventListener("blur", function () {
            if (!this.value || parseInt(this.value) < 1) {
                this.value = 1;
                updateTotals();

                const itemId = this.getAttribute("data-item-id");
                if (itemId) {
                    updateWishlistItemQuantity(itemId, 1);
                }
            }
        });

        input.setAttribute("aria-label", "Quantity");
    });

    async function updateWishlistItemQuantity(itemId, quantity) {
        if (!token) {
            showMessage("CSRF token not found", "error");
            return;
        }
    
        try {
            const controller = new AbortController();
            activeRequests[itemId] = controller;
    
            // Create FormData instead of JSON
            const formData = new FormData();
            formData.append('quantity', quantity);
            formData.append('_token', token.content);
    
            const response = await fetch(`/wishlist/update/${itemId}`, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': token.content,
                    'Accept': 'application/json'
                },
                body: formData,
                signal: controller.signal
            });
    
            delete activeRequests[itemId];
    
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
    
            const data = await response.json();
    
            if (data.success) {
                // Update the basket form quantity to match
                const basketForm = document
                    .querySelector(`.quantity[data-item-id="${itemId}"]`)
                    ?.closest(".product-details-row")
                    ?.querySelector('form input[name="quantity"]');
                
                if (basketForm) {
                    basketForm.value = quantity;
                }
    
                updateTotals();
                showMessage("Quantity updated successfully", "success");
            } else {
                throw new Error(data.message || "Failed to update quantity");
            }
    
        } catch (error) {
            if (error.name === "AbortError") return;
    
            console.error("Error updating quantity:", error);
            showMessage(error.message || "Failed to update quantity", "error");
    
            // Revert to original value on server error
            const input = document.querySelector(
                `.quantity[data-item-id="${itemId}"]`
            );
            if (input) {
                const originalQuantity = parseInt(
                    input.getAttribute("data-original-quantity") || 1
                );
                input.value = originalQuantity;
                updateTotals();
            }
        }
    }

    // Function to display empty wishlist message
    function displayEmptyWishlistMessage() {
        const wishlistContent = document.querySelector(".wishlist-content");
        if (!wishlistContent) return;

        wishlistContent.innerHTML = `
            <div class="empty-wishlist">
                <p>Your wishlist is empty</p>
                <p>When you add items they'll appear here</p>
                <a href="/products" class="continue-shopping" role="button">Continue shopping</a>
            </div>`;

        const header = document.querySelector(".wishlist-title");
        if (header) header.style.display = "none";
    }

    // Function to format price with commas and 2 decimal places
    function formatPrice(price) {
        return price.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Function to show status messages with improved accessibility
    function showMessage(message, type) {
        // Remove any existing message of the same type
        const existingMessages = document.querySelectorAll(`.message.${type}`);
        existingMessages.forEach((msg) => msg.remove());

        const messageDiv = document.createElement("div");
        messageDiv.className = `message ${type}`;
        messageDiv.textContent = message;
        messageDiv.setAttribute("role", "alert");
        messageDiv.setAttribute("aria-live", "assertive");

        if (wishlistPage) {
            wishlistPage.prepend(messageDiv);
        } else {
            document.body.prepend(messageDiv);
        }

        setTimeout(() => {
            messageDiv.classList.add("fade-out");
            setTimeout(() => messageDiv.remove(), 500);
        }, 3000);
    }

    // Remove item functionality with improved error handling
    window.removeItem = function () {
        if (!currentItem) return;

        const form = currentItem.querySelector(".hidden-form");
        if (form) {
            try {
                // Disable the remove button to prevent double-submission
                const removeButton = document.querySelector(
                    "#remove-popup .remove-button"
                );
                if (removeButton) {
                    removeButton.disabled = true;
                    removeButton.textContent = "Removing...";
                }

                form.submit();
            } catch (error) {
                console.error("Error submitting form:", error);
                showMessage("Failed to remove item", "error");

                // Re-enable the button on error
                if (removeButton) {
                    removeButton.disabled = false;
                    removeButton.textContent = "Yes";
                }
            }
        } else {
            console.error("Remove form not found");
            showMessage("Failed to remove item", "error");
        }

        closePopup();
    };

    // Show remove popup with improved accessibility
    window.showRemovePopup = function (element) {
        currentItem = element.closest(".wishlist-item");
        if (!currentItem) return;

        const popup = document.getElementById("remove-popup");
        if (popup) {
            popup.style.display = "flex";

            // Trap focus in the modal
            const focusableElements = popup.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            const firstFocusable = focusableElements[0];
            const lastFocusable =
                focusableElements[focusableElements.length - 1];

            // Focus the first button
            firstFocusable.focus();

            // Handle keyboard navigation for accessibility
            popup.addEventListener("keydown", function (e) {
                if (e.key === "Escape") {
                    closePopup();
                    return;
                }

                if (e.key !== "Tab") return;

                if (e.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        lastFocusable.focus();
                        e.preventDefault();
                    }
                } else {
                    if (document.activeElement === lastFocusable) {
                        firstFocusable.focus();
                        e.preventDefault();
                    }
                }
            });
        }
    };

    // Close popup with improved accessibility
    window.closePopup = function () {
        const popup = document.getElementById("remove-popup");
        if (popup) {
            popup.style.display = "none";

            // Return focus to the element that opened the popup
            if (currentItem) {
                const removeLink = currentItem.querySelector(".remove-link");
                if (removeLink) {
                    removeLink.focus();
                }
            }
        }
        currentItem = null;
    };

    // Store original quantity for revert on error
    quantityInputs.forEach((input) => {
        input.setAttribute("data-original-quantity", input.value);
    });

    // Initialize totals on page load
    updateTotals();
    


    // Add keyboard handler for popup
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closePopup();
        }
    });
});