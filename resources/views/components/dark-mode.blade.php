<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-widget.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/transition-dark-mode.css') }}">
</head>

<body>
  <button class="dark-mode-toggle" onclick="toggleDarkMode()" aria-label="Toggle dark mode">
    <span id="darkModeIcon"></span>
  </button>

  <script>
    //Flash prevention by running before DOM loads
    if (localStorage.getItem('darkMode') === 'enabled') {
      document.documentElement.classList.add('dark-mode');
    }
    // Initialize dark mode on page load
    document.addEventListener('DOMContentLoaded', function() {
      const darkModeIcon = document.getElementById('darkModeIcon');
      const darkModeEnabled = localStorage.getItem('darkMode') === 'enabled';

      if (darkModeEnabled) {
        document.body.classList.add('dark-mode');
        if (darkModeIcon) {
          darkModeIcon.textContent = '☀️'; // Sun icon
        }
      } else {
        if (darkModeIcon) {
          darkModeIcon.textContent = '🌙'; // Moon icon
        }
      }
    });

    // Toggle dark mode function
    function toggleDarkMode() {
      const body = document.body;
      const darkModeIcon = document.getElementById('darkModeIcon');

      body.classList.toggle('dark-mode');

      if (body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
        if (darkModeIcon) {
          darkModeIcon.textContent = '☀️';
        }
      } else {
        localStorage.setItem('darkMode', 'disabled');
        if (darkModeIcon) {
          darkModeIcon.textContent = '🌙';
        }
      }
    }
  </script>
</body>

</html>