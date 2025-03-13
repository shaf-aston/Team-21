<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Updating product information | Gadget Grads</title>
  <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
  <link rel="stylesheet" href="{{asset('css/NavBar.css')}}">
  <link rel="stylesheet" href="{{asset('css/Addingproduct.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Lobster&display=swap" rel="stylesheet">
</head>


<header>
  <!-- logo and header -->
  <header class="header">
    <div class="logo-container">
      <a href="index.html" class="logo">
        <img src="{{asset('images/GG_higher-resolution.png')}}" alt="Logo" height="50">
      </a>
      <div class="site-info">
        <h1 class="title">GADGET GRADS</h1>
        <h2 class="subheading">Graduate with better tech!</h2>
      </div>

    </div>
    <!-- icons -->
    <!-- <div class="icons">
                <a href="{{url('/nav')}}" class="user-icon" title="Sign in"><img src="{{asset('images/user.svg')}}" height="30"></a>
                <a href="{{url('/wishlist')}}" class="wishlist-icon" title="Wishlist"><img src="{{asset('images/heart.svg')}}" height="30"></a>
                <a href="{{url('/basket')}}"class="cart-icon" title="Basket"><img src="{{asset('images/basket.svg')}}" height="30"></a>
        </div> -->
  </header>
  <!-- nav bar -->
  <!-- <nav class="nav-bar">
            <ul>
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{url('/products')}}">Products</a></li>
                <li><a href="{{url('/about')}}">About Us</a></li>
                <li><a href="{{url('/basket')}}">Basket</a></li>
                <li><a href="{{url('/contact')}}">Contact Us</a></li>
            </ul>
        </nav> -->

</header>

<body>
  <!-- updating product information form -->

  <div class="form-container">
    <h2>Stock Inventory</h2>
    <form id="managementForm" method="POST" action="{{ route('products.updateStock', $product->product_id) }}">
      @csrf
      <div class="form-group">
        <label for="product-name">Product Name</label>
        <input type="text" id="product-name" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
        @error('product_name')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="product-price">Product Price</label>
        <input type="number" id="product-price" name="product_price" value="{{ old('product_price', $product->product_price) }}" required min="0" step="0.01">
        @error('product_price')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="stock-quantity">Stock Quantity</label>
        <input type="number" id="stock-quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required min="0" step="1">
        @error('stock_quantity')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>





      <div class="form-buttons">
        <button type="submit">Update</button>

      </div>
    </form>
  </div>

</body>

</html>