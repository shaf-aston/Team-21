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
  <link rel="stylesheet" href="{{ asset('css/LoginPopUp.css') }}">
  <link rel="stylesheet" href="{{ asset('css/Basket.css') }}">
  <link rel="stylesheet" href="{{ asset('css/PaymentMethods.css') }}">
  <link rel="stylesheet" href="{{ asset('css/RemoveItem.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dark-mode-styles/basket-dark-mode.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>


<body>
  @include('components.navbar')
  <div class="container my-5">
    <!-- Basket Header -->
    <h2 class="mb-4">Your Basket (<span id="item-count-header">{{ count($basketItems) }}</span> <span id="item-label">items</span>)</h2>

    <!-- Basket Content -->
    <div class="basket-content">
      <div class="basket-container">
        <!-- Loop through basket items -->
        @php $total = 0; @endphp
        @foreach($basketItems as $item)
        <div class="basket-item mb-4 p-3 border rounded">
          <div class="product-info d-flex align-items-start">
            <!-- Product image -->
            <img src="Images\{{$item->product->img_id}}.jpg" alt="Product Image" class="product-image me-3">

            <!-- Product Details -->
            <div class="product-details">
              <!-- Name and Price -->
              <div class="product-name fw-bold">{{ $item->product->product_name }}</div>
              <div class="product-details-row d-flex align-items-center">
                <div class="quantity-section me-3">
                  <label for="quantity">Quantity:</label>
                  <form action="{{ route('basket.update', $item->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('PUT')
                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity form-control d-inline-block" style="width: 70px;">
                    <button type="submit" class="btn btn-sm btn-primary ms-2">Update</button>
                  </form>
                </div>

                <!-- Remove link -->
                <form action="{{ route('basket.remove', $item->id) }}" method="POST" class="d-inline-block">
                  @csrf
                  @method('DELETE')
                  <a href="#" class="remove-link text-danger" onclick="this.closest('form').submit()">Remove item</a>
                </form>

                <!-- Price -->
                <div class="price ms-auto">£{{ number_format($item->product->product_price, 2) }}</div>
              </div>

              <!-- Delivery/Collection Information -->
              <div class="availability white-box mt-3">
                <p>You can choose your delivery or collection preferences at checkout</p>
                <div class="availability-item d-flex align-items-center">
                  <img src="{{asset('images/truck.svg')}}" alt="Delivery Icon" class="availability-icon me-2">
                  <span>Delivery available</span>
                </div>
                <div class="availability-item d-flex align-items-center">
                  <img src="{{asset('images/shop.svg')}}" alt="Collection Icon" class="availability-icon me-2">
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
      <div class="total-box-container mt-5">
        <div class="total-box p-4 border rounded">
          <!-- Payment Options -->
          <div class="payment-options mb-3">
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
          <a href="{{ url('/checkout2') }}" class="btn btn-success w-100 mt-3">Proceed to Checkout</a>

          <!-- Payment Icons -->
          <p class="text-center mt-3">Pay securely with</p>
          <div class="payment-icons d-flex justify-content-center">
            <img src="{{ asset('images/Maestro.svg') }}" alt="Maestro" class="me-2">
            <img src="{{ asset('images/MasterCard.svg') }}" alt="MasterCard" class="me-2">
            <img src="{{ asset('images/Visa.svg') }}" alt="Visa" class="me-2">
            <img src="{{ asset('images/PayPal.svg') }}" alt="PayPal">
          </div>

          <!-- Continue Shopping -->
          <a href="{{ url('/nav') }}" class="continue-shopping d-block text-center mt-3">Continue shopping</a>

          <!-- Disclaimer -->
          <div class="disclaimer mt-4">
            <p><strong>Illustrative example:</strong> Credit amount £579.00. Pay 36 monthly payments of £23.46. Total amount payable £844.56. The interest rate for this purchase is 19.9%.</p>
            <p><strong>Representative example:</strong> Rate of interest 19.9% (variable). 19.9% APR representative (variable). Assumed Credit Limit £1,200.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Remove Item Popup -->
    <div id="remove-popup" class="popup d-none">
      <div class="popup-content">
        <p>Are you sure you want to remove this item?</p>
        <button onclick="removeItem()" class="btn btn-danger">Yes</button>
        <button onclick="closePopup()" class="btn btn-secondary">No</button>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{asset('js/Basket.js')}}"></script>
  <script src="{{asset('js/PaymentMethods.js')}}"></script>
</body>

</html>