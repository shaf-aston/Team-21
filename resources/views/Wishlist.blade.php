<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Character set and viewport settings for responsive design -->
       <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gadget Grads - Wishlist</title>
    <!-- Links to external CSS stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/LoginPopUp.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Basket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/PaymentMethods.css') }}">
    <link rel="stylesheet" href="{{ asset('css/RemoveItem.css') }}">
    <!-- Link to Google Fonts for custom font -->
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <div class="header-content">
        <div class="logo-container">
                <a href="index.html" class="logo">
                    <img src="{{asset('images/GG_higher-resolution.png')}}" alt="Logo" height="50">
                </a>
                <div class="site-info">
                    <h1 class="title">GADGET GRADS</h1>
                    <h2 class="subheading">Graduate with better tech!</h2>
                </div>

            </div>
            <div class="icons">
                <a href="{{url('/nav')}}" class="user-icon" title="Sign in"><img src="{{asset('images/user.svg')}}" height="30"></a>
                <a href="wishlist.html" class="wishlist-icon" title="Wishlist"><img src="{{asset('images/heart.svg')}}" height="30"></a>
                <a href="{{url('/basket')}}"class="cart-icon" title="Basket"><img src="{{asset('images/basket.svg')}}" height="30"></a>
        </div>      
        </div>
        <!-- Navigation bar with links to various sections -->
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
        <!-- Main content area for the wishlist -->
        <h2>Your Wishlist (<span id="item-count-header">0</span> <span id="item-label">items</span>)</h2>
        <div class="wishlist-content">
            <div class="wishlist-container">
                <div class="wishlist-item">
                    <div class="product-info">
                        <!-- Product image and details -->
                        <img src="Laptop.svg" alt="Product Image" class="product-image">
                        <div class="product-details">
                            <div class="product-name">Product Name</div>
                            <div class="product-details-row">
                                <div class="quantity-section">
                                    <!-- Quantity input for products -->
                                    <label for="quantity">Quantity:</label>
                                    <input type="number" id="quantity" value="1" min="1" class="quantity">
                                </div>
                                <!-- Link to remove item from wishlist -->
                                <a href="#" class="remove-link" onclick="showRemovePopup(this)">Remove item</a>
                                <div class="price">£10.00</div>
                            </div>
                            <!-- Availability information for delivery and collection -->
                            <div class="availability white-box">
                                <p>You can choose your delivery or collection preferences at checkout</p>
                                <div class="availability-item">
                                    <img src="truck.svg" alt="Delivery Icon" class="availability-icon">
                                    <span>Delivery available</span>
                                </div>
                                <div class="availability-item">
                                    <img src="shop.svg" alt="Collection Icon" class="availability-icon">
                                    <span>Collection unavailable</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="total-box-container">
                <div class="total-box">
                    <!-- Total price -->
                    <p>Total: £<span id="wishlist-total">10.00</span></p>
                    <!-- Button to go to basket -->
                    <button class="basket-btn">Go to Basket</button>
                    <!-- Link to continue shopping -->
                    <a href="HomePage.html" class="continue-shopping">Continue shopping</a>
                </div>
            </div>
        </div>
        <!-- Remove Item Popup -->
        <div id="remove-popup" class="popup">
            <div class="popup-content">
                <p>Are you sure you want to remove this item?</p>
                <!-- Buttons to confirm or cancel item removal -->
                <button onclick="removeItem()">Yes</button>
                <button onclick="closePopup()">No</button>
            </div>
        </div>
    </main>
    <!-- External JavaScript files for wishlist and total functionalities -->
    <script src="Wishlist.js"></script>
    <script src="TotalBox.js"></script>
</body>
</html>
