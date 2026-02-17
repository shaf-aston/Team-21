<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Gadget Grads</title>
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('css/NavBar.css')}}"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
    <header>
    @include('components.navbar')
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