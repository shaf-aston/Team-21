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
</head>

<body>
  <header>
    <!-- logo and header -->
    <header class="header">
      <div class="logo-container">
        <a href="index.html" class="logo">
          <img src="{{asset('images/GG_higher-resolution.png')}}" alt="Logo" height="50">
        </a>
        <div class="site-info">
          <h1 class="title">GADGET GRADS</h1>
          <h2 class="subheading">Graduate with better tech!</h2>
        </div>

      </div>
      <!-- icons -->
      <div class="icons">
        <a href="{{url('/nav')}}" class="user-icon" title="Sign in"><img src="{{asset('images/user.svg')}}" height="30"></a>
        <a href="{{url('/wishlist')}}" class="wishlist-icon" title="Wishlist"><img src="{{asset('images/heart.svg')}}" height="30"></a>
        <a href="{{url('/basket')}}" class="cart-icon" title="Basket"><img src="{{asset('images/basket.svg')}}" height="30"></a>
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

  </header>
  <!-- check out form -->

  <div class="checkout-container">
    <h3>Checkout</h3>
    <form id="checkoutForm" method="POST" action="{{ route('checkout.verify') }}">
      @csrf
      <div class="form-group">
        <input type="text" id="fullName" name="fullName" value="{{ old('fullName') }}" placeholder="Full Name" required>
        @error('fullName')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
        @error('email')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" required>
        @error('phone')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Address" required>
        @error('address')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="text" id="city" name="city" value="{{ old('city') }}" placeholder="City" required>
        @error('city')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="text" id="zip" name="zip" value="{{ old('zip') }}" placeholder="Zip Code" required>
        @error('zip')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="text" id="cardName" name="cardName" value="{{ old('cardName') }}" placeholder="Name on Card" required>
        @error('cardName')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="text" id="cardNumber" name="cardNumber" value="{{ old('cardNumber') }}" placeholder="Card Number" required>
        @error('cardNumber')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="month" id="expiryDate" name="expiryDate" value="{{ old('expiryDate') }}" placeholder="yyyy-mm" required>
        @error('expiryDate')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <input type="text" id="cvv" name="cvv" value="{{ old('cvv') }}" placeholder="CVV" required>
        @error('cvv')
        <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="checkout-button">Place Order</button>
    </form>
  </div>


</body>

</html>