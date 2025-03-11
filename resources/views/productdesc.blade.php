<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title>Product View</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/UserReview.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/Product.css') }}">
</head>


<body>
  @include('components.navbar')
  <div class="product-container">
    <img id="product-image" src="/Images\{{$product->img_id}}.jpg" alt="Product Image">
    <div id="zoom-result"></div>
    <script src="{{asset('js/Product.js')}}"></script>
  </div>

  <h3 class="product-title"> {{$product->product_name}}</h3>
  <p class="product-price">£{{$product->product_price}}</p>
  <p class="product-title">{{$product->product_description}}</p>

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


  <!-- Display the reviews -->
  <h3>Customer Reviews</h3>
  @if ($product->reviews->count() > 0)
  @foreach ($product->reviews as $review)
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
    <form action="{{ route('reviews.store', $product->product_id) }}" method="POST" class="review-form">
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
  </div>

</body>

</html>