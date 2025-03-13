<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Gadget Grads - Login/Sign Up</title>

  <link rel="stylesheet" href="{{ asset('css/NavBar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/LoginPopUp.css') }}">
  <link rel="stylesheet" href="{{asset('css/Home.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <div class="header-content">
      <div class="logo-container">
        <!-- Use Laravel's asset helper for images -->
        <img src="{{ asset('images/GG_higher-resolution.png') }}" alt="Gadget Grads Logo">
        <div class="logo-text">
          <h1>Gadget Grads</h1>
          <p>Graduate with better tech!</p>
        </div>
      </div>
      <!-- searchbar -->
      <form action="{{route('search')}}" method="GET">
        <input type="text" class="search-bar" name="query" placeholder="Search for products by name or description" required>
        <button class="search-button" type="submit">Search</button>
      </form>
      <!-- logout button -->
      <button id="login-btn" class="login-btn">Log In</button>
      <form action="{{route('logout')}}" method="POST">
        @csrf
        <button id="logout-btn" class="login-btn">Logout</button>
      </form>
    </div>
    <!-- nav-bar -->
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
  <main>
  </main>

  <!-- Login Pop-up -->
  <div id="auth-popup" class="auth-popup">
    <div class="auth-popup-content">
      <span class="close-btn">&times;</span>
      <div class="login-box">
        <h2 class="login-title">Login</h2>
        <p class="signup-text">New to Gadget Grads? <a href="#" id="signup-link" class="signup-link">Sign up here!</a></p>

        <!-- Display Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
          @csrf
          <div class="input-container">
            <img src="{{ asset('images/mail.svg') }}" class="icon" alt="Email Icon">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="input-container">
            <img src="{{ asset('images/lock-on.svg') }}" class="icon" alt="Password Icon">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="input-container">
            <label for="user_type">User Type:</label>
            <select id="user_type" name="user_type" required>
              <option value="customer" {{ old('user_type') == 'customer' ? 'selected' : '' }}>Customer</option>
              <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('user_type')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="input-container remember-me">
            <input type="checkbox" id="remember-me" name="remember-me">
            <label for="remember-me">Remember me</label>
          </div>

          <button type="submit" class="login-submit">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Sign Up Pop-up -->
  <div id="signup-popup" class="auth-popup">
    <div class="auth-popup-content">
      <span class="close-btn">&times;</span>
      <div class="login-box">
        <h2 class="login-title">Sign Up</h2>

        <!-- Display Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
          @csrf
          <div class="input-container">
            <img src="{{ asset('images/user.svg') }}" class="icon" alt="Username Icon">
            <label for="name">Username:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="input-container">
            <img src="{{ asset('images/mail.svg') }}" class="icon" alt="Email Icon">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="input-container">
            <img src="{{ asset('images/lock-on.svg') }}" class="icon" alt="Password Icon">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" class="login-submit">Sign Up</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Forgot Password Pop-up -->
  <div id="forgot-password-popup" class="auth-popup">
    <div class="auth-popup-content">
      <span class="close-btn">&times;</span>
      <div class="login-box">
        <h2 class="login-title">Forgot Password</h2>
        <form action="{{route('forgot.password.reset')}}" method="POST">
          @csrf
          <div class="input-container">
            <img src="mail.svg" class="icon" alt="Email Icon">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
          </div>
          <div class="input-container">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>
          </div>
          <div class="input-container">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
          </div>
          <a href="#" class="back-to-login" id="back-to-login-forgot">Back to Log In</a>
          <button type="submit" class="login-submit" id="reset-password-btn">Reset Password</button>
        </form>
      </div>
    </div>
  </div>

  @auth
  <p>
    <a href="{{ route('customer.edit') }}" class="btn btn-primary">Update Your Details</a>
  </p>
  @endauth

  @auth
  <p>
    <a href="{{ route('orders.index') }}" class="btn btn-primary">My Orders</a>
  </p>

  @endauth





  <!-- Use Laravel's asset helper for JavaScript -->
  <script src="{{ asset('js/JavaScript_pop-up.js') }}"></script>
</body>

</html>