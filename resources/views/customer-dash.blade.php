<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
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
      <a href="#" class="nav-item" onclick="showSection('account-section')">My Account</a>
      <a href="#" class="nav-item" onclick="showSection('change-credentials-section')">Change email/password</a>
      <a href="#" class="nav-item" onclick="showSection('orders-section')">My Orders</a>
      <a href="#" class="nav-item" onclick="showSection('wishlist-section')">My Wishlist</a>
    </nav>

    <div class="dashboard-sections">
      <!-- Account Section -->
      <section id="account-section" class="content-section hidden">
        <h2 class="section-title">Account Information</h2>
        <div class="info-container">
          <div class="info-group">
            <label>Full Name</label>
            <p>{{ Auth::user()->name ?? 'John Doe' }}</p>
          </div>
          <div class="info-group">
            <label>Email</label>
            <p>{{ Auth::user()->email ?? 'john.doe@example.com' }}</p>
          </div>
          <div class="info-group">
            <label>Address</label>
            <p>{{ Auth::user()->address ?? '123 Example Street' }}<br>
              {{ Auth::user()->city ?? 'London' }}, {{ Auth::user()->postal_code ?? 'SW1A 1AA' }}<br>
              {{ Auth::user()->country ?? 'United Kingdom' }}
            </p>
          </div>
          <div class="info-group">
            <label>Phone</label>
            <p>{{ Auth::user()->phone ?? '+44 20 1234 5678' }}</p>
          </div>
        </div>
      </section>

      <!-- Change Credentials Section -->
      <section id="change-credentials-section" class="content-section hidden">
        <h2 class="section-title">Update Your Credentials</h2>
        <form id="credentials-form">
          <div class="form-row">
            <div class="form-group">
              <label for="current-email">Current Email</label>
              <input type="email" id="current-email" required placeholder="Current email...">
            </div>
            <div class="form-group">
              <label for="new-email">New Email</label>
              <input type="email" id="new-email" placeholder="New email...">
            </div>
          </div>

          <div class="credentials-separator"></div>

          <div class="form-row">
            <div class="form-group">
              <label for="current-password">Current Password</label>
              <input type="password" id="current-password" required placeholder="Current password...">
            </div>
            <div class="form-group">
              <label for="new-password">New Password</label>
              <input type="password" id="new-password" placeholder="New password...">
            </div>
          </div>
          <button type="submit" class="submit-btn">Update Credentials</button>
        </form>
      </section>

      <!-- Orders Section -->
      <section id="orders-section" class="content-section hidden">
        <h2 class="section-title">My Orders</h2>
        <div id="orders-items" class="items-container">
          @if(count($orders ?? []) > 0)
          <div class="orders-list">
            @foreach($orders ?? [] as $order)
            <div class="order-item">
              <div class="order-header">
                <span class="order-number">Order #{{ $order->id }}</span>
                <span class="order-date">{{ $order->created_at->format('d M Y') }}</span>
                <span class="order-status {{ strtolower($order->status) }}">{{ $order->status }}</span>
              </div>
              <div class="order-details">
                <div class="order-products">
                  @foreach($order->items ?? [] as $item)
                  <div class="order-product">
                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}">
                    <div class="product-info">
                      <p class="product-name">{{ $item->product->name }}</p>
                      <p class="product-quantity">Qty: {{ $item->quantity }}</p>
                    </div>
                    <p class="product-price">£{{ number_format($item->price, 2) }}</p>
                  </div>
                  @endforeach
                </div>
                <div class="order-summary">
                  <p class="order-total">Total: <span>£{{ number_format($order->total, 2) }}</span></p>
                  <a href="/order/{{ $order->id }}" class="order-detail-btn">View Details</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @else
          <div class="empty-state">
            <p class="empty-message">You haven't placed any orders yet</p>
            <a href="/products" class="action-button">Browse Products</a>
          </div>
          @endif
        </div>
      </section>

      <!-- Wishlist Section -->
      <section id="wishlist-section" class="content-section hidden">
        <h2 class="section-title">My Wishlist</h2>
        <div id="wishlist-items" class="items-container">
          @if(count($wishlist ?? []) > 0)
          <div class="wishlist-grid">
            @foreach($wishlist ?? [] as $item)
            <div class="wishlist-item">
              <button class="remove-wishlist" data-id="{{ $item->product->id }}">×</button>
              <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}">
              <div class="wishlist-item-info">
                <h3>{{ $item->product->name }}</h3>
                <p class="wishlist-price">£{{ number_format($item->product->price, 2) }}</p>
                <div class="wishlist-actions">
                  <a href="/product/{{ $item->product->id }}" class="view-btn">View Product</a>
                  <button class="add-to-cart-btn" data-id="{{ $item->product->id }}">Add to Cart</button>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @else
          <div class="empty-state">
            <p class="empty-message">Your wishlist is empty</p>
            <a href="/products" class="action-button">Discover Products</a>
          </div>
          @endif
        </div>
      </section>
    </div>
  </div>

  @include('components.footer')

  <script>
    function showSection(sectionId) {
      event.preventDefault();

      // Remove active class from all nav items
      document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
      });

      // Add active class to clicked nav item
      const clickedItem = document.querySelector(`[onclick="showSection('${sectionId}')"]`);
      clickedItem.classList.add('active');

      // Handle section visibility
      const sections = document.querySelectorAll('.content-section');
      sections.forEach(section => {
        if (section.id !== sectionId) {
          section.classList.add('hidden');
        }
      });

      const targetSection = document.getElementById(sectionId);
      targetSection.classList.remove('hidden');
    }

    // Show account section and highlight by default
    document.addEventListener('DOMContentLoaded', function() {
      showSection('account-section');
    });
  </script>
</body>

</html>