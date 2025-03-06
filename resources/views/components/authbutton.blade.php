<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Auth Button - Gadget Grads</title>
  <link rel="stylesheet" href="{{ asset('css/authbutton.css') }}">
</head>

<body>
  <!-- Main Login Button -->
  <button id="login-btn" class="login-btn">Log In</button>

  <!-- Login Pop-up -->
  <div id="auth-popup" class="auth-popup">
    <div class="auth-popup-content">
      <span class="close-btn">&times;</span>
      <div class="login-box">
        <h2 class="login-title">Login</h2>
        <p class="signup-text">New to Gadget Grads? <a href="#" id="signup-link" class="signup-link">Sign up here!</a></p>

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
            <img src="{{ asset('images/eye-open.svg') }}" class="eye-icon" alt="Show Password">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="input-container remember-me">
            <input type="checkbox" id="remember-me" name="remember-me">
            <label for="remember-me">Remember me</label>
          </div>
          <a href="#" class="forgot-password" id="forgot-password-link">Forgot Password?</a>
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
        <form action="{{ route('register.post') }}" method="POST">
          @csrf
          <div class="input-container">
            <img src="{{ asset('images/user.svg') }}" class="icon" alt="Username Icon">
            <label for="signup-name">Username:</label>
            <input type="text" id="signup-name" name="name" value="{{ old('name') }}" required>
          </div>
          <div class="input-container">
            <img src="{{ asset('images/mail.svg') }}" class="icon" alt="Email Icon">
            <label for="signup-email">Email:</label>
            <input type="email" id="signup-email" name="email" value="{{ old('email') }}" required>
          </div>
          <div class="input-container">
            <img src="{{ asset('images/lock-on.svg') }}" class="icon" alt="Password Icon">
            <label for="signup-password">Password:</label>
            <input type="password" id="signup-password" name="password" required>
            <img src="{{ asset('images/eye-open.svg') }}" class="eye-icon" alt="Show Password">
          </div>
          <a href="#" class="back-to-login" id="back-to-login-signup">Back to Log In</a>
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
        <form action="{{ route('forgot.password.reset') }}" method="POST">
          @csrf
          <div class="input-container">
            <img src="{{ asset('images/mail.svg') }}" class="icon" alt="Email Icon">
            <label for="reset-email">Email:</label>
            <input type="email" id="reset-email" name="email" required>
          </div>
          <div class="input-container">
            <img src="{{ asset('images/lock-on.svg') }}" class="icon" alt="Password Icon">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <img src="{{ asset('images/eye-open.svg') }}" class="eye-icon" alt="Show Password">
          </div>
          <div class="input-container">
            <img src="{{ asset('images/lock-on.svg') }}" class="icon" alt="Password Icon">
            <label for="new_password_confirmation">Confirm New Password:</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
            <img src="{{ asset('images/eye-open.svg') }}" class="eye-icon" alt="Show Password">
          </div>
          <a href="#" class="back-to-login" id="back-to-login-forgot">Back to Log In</a>
          <button type="submit" class="login-submit">Reset Password</button>
        </form>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/JavaScript_pop-up.js') }}"></script>
</body>

</html>