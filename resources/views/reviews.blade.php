<div class="container">
    <h2>Reviews for {{ $product->name }}</h2>

    <!-- Display Existing Reviews -->
    @foreach($product->reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $review->user->name }} - {{ $review->rating }}⭐</h5>
                <p class="card-text">{{ $review->review }}</p>
                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
            </div>
        </div>
    @endforeach

    <!-- Review Submission Form -->
    @auth
    <div class="card">
        <div class="card-body">
            <h4>Leave a Review</h4>
            <form action="{{ url('/products/' . $product->id . '/reviews') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating (1-5)</label>
                    <select name="rating" class="form-control" required>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="1">⭐</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="review" class="form-label">Review</label>
                    <textarea name="review" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    </div>
    @else
        <p><a href="{{ route('login') }}">Login</a> to leave a review.</p>
    @endauth
</div>
@endsection