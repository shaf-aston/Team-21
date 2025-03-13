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
  <h2>Place Supplier Order</h2>
  <form action="{{ route('supplier-orders.store') }}" method="POST">
    @csrf

    <!-- Supplier Name -->
    <div class="form-group">
      <label for="supplier_name">Supplier Name</label>
      <input type="text" class="form-control" name="supplier_name" required>
    </div>

    <!-- Order Items Section -->
    <h4>Order Items</h4>
    <table class="table" id="order-items-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Quantity</th>
          <th>Unit Price (-20%)</th>
          <th>Subtotal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <select name="product_id[]" class="form-control product-select" required>
              @foreach($products as $product)
              <option value="{{ $product->product_id }}" data-price="{{ $product->product_price }}">
                {{ $product->product_name }} (Original: ${{ number_format($product->product_price, 2) }})
              </option>
              @endforeach
            </select>
          </td>
          <td><input type="number" name="quantity[]" class="form-control quantity-input" required min="1" value="1"></td>
          <td class="unit-price">$0.00</td>
          <td class="subtotal">$0.00</td>
          <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
        </tr>
      </tbody>
    </table>

    <button type="button" id="add-item" class="btn btn-primary">Add More Items</button>

    <!-- Total Price Section -->
    <div class="mt-3">
      <h4>Total Price: <span id="total_amount">$0.00</span></h4>
    </div>

    <button type="submit" class="btn btn-success">Place Order</button>
  </form>
</div>

<script>
  function updatePrices() {
    let totalPrice = 0;

    document.querySelectorAll('#order-items-table tbody tr').forEach(row => {
      let select = row.querySelector('.product-select');
      let quantityInput = row.querySelector('.quantity-input');
      let unitPriceCell = row.querySelector('.unit-price');
      let subtotalCell = row.querySelector('.subtotal');

      let selectedOption = select.options[select.selectedIndex];
      let originalPrice = parseFloat(selectedOption.getAttribute('data-price')) || 0;
      let discountedPrice = (originalPrice * 0.8).toFixed(2); // Apply 20% discount

      let quantity = parseInt(quantityInput.value) || 1;
      let subtotal = (discountedPrice * quantity).toFixed(2);

      unitPriceCell.textContent = "$" + discountedPrice;
      subtotalCell.textContent = "$" + subtotal;

      totalPrice += parseFloat(subtotal);
    });

    document.getElementById('total_amount').textContent = "$" + totalPrice.toFixed(2);
  }

  document.getElementById('add-item').addEventListener('click', function() {
    let row = `
            <tr>
                <td>
                    <select name="product_id[]" class="form-control product-select" required>
                        @foreach($products as $product)
                            <option value="{{ $product->product_id }}" data-price="{{ $product->product_price }}">
                                {{ $product->product_name }} (Original: ${{ number_format($product->product_price, 2) }})
                            </option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="quantity[]" class="form-control quantity-input" required min="1" value="1"></td>
                <td class="unit-price">$0.00</td>
                <td class="subtotal">$0.00</td>
                <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
            </tr>
        `;
    document.querySelector('#order-items-table tbody').insertAdjacentHTML('beforeend', row);
    updatePrices();
  });

  document.addEventListener('change', function(event) {
    if (event.target.classList.contains('product-select') || event.target.classList.contains('quantity-input')) {
      updatePrices();
    }
  });

  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-item')) {
      event.target.closest('tr').remove();
      updatePrices();
    }
  });

  updatePrices();
</script>