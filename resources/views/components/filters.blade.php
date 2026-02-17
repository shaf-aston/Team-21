<link rel="stylesheet" href="{{ asset('/css/filters.css') }}">
<link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/filters-dark-mode.css') }}">
<aside class="sidebar">
  <div class="sidebar-header">
    <h2>Filters</h2>
    <div class="filter-actions">
      @include('components.list-toggle')
      <button type="button" class="collapse-sidebar-btn" title="Toggle Filters">
        <span class="collapse-icon">▼</span>
      </button>
    </div>
  </div>
  
  <div class="sidebar-content">
    <form method="POST" action="/productsfilter" id="filtersForm">
      @csrf
      <input type="hidden" name="submit" value="true">
      <div class="filters-container">
        <!-- Sort Controls -->
        <div class="sort-container">
          <label for="sort">Sort by:</label>
          <select id="sort" name="sort" form="sortForm">
            <option {{ request()->sortby }} value="default">Default</option>
            <option {{ request()->sortby }} value="priceasc">Price: Low to High</option>
            <option {{ request()->sortby }} value="pricedesc">Price: High to Low</option>
            <option {{ request()->sortby }} value="nameasc">Name: A to Z</option>
            <option {{ request()->sortby }} value="namedesc">Name: Z to A</option>
          </select>
        </div>

        <!-- Filter sections -->
        <div class="filter-groups">
          <!-- RAM Filter -->
          <div class="filter-section">
            <button type="button" class="filter-title">RAM <span class="filter-arrow">▼</span></button>
            <div class="filter-content">
              <label><input name="ram[]" value="64-256gb" type="checkbox" {{ in_array('64-256gb', request('ram', [])) ? 'checked' : '' }}> 64-256GB</label>
              <label><input name="ram[]" value="256-512gb" type="checkbox" {{ in_array('256-512gb', request('ram', [])) ? 'checked' : '' }}> 256-512GB</label>
              <label><input name="ram[]" value="512gb-2tb" type="checkbox" {{ in_array('512gb-2tb', request('ram', [])) ? 'checked' : '' }}> 512GB-2TB</label>
            </div>
          </div>

          <!-- Brand Filter -->
          <div class="filter-section">
            <button type="button" class="filter-title">Brand <span class="filter-arrow">▼</span></button>
            <div class="filter-content">
              <label><input name="brand[]" value="apple" type="checkbox" {{ in_array('apple', request('brand', [])) ? 'checked' : '' }}> Apple</label>
              <label><input name="brand[]" value="lenovo" type="checkbox" {{ in_array('lenovo', request('brand', [])) ? 'checked' : '' }}> Lenovo</label>
              <label><input name="brand[]" value="samsung" type="checkbox" {{ in_array('samsung', request('brand', [])) ? 'checked' : '' }}> Samsung</label>
              <label><input name="brand[]" value="sony" type="checkbox" {{ in_array('sony', request('brand', [])) ? 'checked' : '' }}> SONY</label>
              <label><input name="brand[]" value="hp" type="checkbox" {{ in_array('hp', request('brand', [])) ? 'checked' : '' }}> HP</label>
              <label><input name="brand[]" value="dell" type="checkbox" {{ in_array('dell', request('brand', [])) ? 'checked' : '' }}> Dell</label>
              <label><input name="brand[]" value="microsoft" type="checkbox" {{ in_array('microsoft', request('brand', [])) ? 'checked' : '' }}> Microsoft</label>
              <label><input name="brand[]" value="google" type="checkbox" {{ in_array('google', request('brand', [])) ? 'checked' : '' }}> Google</label>
              <label><input name="brand[]" value="alienware" type="checkbox" {{ in_array('alienware', request('brand', [])) ? 'checked' : '' }}> Alienware</label>
            </div>
          </div>

          <!-- Price Range Filter -->
          <div class="filter-section">
            <button type="button" class="filter-title">Price Range <span class="filter-arrow">▼</span></button>
            <div class="filter-content">
              <div class="range-container">
                <div class="price-inputs">
                  <input type="number" id="minPrice" name="minPrice" min="0" step="10" value="{{ request('minPrice', 0) }}" oninput="updatePrice()">
                  <span>-</span>
                  <input type="number" id="maxPrice" name="maxPrice" min="0" step="10" value="{{ request('maxPrice', 2000) }}" oninput="updateSlider()">
                </div>
                <div class="price-values">
                  <span>£0</span>
                  <span>£<span id="maxPriceValue">2000</span></span>
                </div>
                <input type="range" id="priceRange" min="0" max="2000" step="10" value="{{ request('maxPrice', 1000) }}" oninput="updatePrice()">
                <div class="price-display">Selected Price: £<span id="priceValue">{{ request('maxPrice', 1000) }}</span></div>
              </div>
            </div>
          </div>

          <!-- Colour Filter -->
          <div class="filter-section">
            <button type="button" class="filter-title">Colour <span class="filter-arrow">▼</span></button>
            <div class="filter-content">
              <label><input name="colour[]" value="red" type="checkbox" {{ in_array('red', request('colour', [])) ? 'checked' : '' }}> Red <div class="dot red"></div></label>
              <label><input name="colour[]" value="orange" type="checkbox" {{ in_array('orange', request('colour', [])) ? 'checked' : '' }}> Orange <div class="dot orange"></div></label>
              <label><input name="colour[]" value="yellow" type="checkbox" {{ in_array('yellow', request('colour', [])) ? 'checked' : '' }}> Yellow <div class="dot yellow"></div></label>
              <label><input name="colour[]" value="green" type="checkbox" {{ in_array('green', request('colour', [])) ? 'checked' : '' }}> Green <div class="dot green"></div></label>
              <label><input name="colour[]" value="blue" type="checkbox" {{ in_array('blue', request('colour', [])) ? 'checked' : '' }}> Blue <div class="dot blue"></div></label>
              <label><input name="colour[]" value="black" type="checkbox" {{ in_array('black', request('colour', [])) ? 'checked' : '' }}> Black <div class="dot black"></div></label>
              <label><input name="colour[]" value="white" type="checkbox" {{ in_array('white', request('colour', [])) ? 'checked' : '' }}> White <div class="dot white"></div></label>
              <label><input name="colour[]" value="beige" type="checkbox" {{ in_array('beige', request('colour', [])) ? 'checked' : '' }}> Beige <div class="dot beige"></div></label>
              <label><input name="colour[]" value="grey" type="checkbox" {{ in_array('grey', request('colour', [])) ? 'checked' : '' }}> Grey <div class="dot grey"></div></label>
            </div>
          </div>
        </div>

        <button type="submit" id="applyFilters">Apply</button>
      </div>
    </form>
    
    <!-- Hidden form for sort submission -->
    <form id="sortForm" method="POST" action="/productssort" style="display:none;">
      @csrf
    </form>
  </div>
