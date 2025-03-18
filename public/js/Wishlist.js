   // Global variable to store the item being removed
   let currentItem;
    
    // Wait for the DOM to fully load before running the script
    document.addEventListener("DOMContentLoaded", function () {
      // Select all quantity input fields and price elements
      const quantityInputs = document.querySelectorAll(".quantity");
      const priceCells = document.querySelectorAll(".price");
      
      // Function to update total price and items in the wishlist
      function updateTotals() {
        let totalPrice = 0;
        let totalItems = 0;
        
        // Iterate through each quantity input field
        quantityInputs.forEach((input, index) => {
          const quantity = parseInt(input.value) || 0; // Use parseInt for whole numbers
          const priceText = priceCells[index].textContent.replace('£', '').replace(',', '');
          const price = parseFloat(priceText) || 0; // Handle commas in price formatting
          const total = quantity * price; // Calculate total price for this item
          
          totalPrice += total; // Add to overall total price
          totalItems += quantity; // Add to overall total items
        });
        
        // Update the total display with proper formatting for large numbers
        const wishlistTotal = document.getElementById("wishlist-total");
        if (wishlistTotal) {
          // Format number with commas for thousands
          wishlistTotal.textContent = totalPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
            <a href="{{ url('/home') }}" class="continue-shopping">Continue shopping</a>
          </div>`;
          
        const header = document.querySelector("h2");
        if (header) {
          header.style.display = "none"; // Hide the wishlist header
        }
      }
      
      // Add event listeners to update totals when quantity input changes
      quantityInputs.forEach((input) => {
        input.addEventListener("input", function() {
          // Ensure quantity is at least 1
          if (parseInt(this.value) < 1) {
            this.value = 1;
          }
          
          updateTotals();
          
          // Get the item ID and new quantity
          const itemId = this.getAttribute('data-item-id');
          const newQuantity = this.value;
          
          // Update quantity via AJAX if item ID is available
          if (itemId) {
            updateWishlistItemQuantity(itemId, newQuantity);
          }
        });
      });
      
      // Function to update wishlist item quantity via AJAX
      function updateWishlistItemQuantity(itemId, quantity) {
        // Get the CSRF token from meta tag
        const token = document.querySelector('meta[name="csrf-token"]');
        
        if (!token) {
          console.error("CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token");
          return;
        }
        
        fetch(`/wishlist/update/${itemId}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token.getAttribute('content')
          },
          body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
          console.log('Quantity updated successfully', data);
        })
        .catch(error => {
          console.error('Error updating quantity:', error);
        });
      }
      
      // Initial call to update totals
      updateTotals();
    });
    
    // Function to show the remove item popup
    function showRemovePopup(element) {
      currentItem = element.closest(".wishlist-item"); // Get the closest wishlist item element
      const popup = document.getElementById("remove-popup");
      if (popup) {
        popup.style.display = "flex"; // Show the popup
      }
    }
    
    // Function to remove an item from the wishlist
    function removeItem() {
      if (currentItem) {
        // Find the form within the current item and submit it
        const form = currentItem.querySelector('form');
        if (form) {
          form.submit();
        }
      }
      
      const popup = document.getElementById("remove-popup");
      if (popup) {
        popup.style.display = "none"; // Hide the popup
      }
    }
    
    // Function to close the remove item popup
    function closePopup() {
      const popup = document.getElementById("remove-popup");
      if (popup) {
        popup.style.display = "none"; // Hide the popup
      }
    }