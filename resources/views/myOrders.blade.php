<!-- filepath: /c:/xampp/htdocs/Team-21/resources/views/myOrders.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>My Orders - Gadget Grads</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/ProductListing.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/myOrders.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/myOrders-dark-mode.css') }}">
</head>

<body>
  @include('components.navbar')

  <div id="order-history">
    <h3>Your Order History</h3>

    <table id="orders-table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Order Date</th>
          <th>Total Amount</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="orders-list">
        <tr>
          <td>1001</td>
          <td>28/02/2025</td>
          <td>£299.99</td>
          <td>
            <span class="status-badge status-delivered">
              Delivered
            </span>
          </td>
          <td>
            <a href="{{ url('/orderdetails/1001') }}" class="view-order-btn">View Details</a>
          </td>
        </tr>
        <tr>
          <td>1002</td>
          <td>15/02/2025</td>
          <td>£149.50</td>
          <td>
            <span class="status-badge status-processing">
              Processing
            </span>
          </td>
          <td>
            <a href="{{ url('/orderdetails/1002') }}" class="view-order-btn">View Details</a>
          </td>
        </tr>
        <tr>
          <td>1003</td>
          <td>05/02/2025</td>
          <td>£499.99</td>
          <td>
            <span class="status-badge status-shipped">
              Shipped
            </span>
          </td>
          <td>
            <a href="{{ url('/orderdetails/1003') }}" class="view-order-btn">View Details</a>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Empty state (hidden by default) -->
    <div class="empty-state" style="display: none;">
      <p>You don't have any orders yet.</p>
      <a href="{{ url('/products') }}" class="continue-shopping-btn">Continue Shopping</a>
    </div>
  </div>

  @include('components.footer')
  @include('components.dark-mode')

  <script src="{{ asset('js/myOrders.js') }}"></script>
</body>

</html>