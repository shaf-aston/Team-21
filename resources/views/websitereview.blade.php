<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <!-- Favicons -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">

  <title>Website Reviews</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('/css/websitereview.css') }}">
</head>

<body>
  @include('components.navbar')

  <div class="main-content">
    <!-- Display the reviews -->
    <div class="review-container">
      <h3>Customer Reviews</h3>

      @if ($websitereviews->count() > 0)
      <div class="reviews-list">
        @foreach ($websitereviews as $review)
        <div class="review-item">
          <div class="review-user">{{ $review->user->email }}</div>
          <div class="review-rating">
            @for ($i = 1; $i <= 5; $i++)
              @if ($i <=$review->rating)
              ★
              @else
              ☆
              @endif
              @endfor
              <span class="rating-value">{{ $review->rating }}/5</span>
          </div>
          <p class="review-text">{{ $review->review }}</p>
        </div>
        @endforeach
      </div>
      @else
      <div class="no-reviews">No reviews yet. Be the first to leave a review!</div>
      @endif
    </div>

    <!-- User Review Section -->
    <div class="review-section">
      <h3>Leave a Review</h3>
      <form action="{{ route('websitereviews.store') }}" method="POST" class="review-form" id="reviewForm">
        @csrf
        <div class="rating-container">
          <div class="rating">
            <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars" class="full">★</label>
            <input type="radio" id="star4-5" name="rating" value="4.5"><label for="star4-5" title="4.5 stars" class="half">★</label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars" class="full">★</label>
            <input type="radio" id="star3-5" name="rating" value="3.5"><label for="star3-5" title="3.5 stars" class="half">★</label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars" class="full">★</label>
            <input type="radio" id="star2-5" name="rating" value="2.5"><label for="star2-5" title="2.5 stars" class="half">★</label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars" class="full">★</label>
            <input type="radio" id="star1-5" name="rating" value="1.5"><label for="star1-5" title="1.5 stars" class="half">★</label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star" class="full">★</label>
            <input type="radio" id="star0-5" name="rating" value="0.5"><label for="star0-5" title="0.5 stars" class="half">★</label>
          </div>
          <div class="rating-display"><span id="ratingValue">0</span>/5</div>
        </div>

        @if ($errors->has('rating'))
        <div class="error-message">{{ $errors->first('rating') }}</div>
        @endif
        <div id="rating-error" class="error-message" style="display: none;">Please select a rating before submitting</div>

        <textarea name="review" placeholder="Write your review here..." required></textarea>
        <button type="submit" id="submitReview">Submit Review</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get toggle buttons and products container
      const gridButton = document.querySelector('.toggle-button.grid-view');
      const listButton = document.querySelector('.toggle-button.list-view');
      const productsWrapper = document.querySelector('.products-wrapper');

      // Helper function for layout changes with transition
      function changeLayout(newLayout, oldLayout, animate = true) {
        if (animate) {
          // Add transitioning class
          productsWrapper.classList.add('changing-layout');
        }

        // Update the buttons
        if (newLayout === 'grid-layout') {
          gridButton.classList.add('active');
          listButton.classList.remove('active');
        } else {
          listButton.classList.add('active');
          gridButton.classList.remove('active');
        }

        // Apply the new layout
        productsWrapper.classList.remove(oldLayout);
        productsWrapper.classList.add(newLayout);

        if (animate) {
          // Remove transitioning class after animation completes
          setTimeout(() => {
            productsWrapper.classList.remove('changing-layout');
          }, 400);
        }

        // Save preference
        localStorage.setItem('productViewPreference', newLayout === 'grid-layout' ? 'grid' : 'list');
      }

      // Set up event listeners for toggle buttons
      gridButton.addEventListener('click', function() {
        if (!productsWrapper.classList.contains('grid-layout')) {
          changeLayout('grid-layout', 'list-layout', true);
        }
      });

      listButton.addEventListener('click', function() {
        if (!productsWrapper.classList.contains('list-layout')) {
          changeLayout('list-layout', 'grid-layout', true);
        }
      });

      // Check for saved preference and apply without animation on initial load
      const viewPreference = localStorage.getItem('productViewPreference');
      if (viewPreference === 'list' && productsWrapper.classList.contains('grid-layout')) {
        // Remove any animations that might be defined in CSS
        productsWrapper.classList.add('no-animation');

        // Apply list view without animation
        changeLayout('list-layout', 'grid-layout', false);

        // Allow animations after initial setup
        setTimeout(() => {
          productsWrapper.classList.remove('no-animation');
        }, 50);
      } else if (viewPreference !== 'list' && productsWrapper.classList.contains('list-layout')) {
        // Apply grid view without animation
        productsWrapper.classList.add('no-animation');
        changeLayout('grid-layout', 'list-layout', false);
        setTimeout(() => {
          productsWrapper.classList.remove('no-animation');
        }, 50);
      }
    });
  </script>
</body>

</html>