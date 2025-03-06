document.addEventListener("DOMContentLoaded", () => {
    // Get all necessary DOM elements
    const authPopup = document.getElementById("auth-popup");
    const signupPopup = document.getElementById("signup-popup");
    const forgotPasswordPopup = document.getElementById(
        "forgot-password-popup"
    );
    const closeBtns = document.querySelectorAll(".close-btn");
    const loginBtn = document.getElementById("login-btn");
    const signupLink = document.getElementById("signup-link");
    const forgotPasswordLink = document.getElementById("forgot-password-link");
    const backToLoginSignup = document.getElementById("back-to-login-signup");
    const backToLoginForgot = document.getElementById("back-to-login-forgot");
    const eyeIcons = document.querySelectorAll(".eye-icon");

    const togglePopup = (popup) => {
        if (popup.style.display === 'block') {
            popup.classList.remove('active');
            setTimeout(() => {
                popup.style.display = 'none';
            }, 300);
        } else {
            popup.style.display = 'block';
            setTimeout(() => {
                popup.classList.add('active');
            }, 10);
        }
    };
    // Event listeners for close buttons
    closeBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            togglePopup(btn.closest(".auth-popup"));
        });
    });

    // Show login popup
    loginBtn.addEventListener("click", () => {
        togglePopup(authPopup);
    });

    // Switch to signup popup
    signupLink.addEventListener("click", (e) => {
        e.preventDefault();
        togglePopup(authPopup);
        togglePopup(signupPopup);
    });

    // Switch to forgot password popup
    forgotPasswordLink.addEventListener("click", (e) => {
        e.preventDefault();
        togglePopup(authPopup);
        togglePopup(forgotPasswordPopup);
    });

    // Back to login from signup
    backToLoginSignup.addEventListener("click", (e) => {
        e.preventDefault();
        togglePopup(signupPopup);
        togglePopup(authPopup);
    });

    // Back to login from forgot password
    backToLoginForgot.addEventListener("click", (e) => {
        e.preventDefault();
        togglePopup(forgotPasswordPopup);
        togglePopup(authPopup);
    });

    // Toggle password visibility
    eyeIcons.forEach((eyeIcon) => {
        eyeIcon.addEventListener("click", () => {
            const input = eyeIcon.previousElementSibling;
            const type = input.type === "password" ? "text" : "password";
            input.type = type;
            eyeIcon.src =
                type === "password"
                    ? "images/eye-open.svg"
                    : "images/eye-closed.svg";
            eyeIcon.alt =
                type === "password" ? "Show Password" : "Hide Password";
        });
    });

    // Close popups with Escape key
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            [authPopup, signupPopup, forgotPasswordPopup].forEach((popup) => {
                if (popup.style.display === "block") {
                    togglePopup(popup);
                }
            });
        }
    });

    // Close popups when clicking outside
    window.addEventListener("click", (event) => {
        [authPopup, signupPopup, forgotPasswordPopup].forEach((popup) => {
            if (event.target === popup) {
                togglePopup(popup);
            }
        });
    });

    // Keep popup open if there are errors
    if (authPopup.querySelector(".text-danger"))
        authPopup.style.display = "block";
    if (signupPopup.querySelector(".text-danger"))
        signupPopup.style.display = "block";
    if (forgotPasswordPopup.querySelector(".text-danger"))
        forgotPasswordPopup.style.display = "block";
});
