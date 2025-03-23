<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Sales Reports</title>
  <link rel="stylesheet" href="{{asset('css/admin/sales-report.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
  @include('components.admin-navbar')
  <h1>Sales Reports</h1>
  
  <!-- Cards Grid -->
  <div class="cards-grid">
    <div class="card top-selling">
      <h3>Top-Selling Product</h3>
      <p class="metric-label">Most popular item</p>
      <p class="metric-value">{{ $mostSellingProduct->product_name }}</p>
      <p>Sold: <strong>{{ $mostSellingProduct->total_quantity }}</strong> units</p>
    </div>

    <div class="card least-selling">
      <h3>Least-Selling Product</h3>
      <p class="metric-label">Least popular item</p>
      <p class="metric-value">{{ $leastSellingProduct->product_name }}</p>
      <p>Sold: <strong>{{ $leastSellingProduct->total_quantity }}</strong> units</p>
    </div>

    <div class="card revenue">
      <h3>Revenue</h3>
      <p class="metric-label">Incoming money</p>
      <p class="metric-value">£{{ number_format($totalSales, 2) }}</p>
      <p>Cash Inflow</p>
    </div>

    <div class="card costs">
      <h3>Costs</h3>
      <p class="metric-label">Costs of the company</p>
      <p class="metric-value">£{{ number_format($totalCosts, 2) }}</p>
      <p>Expenses & Overhead</p>
    </div>
    
    <div class="card profit">
      <h3>Profit</h3>
      <p class="metric-label">Net profit after costs</p>
      <p class="metric-value">£{{ number_format($totalSales - $totalCosts, 2) }}</p>
      <p>Total Earnings</p>
    </div>
  </div>

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

      <tr>
        <td colspan="2" style="text-align: right; font-weight: bold;">Total Sales:</td>
        <td>£{{ number_format($totalSales, 2) }}</td>
      </tr>
    </tbody>
  </table>
</body>

</html>