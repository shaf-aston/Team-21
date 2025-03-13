//search bar functioning
document.querySelector(".search-icon").addEventListener("click", function () {
    const searchQuery = document.querySelector(".search-bar").value.trim();
    if (searchQuery) {
        window.location.href = `/search?q=${encodeURIComponent(searchQuery)}`;
    } else {
        alert("Please enter a search term.");
    }
});

//errors when form is filled out incorrect
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("checkoutForm");
    const notificationBox = document.createElement("div"); // Notification
    notificationBox.style.marginTop = "20px";
    notificationBox.style.textAlign = "center";
    notificationBox.style.fontSize = "1.2rem";
    form.appendChild(notificationBox);

    // function to validate inputs
    function validateForm() {
        const fullName = document.getElementById("fullName").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const address = document.getElementById("address").value.trim();
        const city = document.getElementById("city").value.trim();
        const zip = document.getElementById("zip").value.trim();
        const cardName = document.getElementById("cardName").value.trim();
        const cardNumber = document.getElementById("cardNumber").value.trim();
        const expiryDate = document.getElementById("expiryDate").value.trim();
        const cvv = document.getElementById("cvv").value.trim();

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^[0-9]{10,15}$/;
        const cardNumberRegex = /^[0-9]{16}$/;
        const cvvRegex = /^[0-9]{3}$/;

        if (
            !fullName ||
            !email ||
            !phone ||
            !address ||
            !city ||
            !zip ||
            !cardName ||
            !cardNumber ||
            !expiryDate ||
            !cvv
        ) {
            return "All fields are required!";
        }

        if (!emailRegex.test(email)) {
            return "Please enter a valid email address.";
        }

        if (!phoneRegex.test(phone)) {
            return "Please enter a valid phone number.";
        }

        if (!cardNumberRegex.test(cardNumber)) {
            return "Card number must be 16 digits.";
        }

        if (!cvvRegex.test(cvv)) {
            return "CVV must be 3 digits.";
        }

        return ""; // Return if no errors
    }

    // form submission
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const errorMessage = validateForm();
        if (errorMessage) {
            notificationBox.textContent = errorMessage;
            notificationBox.style.color = "red";
        } else {
            notificationBox.textContent =
                "Payment was successful! Thank you for your order.";
            notificationBox.style.color = "green";

            // Clear form inputs after successful submission
            form.reset();
        }
        console.log(errorMessage);
    });
});
