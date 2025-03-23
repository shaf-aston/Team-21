<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Wishlist - Gadget Grads</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/wishlist.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/wishlist-dark-mode.css') }}">
</head>

<body>
  @include('components.navbar')

  <main>
    <div class="container wishlist-page">
      <!-- Status message area for AJAX feedback -->
      <div id="status-messages" aria-live="polite"></div>

      <!-- Wishlist Header -->
      <h2 class="wishlist-title">Your Wishlist (<span id="item-count-header">{{ count($wishListItems) }}</span> <span id="item-label">{{ count($wishListItems) == 1 ? 'item' : 'items' }}</span>)</h2>

      <!-- Wishlist Content -->
      <div class="wishlist-content">
        @if(count($wishListItems) > 0)
        <div class="wishlist-container">
          <!-- Loop through wishlist items -->
          @php $total = 0; @endphp
          @foreach($wishListItems as $item)
          <div class="wishlist-item" id="wishlist-item-{{ $item->id }}">
            <div class="product-info">
              <!-- Product image -->
              <img src="{{ asset('images/' . $item->product->img_id . '.jpg') }}" alt="{{ $item->product->product_name }}" class="product-image">

              <!-- Product Details -->
              <div class="product-details">
                <div class="product-name">
                  <a href="{{ url('productdesc', $item->product->product_id) }}" class="product-link">
                    {{ $item->product->product_name }}
                  </a>
                </div>
                <div class="product-details-row">
                  <div class="quantity-section">
                    <label for="quantity-{{ $item->id }}">Quantity:</label>
                    <input type="number"
                      id="quantity-{{ $item->id }}"
                      data-item-id="{{ $item->id }}"
                      data-original-quantity="{{ $item->quantity }}"
                      value="{{ $item->quantity }}"
                      min="1"
                      aria-label="Quantity for {{ $item->product->product_name }}"
                      class="quantity quantity-input"
                      style="width: 70px;">
                  </div>

                  <!-- Add to Basket form -->
                  <form method="POST" action="{{ route('basket.add') }}" class="basket-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item->product->product_id }}">
                    <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                    <button type="submit" class="button-primary add-to-basket" aria-label="Add {{ $item->product->product_name }} to basket">
                      Add to Basket
                    </button>
                  </form>

                  <!-- Remove link -->
                  <a href="#"
                    class="remove-link"
                    onclick="showRemovePopup(this); return false;"
                    aria-label="Remove {{ $item->product->product_name }} from wishlist">
                    Remove item
                  </a>
                  <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="hidden-form">
                    @csrf
                    @method('DELETE')
                  </form>

                  <!-- Price -->
                  <div class="price" aria-label="Price: £{{ number_format($item->product->product_price, 2) }}">
                    £{{ number_format($item->product->product_price, 2) }}
                  </div>
                </div>

                <!-- Availability Information -->
                <div class="availability white-box">
                  <p>You can choose your delivery or collection preferences at checkout</p>
                  <div class="availability-item">
                    <img src="{{ asset('images/truck.svg') }}" alt="" class="availability-icon" aria-hidden="true">
                    <span>Delivery available</span>
                  </div>
                  <div class="availability-item">
                    <img src="{{ asset('images/shop.svg') }}" alt="" class="availability-icon" aria-hidden="true">
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
            <a href="{{ url('/basket') }}" class="button-primary basket-button" role="button">Go to Basket</a>
            <!-- Continue shopping link -->
            <a href="{{ url('/products') }}" class="button-secondary continue-shopping" role="button">Continue shopping</a>
          </div>
        </div>
        @else
        <!-- Empty Wishlist Message -->
        <div class="empty-wishlist">
          <p>Your wishlist is empty</p>
          <p>When you add items they'll appear here</p>
          <a href="{{ url('/products') }}" class="button-secondary continue-shopping" role="button">Continue shopping</a>
        </div>
        @endif
      </div>

      <!-- Remove Item Popup -->
      <div id="remove-popup" class="popup" role="dialog" aria-modal="true" aria-labelledby="remove-popup-title">
        <div class="popup-content">
          <p id="remove-popup-title">Are you sure you want to remove this item?</p>
          <div class="popup-buttons">
            <button onclick="removeItem()" class="button-primary remove-button">Yes</button>
            <button onclick="closePopup()" class="button-secondary cancel-button">No</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  @include('components.footer')
  <script src="{{ asset('js/Wishlist.js') }}"></script>
  <script src="{{ asset('js/TotalBox.js') }}"></script>
</body>

</html>