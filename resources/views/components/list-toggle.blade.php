<link rel="stylesheet" href="{{ asset('/css/list-toggle.css') }}">
<div class="view-toggle">
  <!-- Grid View Button -->
  <button class="toggle-button grid-button {{ request()->input('view') !== 'list' ? 'active' : '' }}" data-view="grid">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <rect x="3" y="3" width="7" height="7"></rect>
      <rect x="14" y="3" width="7" height="7"></rect>
      <rect x="14" y="14" width="7" height="7"></rect>
      <rect x="3" y="14" width="7" height="7"></rect>
    </svg>
  </button>
  
  <!-- List View Button -->
  <button class="toggle-button list-button {{ request()->input('view') === 'list' ? 'active' : '' }}" data-view="list">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" 
         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
    // Cache DOM elements
    const gridButton = document.querySelector('.grid-button');
    const listButton = document.querySelector('.list-button');
    const productsWrapper = document.querySelector('.products-wrapper');
    const mainContent = document.querySelector('.main-content');

    /**
     * Update layout between grid and list views with smooth fade transition
     * @param {string} layout - 'grid' or 'list'
     */
    function updateLayout(layout) {
      // Step 1: Fade out (trigger transition)
      productsWrapper.classList.add('changing-layout');
      
      // Step 2: Change layout classes after fade out completes
      setTimeout(() => {
        if (layout === 'list') {
          // Switch to list layout
          productsWrapper.classList.add('list-layout');
          productsWrapper.classList.remove('grid-layout');
          mainContent.classList.add('list-mode');
          mainContent.classList.remove('grid-mode');
          listButton.classList.add('active');
          gridButton.classList.remove('active');
        } else {
          // Switch to grid layout
          productsWrapper.classList.add('grid-layout');
          productsWrapper.classList.remove('list-layout');
          mainContent.classList.add('grid-mode');
          mainContent.classList.remove('list-mode');
          gridButton.classList.add('active');
          listButton.classList.remove('active');
        }

        // Step 3: Fade back in
        setTimeout(() => {
          productsWrapper.classList.remove('changing-layout');
        }, 50);
        
        // Step 4: Save user preference
        const url = new URL(window.location);
        url.searchParams.set('view', layout);
        window.history.replaceState({}, '', url);
        localStorage.setItem('preferredLayout', layout);
      }, 300); // Match timing with CSS transition duration
    }

    // Event Listeners
    gridButton.addEventListener('click', () => updateLayout('grid'));
    listButton.addEventListener('click', () => updateLayout('list'));

    // Initialize based on URL parameter or saved preference
    const urlView = new URLSearchParams(window.location.search).get('view');
    const savedView = localStorage.getItem('preferredLayout');

    // Apply list layout if specified, without animation on initial load
    if (urlView === 'list' || (urlView !== 'grid' && savedView === 'list')) {
      productsWrapper.classList.add('no-animation');
      productsWrapper.classList.add('list-layout');
      productsWrapper.classList.remove('grid-layout');
      mainContent.classList.add('list-mode');
      mainContent.classList.remove('grid-mode');
      listButton.classList.add('active');
      gridButton.classList.remove('active');
      
      // Re-enable animations after initial render
      setTimeout(() => {
        productsWrapper.classList.remove('no-animation');
      }, 100);
    }
  });
</script>