<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title>Customer Dashboard</title>
  <link rel="stylesheet" href="{{ asset('/css/customer-dash.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/customer-dash-dark-mode.css') }}">
</head>
<body>
  @include('components.navbar')
  <div class="dashboard-content">
    <nav class="dashboard-nav">
      <a href="#" class="nav-item" onclick="showSection('account-section', event)">My Account</a>
      <a href="#" class="nav-item" onclick="showSection('change-credentials-section', event)">Change Email/Password</a>
      <a href="#" class="nav-item" onclick="showSection('orders-section', event)">My Orders</a>
      <a href="#" class="nav-item" onclick="showSection('wishlist-section', event)">My Wishlist</a>
    </nav>

    <div class="dashboard-sections">
      <!-- Account Section -->
      <section id="account-section" class="content-section hidden">
        <h2 class="section-title">Account Information</h2>
        <div class="info-container">
          <div class="info-group"><label>Full Name</label><p>{{ auth()->user()->name }}</p></div>
          <div class="info-group"><label>Email</label><p>{{ auth()->user()->email }}</p></div>
          <div class="info-group"><label>Address</label><p>{{ auth()->user()->address ?? 'No address provided' }}</p></div>
          <div class="info-group"><label>Phone</label><p>{{ auth()->user()->phone ?? 'No phone number provided' }}</p></div>
        </div>
      </section>

      <!-- Change Credentials Section -->
      <section id="change-credentials-section" class="content-section hidden">
        <h2>Update Your Credentials</h2>
        <form id="credentials-form" method="POST" action="{{ route('update.credentials') }}">
          @csrf @method('PUT')
          <div class="form-group">
            <label for="current-email">Current Email</label>
            <input type="email" id="current-email" name="current_email" value="{{ auth()->user()->email }}" readonly>
          </div>
          <div class="form-group">
            <label for="new-email">New Email</label>
            <input type="email" id="new-email" name="new_email" placeholder="New email...">
          </div>
          <div class="form-group">
            <label for="current-password">Current Password</label>
            <input type="password" id="current-password" name="current_password" required>
          </div>
          <div class="form-group">
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new_password" placeholder="New password...">
          </div>
          <button type="submit" class="submit-btn">Update Credentials</button>
        </form>
      </section>

      <!-- Orders Section -->
      <section id="orders-section" class="content-section hidden">
        <h2>My Orders</h2>
        @if ($orders->isEmpty())
          <p>No orders to show</p>
        @else
          <div class="items-container">
            @foreach ($orders as $order)
              <div class="order-item">
                <h3>Order no: {{ $order->order_id }}</h3>
                <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                <button onclick="toggleOrderDetails({{ $order->id }})">View Details</button>
                <div id="order-details-{{ $order->id }}" class="order-details hidden">
                  <ul>
                    @foreach ($order->orderItems as $item)
                      <li>{{ $item->product->name }} - ${{ number_format($item->price, 2) }} (Qty: {{ $item->quantity }})</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </section>

      <!-- Wishlist Section -->
      <section id="wishlist-section" class="content-section hidden">
        <h2>My Wishlist</h2>
        @if ($wishlistItems->isEmpty())
          <p>No items in your wishlist</p>
        @else
          <div class="items-container">
            @foreach ($wishlistItems as $item)
              <div class="wishlist-item">
                <img src="{{ asset('storage/' . $item->product->img_id) }}" alt="{{ $item->product->name }}">
                <div class="wishlist-details">
                  <h3>{{ $item->product->product_name }}</h3>
                  <p><strong>Price:</strong> ${{ number_format($item->product->product_price, 2) }}</p>
                  <button onclick="removeFromWishlist({{ $item->id }})" class="remove-btn">Remove</button>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </section>
    </div>
  </div>

  @include('components.footer')

  <script>
    function showSection(sectionId, event) {
      if (event) event.preventDefault();
      document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));
      document.querySelector(`[onclick="showSection('${sectionId}', event)"]`).classList.add('active');
      document.querySelectorAll('.content-section').forEach(section => section.classList.add('hidden'));
      document.getElementById(sectionId).classList.remove('hidden');
    }
    document.addEventListener('DOMContentLoaded', () => showSection('account-section'));
    function toggleOrderDetails(orderId) {
      document.getElementById(`order-details-${orderId}`).classList.toggle('hidden');
    }
    function removeFromWishlist(wishlistItemId) {
      fetch(`/wishlist/remove/${wishlistItemId}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
      }).then(response => {
        if (response.ok) location.reload();
        else alert('Failed to remove item from wishlist');
      });
    }
  </script>
</body>
</html>