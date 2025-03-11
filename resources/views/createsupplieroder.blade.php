<div class="container">
    <h2>Create Supplier Order</h2>

    <form action="{{ route('supplier-orders.store') }}" method="POST">
        @csrf

        <!-- Supplier Name -->
        <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
        </div>

        <!-- Products to Order -->
        <div class="form-group">
            <label for="products">Products to Order</label>
            <select class="form-control" id="products" name="products[]" multiple>
                @foreach($products as $product)
                    <option value="{{ $product->product_id }}">{{ $product->product_name }} (Stock: {{ $product->stock_quantity }})</option>
                @endforeach
            </select>
        </div>

        <!-- Quantities for Products -->
        <div class="form-group" id="quantities">
            <!-- Dynamically generate inputs for quantities of each selected product -->
        </div>

        <!-- Total Amount -->
        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>

<script>
    // Listen to changes in the product select box to dynamically show quantity inputs
    document.getElementById('products').addEventListener('change', function () {
        let products = this.selectedOptions;
        let quantitiesContainer = document.getElementById('quantities');
        quantitiesContainer.innerHTML = ''; // Clear previous inputs

        let total = 0;
        Array.from(products).forEach(product => {
            let productId = product.value;
            let productPrice = product.text.split('(')[0].trim(); // Assuming product price is part of the name
            let productInput = document.createElement('div');
            productInput.classList.add('form-group');
            productInput.innerHTML = `
                <label for="quantity_${productId}">Quantity for ${product.text}</label>
                <input type="number" class="form-control" id="quantity_${productId}" name="quantities[${productId}]" min="1" required>
            `;
            quantitiesContainer.appendChild(productInput);

            // Update total amount
            total += parseFloat(productPrice.replace('$', '').trim());  // Assuming price is in USD
        });

        // Update the total amount field
        document.getElementById('total_amount').value = '$' + total.toFixed(2);
    });
</script>