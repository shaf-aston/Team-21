<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title> Tablet Page </title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin/admin-view.css') }}">
  </head>

<body>
  @include('components.admin-navbar')
  <!-- sort function -->
  <div class="sort-section">
    <label for="sort">Sort by:</label>
    <form method="POST" action="/productssort">
      @csrf
      <select id="sort" name="sort">
        <option {{request()->sortby}} value="default">Default</option>
        <option {{request()->sortby}} value="priceasc">Price: Low to High</option>
        <option {{request()->sortby}} value="pricedesc">Price: High to Low</option>
        <option {{request()->sortby}} value="nameasc">Name: A to Z</option>
        <option {{request()->sortby}} value="namedesc">Name: Z to A</option>
      </select>
      <button type="submit">Sort!</button>
    </form>
  </div>
  <button class="view-button" type="submit" id="viewprod" onclick="window.location='{{url('/products/create')}}'"> Add product</button>


  <!-- product display -->
  @foreach ($products as $product)
  <div class="product-section">
    <div class="product">
      <img src="Images\{{$product->img_id}}.jpg" alt="Product" class="iPadAir">
      <div class="product-info">
        <h3 class="product-title"> {{$product->product_name}}</h3>
        <p class="product-price">£{{$product->product_price}}</p>
        <p class="product-stock">Stock Quantity: {{$product->stock_quantity}}</p>
        <!-- Low stock alert message -->
        @if($product->stock_quantity <= 5 && $product->stock_quantity > 0)
          <p class="text-warning">Make an order to the supplier for this product. Only {{$product->stock_quantity}} left in stock.</p>
          @elseif($product->stock_quantity == 0)
          <p class="text-danger">Out of stock</p>
          @endif
          <div class="product-buttons">
            <!-- view button -->
            <button class="view-button" type="submit" id="viewprod" onclick="window.location='{{url('productdesc',$product->product_id)}}'">View Product</button>
            <button class="view-button" type="submit" id="viewprod" onclick="window.location='{{route('products.update', $product->product_id)}}'">Update Product Info</button>

            <!-- Add to Basket -->
            <!-- <div class="card-footer text-center">
        @if(Auth::check())
          <form method="POST" action="{{ route('basket.add') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="add-button btn-primary">Add to Basket</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-primary">Log in to Add to Basket</a>
        @endif
    </div> -->

            <!-- Remove the product -->

            @if(Auth::check())
            <form action="{{ route('admin.remove', $product->product_id) }}" method="POST" class="d-inline-block">
              @csrf
              @method('DELETE')
              <button type='submit' class="remove-link text-danger" onclick="this.closest('form').submit()">Remove item</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary">Log in to remove product</a>
            @endif
          </div>
      </div>
    </div>
  </div>
  @endforeach

  </header>
</body>

</html>