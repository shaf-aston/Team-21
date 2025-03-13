<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Sales Report</title>
  <link rel="stylesheet" href="{{asset('css/admin/sales-report.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
  @include('components.admin-navbar')
  <h1>Sales Report</h1>
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

</html>