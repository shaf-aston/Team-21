<link rel="stylesheet" href="{{ asset('/css/Footer.css') }}">
<footer class="footer">
  <div class="footer-container">
    <div class="footer-section footer-logo">
      <div class="logo-container">
        <div class="logo-placeholder">GG</div>
        <div class="site-info">
          <h3 class="footer-title">GADGET GRADS</h3>
          <p class="footer-subtitle">Graduate with better tech!</p>
        </div>
      </div>
      <p class="footer-description">
        Your trusted source for high-quality electronics and tech accessories.
      </p>
    </div>

    <div class="footer-section footer-links">
      <h4 class="footer-heading">Quick Links</h4>
      <ul class="footer-menu">
        <li><a href="{{ url('/home') }}">Home</a></li>
        <li><a href="{{ url('/products') }}">Products</a></li>
        <li><a href="{{ url('/about') }}">About Us</a></li>
        <li><a href="{{ url('/contact') }}">Contact Us</a></li>
      </ul>
    </div>

    <div class="footer-section footer-categories">
      <h4 class="footer-heading">Categories</h4>
      <ul class="footer-menu">
        <li><a href="{{ url('/Laptops') }}">Laptops</a></li>
        <li><a href="{{ url('/Tablets') }}">Tablets</a></li>
        <li><a href="{{ url('/Phones') }}">Phones</a></li>
        <li><a href="{{ url('/Accessories') }}">Accessories</a></li>
      </ul>
    </div>

    <div class="footer-section footer-contact">
      <h4 class="footer-heading">Contact Us</h4>
      <address>
        <p>123 Tech Street, Digital City</p>
        <p>Email: info@gadgetgrads.com</p>
        <p>Phone: +44 123 456 7890</p>
      </address>
      <div class="social-icons">
        <a href="#" class="social-icon social-facebook" aria-label="Facebook"></a>
        <a href="#" class="social-icon social-twitter" aria-label="Twitter"></a>
        <a href="#" class="social-icon social-instagram" aria-label="Instagram"></a>
        <a href="#" class="social-icon social-linkedin" aria-label="LinkedIn"></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="footer-container">
      <p class="copyright">© 2025 Gadget Grads. All Rights Reserved.</p>
      <div class="footer-legal">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Policy</a>
      </div>
    </div>
  </div>
</footer>