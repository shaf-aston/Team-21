<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title>Wishlist - Gadget Grads</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/wishlist/Wishlist.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/wishlist/RemoveItem.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/wishlist/TotalBox.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/wishlist/UserReview.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/Wishlist-dark-mode.css') }}">
</head>

<body>
  @include('components.navbar')

  <main>
    <div class="container my-5">
      <!-- Wishlist Header -->
      <h2 class="mb-4">Your Wishlist (<span id="item-count-header">{{ count($wishListItems) }}</span> <span id="item-label">items</span>)</h2>

      <!-- Wishlist Content -->
      <div class="wishlist-content">
        <div class="wishlist-container">
          <!-- Loop through wishlist items -->
          @php $total = 0; @endphp
          @foreach($wishListItems as $item)
          <div class="wishlist-item">
            <div class="product-info">
              <!-- Product image -->
              <img src="Images\{{$item->product->img_id}}.jpg" alt="Product Image" class="product-image me-3">

              <!-- Product Details -->
              <div class="product-details">
                <div class="product-name">{{ $item->product->product_name }}</div>
                <div class="product-details-row">
                  <div class="quantity-section">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" value="{{ $item->quantity }}" min="1" class="quantity form-control d-inline-block" style="width: 70px;">
                  </div>
                  <!-- Remove link -->
                  <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <a href="#" class="remove-link" onclick="this.closest('form').submit()">Remove item</a>
                  </form>
                  <!-- Price -->
                  <div class="price">£{{ number_format($item->product->product_price, 2) }}</div>
                </div>

                <!-- Availability Information -->
                <div class="availability white-box">
                  <p>You can choose your delivery or collection preferences at checkout</p>
                  <div class="availability-item">
                    <img src="{{asset('images/truck.svg')}}" alt="Delivery Icon" class="availability-icon">
                    <span>Delivery available</span>
                  </div>
                  <div class="availability-item">
                    <img src="{{asset('images/shop.svg')}}" alt="Collection Icon" class="availability-icon">
                    <span>Collection unavailable</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @php $total += $item->product->product_price * $item->quantity; @endphp
          @endforeach
        </div>

        <!-- Total Box -->
        <div class="total-box-container">
          <div class="total-box">
            <p>Total: £<span id="wishlist-total">{{ number_format($total, 2) }}</span></p>
            <!-- Button to go to basket -->
            <a href="{{ url('/basket') }}" class="btn btn-success w-100 mt-3">Go to Basket</a>
            <!-- Continue shopping link -->
            <a href="{{ url('/home') }}" class="continue-shopping">Continue shopping</a>
          </div>
        </div>
      </div>

      <!-- Remove Item Popup -->
      <div id="remove-popup" class="popup">
        <div class="popup-content">
          <p>Are you sure you want to remove this item?</p>
          <button onclick="removeItem()" class="btn btn-danger">Yes</button>
          <button onclick="closePopup()" class="btn btn-secondary">No</button>
        </div>
      </div>
    </div>
  </main>

  <!-- External JavaScript files -->
  <script src="{{asset('js/Wishlist.js')}}"></script>
  <script src="{{asset('js/TotalBox.js')}}"></script>
</body>

</html>