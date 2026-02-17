<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport" 
          content="width=device-width, 
                   initial-scale=1.0">
    <title>GadgetGrads</title>
   
    <link rel="stylesheet" href="{{ asset('/css/navbar2.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/statistics.css') }}">
    <!-- <script src="{{ asset('js/statistics.js') }}" defer></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
 

   
</head>

<body>

  <header id="main-header">
    <div class="header-left">
      <a href="{{ url('/home') }}">
        <img src="logo.png" alt="Gadget Grads Logo" class="logo">
      </a>
      <div class="navbar-text">
        <h1 class="navbar-title">GADGET GRADS</h1>
        <p class="navbar-subtitle">Graduate with better tech!</p>
      </div>
    </div>

    <div class="search-container">
      <form class="search-form" action="{{ route('search') }}" method="GET">
        <input type="text" class="search-input" name="query" placeholder="Search for products..." required>
        <button class="search-button" type="submit">Search</button>
      </form>
    </div>
    </div>
      <a href="{{ url('/wishlist') }}" class="wishlist-icon" title="Wishlist">
        <img src="heart.svg" height="30" alt="Wishlist icon">
      </a>
      <a href="{{ url('/basket') }}" class="cart-icon" title="Basket">
        <img src="basket.svg" height="30" alt="Basket icon">
      </a>
    </div>
   
    </header>
    <h2>Apple Sales Chart</h2>
    <section class="apple-content">
        
        <canvas id="horizontalBar"></canvas> <!-- Chart container -->
        <canvas id="horizontalBar2"></canvas> <!-- Chart container -->
        <canvas id="horizontalBar3"></canvas> <!-- Chart container -->
    </section>
    

  <!-- Load Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
 
     
    </body>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    // Load sales data
    var sales = @json($sales);
    var orders = @json($orders);
    var revnue = @json($revnue);

    // Initialize arrays for Sales Chart
    const product = [];
    const amount = [];

    // Extract data for Sales Chart
    $.each(sales, function(key, val) {
        product.push(val.product);
        amount.push(val.amount);
    });

    // Initialize arrays for Orders Chart
    const product_ordered = [];
    const quantity = [];

    // Extract data for Orders Chart
    $.each(orders, function(key, val) {
        product_ordered.push(val.product_ordered);
        quantity.push(val.quantity);
    });

    const product_name = [];
    const total_revnue = [];

    // Fixed closing brace here for the $.each(revnue) loop
    $.each(revnue, function(key, val) {
        product_name.push(val.product_name);
        total_revnue.push(val.total_revnue);
    });

    // Log to check data before rendering charts
    console.log("Sales Data:", product, amount);
    console.log("Orders Data:", product_ordered, quantity);
    console.log("Revnue Data:", product_name, total_revnue);

    // Set up Sales Chart
    const ctx1 = document.getElementById("horizontalBar").getContext("2d");
    new Chart(ctx1, {
        type: "bar",
        data: {
            labels: product,
            datasets: [{
                label: "Apple Products In Stock",
                data: amount,
                fill: false,
                backgroundColor: [
                    "rgba(255, 99, 132, 0.6)",
                    "rgba(54, 162, 235, 0.6)",
                    "rgba(255, 206, 86, 0.6)",
                    "rgba(75, 192, 192, 0.6)",
                    "rgba(153, 102, 255, 0.6)",
                    "rgba(255, 159, 64, 0.6)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)"
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                x: { beginAtZero: true }
            }
        }
    });

    // Set up Orders Chart
    const ctx2 = document.getElementById("horizontalBar2").getContext("2d");
    new Chart(ctx2, {
        type: "bar",
        data: {
            labels: product_ordered,
            datasets: [{
                label: "Apple Products Ordered",
                data: quantity,
                fill: false,
                backgroundColor: [
                    "rgba(255, 99, 132, 0.6)",
                    "rgba(54, 162, 235, 0.6)",
                    "rgba(255, 206, 86, 0.6)",
                    "rgba(75, 192, 192, 0.6)",
                    "rgba(153, 102, 255, 0.6)",
                    "rgba(255, 159, 64, 0.6)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)"
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                x: { beginAtZero: true }
            }
        }
    });

    // Set up Revenue Chart
    const ctx3 = document.getElementById("horizontalBar3").getContext("2d");
    new Chart(ctx3, {
        type: "bar",
        data: {
            labels: product_name,
            datasets: [{
                label: "Apple Revenue By Product",
                data: total_revnue,
                fill: false,
                backgroundColor: [
                    "rgba(255, 99, 132, 0.6)",
                    "rgba(54, 162, 235, 0.6)",
                    "rgba(255, 206, 86, 0.6)",
                    "rgba(75, 192, 192, 0.6)",
                    "rgba(153, 102, 255, 0.6)",
                    "rgba(255, 159, 64, 0.6)"
                ],
                borderColor: [
                    "rgba(255, 99, 132, 1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)"
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                x: { beginAtZero: true }
            }
        }
    });
});

</script>


    <!-- <script>
    
    document.addEventListener("DOMContentLoaded", function () {
        // Pass the PHP $sales array to a JavaScript variable
        var sales = @json($sales);

        // Initialize empty arrays for products and amounts
        const product = [];
        const amount = [];

        // Log the sales data to check its structure
        console.log(sales);

        
        $.each(sales,function(key,val){
            product.push(val.product);
            amount.push(val.amount);
        });
        // Log the product and amount arrays to check their values
        console.log(product);  
        console.log(amount);

        // Set up the chart
        const ctx = document.getElementById("horizontalBar2").getContext("2d");

        new Chart(ctx, {
            type: "bar",  // Use 'bar' with indexAxis: 'y' instead of 'horizontalBar'
            data: {
                labels: product,  // Use the dynamic product labels from the PHP data
                datasets: [{
                    label: "Apple Products In Stock",  // Adjust label as needed
                    data: amount,  // Use the dynamic amount data from the PHP data
                    fill: false,
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.6)",
                        "rgba(54, 162, 235, 0.6)",
                        "rgba(255, 206, 86, 0.6)",
                        "rgba(75, 192, 192, 0.6)",
                        "rgba(153, 102, 255, 0.6)",
                        "rgba(255, 159, 64, 0.6)"
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)"
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',  // Makes it horizontal
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
   
       
   
</script> -->

    
      