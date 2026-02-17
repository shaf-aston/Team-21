<!DOCTYPE html> 
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title>Checkout | Gadget Grads</title>
  <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
  <link rel="stylesheet" href="{{asset('css/NavBar.css')}}">
  <link rel="stylesheet" href="{{asset('css/Addingproduct.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
  <div class="form-container">
    <h2>Stock Inventory</h2>

    @if(session('success'))
      <p class="success-message">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
      <div class="error-messages">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form id="managementForm" method="POST" action="{{ route('addproduct') }}" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="product-name">Product Name</label>
        <input type="text" id="product-name" name="name" value="{{ old('name') }}" required>
      </div>

      <div class="form-group">
        <label for="product-price">Price</label>
        <input type="number" id="product-price" name="price" value="{{ old('price') }}" required min="0" step="0.01">
      </div>

      <div class="form-group">
        <label for="categoryid">Category Id</label>
        <input type="number" id="categoryid" name="categoryid" value="{{ old('categoryid') }}" required>
      </div>

      <div class="form-group">
        <label for="product-description">Description</label>
        <textarea id="product-description" name="description" required>{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label for="stock-quantity">Quantity</label>
        <input type="number" id="stock-quantity" name="quantity" value="{{ old('quantity') }}" required min="1">
      </div>

      <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" id="brand" name="brand" value="{{ old('brand') }}" required>
      </div>

      <div class="form-group">
        <label for="colour">Colour</label>
        <input type="text" id="colour" name="colour" value="{{ old('colour') }}" required>
      </div>

      <div class="form-group">
        <label for="ram">RAM</label>
        <input type="text" id="ram" name="ram" value="{{ old('ram') }}" required>
      </div>

      <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" id="image" name="image" required>
      </div>

      <div class="form-buttons">
        <button type="submit">Add Product</button>
      </div>
    </form>
  </div>
</body>

</html>