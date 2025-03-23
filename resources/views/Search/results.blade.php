<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Products</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/ProductListing.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/ProductListing-dark-mode.css') }}">
</head>

<body>
  @include('components.navbar')

  <body>
    <h1>Search Results for "{{$query}}"</h1>

    @if($products->isEmpty())
    <p>No products found matching your search criteria</p>
    @else

    @foreach ($products as $product)
    <div class="product-section">
      <div class="product">
        <img src="Images\{{$product->img_id}}.jpg" alt="Product" class="iPadAir">
        <div class="product-info">
          <h3 class="product-title"> {{$product->product_name}}</h3>
          <p class="product-price">£{{$product->product_price}}</p>
          <div class="product-buttons">
            <button class="view-button" type="submit" id="viewprod" onclick="window.location='{{url('productdesc',$product->product_id)}}'">View Product</button>

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
          </div>
        </div>
      </div>
    </div>
    @endforeach
    @endif

  </body>

</html>