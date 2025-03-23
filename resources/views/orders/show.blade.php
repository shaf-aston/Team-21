<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table of Orders - Admin</title>
  <link rel="stylesheet" href="{{asset('css/admin/admin-orders.css')}}">
</head>

@include('components.navbar')


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
      <td>£{{ number_format($order->total_amount, 2) }}</td>
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
        <td>
          @if($order->order_status === 'delivered')
          <form action="{{ route('orders.returnItem', ['item' => $item->order_item_id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Return Item</button>
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to Orders</a>
</div>
