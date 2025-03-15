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
  <div class="MacbookAir2">
    <div class="left-sidepanel"></div>
    <div class="DashboardContents">
      <div class="DashboardContentsInner">
        <nav class="menu-container">
          <a href="#" class="menu-item MyAccount" onclick="showSection('account-section')">My Account</a>
          <a href="#" class="menu-item ChangeEmailPassword" onclick="showSection('change-credentials-section')">Change email/password</a>
          <a href="#" class="menu-item MyOrders" onclick="showSection('orders-section')">My Orders</a>
          <a href="#" class="menu-item MyWishlist" onclick="showSection('wishlist-section')">My Wishlist</a>
          <a href="#" class="menu-item Newsletter" onclick="showSection('newsletter-section')">Newsletter</a>
        </nav>

        <div class="section-container">
          <!-- Account Section -->
          <div id="account-section" class="section-content hidden">
            <h2>Account Information</h2>
            <div class="info-container">
              <div class="info-group">
                <label>Full Name</label>
                <p>[FIRSTNAME SURNAME]</p>
              </div>
              <div class="info-group">
                <label>Email</label>
                <p>brian.jav@example.com</p>
              </div>
              <div class="info-group">
                <label>Address</label>
                <p>123 Example Street<br>London, SW1A 1AA<br>England</p>
              </div>
              <div class="info-group">
                <label>Phone</label>
                <p>+44 20 1234 5678</p>
              </div>
            </div>
          </div>

          <!-- Change Credentials Section -->
          <div id="change-credentials-section" class="section-content hidden">
            <h2>Update Your Credentials</h2>
            <!-- Update the form structure in CustomerDash.html -->
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
          </div>

          <!-- Orders Section -->
          <div id="orders-section" class="section-content hidden">
            <h2>My Orders</h2>
            <div id="orders-items" class="items-container">
              <p class="empty-message">No items to show</p>
            </div>
          </div>

          <!-- Wishlist Section -->
          <div id="wishlist-section" class="section-content hidden">
            <h2>My Wishlist</h2>
            <div id="wishlist-items" class="items-container">
              <p class="empty-message">No items to show</p>
            </div>
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
    <img class="UserProfilePic2" src="" />
    <div class="profile-container">
      <div class="profile-name">[FIRSTNAME SURNAME]</div>
      <div class="profile-country">England</div>
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

      // Remove active class from all menu items
      document.querySelectorAll('.menu-item').forEach(item => {
        item.classList.remove('active');
      });

      // Add active class to clicked menu item
      const clickedItem = document.querySelector(`[onclick="showSection('${sectionId}')"]`);
      clickedItem.classList.add('active');

      // Handle section visibility
      const sections = document.querySelectorAll('.section-content');
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