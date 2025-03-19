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

  <title>Gadget Grads - Basket</title>
  <link rel="stylesheet" href="{{ asset('css/Basket.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dark-mode-styles/basket-dark-mode.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
  @include('components.navbar')
  <div class="container">
    <!-- Basket Header -->
    <h2 class="basket-title">Your Basket (<span id="item-count-header">{{ count($basketItems) }}</span> <span id="item-label">items</span>)</h2>

    <!-- Basket Content -->
    <div class="basket-content">
      <div class="basket-container">
        @php $total = 0; @endphp
        @foreach($basketItems as $item)
        <div class="basket-item" data-item-id="{{ $item->id }}">
            <div class="product-info">
                <img src="Images\{{$item->product->img_id}}.jpg" alt="Product Image" class="product-image">
                <div class="product-details">
                    <div class="product-name">{{ $item->product->product_name }}</div>
                    <div class="product-details-row">
                        <div class="quantity-section">
                            <label for="quantity-{{$item->id}}">Quantity:</label>
                            <input type="number"
                                id="quantity-{{$item->id}}"
                                class="quantity quantity-input"
                                value="{{ $item->quantity }}"
                                min="1">
                            <form action="{{ route('basket.update', $item->id) }}" method="POST" style="display:none;" class="quantity-update-form">
                                @csrf
                                <input type="number" name="quantity" class="hidden-quantity">
                            </form>
                        </div>
                        <form action="{{ route('basket.remove', $item->id) }}" method="POST" class="remove-form" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="action-link" onclick="showRemovePopup(this)">Remove item</a>
                        <div class="price">£{{ number_format($item->product->product_price, 2) }}</div>
                    </div>
        
                    <div class="availability">
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

      <div class="total-box-container">
        <div class="total-box">
          <div class="payment-options">
            <label>
              <input type="checkbox" class="payment-checkbox"> Card/Paypal
            </label>
            <label>
              <input type="checkbox" class="payment-checkbox"> Spread the cost
            </label>
          </div>

          <div class="payment-details">
            <p>Make monthly payments</p>
            <div id="monthly-payment">From £{{ number_format($total / 36, 2) }} for 36 months</div>
            <p>Or buy now, pay later</p>
            <div id="buy-later-date"></div>
          </div>

          <p>Total: <span id="basket-total" data-initial-total="{{ $total }}">{{ number_format($total, 2) }}</span></p>

          <a href="{{ url('/checkout2') }}" class="checkout-button">Proceed to Checkout</a>

          <p class="text-center">Pay securely with</p>
          <div class="payment-icons">
            <img src="{{ asset('images/Maestro.svg') }}" alt="Maestro">
            <img src="{{ asset('images/MasterCard.svg') }}" alt="MasterCard">
            <img src="{{ asset('images/Visa.svg') }}" alt="Visa">
            <img src="{{ asset('images/PayPal.svg') }}" alt="PayPal">
          </div>

          <a href="{{ url('/products') }}" class="continue-shopping">Continue shopping</a>

          <div class="disclaimer"></div>
        </div>
      </div>
    </div>

    <!-- Remove Item Popup -->
    <div id="remove-popup" class="popup">
      <div class="popup-content">
        <h4>Remove Item</h4>
        <p>Are you sure you want to remove this item from your basket?</p>
        <div class="popup-buttons">
          <button class="button remove-button" onclick="removeItem()">Remove</button>
          <button class="button cancel-button" onclick="closePopup()">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{asset('js/Basket.js')}}"></script>
  <script src="{{asset('js/PaymentMethods.js')}}"></script>
</body>

</html>