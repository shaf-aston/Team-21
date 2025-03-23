<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Table of Orders - Admin</title>
  <link rel="stylesheet" href="{{asset('css/admin/admin-orders.css')}}">
</head>

@include('components.admin-navbar')
<div class="container">
  <h1>Supplier Order Details</h1>

  <!-- Supplier Order Information -->
  <div class="order-info">
    <p><strong>Supplier Name:</strong> {{ $supplierOrder->supplier_name }}</p>
    <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($supplierOrder->order_date)->format('F j, Y') }}</p>
    <p><strong>Total Price:</strong> £{{ number_format($supplierOrder->total_amount, 2) }}</p>
  </div>

  <!-- Order Items -->
  <h3>Ordered Items</h3>
  @if($supplierOrder->supplierOrderItems->count() > 0)
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($supplierOrder->supplierOrderItems as $item)
      <tr>
        <td>{{ $item->product->product_name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>£{{ number_format($item->unit_price, 2) }}</td>
        <td>£{{ number_format($item->unit_price * $item->quantity, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
  <p>No items found in this order.</p>
  @endif

  <!-- Optional Button to Edit or Go Back -->
  <div class="mt-3">
    <a href="{{ route('supplier-orders.index') }}" class="btn btn-primary">Back to Orders</a>
  </div>
</div>