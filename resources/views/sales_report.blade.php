<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gadget Grads - Sales Report</title>

    <!-- Use Laravel's asset helper for CSS -->
    <link rel="stylesheet" href="{{ asset('css/NavBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LoginPopUp.css') }}">
    <link rel="stylesheet" href="{{asset('css/Home.css')}}">
    <link rel="stylesheet" href="{{asset('css/SalesReport.css')}}">

    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo-container">
                <!-- Use Laravel's asset helper for images -->
                <img src="{{ asset('images/GG_higher-resolution.png') }}" alt="Gadget Grads Logo">
                <div class="logo-text">
                    <h1>Gadget Grads</h1>
                    <p>Graduate with better tech!</p>
                </div>
            </div>
            <!-- searchbar -->
            <form action="{{route('search')}}" method="GET">
                <input type="text"  class= "search-bar" name="query" placeholder="Search for products by name or description" required>
                <button  class = "search-button" type="submit">Search</button>
            </form>

        </div>
        <!-- nav-bar -->
        <nav class="nav-bar">
            <ul>
                <li><a href="{{url('/home')}}">Home</a></li>
                <li><a href="{{url('/products')}}">Products</a></li>
                <li><a href="{{url('/about')}}">About Us</a></li>
                <li><a href="{{url('/basket')}}">Basket</a></li>
                <li><a href="{{url('/contact')}}">Contact Us</a></li>
                
    
            </ul>
        </nav>
        
    
    <main>


<body>
    <h2 style="text-align: center; margin-top: 20px;">Sales Report</h2>

    <!-- Sales Report Table -->
    <table class="sales-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesData as $data)
                    <tr>
                        <td>{{ $data['order_id'] }}</td>
                        <td>{{ $data['order_date'] }}</td>
                        <td>£{{ number_format($data['total_amount'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Top-Selling Product -->
        <div class="card">
            <h3>Top-Selling Product</h3>
            <p><strong>{{ $mostSellingProduct->product_name }}</strong></p>
            <p>Sold: <strong>{{ $mostSellingProduct->total_quantity }}</strong> units</p>
        </div>

        <!-- Least-Selling Product -->
        <div class="card">
            <h3>Least-Selling Product</h3>
            <p><strong>{{ $leastSellingProduct->product_name }}</strong></p>
            <p>Sold: <strong>{{ $leastSellingProduct->total_quantity }}</strong> units</p>
        </div>
</body>
</header>
</html>
