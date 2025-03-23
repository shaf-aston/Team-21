<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Preview</title>
  <link rel="stylesheet" href="{{ asset('/css/NavBar.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/navbar-dark-mode.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="navbar-wrapper">
    <header id="main-header">
      <div class="header-left">
        <a href="{{ url('/home') }}">
          <img src="{{ asset('images/logo.png') }}" alt="Gadget Grads Logo" class="logo">
        </a>
        <div class="navbar-text">
          <h1 class="navbar-title">GADGET GRADS</h1>
          <p class="navbar-subtitle">Graduate with better tech!</p>
        </div>
      </div>

      <div class="search-container">
        <form class="search-form" action="{{ route('search') }}" method="GET">
          <input type="text" class="search-input" name="query" placeholder="Search for products..." required>
          <button class="search-button" type="submit">Search</button>
        </form>
      </div>
      <div class="icons">
              <div class="profile-dropdown">
                @auth
                @if(Auth::user()->user_type == 'admin')
                <a href="{{ url('/adminproducts') }}" class="user-icon" title="Admin Dashboard">
                  <img src="{{ asset('images/user-1.svg') }}" height="30" alt="Admin icon">
                </a>
                @else
                <a href="{{ url('/dashboard') }}" class="user-icon" title="My Profile">
                  <img src="{{ asset('images/user-1.svg') }}" height="30" alt="User icon">
                </a>
                @endif
                @else
                <a href="#" class="user-icon" title="My Profile">
                  <img src="{{ asset('images/user-1.svg') }}" height="30" alt="User icon">
                </a>
                @endauth
                <div class="dropdown-content">
                  @auth
                  @if(Auth::user()->user_type == 'admin')
                  <a href="{{ url('/adminproducts') }}">Admin Dashboard</a>
                  <a href="{{ url('/adminusers') }}">Manage Users</a>
                  <a href="{{ url('/orders/admin') }}">Manage Orders</a>
                  <a href="{{ url('/supplier-orders') }}">Supplier Orders</a>
                  <a href="{{ url('/sales-report') }}">Sales Report</a>
                  <a href="{{ url('/stock-report') }}">Stock Report</a>
                  @else
                  <a href="{{ url('/dashboard') }}">My Profile</a>
                  <a href="{{ url('/orders') }}">My Orders</a>
                  @endif
                  <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                  @else
                  <a href="#" class="login-btn">Login</a>
                  <a href="#" class="register-btn">Register</a>
                  @endauth
                </div>
              </div>
              <a href="{{ url('/wishlist') }}" class="wishlist-icon" title="Wishlist">
                <img src="{{ asset('images/heart.svg') }}" height="30" alt="Wishlist icon">
              </a>
              <a href="{{ url('/basket') }}" class="cart-icon" title="Basket">
                <img src="{{ asset('images/basket.svg') }}" height="30" alt="Basket icon">
              </a>
            </div>
    </header>

    <nav class="navigation-banner">
      <ul>
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li class="has-dropdown">
          <a href="{{ url('/products') }}">Products</a>
          @if (!in_array(request()->path(), ['products', 'Tablets', 'Laptops', 'Accessories', 'Phones', 'Smartwatches']))
          <div class="dropdown-menu">
            <a href="{{ url('Tablets') }}">Tablets</a>
            <a href="{{ url('Laptops') }}">Laptops</a>
            <a href="{{ url('Accessories') }}">Accessories</a>
            <a href="{{ url('Phones') }}">Phones</a>
            <a href="{{ url('Smartwatches') }}">Smartwatches</a>
          </div>
          @endif
        </li>
        <li><a href="{{ url('/about') }}">About Us</a></li>
        <li><a href="{{ url('/basket') }}">Basket</a></li>
        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
        <li><a href="{{ url('/websitereviews') }}">Reviews</a></li>
      </ul>
      @include('components.dark-mode')
    </nav>
  </div>
  @include('components.scroll-to-top')
  @include('components.authbutton')
</body>

</html>