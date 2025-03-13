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

@include('components.admin-navbar')

<div class="container">
  <h2>Search Results for "{{ $query }}"</h2>

  @if($orders->isEmpty())
  <p>No orders found matching your search.</p>
  @else
  <table class="table">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Order Status</th>
        <th>Total Amount</th>
        <th>Order Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
        <td>{{ $order->order_id }}</td>
        <td>{{ $order->user_id }}</td>
        <td>{{ ucfirst($order->order_status) }}</td>
        <td>${{ number_format($order->total_amount, 2) }}</td>
        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y, h:i A') }}</td>
        <td>
          <a href="{{ route('orders.adminShow', $order->order_id) }}" class="btn btn-info btn-sm">View</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</div>