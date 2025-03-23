<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>User view - Admin</title>
  <link rel="stylesheet" href="{{asset('css/admin/admin-orders.css')}}">
</head>

@include('components.admin-navbar')
<div class="container">
  <h2>User Details</h2>
  <table class="table table-bordered">
    <tr>
      <th>User ID:</th>
      <td>{{ $user->id }}</td>
    </tr>
    <tr>
      <th>Customer:</th>
      <td>{{ $user->name ?? 'Guest' }}</td>
    </tr>
    <tr>
      <th>Email</th>
      <td>${{ $user->email }}</td>
    </tr>
  </table>
</div>