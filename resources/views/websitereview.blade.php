<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
      <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
	<title> Wesbite Reviews </title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
		 <link rel = "stylesheet"  href="{{ asset('/css/Tablet.css') }}" >
         <link rel = "stylesheet"  href="{{ asset('/css/UserReview.css') }}" >  
	</head>


    <body>
        <header id = "main-header">
          <a href="Home.html"><img src ="Images/logo.png" alt="Gadget Grads Logo" class="logo" width="98" height="48"></a>
        <h1>GADGET GRADS</h1>
        <h2>Graduate with better tech!</h2>

        <div class = "searchnav">

            <!-- <input type="text" class="search-bar" placeholder="Search products and brands" aria-label="Search"> -->
            <form action="{{route('search')}}" method="GET">
                <input type="text"  class= "search-bar" name="query" placeholder="Search for products by name or description" required>
                <button  class = "search-button" type="submit">Search</button>
            </form>
        </div>

      </div>
      <div class="icons">
          <a href="{{url('/nav')}}" class="user-icon" title="Sign in"><img src="images\user-1.svg" height="30"></a>
          <a href="{{url('/wishlist')}}" class="wishlist-icon" title="Wishlist"><img src="{{asset('images/heart.svg')}}" height="30"></a>
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
      <!-- categories nav bar -->

        <nav id = "gadgetGrads">
        <div class="topnav">
      <a class="active" href= "{{url('Tablets')}}">Tablets</a>
      <a href= "{{url('Laptops')}}">Laptops</a>
      <a href= "{{url('Accessories')}}">Accessories</a>
      <a href="{{url('Phones')}}">Phones</a>
      <a href="{{url('Smartwatches')}}">Smartwatches</a>
    </div>
</nav>  

    <!-- Display the reviews -->
    <h3>Customer Reviews</h3>
@if ($websitereviews->count() > 0)
    @foreach ($websitereviews as $review)
        <div>
            <strong>User {{ $review->user->email }}</strong>
            <p>Rating: ⭐ {{ $review->rating }} / 5</p>
            <p>{{ $review->review }}</p>
            <hr>
        </div>
    @endforeach
@else
    <p>No reviews yet. Be the first to leave a review!</p>
@endif




        <!-- User Review Section -->
        <div class="review-section">
            <h3>Leave a Review</h3>
            <form action="{{ route('websitereviews.store') }}" method="POST" class="review-form">
                @csrf
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars">★</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">★</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">★</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">★</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star">★</label>
                </div>
                <textarea name="review" placeholder="Write your review here..." required></textarea>
                <button type="submit">Submit Review</button>
            </form>



</header>
</body>
</html>