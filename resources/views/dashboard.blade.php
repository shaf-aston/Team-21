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
    <div class="MacbookAir2">
      <div class="left-sidepanel"></div>
      <div class="DashboardContents">
        <div class="DashboardContentsInner">
          <nav class="menu-container">
            <a href="#" class="menu-item MyAccount" onclick="showSection('account-section')">My Account</a>
            <a href="#" class="menu-item ChangeEmailPassword" onclick="showSection('change-credentials-section')">Change email/password</a>
            <a href="#" class="menu-item MyOrders" onclick="showSection('orders-section')">My Orders</a>
            <a href="#" class="menu-item MyWishlist" onclick="showSection('wishlist-section')">My Wishlist</a>
  
          </nav>
  
          <div class="section-container">
            <!-- Account Section -->
            <div id="account-section" class="section-content hidden">
              <h2>Account Information</h2>
              <div class="info-container">
                <div class="info-group">
                  <label>Full Name</label>
                  <p>{{ auth()->user()->name }}</p>
                </div>
                <div class="info-group">
                  <label>Email</label>
                  <p>{{ auth()->user()->email }}</p>
                </div>
                <div class="info-group">
                  <label>Address</label>
                  <p>{{ auth()->user()->address ?? 'No address provided' }}</p>
                </div>
                <div class="info-group">
                  <label>Phone</label>
                  <p>{{ auth()->user()->phone ?? 'No phone number provided' }}</p>
                </div>
              </div>
            </div>
  
            <!-- Change Credentials Section -->          <!-- Change Credentials Section -->
            <div id="change-credentials-section" class="section-content hidden">
            <h2>Update Your Credentials</h2>
  <form id="credentials-form" method="POST" action="{{ route('update.credentials') }}">
    @csrf <!-- CSRF Token for security -->
    @method('PUT')
  
    <div class="form-row">
      <div class="form-group">
        <label for="current-email">Current Email</label>
        <input type="email" id="current-email" name="current_email" value="{{ auth()->user()->email }}" required readonly>
      </div>
      <div class="form-group">
        <label for="new-email">New Email</label>
        <input type="email" id="new-email" name="new_email" placeholder="New email..." value="{{ old('new_email') }}">
        @error('new_email') <span class="error">{{ $message }}</span> @enderror
      </div>
    </div>
  
    <div class="credentials-separator"></div>
  
    <div class="form-row">
      <div class="form-group">
        <label for="current-password">Current Password</label>
        <input type="password" id="current-password" name="current_password" required placeholder="Current password...">
        @error('current_password') <span class="error">{{ $message }}</span> @enderror
      </div>
      <div class="form-group">
        <label for="new-password">New Password</label>
        <input type="password" id="new-password" name="new_password" placeholder="New password...">
        @error('new_password') <span class="error">{{ $message }}</span> @enderror
      </div>
    </div>
  
    <button type="submit" class="submit-btn">Update Credentials</button>
  </form>
            </div>
  
  <!-- Orders Section -->
  <div id="orders-section" class="section-content hidden">
      <h2>My Orders</h2>
      
      @if ($orders->isEmpty())
          <p class="empty-message">No orders to show</p>
      @else
          <div class="items-container">
              @foreach ($orders as $order)
                  <div class="order-item">
                      <h3>Order #{{ $order->id }}</h3>
                      <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                      <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
                      <p><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
                      
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
  </div>
  
  <!-- Wishlist Section -->
  <div id="wishlist-section" class="section-content hidden">
      <h2>My Wishlist</h2>
  
      @if ($wishlistItems->isEmpty())
          <p class="empty-message">No items in your wishlist</p>
      @else
          <div class="items-container">
              @foreach ($wishlistItems as $item)
                  <div class="wishlist-item">
                      <img src="{{ asset('storage/' . $item->product->img_id) }}" alt="{{ $item->product->name }}">
                      <img src="Images\{{$item->product->img_id}}.jpg" alt="Product" class="iPadAir">
                      <div class="wishlist-details">
                          <h3>{{ $item->product->product_name }}</h3>
                          <p><strong>Price:</strong> ${{ number_format($item->product->product_price, 2) }}</p>
                          <button onclick="removeFromWishlist({{ $item->id }})" class="remove-btn">Remove</button>
                      </div>
                  </div>
              @endforeach
          </div>
      @endif
  </div>
  
            <!-- Newsletter Section -->
            <div id="newsletter-section" class="section-content hidden">
              <h2>Newsletter Subscription</h2>
              <div class="form-group">
                <label class="checkbox-label">
                  <input type="checkbox" id="newsletter-checkbox">
                  <span>Subscribe to our newsletter to receive updates and offers</span>
                </label>
                <button type="button" class="save-btn" onclick="saveNewsletter()">Save Preferences</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="Rectangle16"></div>
  
      <div class="profile-container">
        <div class="profile-name">{{ auth()->user()->name }}</div>
        <div class="profile-country">{{ auth()->user()->country ?? 'Unknown' }}</div>
      </div>
      <div class="Group8">
        <div class="Rectangle3"></div>
      </div>
      <div class="Dashboard">DASHBOARD</div>
    </div>
  
    @include('components.footer')
  
    <script>
      function showSection(sectionId) {
        event.preventDefault();
  
        document.querySelectorAll('.menu-item').forEach(item => {
          item.classList.remove('active');
        });
  
        const clickedItem = document.querySelector(`[onclick="showSection('${sectionId}')"]`);
        clickedItem.classList.add('active');
  
        document.querySelectorAll('.section-content').forEach(section => {
          section.classList.add('hidden');
        });
  
        document.getElementById(sectionId).classList.remove('hidden');
      }
  
      document.addEventListener('DOMContentLoaded', function() {
        showSection('account-section');
      });
  
      function toggleOrderDetails(orderId) {
          document.getElementById(`order-details-${orderId}`).classList.toggle('hidden');
      }
  
      function removeFromWishlist(wishlistItemId) {
          fetch(`/wishlist/remove/${wishlistItemId}`, {
              method: 'DELETE',
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json'
              }
          }).then(response => {
              if (response.ok) {
                  location.reload();
              } else {
                  alert('Failed to remove item from wishlist');
              }
          });
      }
    </script>
  </body>
  </html>