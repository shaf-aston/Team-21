  <link rel="stylesheet" href="{{ asset('/css/filters.css') }}">
  <aside class="sidebar">
    <h2>Filters</h2>
    <ul>
      <!-- RAM Filter -->
      <div class="filter-section">
        <button class="filter-title">RAM ▼</button>
        <div class="filter-content">
          <label><input type="checkbox"> 64-256GB</label>
          <label><input type="checkbox"> 256-512GB</label>
          <label><input type="checkbox"> 512GB-2TB</label>
        </div>
      </div>
  
      <!-- Brand Filter -->
      <div class="filter-section">
        <button class="filter-title">Brand ▼</button>
        <div class="filter-content">
          <label><input type="checkbox"> Apple</label>
          <label><input type="checkbox"> Lenovo</label>
          <label><input type="checkbox"> Samsung</label>
          <label><input type="checkbox"> SONY</label>
          <label><input type="checkbox"> HP</label>
          <label><input type="checkbox"> Dell</label>
          <label><input type="checkbox"> Microsoft</label>
          <label><input type="checkbox"> Google</label>
          <label><input type="checkbox"> Alienware</label>
        </div>
      </div>
  
      <!-- Price Range Filter -->
      <div class="filter-section">
        <button class="filter-title">Price Range ▼</button>
        <div class="filter-content">
          <div class="range-container">
            <div class="price-inputs">
              <input type="number" id="minPrice" min="0" step="10" value="0" oninput="updatePrice()">
              <span>-</span>
              <input type="number" id="maxPrice" min="0" step="10" value="2000" oninput="updateSlider()">
            </div>
            <div class="price-values">
              <span>£0</span>
              <span>£<span id="maxPriceValue">2000</span></span>
            </div>
            <input type="range" id="priceRange" min="0" max="2000" step="10" value="1000" oninput="updatePrice()">
            <div class="price-display">Selected Price: £<span id="priceValue">1000</span></div>
          </div>
        </div>
      </div>
  
      <!-- Color Filter -->
      <div class="filter-section">
        <button class="filter-title">Colour ▼</button>
        <div class="filter-content">
          <li><input type="checkbox"><label> Red </label>
            <div class="dot red"></div>
          </li>
          <li><input type="checkbox"><label> Orange </label>
            <div class="dot orange"></div>
          </li>
          <li><input type="checkbox"><label> Yellow </label>
            <div class="dot yellow"></div>
          </li>
          <li><input type="checkbox"><label> Green </label>
            <div class="dot green"></div>
          </li>
          <li><input type="checkbox"><label> Blue </label>
            <div class="dot blue"></div>
          </li>
          <li><input type="checkbox"><label> Black </label>
            <div class="dot black"></div>
          </li>
          <li><input type="checkbox"><label> White </label>
            <div class="dot white"></div>
          </li>
          <li><input type="checkbox"><label> Beige </label>
            <div class="dot beige"></div>
          </li>
          <li><input type="checkbox"><label> Grey </label>
            <div class="dot grey"></div>
          </li>
        </div>
      </div>
  
      <button id="applyFilters">Apply</button>
    </ul>
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
  
    document.querySelectorAll('.filter-title').forEach(title => {
      title.addEventListener('click', () => {
        const content = title.nextElementSibling;
        const isVisible = content.style.display === "block";
        content.style.display = isVisible ? "none" : "block";
        title.innerHTML = title.innerHTML.replace(isVisible ? '▲' : '▼', isVisible ? '▼' : '▲');
      });
    });
  
    ["minPrice", "maxPrice", "priceRange"].forEach(id => {
      document.getElementById(id).addEventListener("input", id === "priceRange" ? updatePrice : updateSlider);
    });
  </script>