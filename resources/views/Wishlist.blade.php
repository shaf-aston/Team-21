<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wishlist - Gadget Grads</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/wishlist/Wishlist.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/wishlist/RemoveItem.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/wishlist/TotalBox.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/wishlist/UserReview.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/Wishlist-dark-mode.css') }}">
</head>



<body>
  @include('components.navbar')

  <main>
    <h2>Your Wishlist (<span id="item-count-header">0</span> <span id="item-label">items</span>)</h2>
    <div class="wishlist-content">
      <div class="wishlist-container">
        <div class="wishlist-item">
          <div class="product-info">
            <img src="{{ asset('images/Laptop.svg') }}" alt="Product Image" class="product-image">
            <div class="product-details">
              <div class="product-name">Product Name</div>
              <div class="product-details-row">
                <div class="quantity-section">
                  <label for="quantity">Quantity:</label>
                  <input type="number" id="quantity" value="1" min="1" class="quantity">
                </div>
                <a href="#" class="remove-link" onclick="showRemovePopup(this)">Remove item</a>
                <div class="price">£10.00</div>
              </div>
              <div class="availability white-box">
                <p>You can choose your delivery or collection preferences at checkout</p>
                <div class="availability-item">
                  <img src="{{ asset('images/truck.svg') }}" alt="Delivery Icon" class="availability-icon">
                  <span>Delivery available</span>
                </div>
                <div class="availability-item">
                  <img src="{{ asset('images/shop.svg') }}" alt="Collection Icon" class="availability-icon">
                  <span>Collection unavailable</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="total-box-container">
        <div class="total-box">
          <p>Total: £<span id="wishlist-total">10.00</span></p>
          <button class="basket-btn">Go to Basket</button>
          <a href="{{ url('/home') }}" class="continue-shopping">Continue shopping</a>
        </div>
      </div>
    </div>
    <div id="remove-popup" class="popup">
      <div class="popup-content">
        <p>Are you sure you want to remove this item?</p>
        <button onclick="removeItem()">Yes</button>
        <button onclick="closePopup()">No</button>
      </div>
    </div>
    <!-- User Review Section -->
    <div class="review-section">
      <h3>Leave a Review</h3>
      {{-- <form action="{{ route('submit.review') }}" method="POST" class="review-form"> --}}
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
  </main>

  @include('components.footer')

  <script src="{{ asset('js/Wishlist.js') }}"></script>
  <script src="{{ asset('js/TotalBox.js') }}"></script>
</body>

</html>