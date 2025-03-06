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
</body>

</html>