<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title>Admin Navbar</title>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Lobster&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin/admin-navbar.css') }}">
</head>

<body>
  <header id="main-header">
    <div class="logo-section">
      <a href="{{ url('/home') }}"><img src="{{ asset('Images/logo.png') }}" alt="Gadget Grads Logo" class="logo" width="98" height="48"></a>
      <div class="navbar-text">
        <h1 class="h1">GADGET GRADS</h1>
        <h2>Graduate with better tech!</h2>
      </div>
    </div>
    <div class="search-section">
      <h3 class="search-heading">Search Orders</h3>
      <div class="search-forms-container">
        <div class="searchnav">
          <form action="{{ route('adminproductsearch') }}" method="GET">
            <input type="text" class="search-bar" name="query" placeholder="Search for products by name or description" required>
            <button class="search-button" type="submit">Search</button>
          </form>
        </div>

        <div class="searchnav">
          <form action="{{route('adminsearch')}}" method="GET">
            <input type="text" class="search-bar" name="query" placeholder="Search for orders by id or status" required>
            <button class="search-button" type="submit">Search</button>
          </form>
        </div>

        <div class="searchnav">
          <form method="GET" action="{{ route('adminsort.result') }}" class="sort-controls">
            <label for="sort_by">Sort by:</label>
            <select name="sort_by" id="sort_by">
              <option value="order_id" {{ request('sort_by') == 'order_id' ? 'selected' : '' }}>Order ID</option>
              <option value="total_amount" {{ request('sort_by') == 'total_amount' ? 'selected' : '' }}>Price</option>
              <option value="order_status" {{ request('sort_by') == 'order_status' ? 'selected' : '' }}>Alphabetical (Order Status)</option>
            </select>

            <select name="sort_order" id="sort_order">
              <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
              <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>

            <button type="submit" class="search-button">Sort</button>
          </form>
        </div>
      </div>
    </div>
  </header>

  <nav class="navigation">
    <ul>
      <li><a href="{{ url('/admin') }}">Admin Dashboard</a></li>
      <li><a href="{{ url('/adminproducts') }}">Products</a></li>
      <li><a href="{{ url('/adminorders') }}">Orders</a></li>
      <li><a href="{{ url('/sales-report') }}">Reports</a></li>
      <li><a href="{{ url('/supplier-orders')}}">Supplier Orders</a></li>
      <li><a href="{{ url('/adminusers') }}">Manage Customers</a></li>
      <li><a href="{{ url('/home') }}">Return to Homepage</a></li>
      @if(Auth::check())
      <li>
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          @csrf
        </form>
      </li>
      @else
      <li><a href="#" class="login-btn">Login</a></li>
      @endif
    </ul>
  </nav>
  @include('components.authbutton')
</body>

</html>