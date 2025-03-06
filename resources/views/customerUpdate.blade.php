<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updating product information | Gadget Grads</title>
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    <link rel="stylesheet" href="{{asset('css/NavBar.css')}}">
    <link rel="stylesheet" href="{{asset('css/editcustomerdetailsform.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Lobster&display=swap" rel="stylesheet">
</head>


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
            <!-- <div class="icons">
                <a href="{{url('/nav')}}" class="user-icon" title="Sign in"><img src="{{asset('images/user.svg')}}" height="30"></a>
                <a href="{{url('/wishlist')}}" class="wishlist-icon" title="Wishlist"><img src="{{asset('images/heart.svg')}}" height="30"></a>
                <a href="{{url('/basket')}}"class="cart-icon" title="Basket"><img src="{{asset('images/basket.svg')}}" height="30"></a>
        </div> -->
        </header>
        <!-- nav bar -->
        <!-- <nav class="nav-bar">
            <ul>
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{url('/products')}}">Products</a></li>
                <li><a href="{{url('/about')}}">About Us</a></li>
                <li><a href="{{url('/basket')}}">Basket</a></li>
                <li><a href="{{url('/contact')}}">Contact Us</a></li>
            </ul>
        </nav> -->

    </header>

    <body>
    <!-- updating product information form -->

    <div class="form-container">
    <h2>Customer Details</h2>
    <form method="POST" action="{{ route('customer.update') }}">
        @csrf


        <div class="form-group">
            <label for="name">Name</label>
            <div class="name-group">
                <input type="text" id="name" name="name" placeholder="First Name" value="{{ old('name', auth()->user()->name) }}" required>
                @error('name')
                    <p class="error-message" style="color: red;">{{ $message }}</p>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="e.g. hello@gmail.com" value="{{ old('email', auth()->user()->email) }}" required>
            @error('email')
                <p class="error-message" style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="{{ old('password', auth()->user()->password) }}"required>
            @error('password')
                <p class="error-message" style="color: red;">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-buttons">
            <button type="submit">Update</button>
            <button type="button" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete</button>
        </div>
    </form>


</div>
</body>
</html>