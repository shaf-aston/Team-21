document.addEventListener("DOMContentLoaded", () => {
    // Get all necessary DOM elements
    const authPopup = document.getElementById("auth-popup");
    const signupPopup = document.getElementById("signup-popup");
    const forgotPasswordPopup = document.getElementById("forgot-password-popup");
    const closeBtns = document.querySelectorAll(".close-btn");

    const loginBtns = document.querySelectorAll(".login-btn");
    const registerBtn = document.querySelectorAll(".register-btn");

    const signupLink = document.getElementById("signup-link");
    const forgotPasswordLink = document.getElementById("forgot-password-link");
    const backToLoginSignup = document.getElementById("back-to-login-signup");
    const backToLoginForgot = document.getElementById("back-to-login-forgot");
    const eyeIcons = document.querySelectorAll(".eye-icon");

    const openPopup = (popup) => {
        if (!popup) return;
        popup.style.display = "block";
        // Give the browser a moment to process the display change before adding the active class
        setTimeout(() => {
            popup.classList.add("active");
        }, 10);
    };

    const closePopup = (popup) => {
        if (!popup) return;
        popup.classList.remove("active");
        setTimeout(() => {
            popup.style.display = "none";
        }, 300);
    };

    const togglePopup = (popup) => {
        if (!popup) return;
        
        if (popup.style.display === "block") {
            closePopup(popup);
        } else {
            openPopup(popup);
        }
    };

    // Close popups when clicking outside
    window.addEventListener("click", (event) => {
        if (event.target.classList.contains("auth-popup")) {
            [authPopup, signupPopup, forgotPasswordPopup].forEach((popup) => {
                if (popup && popup === event.target) {
                    closePopup(popup);
                }
            });
        }
    });

    // Close popups with Escape key
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            [authPopup, signupPopup, forgotPasswordPopup].forEach((popup) => {
                if (popup && popup.style.display === "block") {
                    closePopup(popup);
                }
            });
        }
    });

    // Event listeners for close buttons
    closeBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            const popup = btn.closest(".auth-popup");
            closePopup(popup);
        });
    });

    // Login button handlers
    if (loginBtns && loginBtns.length > 0) {
        loginBtns.forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation(); // Prevent event bubbling
                openPopup(authPopup);
            });
        });
    }

    // Register button handlers
    if (registerBtn && registerBtn.length > 0) {
        registerBtn.forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation(); // Prevent event bubbling
                openPopup(signupPopup);
            });
        });
    }

    // Switch to signup popup
    if (signupLink) {
        signupLink.addEventListener("click", (e) => {
            e.preventDefault();
            closePopup(authPopup);
            openPopup(signupPopup);
        });
    }

    // Switch to forgot password popup
    if (forgotPasswordLink) {
        forgotPasswordLink.addEventListener("click", (e) => {
            e.preventDefault();
            closePopup(authPopup);
            openPopup(forgotPasswordPopup);
        });
    }

    // Back to login links
    if (backToLoginSignup) {
        backToLoginSignup.addEventListener("click", (e) => {
            e.preventDefault();
            closePopup(signupPopup);
            openPopup(authPopup);
        });
    }

    if (backToLoginForgot) {
        backToLoginForgot.addEventListener("click", (e) => {
            e.preventDefault();
            closePopup(forgotPasswordPopup);
            openPopup(authPopup);
        });
    }

    // Keep popup open if there are errors
    if (authPopup && authPopup.querySelector(".text-danger")) {
        openPopup(authPopup);
    }
    if (signupPopup && signupPopup.querySelector(".text-danger")) {
        openPopup(signupPopup);
    }
    if (forgotPasswordPopup && forgotPasswordPopup.querySelector(".text-danger")) {
        openPopup(forgotPasswordPopup);
    }

    // Eye icon functionality for password fields
    eyeIcons.forEach((eyeIcon) => {
        eyeIcon.addEventListener("click", () => {
            const input = eyeIcon.previousElementSibling;
            const type = input.type === "password" ? "text" : "password";
            input.type = type;
            
            // Fix path to eye icons
            eyeIcon.src = type === "password" 
                ? "/images/eye-open.svg" 
                : "/images/eye-closed.svg";
                
            eyeIcon.alt = type === "password" ? "Show Password" : "Hide Password";
        });
    });
});