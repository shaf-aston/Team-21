<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title> Tablet Page </title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/admin/admin-view.css')}}">
</head>

<body>
  <header id="main-header">
    <a href="Home.html"><img src="Images/logo.png" alt="Gadget Grads Logo" class="logo" width="98" height="48"></a>
    <h1>GADGET GRADS</h1>
    <h2>Graduate with better tech!</h2>

    <div class="searchnav">

      <!-- <input type="text" class="search-bar" placeholder="Search products and brands" aria-label="Search"> -->
      <form action="{{route('search')}}" method="GET">
        <input type="text" class="search-bar" name="query" placeholder="Search for products by name or description" required>
        <button class="search-button" type="submit">Search</button>
      </form>
    </div>

    </div>
    <!-- <div class="icons">
          <a href="{{url('/nav')}}" class="user-icon" title="Sign in"><img src="images\user-1.svg" height="30"></a>
          <a href="wishlist.html" class="wishlist-icon" title="Wishlist"><img src="images\heart.svg" height="30"></a>
          <a href="{{url('/basket')}}" class="cart-icon" title="Basket"><img src=" images\basket.svg" height="30"></a>
      </div> -->
  </header>
  <!-- nav bar
  <nav class="nav-bar">
            <ul>
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{url('/products')}}">Products</a></li>
                <li><a href="{{url('/about')}}">About Us</a></li>
                <li><a href="{{url('/basket')}}">Basket</a></li>
                <li><a href="{{url('/contact')}}">Contact Us</a></li>
                
    
            </ul>
        </nav> -->
  <!-- categories nav bar -->

  <!-- <nav id = "gadgetGrads">
        <div class="topnav">
      <a class="active" href= "{{url('Tablets')}}">Tablets</a>
      <a href= "{{url('Laptops')}}">Laptops</a>
      <a href= "{{url('Accessories')}}">Accessories</a>
      <a href="{{url('Phones')}}">Phones</a>
      <a href="{{url('Smartwatches')}}">Smartwatches</a>
    </div>
</nav>   -->

  <!-- sort function -->
  <div class="sort-section">
    <label for="sort">Sort by:</label>
    <form method="POST" action="/productssort">
      @csrf
      <select id="sort" name="sort">
        <option {{request()->sortby}} value="default">Default</option>
        <option {{request()->sortby}} value="priceasc">Price: Low to High</option>
        <option {{request()->sortby}} value="pricedesc">Price: High to Low</option>
        <option {{request()->sortby}} value="nameasc">Name: A to Z</option>
        <option {{request()->sortby}} value="namedesc">Name: Z to A</option>
      </select>
      <button type="submit">Sort!</button>
    </form>
  </div>
  <button class="view-button" type="submit" id="viewprod" onclick="window.location='{{url('/products/create')}}'"> Add product</button>


  <!-- product display -->
  @foreach ($products as $product)
  <div class="product-section">
    <div class="product">
      <img src="Images\{{$product->img_id}}.jpg" alt="Product" class="iPadAir">
      <div class="product-info">
        <h3 class="product-title"> {{$product->product_name}}</h3>
        <p class="product-price">{{$product->product_price}}</p>
        <p class="product-stock">Stock Quantity: {{$product->stock_quantity}}</p>
        <!-- Low stock alert message -->
        @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
          <p class="text-warning">Make an order to the supplier for this product. Only {{$product->stock_quantity}} left in stock.</p>
          @elseif($product->stock_quantity == 0)
          <p class="text-danger">Out of stock</p>
          @endif
          <div class="product-buttons">
            <!-- view button -->
            <button class="view-button" type="submit" id="viewprod" onclick="window.location='{{url('productdesc',$product->product_id)}}'">View Product</button>
            <button class="view-button" type="submit" id="viewprod" onclick="window.location='{{route('products.update', $product->product_id)}}'">Update Product Info</button>

            <!-- Add to Basket -->
            <!-- <div class="card-footer text-center">
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
    </div> -->

            <!-- Remove the product -->

            @if(Auth::check())
            <form action="{{ route('admin.remove', $product->product_id) }}" method="POST" class="d-inline-block">
              @csrf
              @method('DELETE')
              <button type='submit' class="remove-link text-danger" onclick="this.closest('form').submit()">Remove item</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary">Log in to remove product</a>
            @endif
          </div>
      </div>
    </div>
  </div>
  @endforeach

  </header>
</body>

</html>