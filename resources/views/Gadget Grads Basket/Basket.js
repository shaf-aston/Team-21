// Wait for the DOM to fully load before running the script
document.addEventListener('DOMContentLoaded', function() { 
    // Select all quantity input fields and price elements
    const quantityInputs = document.querySelectorAll('.quantity'); 
    const priceCells = document.querySelectorAll('.price'); 
    let currentItem; // Variable to store the item being removed

    // Function to update total price and items in the basket
    function updateTotals() { 
        let totalPrice = 0; 
        let totalItems = 0; 

        // Iterate through each quantity input field
        quantityInputs.forEach((input, index) => { 
            const quantity = parseFloat(input.value); // Get the quantity value
            const price = parseFloat(priceCells[index].textContent.replace('£', '')); // Get the price value
            const total = quantity * price; // Calculate total price for this item
            totalPrice += total; // Add to overall total price
            totalItems += quantity; // Add to overall total items
        }); 

        // If basket is empty, display an empty basket message
        if (totalItems === 0) { 
            displayEmptyBasketMessage(); 
        } 
    } 

    // Function to display a message when the basket is empty
    function displayEmptyBasketMessage() { 
        document.querySelector('.basket-content').innerHTML = ` 
            <div class="empty-basket"> 
                <p>Your basket is empty</p> 
                <p>When you add items they'll appear here</p> 
                <a href="HomePage.html" class="continue-shopping">Continue shopping</a> 
            </div>`; 

        document.querySelector('h2').style.display = 'none'; // Hide the basket header
    } 

    // Add event listeners to update totals when quantity input changes
    quantityInputs.forEach(input => { 
        input.addEventListener('input', updateTotals); 
    }); 

    // Initial call to update totals
    updateTotals(); 
}); 

// Function to show the remove item popup
function showRemovePopup(element) { 
    currentItem = element.closest('.basket-item'); // Get the closest basket item element
    document.getElementById('remove-popup').style.display = 'flex'; // Show the popup
} 

// Function to remove an item from the basket
function removeItem() { 
    // Clear the basket content
    displayEmptyBasketMessage(); 
    document.getElementById('remove-popup').style.display = 'none'; // Hide the popup
} 

// Function to close the remove item popup
function closePopup() { 
    document.getElementById('remove-popup').style.display = 'none'; // Hide the popup
} 

// Function to display a message when the basket is empty
function displayEmptyBasketMessage() { 
    document.querySelector('.basket-content').innerHTML = ` 
        <div class="empty-basket"> 
            <p>Your basket is empty</p> 
            <p>When you add items they'll appear here</p> 
            <a href="HomePage.html" class="continue-shopping">Continue shopping</a> 
        </div>`; 

    document.querySelector('h2').style.display = 'none'; // Hide the basket header
}
