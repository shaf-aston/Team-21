<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Products Listing</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/ProductListing.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/ProductListing-dark-mode.css') }}">
</head>

<body>
  @include('components.navbar')
  <nav id="gadgetGrads">
    <div class="topnav">
      <a href="{{ url('Tablets') }}">Tablets</a>
      <a href="{{ url('Laptops') }}">Laptops</a>
      <a href="{{ url('Accessories') }}">Accessories</a>
      <a href="{{ url('Phones') }}">Phones</a>
      <a href="{{ url('Smartwatches') }}">Smartwatches</a>
    </div>
  </nav>

  <div class="product-container">
    <div class="actions-header">
      <!-- sort function -->
      <div class="sort-section">
        <label for="sort">Sort by:</label>
        <form method="POST" action="/productssort">
          @csrf
          <select id="sort" name="sort">
            <option {{ request()->sortby }} value="default">Default</option>
            <option {{ request()->sortby }} value="priceasc">Price: Low to High</option>
            <option {{ request()->sortby }} value="pricedesc">Price: High to Low</option>
            <option {{ request()->sortby }} value="nameasc">Name: A to Z</option>
            <option {{ request()->sortby }} value="namedesc">Name: Z to A</option>
          </select>
          <button type="submit">Sort!</button>
        </form>
      </div>

      <!-- View toggle -->
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
    </div>
    <!-- product display -->
    <div class="products-wrapper grid-layout">
      @foreach ($products as $product)
      <div class="product-section">
        <div class="product">
          <img src="{{ asset('images/'.$product->img_id.'.jpg') }}" alt="Product" class="iPadAir">
          <div class="product-info">
            <div class="product-info-text">
              <h3 class="product-title">{{ $product->product_name }}</h3>
              <p class="product-price">£{{ $product->product_price }}</p>

              <!-- Low stock alert message -->
              @if(isset($product->stock_quantity) && $product->stock_quantity <= 5 && $product->stock_quantity > 0)
                <p class="text-warning">Hurry! Only {{$product->stock_quantity}} left in stock.</p>
              @elseif(isset($product->stock_quantity) && $product->stock_quantity == 0)
                <p class="text-danger">Out of stock</p>
              @endif
            </div>
            
            <div class="product-buttons">
              <!-- view button -->
              <button class="view-button" type="submit" id="viewprod" onclick="window.location='{{ url('productdesc', $product->product_id) }}'">View Product</button>
    
              <!-- Add to Basket -->
              <div class="card-footer text-center">
                @if(Auth::check())
                <form method="POST" action="{{ route('basket.add') }}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="add-button btn-primary">Add to Basket</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary">Log in to Add to Basket</a>
                @endif
              </div>
    
              <!-- Add to Wishlist -->
              <div class="card-footer text-center">
                @if(Auth::check())
                <form method="POST" action="{{ route('wishlist.add') }}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="add-button btn-primary">Add to Wishlist</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn btn-primary">Log in to Add to Wishlist</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  @include('components.Footer')

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
          setTimeout(() => { isTransitioning = false; }, 400);
        }
      });
      
      listButton.addEventListener('click', function() {
        if (!productsWrapper.classList.contains('list-layout') && !isTransitioning) {
          isTransitioning = true;
          changeLayout('list-layout', 'grid-layout');
          setTimeout(() => { isTransitioning = false; }, 400);
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
</body>

</html>