<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Stock Report</title>
  <link rel="stylesheet" href="{{asset('css/admin/sales-report.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>

<body>
  @include('components.admin-navbar')
  <h1>Stock Levels Report</h1>

  @if(session('lowStockAlert'))
  <div class="alert alert-warning">
    <strong>Warning!</strong> {{ session('lowStockAlert') }}
  </div>
  @endif

  <!-- Low Stock Alert -->
  @if(count($lowStockProducts) > 0)
  <div class="low-stock-container">
    <div class="low-stock-title">Low Stock Products:</div>
    <ul class="low-stock-list">
      @foreach($lowStockProducts as $product)
      @php
      $stockClass = 'alert';
      $icon = '🟡';

      if ($product->stock_quantity <= 1) {
        $stockClass='critical' ;
        $icon='⚠️' ;
        } elseif ($product->stock_quantity <= 4) {
          $stockClass='warning' ;
          $icon='🟠' ;
          }
          @endphp
          <li>{{ $icon }} <span class="{{ $stockClass }}">{{ $product->product_name }}</span> - Only {{ $product->stock_quantity }} left!</li>
          @endforeach
    </ul>
  </div>
  @endif

  <!-- Stock Levels Table -->
  <table class="sales-table" border="1" cellpadding="10">
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Stock Quantity</th>
      </tr>
    </thead>
    <tbody>
      @foreach($stockLevels as $product)
      @php
      $rowClass = '';
      if ($product->stock_quantity <= 1) {
        $rowClass='critical' ;
        } elseif ($product->stock_quantity <= 4) {
          $rowClass='warning' ;
          } elseif ($product->stock_quantity <= 10) {
            $rowClass='alert' ;
            }
            @endphp
            <tr class="{{ $rowClass }}">
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->stock_quantity }}</td>
            </tr>
            @endforeach
    </tbody>
  </table>

</body>

</html>