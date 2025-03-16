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
      <form action="{{ route('websitereviews.store') }}" method="POST" class="review-form">
        @csrf
        <div class="rating">
          <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars">★</label>
          <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">★</label>
          <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">★</label>
          <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">★</label>
          <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star">★</label>
        </div>
        <textarea name="review" placeholder="Write your review here..." required></textarea>
        <button type="submit">Submit Review</button>
      </form>
    </div>
  </div>
</body>

</html>