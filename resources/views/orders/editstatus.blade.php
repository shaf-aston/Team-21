<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Updating product information | Gadget Grads</title>
  <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
  <link rel="stylesheet" href="{{asset('css/NavBar.css')}}">
  <link rel="stylesheet" href="{{asset('css/Addingproduct.css')}}">
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
    <h2>Change Order Status for Order #{{ $order->order_id }}</h2>

    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('orders.adminUpdateStatus', ['order' => $order->order_id]) }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="order_status">Order Status</label>
        <select name="order_status" id="order_status" class="form-control @error('order_status') is-invalid @enderror" required>
          <option value="pending" {{ old('order_status', $order->order_status) == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="shipped" {{ old('order_status', $order->order_status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
          <option value="delivered" {{ old('order_status', $order->order_status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
          <option value="canceled" {{ old('order_status', $order->order_status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
        </select>
        @error('order_status')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit">Update Status</button>
      <a href="{{ route('orders.adminIndex') }}" class="btn btn-secondary">Back to Orders</a>
    </form>
  </div>

</body>

</html>