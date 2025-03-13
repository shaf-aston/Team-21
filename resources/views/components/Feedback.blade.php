<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gadget Grads - Feedback</title>
  <link rel="stylesheet" href="{{ asset('/css/Feedback.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/dark-mode-styles/feedback-dark-mode.css') }}">
</head>

<body>

  <div class="feedback-container">
    <h2 class="feedback-heading">Your Feedback Matters</h2>
    {{-- <form class="feedback-form" action="{{ route('feedback.submit') }}" method="POST"> --}}
    @csrf

    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label for="category">Feedback Category</label>
      <select id="category" name="category" required>
        <option value="">Select Category</option>
        <option value="product">Product Quality</option>
        <option value="website">Website Experience</option>
        <option value="service">Customer Service</option>
        <option value="delivery">Delivery Service</option>
        <option value="other">Other</option>
      </select>
    </div>

    <div class="form-group">
      <label for="rating">Rating</label>
      <select id="rating" name="rating" required>
        <option value="">Select Rating</option>
        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
        <option value="4">⭐⭐⭐⭐ Very Good</option>
        <option value="3">⭐⭐⭐ Good</option>
        <option value="2">⭐⭐ Fair</option>
        <option value="1">⭐ Poor</option>
      </select>
    </div>

    <div class="form-group">
      <label for="feedback">Your Feedback</label>
      <textarea id="feedback" name="feedback" placeholder="Please share your experience with us..." required></textarea>
    </div>

    <button type="submit" class="submit-btn">Submit Feedback</button>
    </form>
  </div>
  @include('components.footer')
</body>

</html>