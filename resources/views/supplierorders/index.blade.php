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
  <h2>Supplier Orders</h2>

  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Supplier Name</th>
        <th>Order Date</th>
        <th>Total Amount</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($supplierOrders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->supplier_name }}</td>
        <td>{{ $order->order_date }}</td>
        <td>£{{ number_format($order->total_amount, 2) }}</td>
        <td>
          <a href="{{ route('supplier-orders.show', $order->id) }}" class="btn btn-info">View</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<a href="{{ route('supplierorders.create') }}" id="supplier-order-btn-container" class="btn btn-primary">Create Supplier Order</a>