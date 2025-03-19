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
            <input type="number" id="minPrice" min="0" max="3000" step="10" value="0" oninput="updatePrice()">
            <span>-</span>
            <input type="number" id="maxPrice" min="0" max="3000" step="10" value="3000">
          </div>
          <div class="price-values">
            <span>£0</span>
            <span>£3000</span>
          </div>
          <input type="range" id="priceRange" min="0" max="3000" step="10" value="1500" oninput="updatePrice()">
          <div class="price-display">Selected Price: £<span id="priceValue">1500</span></div>
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
  // Price Range Functionality
  function updatePrice() {
    let price = document.getElementById("priceRange").value;
    document.getElementById("priceValue").textContent = price;

    // Update input boxes based on slider value
    document.getElementById("minPrice").value = 0;
    document.getElementById("maxPrice").value = price;
  }

  // Update slider based on min/max price inputs
  function updateSlider() {
    let minPrice = parseInt(document.getElementById("minPrice").value);
    let maxPrice = parseInt(document.getElementById("maxPrice").value);

    // Ensure the values are valid
    if (minPrice >= 0 && maxPrice <= 3000 && minPrice < maxPrice) {
      document.getElementById("priceRange").min = minPrice;
      document.getElementById("priceRange").max = maxPrice;
    }
  }

  // Filter Section Toggle
  const filterTitles = document.querySelectorAll('.filter-title');
  filterTitles.forEach((title) => {
    title.addEventListener('click', function() {
      const content = this.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
        this.innerHTML = this.innerHTML.replace('▲', '▼');
      } else {
        content.style.display = "block";
        this.innerHTML = this.innerHTML.replace('▼', '▲');
      }
    });
  });

  // Event listeners for price range
  document.getElementById("minPrice").addEventListener("input", updateSlider);
  document.getElementById("maxPrice").addEventListener("input", updateSlider);
  document.getElementById("priceRange").addEventListener("input", updatePrice);
</script>