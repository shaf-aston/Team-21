let currentItem;

document.addEventListener("DOMContentLoaded", function () {
    const quantityInputs = document.querySelectorAll(".quantity");
    const priceCells = document.querySelectorAll(".price");
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const popup = document.getElementById("remove-popup");

    // Close popup when clicking outside
    window.addEventListener("click", (e) => {
        if (e.target === popup) {
            closePopup();
        }
    });

    // Close popup with Escape key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closePopup();
        }
    });

    function updateTotals() {
        let totalPrice = 0;
        let totalItems = 0;

        quantityInputs.forEach((input, index) => {
            const quantity = parseInt(input.value) || 0;
            const priceText = priceCells[index].textContent.replace('£', '').replace(',', '');
            const price = parseFloat(priceText) || 0;
            totalPrice += quantity * price;
            totalItems += quantity;
        });

        const basketTotal = document.getElementById("basket-total");
        if (basketTotal) {
            basketTotal.textContent = totalPrice.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        const itemCountHeader = document.getElementById("item-count-header");
        if (itemCountHeader) {
            itemCountHeader.textContent = totalItems;
        }

        const itemLabel = document.getElementById("item-label");
        if (itemLabel) {
            itemLabel.textContent = totalItems === 1 ? "item" : "items";
        }

        if (totalItems === 0) {
            displayEmptyBasketMessage();
        }

        return { totalPrice, totalItems };
    }

    async function updateBasketItem(itemId, quantity) {
        try {
            const response = await fetch(`/basket/update/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ quantity })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            return await response.json();
        } catch (error) {
            console.error('Error updating basket:', error);
            showError('Failed to update basket. Please try again.');
        }
    }

    quantityInputs.forEach(input => {
        let timeout;
        input.addEventListener("input", () => {
            // Minimum quantity validation
            if (parseInt(input.value) < 1) {
                input.value = 1;
            }

            // Debounce the update
            clearTimeout(timeout);
            timeout = setTimeout(async () => {
                const totals = updateTotals();
                const itemId = input.closest('.basket-item').dataset.itemId;
                await updateBasketItem(itemId, input.value);
                updatePaymentOptions(totals.totalPrice);
            }, 500);
        });
    });

    function updatePaymentOptions(total) {
        const monthlyPayment = document.getElementById("monthly-payment");
        if (monthlyPayment) {
            const monthlyAmount = ((total * (1 + 19.9/100)) / 36).toFixed(2);
            monthlyPayment.textContent = `From £${monthlyAmount} for 36 months`;
        }

        const buyLaterDate = document.getElementById("buy-later-date");
        if (buyLaterDate) {
            const date = new Date();
            date.setFullYear(date.getFullYear() + 1);
            const formattedDate = date.toLocaleDateString('en-GB', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            buyLaterDate.textContent = `Pay as much as you'd like for 12 months, settle in full by ${formattedDate} and pay no interest`;
        }

        // Update disclaimer
        const disclaimer = document.querySelector(".disclaimer");
        if (disclaimer) {
            const monthlyAmount = ((total * (1 + 19.9/100)) / 36).toFixed(2);
            const totalPayable = (monthlyAmount * 36).toFixed(2);
            disclaimer.innerHTML = `
                <strong>Illustrative example:</strong> Credit amount £${total.toFixed(2)}. 
                Pay 36 monthly payments of £${monthlyAmount}. 
                Total amount payable £${totalPayable}. 
                The interest rate for this purchase is 19.9%.<br>
                <strong>Representative example:</strong> Rate of interest 19.9% (variable). 
                19.9% APR representative (variable). 
                Assumed Credit Limit £1,200.
            `;
        }
    }

    function showRemovePopup(element) {
        currentItem = element.closest(".basket-item");
        popup.style.display = "flex";
        popup.querySelector("button.remove-button").focus();
    }

    function removeItem() {
        if (!currentItem) return;
        
        const itemId = currentItem.dataset.itemId;
        const form = currentItem.querySelector('form');
        
        if (form) {
            form.submit();
        } else {
            console.error('Remove form not found');
        }
        
        closePopup();
    }

    function closePopup() {
        popup.style.display = "none";
        currentItem = null;
    }

    function displayEmptyBasketMessage() {
        document.querySelector(".basket-content").innerHTML = `
            <div class="empty-basket">
                <p>Your basket is empty</p>
                <p>When you add items they'll appear here</p>
                <a href="/nav" class="continue-shopping">Continue shopping</a>
            </div>`;
        document.querySelector(".basket-title").style.display = "none";
    }

    function showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        document.querySelector('.basket-container').prepend(errorDiv);
        setTimeout(() => errorDiv.remove(), 3000);
    }

    // Initialize the basket
    updateTotals();
    updatePaymentOptions(parseFloat(document.getElementById("basket-total").dataset.initialTotal) || 0);

    // Make functions globally available
    window.showRemovePopup = showRemovePopup;
    window.removeItem = removeItem;
    window.closePopup = closePopup;
});