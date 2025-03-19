<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Checkout | Gadget Grads</title>
  <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
  @include('components.navbar')
  
    <div class="checkout-container">
      <form id="checkoutForm" method="POST" action="{{ route('checkout.verify') }}">
        @csrf
        <div class="form-sections">
          <!-- Left Column: Customer + Payment -->
          <div class="checkout-column main-column">
            <!-- Customer Information Section -->
            <div class="form-section">
              <h3>Customer Information</h3>
              <div class="form-grid">
                <div class="form-group full-width">
                  <label for="fullName">Full Name</label>
                  <input type="text" id="fullName" name="fullName" value="{{ old('fullName') }}" required>
                  @error('fullName')
                  <p class="error-message">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="email">Email Address</label>
                  <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                  @error('email')
                  <p class="error-message">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                  @error('phone')
                  <p class="error-message">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group full-width">
                  <label for="address">Street Address</label>
                  <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                  @error('address')
                  <p class="error-message">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" id="city" name="city" value="{{ old('city') }}" required>
                  @error('city')
                  <p class="error-message">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="zip">Post Code</label>
                  <input type="text" id="zip" name="zip" value="{{ old('zip') }}" required>
                  @error('zip')
                  <p class="error-message">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Payment Information Section -->
            <div class="form-section">
              <h3>Payment Method</h3>
              <div class="form-grid">
                <div class="payment-methods">
                  <div class="payment-method">
                    <input type="radio" id="card-payment" name="paymentMethod" value="card" checked>
                    <label for="card-payment" class="method-label">
                      <span class="method-name">Credit/Debit Card</span>
                      <div class="card-icons">
                        <img src="{{ asset('images/Visa.svg') }}" alt="Visa">
                        <img src="{{ asset('images/MasterCard.svg') }}" alt="Mastercard">
                        <img src="{{ asset('images/Maestro.svg') }}" alt="Maestro">
                      </div>
                    </label>
                  </div>
                  
                  <div class="payment-method">
                    <input type="radio" id="paypal-payment" name="paymentMethod" value="paypal">
                    <label for="paypal-payment" class="method-label">
                      <span class="method-name">PayPal</span>
                      <div class="card-icons">
                        <img src="{{ asset('images/PayPal.svg') }}" alt="PayPal">
                      </div>
                    </label>
                  </div>
                </div>
                
                <div id="card-details" class="full-width">
                  <div class="form-group full-width">
                    <label for="cardName">Name on Card</label>
                    <input type="text" id="cardName" name="cardName" value="{{ old('cardName') }}">
                    @error('cardName')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="form-group full-width">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" maxlength="19" placeholder="XXXX XXXX XXXX XXXX">
                    @error('cardNumber')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="card-extra-details">
                    <div class="form-group">
                      <label for="expiryDate">Expiry Date</label>
                      <input type="month" id="expiryDate" name="expiryDate" value="{{ old('expiryDate') }}">
                      @error('expiryDate')
                      <p class="error-message">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="cvv">Security Code</label>
                      <input type="text" id="cvv" name="cvv" value="{{ old('cvv') }}" maxlength="4" placeholder="CVV">
                      @error('cvv')
                      <p class="error-message">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Right Column: Order Summary -->
          <div class="checkout-column summary-column">
            <div class="form-section order-summary-section">
              <h3>Order Summary</h3>
              <div class="order-summary">
                <div class="summary-items">
                  @php
                    $subtotal = session('cart_total', 89.99); 
                    $shipping = session('shipping_cost', 3.99);
                    $tax = session('tax', round($subtotal * 0.2, 2));
                    $total = session('total_with_tax', $subtotal + $shipping + $tax);
                  @endphp
                  
                  <div class="summary-item">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">£{{ number_format($subtotal, 2) }}</span>
                  </div>
                  <div class="summary-item">
                    <span class="summary-label">Shipping</span>
                    <span class="summary-value">£{{ number_format($shipping, 2) }}</span>
                  </div>
                  <div class="summary-item">
                    <span class="summary-label">VAT (20%)</span>
                    <span class="summary-value">£{{ number_format($tax, 2) }}</span>
                  </div>
                </div>
                
                <div class="summary-divider"></div>
                
                <div class="summary-item total">
                  <span class="summary-label">Total</span>
                  <span class="summary-value">£{{ number_format($total, 2) }}</span>
                </div>
                
                <div class="promo-code">
                  <label for="promoCode">Promo Code</label>
                  <div class="promo-input">
                    <input type="text" id="promoCode" name="promoCode" placeholder="Enter promo code">
                    <button type="button" class="apply-code-btn">Apply</button>
                  </div>
                </div>
                
                <button type="submit" class="checkout-button">Complete Order</button>
                
                <div class="secure-checkout">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                  </svg>
                  <span>Secure Checkout</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <script>
    // Simple JS to toggle payment methods
    document.addEventListener('DOMContentLoaded', function() {
      const cardRadio = document.getElementById('card-payment');
      const paypalRadio = document.getElementById('paypal-payment');
      const cardDetails = document.getElementById('card-details');
      
      cardRadio.addEventListener('change', function() {
        cardDetails.style.display = 'block';
      });
      
      paypalRadio.addEventListener('change', function() {
        cardDetails.style.display = 'none';
      });
    });
  </script>
</body>

</html>