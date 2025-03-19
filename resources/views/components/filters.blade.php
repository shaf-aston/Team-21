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

<style>
  /* Sidebar Styles */
  .sidebar {
    width: 250px;
    background-color: #f4f4f4;
    padding: 20px;
    height: 500px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #888 #f4f4f4;
  }

  .sidebar h2 {
    font-size: 20px;
    margin-bottom: 10px;
  }

  .sidebar ul {
    list-style-type: none;
    padding: 0;
  }

  .sidebar ul li {
    margin: 10px 0;
  }

  /* Scrollbar Styles */
  .sidebar::-webkit-scrollbar {
    width: 8px;
  }

  .sidebar::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 4px;
  }

  .sidebar::-webkit-scrollbar-thumb:hover {
    background-color: #555;
  }

  /* Filter Section Styles */
  .filter-section {
    margin-bottom: 10px;
  }

  .filter-title {
    background-color: #2d4059;
    opacity: 90%;
    color: white;
    padding: 10px;
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  /* Color Dots */
  .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin: 5px;
  }

  .red {
    background-color: red;
  }

  .orange {
    background-color: orange;
  }

  .yellow {
    background-color: yellow;
  }

  .green {
    background-color: green;
  }

  .blue {
    background-color: blue;
  }

  .black {
    background-color: black;
  }

  .white {
    background-color: white;
  }

  .beige {
    background-color: beige;
  }

  .grey {
    background-color: grey;
  }

  /* Price Range Inputs */
  .price-inputs {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }

  .price-inputs input {
    width: 45%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
  }

  /* Apply Filters Button */
  #applyFilters {
    padding: 8px 20px;
    border-radius: 8px;
    border: 2px solid #2d4059;
    background-color: #213145;
    color: #ffffff;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: "Inter", sans-serif;
    font-weight: 500;
    box-shadow: 0 2px 4px rgba(45, 64, 89, 0.2);
    width: 100%;
    margin-top: 20px;
  }

  #applyFilters:hover {
    background-color: #2d4059;
    color: #ffffff;
    box-shadow: 0 4px 8px rgba(45, 64, 89, 0.2);
    transform: translateY(-1px);
  }

  #applyFilters:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(45, 64, 89, 0.5);
  }
</style>