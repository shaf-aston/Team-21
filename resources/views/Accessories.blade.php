<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title>Accessories</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/ProductListing.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/ProductListing-dark-mode.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/list-toggle.css') }}">
</head>

<body>
  @include('components.navbar')
  <nav id="gadgetGrads">
    <div class="topnav">
      <a href="{{ url('Tablets') }}">Tablets</a>
      <a href="{{ url('Laptops') }}">Laptops</a>
      <a class="active" href="{{ url('Accessories') }}">Accessories</a>
      <a href="{{ url('Phones') }}">Phones</a>
      <a href="{{ url('Smartwatches') }}">Smartwatches</a>
    </div>
  </nav>

  <div class="product-container">
    <div class="main-content">
      <!-- Filters -->
      <aside class="sidebar-container">
        @include('components.filters')
      </aside>
      
      <!-- Product display -->
      <div class="products-wrapper grid-layout">
        @foreach ($products as $product)
        @if ($product->category_id != 6)
        @else
        <div class="product-section">
          <div class="product">
            <!-- Make image clickable -->
            <a href="{{ url('productdesc', $product->product_id) }}" class="product-link">
              <img src="Images\{{$product->img_id}}.jpg" alt="Product" class="iPadAir">
            </a>
            <div class="product-info">
              <div class="product-info-text">
                <!-- Make title clickable -->
                <h3 class="product-title">
                  <a href="{{ url('productdesc', $product->product_id) }}" class="product-link">
                    {{$product->product_name}}
                  </a>
                </h3>
                <p class="product-price">£{{$product->product_price}}</p>
              
                @if(isset($product->stock_quantity) && $product->stock_quantity <= 5 && $product->stock_quantity > 0)
                  <p class="text-warning">Hurry! Only {{$product->stock_quantity}} left in stock.</p>
                @elseif(isset($product->stock_quantity) && $product->stock_quantity == 0)
                  <p class="text-danger">Out of stock</p>
                @endif
              </div>
              
              <div class="product-buttons">
                <!-- View Product button removed -->
                
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
        @endif
        @endforeach
      </div>
    </div>
  </div>
  @include('components.Footer')
</body>

</html>