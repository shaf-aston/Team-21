  <link rel="stylesheet" href="{{ asset('/css/list-toggle.css') }}">
  <div class="view-toggle">
    <button class="toggle-button grid-view active" title="Grid View">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="7" height="7"></rect>
        <rect x="14" y="3" width="7" height="7"></rect>
        <rect x="14" y="14" width="7" height="7"></rect>
        <rect x="3" y="14" width="7" height="7"></rect>
      </svg>
    </button>
    <button class="toggle-button list-view" title="List View">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="8" y1="6" x2="21" y2="6"></line>
        <line x1="8" y1="12" x2="21" y2="12"></line>
        <line x1="8" y1="18" x2="21" y2="18"></line>
        <line x1="3" y1="6" x2="3.01" y2="6"></line>
        <line x1="3" y1="12" x2="3.01" y2="12"></line>
        <line x1="3" y1="18" x2="3.01" y2="18"></line>
      </svg>
    </button>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const gridButton = document.querySelector('.toggle-button.grid-view');
      const listButton = document.querySelector('.toggle-button.list-view');
      const productsWrapper = document.querySelector('.products-wrapper');

      // Apply no-animation class to prevent initial transitions
      productsWrapper.classList.add('no-animation');

      // Helper function for layout changes with transition
      function changeLayout(newLayout, oldLayout) {
        // Update buttons immediately
        if (newLayout === 'grid-layout') {
          gridButton.classList.add('active');
          listButton.classList.remove('active');
        } else {
          listButton.classList.add('active');
          gridButton.classList.remove('active');
        }

        // Add changing class
        productsWrapper.classList.add('changing-layout');

        // Change layout after a minimal delay
        requestAnimationFrame(() => {
          productsWrapper.classList.remove(oldLayout);
          productsWrapper.classList.add(newLayout);

          // Remove changing class after transition completes
          setTimeout(() => {
            productsWrapper.classList.remove('changing-layout');
          }, 300); // Slightly shorter than CSS transition
        });

        // Save preference
        localStorage.setItem('productViewPreference', newLayout === 'grid-layout' ? 'grid' : 'list');
      }

      // Set up event listeners with debounce to prevent rapid clicking
      let isTransitioning = false;

      gridButton.addEventListener('click', function() {
        if (!productsWrapper.classList.contains('grid-layout') && !isTransitioning) {
          isTransitioning = true;
          changeLayout('grid-layout', 'list-layout');
          setTimeout(() => {
            isTransitioning = false;
          }, 400);
        }
      });

      listButton.addEventListener('click', function() {
        if (!productsWrapper.classList.contains('list-layout') && !isTransitioning) {
          isTransitioning = true;
          changeLayout('list-layout', 'grid-layout');
          setTimeout(() => {
            isTransitioning = false;
          }, 400);
        }
      });

      // Check if there's a saved preference
      const viewPreference = localStorage.getItem('productViewPreference');
      if (viewPreference === 'list') {
        // Apply list view without animation on page load
        listButton.classList.add('active');
        gridButton.classList.remove('active');
        productsWrapper.classList.remove('grid-layout');
        productsWrapper.classList.add('list-layout');
      }

      // Remove no-animation class after initial layout is set
      setTimeout(() => {
        productsWrapper.classList.remove('no-animation');
      }, 50);
    });
  </script>