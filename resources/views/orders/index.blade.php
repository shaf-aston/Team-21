<h2 class="mb-4">My Orders</h2>

@if($orders->isEmpty())
    <p class="alert alert-warning">You have no orders yet.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
                <td>
                    @if($order->order_status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($order->order_status == 'shipped')
                        <span class="badge bg-primary">Shipped</span>
                    @elseif($order->order_status == 'delivered')
                        <span class="badge bg-success">Delivered</span>
                    @else
                        <span class="badge bg-secondary">{{ ucfirst($order->order_status) }}</span>
                    @endif
                </td>
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