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
		 <link rel = "stylesheet"  href="{{ asset('/css/Tablet.css') }}" > 
	</head>


    <body>
      <!-- logo -->
        <header id = "main-header">
          <a href="Home.html"><img src ="/Images/logo.png" alt="Gadget Grads Logo" class="logo" width="98" height="48"></a>
        <h1>GADGET GRADS</h1>
        <h2>Graduate with better tech!</h2>


 <!-- icons -->
      <div class="icons">
          <a href="{{url('/nav')}}" class="user-icon" title="Sign in"><img src="images\user.svg" height="30"></a>
          <a href="wishlist.html" class="wishlist-icon" title="Wishlist"><img src="images\heart.svg" height="30"></a>
          <a href="{{url('/basket')}}" class="cart-icon" title="Basket"><img src=" images\basket.svg" height="30"></a>
      </div>
  </header>
  <!-- nav bar -->
  <nav class="nav-bar">
            <ul>
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{url('/products')}}">Products</a></li>
                <li><a href="{{url('/about')}}">About Us</a></li>
                <li><a href="{{url('/basket')}}">Basket</a></li>
                <li><a href="{{url('/contact')}}">Contact Us</a></li>
                
    
            </ul>
        </nav>
<!-- categories nav-bar -->
        <nav id = "gadgetGrads">
        <div class="topnav">
        <a class="active" href= "{{url('Tablets')}}">Tablets</a>
      <a href= "{{url('Laptops')}}">Laptops</a>
      <a href= "{{url('Accessories')}}">Accessories</a>
      <a href="{{url('Phones')}}">Phones</a>
      <a href="{{url('Smartwatches')}}">Smartwatches</a>
    </div>
</nav>  
<!-- sort -->
<div class="sort-section">

</div>
<img src= "/Images\{{$product->img_id}}.jpg" alt="Product" class="iPadAir">
<h3 class="product-title"> {{$product->product_name}}</h3>
<p class ="product-price">{{$product->product_price}}</p>
<p class ="product-title">{{$product->product_description}}</p>
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

</header>
</body>
</html>