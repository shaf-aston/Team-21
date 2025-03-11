<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gadget Grads - Login/Sign Up</title>
    <link rel="stylesheet" href="{{asset('css/NavBar.css')}}">
    <link rel="stylesheet" href="{{asset('css/AboutUs.css')}}">
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    <link rel="stylesheet" href="{{asset('css/Tablet.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-container">
               
                <img src="{{ asset('images/GG_higher-resolution.png') }}" alt="Gadget Grads Logo">
                <div class="logo-text">
                    <h1>Gadget Grads</h1>
                    <p>Graduate with better tech!</p>
                </div>
            </div>

        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{url('/products')}}">Products</a></li>
                <li><a href="{{url('/about')}}">About Us</a></li>
                <li><a href="{{url('/basket')}}">Basket</a></li>
                <li><a href="{{url('/contact')}}">Contact Us</a></li>
                
    
            </ul>
        </nav>
        <div class="icons">
                <a href="{{url('/nav')}}" class="user-icon" title="Sign in"><img src="{{asset('images/user.svg')}}" height="30"></a>
                <a href="{{url('/wishlist')}}" class="wishlist-icon" title="Wishlist"><img src="{{asset('images/heart.svg')}}" height="30"></a>
                <a href="{{url('/basket')}}"class="cart-icon" title="Basket"><img src="{{asset('images/basket.svg')}}" height="30"></a>
        </div>
    </header>
<body>
    <h1>Search Results for "{{$query}}"</h1>

    @if($products->isEmpty())
        <p>No products found matching your search criteria</p>
    @else

            @foreach ($products as $product)
            <div class = "product-section">
            <div class="product">
            <img src= "Images\{{$product->img_id}}.jpg" alt="Product" class="iPadAir">
            <div class ="product-info">
                <h3 class="product-title"> {{$product->product_name}}</h3>  
                <p class ="product-price">{{$product->product_price}}</p>
                <div class="product-buttons">
            <button class="view-button" type = "submit" id="viewprod" onclick="window.location='{{url('productdesc',$product->product_id)}}'">View Product</button>
            
                <!-- Add to Basket -->
                <div class="card-footer text-center">
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
                </div>
            </div>
            </div>
            </div>
            </div>
            @endforeach
    @endif
    
</body>
</html>