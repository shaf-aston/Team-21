<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Navbar</title>
  <link rel="stylesheet" href="{{asset('css/admin/admin-navbar.css')}}">
</head>

<body>
  <header id="main-header">
    <a href="{{ url('/home') }}"><img src="{{ asset('Images/logo.png') }}" alt="Gadget Grads Logo" class="logo" width="98" height="48"></a>
    <h1>GADGET GRADS</h1>
    <h2>Graduate with better tech!</h2>

    <div class="searchnav">
      <form action="{{ route('search') }}" method="GET">
        <input type="text" class="search-bar" name="query" placeholder="Search for products by name or description" required>
        <button class="search-button" type="submit">Search</button>
      </form>
    </div>
  </header>

  <nav class="nav-bar">
    <ul>
      <li><a href="{{ url('/home') }}">Home</a></li>
      <li><a href="{{ url('/products') }}">Products</a></li>
      <li><a href="{{ url('/about') }}">About Us</a></li>
      <li><a href="{{ url('/basket') }}">Basket</a></li>
      <li><a href="{{ url('/contact') }}">Contact Us</a></li>
    </ul>
  </nav>

  <nav id="gadgetGrads">
    <div class="topnav">
      <a class="active" href="{{ url('Tablets') }}">Tablets</a>
      <a href="{{ url('Laptops') }}">Laptops</a>
      <a href="{{ url('Accessories') }}">Accessories</a>
      <a href="{{ url('Phones') }}">Phones</a>
      <a href="{{ url('Smartwatches') }}">Smartwatches</a>
    </div>
  </nav>
</body>

</html>