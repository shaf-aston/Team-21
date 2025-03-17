  <link rel="stylesheet" href="{{ asset('/css/scroll-to-top.css') }}">
  <div class="scroll-to-top" id="scrollToTop">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
  </div>

  <script>
    // Scroll to top functionality
    document.addEventListener('DOMContentLoaded', function() {
      const scrollToTopButton = document.getElementById('scrollToTop');

      // Show/hide the button based on scroll position
      window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
          scrollToTopButton.classList.add('show');
        } else {
          scrollToTopButton.classList.remove('show');
        }
      });

      // Scroll to top when clicked
      scrollToTopButton.addEventListener('click', function() {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    });
  </script>