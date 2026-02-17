<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Admin Product Show</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('/css/UserReview.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/Product.css') }}">


</head>


<body>
  @include('components.admin-navbar')

  <div class="product-container">
    <img id="product-image" src="/Images\{{$product->img_id}}.jpg" alt="Product Image">
    <div id="zoom-result"></div>
    <script src="{{asset('js/Product.js')}}"></script>
  </div>

  <h3 class="product-title"> {{$product->product_name}}</h3>
  <p class="product-price">£{{$product->product_price}}</p>
  <p class="product-title">{{$product->product_description}}</p>



  </header>
</body>

</html>