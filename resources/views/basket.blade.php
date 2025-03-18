<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Gadget Grads - Basket</title>
  <link rel="stylesheet" href="{{ asset('css/Basket.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
  @include('components.navbar')
  <main>
    <div class="container basket-page">
      <!-- Basket Header -->
      <h2 class="basket-title">Your Basket (<span id="item-count-header">{{ count($basketItems) }}</span> <span id="item-label">items</span>)</h2>

      <!-- Basket Content -->
      <div class="basket-content">
        <div class="basket-container">
          <!-- Loop through basket items -->
          @php $total = 0; @endphp
          @foreach($basketItems as $item)
          <div class="basket-item">
            <div class="product-info">
              <!-- Product image -->
              <img src="Images\{{$item->product->img_id}}.jpg" alt="Product Image" class="product-image">

              <!-- Product Details -->
              <div class="product-details">
                <div class="product-name">{{ $item->product->product_name }}</div>
                <div class="product-details-row">
                  <div class="quantity-section">
                    <label for="quantity-{{ $item->id }}">Quantity:</label>
                    <form action="{{ route('basket.update', $item->id) }}" method="POST" class="quantity-form">
                      @csrf
                      @method('PUT')
                      <input type="number" 
                             id="quantity-{{ $item->id }}"
                             name="quantity" 
                             value="{{ $item->quantity }}" 
                             min="1" 
                             class="quantity-input">
                      <button type="submit" class="update-button">Update</button>
                    </form>
                  </div>

                  <!-- Remove link -->
                  <form action="{{ route('basket.remove', $item->id) }}" method="POST" class="remove-form">
                    @csrf
                    @method('DELETE')
                    <a href="#" class="remove-link" onclick="this.closest('form').submit()">Remove item</a>
                  </form>

                  <!-- Price -->
                  <div class="price">£{{ number_format($item->product->product_price, 2) }}</div>
                </div>

                <!-- Delivery/Collection Information -->
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
            <!-- Payment Options -->
            <div class="payment-options">
              <label>
                <input type="checkbox" class="payment-checkbox"> Card/Paypal
              </label>
              <label>
                <input type="checkbox" class="payment-checkbox"> Spread the cost
              </label>
            </div>

            <!-- Payment Details -->
            <div class="payment-details">
              <p>Make monthly payments</p>
              <ul>
                <li id="monthly-payment">From £{{ number_format($total / 36, 2) }} for 36 months</li>
              </ul>
              <p>Or buy now, pay later</p>
              <ul>
                <li id="buy-later-date">Pay as much as you'd like for 12 months, settle in full by (date) and pay no interest</li>
              </ul>
            </div>
            <p>Total: £<span id="basket-total">{{ number_format($total, 2) }}</span></p>

            <!-- Checkout Button -->
            <a href="{{ url('/checkout2') }}" class="checkout-button">Proceed to Checkout</a>

            <!-- Payment Icons -->
            <p class="payment-text">Pay securely with</p>
            <div class="payment-icons">
              <img src="{{ asset('images/Maestro.svg') }}" alt="Maestro">
              <img src="{{ asset('images/MasterCard.svg') }}" alt="MasterCard">
              <img src="{{ asset('images/Visa.svg') }}" alt="Visa">
              <img src="{{ asset('images/PayPal.svg') }}" alt="PayPal">
            </div>

            <!-- Continue Shopping -->
            <a href="{{ url('/nav') }}" class="continue-shopping">Continue shopping</a>

            <!-- Disclaimer -->
            <div class="disclaimer">
              <p><strong>Illustrative example:</strong> Credit amount £579.00. Pay 36 monthly payments of £23.46. Total amount payable £844.56. The interest rate for this purchase is 19.9%.</p>
              <p><strong>Representative example:</strong> Rate of interest 19.9% (variable). 19.9% APR representative (variable). Assumed Credit Limit £1,200.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Remove Item Popup -->
      <div id="remove-popup" class="popup">
        <div class="popup-content">
          <p>Are you sure you want to remove this item?</p>
          <div class="popup-buttons">
            <button onclick="removeItem()" class="remove-button">Yes</button>
            <button onclick="closePopup()" class="cancel-button">No</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  @include('components.footer')
  <!-- Scripts -->
  <script src="{{asset('js/Basket.js')}}"></script>
  <script src="{{asset('js/PaymentMethods.js')}}"></script>
</body>
</html>