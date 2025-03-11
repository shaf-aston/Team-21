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
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <a href="{{ route('supplier-orders.show', $order->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>