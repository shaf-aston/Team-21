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
                            <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>