</aside>

<script>
  const maxPriceLimit = 2000;

  function updatePrice() {
    const priceRange = document.getElementById("priceRange");
    const priceValue = document.getElementById("priceValue");
    const minPriceInput = document.getElementById("minPrice");
    const maxPriceInput = document.getElementById("maxPrice");

    const selectedPrice = Math.min(parseInt(priceRange.value) || 0, maxPriceLimit);
    priceValue.textContent = selectedPrice;
    minPriceInput.value = 0;
    maxPriceInput.value = selectedPrice;
  }

  function updateSlider() {
    const minPrice = Math.max(parseInt(document.getElementById("minPrice").value) || 0, 0);
    const maxPrice = Math.min(parseInt(document.getElementById("maxPrice").value) || maxPriceLimit, maxPriceLimit);
    const priceRange = document.getElementById("priceRange");

    if (minPrice >= 0 && maxPrice <= maxPriceLimit && minPrice < maxPrice) {
      priceRange.min = 0;
      priceRange.max = maxPriceLimit;
      priceRange.value = maxPrice; // Scale the slider value correctly
      document.getElementById("priceValue").textContent = maxPrice;
    }
  }

  document.getElementById("maxPriceValue").textContent = maxPriceLimit;

  // Clean up event listeners by removing all previous ones
  document.querySelectorAll('.filter-title').forEach(title => {
    const newTitle = title.cloneNode(true);
    title.parentNode.replaceChild(newTitle, title);
  });

  // Improved filter dropdown handler
  document.querySelectorAll('.filter-title').forEach(title => {
    title.addEventListener('click', function(e) {
      e.stopPropagation();
      const content = this.nextElementSibling;
      const arrow = this.querySelector('.filter-arrow');
      const isVisible = window.getComputedStyle(content).display === "block";
      
      // Close all other dropdowns
      document.querySelectorAll('.filter-content').forEach(dropdown => {
        if (dropdown !== content && dropdown.style.display === "block") {
          dropdown.style.display = "none";
          const dropdownArrow = dropdown.previousElementSibling.querySelector('.filter-arrow');
          if (dropdownArrow) dropdownArrow.textContent = '▼';
        }
      });
      
      if (!isVisible) {
        // Show the dropdown
        content.style.display = "block";
        const mainContent = document.querySelector('.main-content');
        
        if (mainContent && mainContent.classList.contains('list-mode')) {
          // List mode - static positioning
          content.style.position = "static";
          content.style.width = "100%";
        } else {
          // Grid mode - absolute positioning relative to the document
          const rect = this.getBoundingClientRect();
          
          // Position dropdown at fixed position below button
          content.style.position = "fixed";
          content.style.top = rect.bottom + "px";
          content.style.left = rect.left + "px";
          content.style.maxHeight = "300px";
          content.style.width = "auto";
          content.style.minWidth = Math.max(250, rect.width) + "px";
          content.style.zIndex = "1050";
          
          // Make sure dropdown doesn't go off-screen
          setTimeout(() => {
            const contentRect = content.getBoundingClientRect();
            const viewportWidth = window.innerWidth;
            const viewportHeight = window.innerHeight;
            
            // Handle horizontal overflow
            if (contentRect.right > viewportWidth) {
              content.style.left = (viewportWidth - contentRect.width - 10) + "px";
            }
            
            // Handle vertical overflow
            if (contentRect.bottom > viewportHeight) {
              // If it would go off bottom of screen, show it above the button instead
              if (rect.top > contentRect.height) {
                // If there's enough space above, show it above
                content.style.top = (rect.top - contentRect.height) + "px";
              } else {
                // Otherwise limit the height to fit in viewport
                content.style.maxHeight = (viewportHeight - rect.bottom - 10) + "px";
              }
            }
          }, 0);
        }
        
        arrow.textContent = '▲';
      } else {
        // Hide the dropdown
        content.style.display = "none";
        arrow.textContent = '▼';
      }
    });
  });

  // Collapse/expand sidebar button functionality
  const collapseSidebarBtn = document.querySelector('.collapse-sidebar-btn');
  if (collapseSidebarBtn) {
    collapseSidebarBtn.addEventListener('click', () => {
      const sidebarContent = document.querySelector('.sidebar-content');
      const icon = collapseSidebarBtn.querySelector('.collapse-icon');
      
      if (sidebarContent.style.display === 'none') {
        sidebarContent.style.display = 'block';
        icon.textContent = '▼';
        collapseSidebarBtn.setAttribute('title', 'Collapse Filters');
        localStorage.setItem('filterSidebarState', 'expanded');
      } else {
        sidebarContent.style.display = 'none';
        icon.textContent = '▶';
        collapseSidebarBtn.setAttribute('title', 'Expand Filters');
        localStorage.setItem('filterSidebarState', 'collapsed');
      }
    });
    
    // Restore sidebar state from localStorage
    const sidebarState = localStorage.getItem('filterSidebarState');
    if (sidebarState === 'collapsed') {
      const sidebarContent = document.querySelector('.sidebar-content');
      const icon = collapseSidebarBtn.querySelector('.collapse-icon');
      
      sidebarContent.style.display = 'none';
      icon.textContent = '▶';
      collapseSidebarBtn.setAttribute('title', 'Expand Filters');
    }
  }

  // Sort integration
  document.getElementById('sort').addEventListener('change', function() {
    document.getElementById('sortForm').submit();
  });
  
  // Close dropdowns when clicking outside
  document.addEventListener('click', function(event) {
    if (!event.target.closest('.filter-section')) {
      document.querySelectorAll('.filter-content').forEach(content => {
        content.style.display = "none";
        const arrow = content.previousElementSibling.querySelector('.filter-arrow');
        if (arrow) arrow.textContent = '▼';
      });
    }
  });

  // Keep track of active dropdowns during scroll or resize
  function adjustActiveDropdowns() {
    const mainContent = document.querySelector('.main-content');
    if (mainContent && !mainContent.classList.contains('list-mode')) {
      document.querySelectorAll('.filter-content').forEach(content => {
        if (content.style.display === "block") {
          const button = content.previousElementSibling;
          const rect = button.getBoundingClientRect();
          
          content.style.top = (rect.bottom + window.scrollY) + "px";
          content.style.left = rect.left + "px";
          
          // Check if offscreen and adjust
          const contentRect = content.getBoundingClientRect();
          if (contentRect.right > window.innerWidth) {
            const overflowAmount = contentRect.right - window.innerWidth;
            content.style.left = (rect.left - overflowAmount - 10) + "px";
          }
        }
      });
    }
  }

  // Handle window scroll and resize
  window.addEventListener('scroll', adjustActiveDropdowns, { passive: true });
  window.addEventListener('resize', adjustActiveDropdowns);
</script>