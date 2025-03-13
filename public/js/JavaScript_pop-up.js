document.addEventListener("DOMContentLoaded", () => {
  // Get all necessary DOM elements
  const authPopup = document.getElementById("auth-popup");
  const signupPopup = document.getElementById("signup-popup");
  const forgotPasswordPopup = document.getElementById(
      "forgot-password-popup"
  );
  const closeBtns = document.querySelectorAll(".close-btn");
  const loginBtn = document.getElementById("login-btn");
  const navbarLoginBtn = document.getElementById("navbar-login-btn");
  const navbarRegisterBtn = document.getElementById("navbar-register-btn");
  const signupLink = document.getElementById("signup-link");
  const forgotPasswordLink = document.getElementById("forgot-password-link");
  const backToLoginSignup = document.getElementById("back-to-login-signup");
  const backToLoginForgot = document.getElementById("back-to-login-forgot");
  const eyeIcons = document.querySelectorAll(".eye-icon");

  const togglePopup = (popup) => {
      if (!popup) return; // Guard clause for null elements

      if (popup.style.display === "block") {
          popup.classList.remove("active");
          setTimeout(() => {
              popup.style.display = "none";
          }, 300);
      } else {
          popup.style.display = "block";
          setTimeout(() => {
              popup.classList.add("active");
          }, 10);
      }
  };

  // Close popups when clicking outside
  window.addEventListener("click", (event) => {
      if (event.target.classList.contains("auth-popup")) {
          [authPopup, signupPopup, forgotPasswordPopup].forEach((popup) => {
              if (popup && popup === event.target) {
                  togglePopup(popup);
              }
          });
      }
  });

  // Close popups with Escape key
  document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") {
          [authPopup, signupPopup, forgotPasswordPopup].forEach((popup) => {
              if (popup && popup.style.display === "block") {
                  togglePopup(popup);
              }
          });
      }
  });

  // Event listeners for close buttons
  closeBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
          togglePopup(btn.closest(".auth-popup"));
      });
  });

  // Main login button
  if (loginBtn) {
      loginBtn.addEventListener("click", () => {
          togglePopup(authPopup);
      });
  }

  // Navbar login button
  if (navbarLoginBtn) {
      navbarLoginBtn.addEventListener("click", (e) => {
          e.preventDefault();
          togglePopup(authPopup);
      });
  }

  // Navbar register button
  if (navbarRegisterBtn) {
      navbarRegisterBtn.addEventListener("click", (e) => {
          e.preventDefault();
          togglePopup(signupPopup);
      });
  }

  // Switch to signup popup
  if (signupLink) {
      signupLink.addEventListener("click", (e) => {
          e.preventDefault();
          togglePopup(authPopup);
          togglePopup(signupPopup);
      });
  }

  // Switch to forgot password popup
  if (forgotPasswordLink) {
      forgotPasswordLink.addEventListener("click", (e) => {
          e.preventDefault();
          togglePopup(authPopup);
          togglePopup(forgotPasswordPopup);
      });
  }

  // Back to login links
  if (backToLoginSignup) {
      backToLoginSignup.addEventListener("click", (e) => {
          e.preventDefault();
          togglePopup(signupPopup);
          togglePopup(authPopup);
      });
  }

  if (backToLoginForgot) {
      backToLoginForgot.addEventListener("click", (e) => {
          e.preventDefault();
          togglePopup(forgotPasswordPopup);
          togglePopup(authPopup);
      });
  }

  // Keep popup open if there are errors
  if (authPopup && authPopup.querySelector(".text-danger")) {
      authPopup.style.display = "block";
  }
  if (signupPopup && signupPopup.querySelector(".text-danger")) {
      signupPopup.style.display = "block";
  }
  if (
      forgotPasswordPopup &&
      forgotPasswordPopup.querySelector(".text-danger")
  ) {
      forgotPasswordPopup.style.display = "block";
  }

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



});
