<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Product View</title>
  <link rel="stylesheet" href="{{asset('css/admin/admin-orders.css')}}">
</head>

<body>
  @include('components.admin-navbar')
  <div class="container">
    <h2>Order Details</h2>
    <table class="table table-bordered">
      <tr>
        <th>Order ID:</th>
        <td>{{ $order->order_id }}</td>
      </tr>
      <tr>
        <th>Customer:</th>
        <td>{{ $order->user->name ?? 'Guest' }}</td>
      </tr>
      <tr>
        <th>Total Amount:</th>
      </tr>
      <tr>
        <th>Status:</th>
        <td>{{ ucfirst($order->order_status) }}</td>
      </tr>
      <tr>
        <th>Order Date:</th>
        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y, h:i A') }}</td>
      </tr>
    </table>

    <h3>Order Items</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->orderItems as $item)
        <tr>

          <td>{{ $item->product->product_name ?? 'Unknown Product' }}</td>
          <td>{{ $item->quantity }}</td>
          <td>${{ number_format($item->product->product_price, 2) }}</td>
          <td>${{ number_format($item->quantity * $item->product->product_price, 2) }}</td>

        </tr>
        @endforeach
      </tbody>
    </table>

    <a href="{{ route('orders.adminIndex') }}" class="btn btn-primary">Back to Orders</a>
    <a href="{{ route('orders.adminEditStatus', ['order' => $order->order_id]) }}" class="btn btn-warning">Change Order Status</a>
  </div>

  <h4>Debug Information:</h4>
  <pre>{{ print_r($order->orderItems->toArray(), true) }}</pre>
</body>

</html>