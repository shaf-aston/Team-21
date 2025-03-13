<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Table of Orders - Admin</title>
  <link rel="stylesheet" href="{{asset('css/admin/admin-orders.css')}}">
</head>

<body>
  @include('components.admin-navbar')


  <div class="container">
    <h2>All Orders</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Customer</th>
          <th>Total Amount</th>
          <th>Status</th>
          <th>Order Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td>{{ $order->order_id }}</td>
          <td>{{ $order->user->name ?? 'Guest' }}</td> <!-- Fetching user name -->
          <td>${{ number_format($order->total_amount, 2) }}</td>
          <td>{{ ucfirst($order->order_status) }}</td>
          <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y, h:i A') }}</td>
          <td>
            <a href="{{ route('orders.adminShow', $order->order_id) }}" class="btn btn-info btn-sm">View</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>

</html>