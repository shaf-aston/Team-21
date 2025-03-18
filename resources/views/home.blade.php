<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
  <title>Top Deals</title>

  <link rel="stylesheet" href="{{asset('css/Home.css')}}">
  <link rel="stylesheet" href="{{asset('css/Footer.css')}}">
  <link rel="stylesheet" href="{{ asset('css/dark-mode-styles/home-dark-mode.css') }}">
</head>

<body style="padding-top: 7.5rem">
  <main>
    @include('components.navbar')

    <!-- Top Deals Banner Section -->
    <section class="top-deals-banner">
      <!-- Call To Action Banner -->
      <div class="cta-banner">
        <img class="cta-banner__image" src="{{asset('images/BigCTA.svg')}}" alt="Laptop Image" />
        <div class="cta-banner__content">
          <span class="cta-banner__title">Performance and Portability<br />All in one.</span>
          <span class="cta-banner__description"><br />Discover deals on new products</span>
        </div>
        <div class="cta-banner__gradient"></div>
        <div class="cta-banner__shop-now">
          <a href="{{url('/products')}}">Shop Now</a>
        </div>
      </div>

      <!-- New Deals Section -->
      <a href="{{url('Laptops')}}">
        <div class="new-deals-banner">
          <img class="new-deals-banner__image" src="{{asset('images/NewDeals.svg')}}" alt="Promotional Image" />
          <div class="new-deals-banner__content">
            <span class="new-deals-banner__subtitle">NEW IN</span>
            <span class="new-deals-banner__title">Laptops</span>
          </div>
        </div>
      </a>
    </section>

    <!-- Top Categories Section -->
    <section class="top-categories-section">
      <div class="section-header">
        <div class="section-header__title-wrapper">
          <h2 class="section-header__title">Shop From <span class="highlight">Top Categories</span></h2>
          <div class="section-header__title-underline"></div>
        </div>
        <a href="{{url('/products')}}" class="view-all-link">
          View All
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>
      </div>

      <div class="categories-grid">
        <ul class="categories-grid__list">

          <li class="category-item">
            <a href="{{url('Laptops')}}" class="category-item__link">
              <div class="category-item__icon-wrapper">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b85459064d1db8872cefa35ea0cb75b96611485a1034eab15cc15c903be0b1fb"
                  alt="Laptop category" class="category-item__icon" />
              </div>
              <span class="category-item__label">Laptops</span>
            </a>
          </li>

          <li class="category-item">
            <a href="{{url('Accessories')}}" class="category-item__link">
              <div class="category-item__icon-wrapper">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/3d114d2700b095d1f92bbc9b95c57495e85029199addbf0145d81ecd56b6a580"
                  alt="Accessories category" class="category-item__icon" />
              </div>
              <span class="category-item__label">Accessories</span>
            </a>
          </li>

          <li class="category-item">
            <a href="{{url('Phones')}}" class="category-item__link">
              <div class="category-item__icon-wrapper">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/9df3deee2522870205eae632db86bcd0b4a51397fe4d6092b3a1ec1f52de2daf"
                  alt="Mobile phones category" class="category-item__icon" />
              </div>
              <span class="category-item__label">Phones</span>
            </a>
          </li>

          <li class="category-item">
            <a href="{{url('Smartwatches')}}" class="category-item__link">
              <div class="category-item__icon-wrapper">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/a8059aabbd907429b9b6314b4ba2b571f35b511efb624789dc7395c92463cfc7"
                  alt="Smartwatches category" class="category-item__icon" />
              </div>
              <span class="category-item__label">Smartwatches</span>
            </a>
          </li>

          <li class="category-item">
            <a href="{{url('Tablets')}}" class="category-item__link">
              <div class="category-item__icon-wrapper">
                <img src="{{asset('images/Lenovo.svg')}}" alt="Headphones category"
                  class="category-item__icon" />
              </div>
              <span class="category-item__label">Tablets</span>
            </a>
          </li>


        </ul>
      </div>
    </section>

    <!-- Top Electronic Brands Carousel Section -->
    <section class="top-brands-section brand-carousel">
      <div class="section-header">
        <div class="section-header__title-wrapper">
          <h2 class="section-header__title">Top Electronic <span class="highlight">Brands</span></h2>
          <div class="section-header__title-underline"></div>
        </div>
      </div>

      <div class="brand-carousel__container">
        <button class="brand-carousel__button brand-carousel__button--left" aria-label="Previous slide">←</button>

        <div class="brand-carousel__items">
          <div class="brand-carousel__item">
            <img src="{{ asset('Images/samsung_logo.jpg') }}" alt="Samsung">
            <h3>Samsung</h3>
          </div>
          <div class="brand-carousel__item">
            <img src="{{ asset('images/apple_logo.png') }}" alt="Apple">
            <h3>Apple</h3>
          </div>
          <div class="brand-carousel__item">
            <img src="{{ asset('images/dell_logo.png') }}" alt="Dell">
            <h3>Dell</h3>
          </div>
          <div class="brand-carousel__item">
            <img src="{{ asset('images/sony_logo.png') }}" alt="Sony">
            <h3>Sony</h3>
          </div>
          <div class="brand-carousel__item">
            <img src="{{ asset('images/alienware_logo.png') }}" alt="Alienware">
            <h3>Alienware</h3>
          </div>
          <div class="brand-carousel__item">
            <img src="{{ asset('images/playstation_logo.png') }}" alt="PlayStation">
            <h3>PlayStation</h3>
          </div>
          <div class="brand-carousel__item">
            <img src="{{ asset('images/drdre_logo.png') }}" alt="Dr. Dre">
            <h3>Dr. Dre</h3>
          </div>
          <div class="brand-carousel__item">
            <img src="{{ asset('images/oneplus_logo.png') }}" alt="OnePlus">
            <h3>OnePlus</h3>
          </div>
          <div class="brand-carousel__item">
            <img src="{{ asset('images/asus_logo.png') }}" alt="Asus">
            <h3>Asus</h3>
          </div>
        </div>

        <button class="brand-carousel__button brand-carousel__button--right" aria-label="Next slide">→</button>
      </div>
    </section>

    <!-- Popular Products Section -->
    <section class="popular-products-section">
      <!-- Header Section -->
      <header class="popular-products-section__header">

        <div class="popular-products-section__popular">
          <h2 class="popular-products-section__popular-title">Popular Right Now</h2>

        </div>
      </header>

      <!-- Products Grid Section -->
      <section class="products-grid" loading="lazy">
        <!-- Product Card 1 -->
        <article class="product-card">
          <div class="product-card__image-placeholder"
            role="img"
            aria-label="Product image placeholder"><img src="{{asset('images/2.jpg')}}" alt=""></div>

          <h3 class="product-card__title">Apple Watch Series 10 - 42mm</h3>
          <p class="product-card__price">£399.00</p>
        </article>

        <!-- Product Card 2 -->
        <article class="product-card">
          <div class="product-card__image-placeholder"
            role="img"
            aria-label="Product image placeholder"><img src="{{asset('images/4.jpg')}}" alt=""></div>
          <h3 class="product-card__title">Apple iPhone 16 Pro Max</h3>
          <p class="product-card__price">£1199.00</p>
        </article>

        <!-- Product Card 3 -->
        <article class="product-card">

          <div class="product-card__image-placeholder"
            role="img"
            aria-label="Product image placeholder"><img src="{{asset('images/3.jpg')}}" alt=""></div>
          <h3 class="product-card__title">Apple 11" iPad Air(2024)</h3>
          <p class="product-card__price">£599.00</p>

        </article>

        <!-- Product Card 4 -->
        <article class="product-card">
          <div class="product-card__image-placeholder"
            role="img"
            aria-label="Product image placeholder"><img src="{{asset('images/7.jpg')}}" alt=""></div>
          <h3 class="product-card__title">Lenovo Thinkpad IdeaPad Gaming</h3>
          <p class="product-card__price">£799.00</p>
        </article>

        <!-- Navigation Icon -->
        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2f9608223079bcf7e5f7696e37a9660cc9ef78b37e9f6d990bd1eed11a9294be?placeholderIfAbsent=true&apiKey=3a437244a50945448f94b673144271db"
          alt="Navigation icon"
          class="products-grid__navigation-icon"
          loading="lazy">
      </section>
    </section>
    @include('components.Footer')
  </main>

  <!-- <script src="{{ asset('js/JavaScript_pop-up.js') }}"></script> -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      try {
        const brandItems = document.querySelector('.brand-carousel__items');
        const leftBtn = document.querySelector('.brand-carousel__button--left');
        const rightBtn = document.querySelector('.brand-carousel__button--right');
        const items = document.querySelectorAll('.brand-carousel__item');
        const visibleCount = 3;
        let currentIndex = 0;

        // Set initial styles
        brandItems.style.display = 'flex';
        brandItems.style.transition = 'transform 0.6s ease'; // Adjust the speed here

        // Calculate item width based on container
        const containerWidth = brandItems.parentElement.offsetWidth - 80; // Account for padding
        const itemWidth = (containerWidth / visibleCount) - 40; // Account for gap

        // Set width for each item
        items.forEach(item => {
          item.style.minWidth = `${itemWidth}px`;
          item.style.marginRight = '40px'; // Match the gap
        });

        function showItems(index) {
          if (index < 0) {
            currentIndex = items.length - visibleCount;
          } else if (index >= items.length) {
            currentIndex = 0;
          } else {
            currentIndex = index;
          }
          const moveAmount = (itemWidth + 40) * currentIndex; // Include gap in calculation
          brandItems.style.transform = `translateX(-${moveAmount}px)`;
        }

        leftBtn.addEventListener('click', () => {
          showItems(currentIndex - 1);
        });

        rightBtn.addEventListener('click', () => {
          showItems(currentIndex + 1);
        });

        // Initialize
        showItems(currentIndex);

        // Update on window resize
        window.addEventListener('resize', () => {
          const newContainerWidth = brandItems.parentElement.offsetWidth - 80;
          const newItemWidth = (newContainerWidth / visibleCount) - 40;

          items.forEach(item => {
            item.style.minWidth = `${newItemWidth}px`;
          });

          showItems(currentIndex);
        });

      } catch (e) {
        console.error("Carousel error:", e);
      }
    });
  </script>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Update images when dark mode state
    function updateImagesForDarkMode() {
      const isDarkMode = document.body.classList.contains('dark-mode');
      
      // Update brand logos
      const brandImages = {
        'samsung_logo.jpg': 'samsung_dark_mode.png',
        'apple_logo.png': 'apple_dark_mode.png',
        // 'dell_logo.png': 'dell_dark_mode.jpg',
        'sony_logo.png': 'sony_dark_mode.png',
        'alienware_logo.png': 'alienware_dark_mode.png',
        'playstation_logo.png': 'playstation_dark_mode.png',
        'drdre_logo.png': 'drdre_dark_mode.png',
        // 'oneplus_logo.png': 'oneplus_dark_mode.png',
        'asus_logo.png': 'asus_dark_mode.png'
      };
      
      // Select all brand carousel images
      document.querySelectorAll('.brand-carousel__item img').forEach(img => {
        const src = img.src;
        const filename = src.substring(src.lastIndexOf('/') + 1);
        
        if (isDarkMode && brandImages[filename]) {
          // Switch to dark mode image
          img.src = src.replace(filename, brandImages[filename]);
        } else if (!isDarkMode) {
          // Switch back to light mode image
          for (const [light, dark] of Object.entries(brandImages)) {
            if (filename === dark) {
              img.src = src.replace(dark, light);
              break;
            }
          }
        }
      });
    }
    
    // Call once on page load to set correct state
    updateImagesForDarkMode();
    
    // Listen for dark mode changes
    const observer = new MutationObserver(function(mutations) {
      mutations.forEach(function(mutation) {
        if (mutation.attributeName === 'class' && 
            mutation.target === document.body) {
          updateImagesForDarkMode();
        }
      });
    });
    
    // Start observing <body> for class changes
    observer.observe(document.body, { attributes: true });
  });
</script>
</html>