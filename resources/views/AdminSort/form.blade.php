<form method="GET" action="{{ route('adminsort.result') }}" class="mb-3">
    <label for="sort_by">Sort by:</label>
    <select name="sort_by" id="sort_by" class="form-control d-inline-block w-auto">
        <option value="order_id" {{ request('sort_by') == 'order_id' ? 'selected' : '' }}>Order ID</option>
        <option value="total_amount" {{ request('sort_by') == 'total_amount' ? 'selected' : '' }}>Price</option>
        <option value="order_status" {{ request('sort_by') == 'order_status' ? 'selected' : '' }}>Alphabetical (Order Status)</option>
    </select>

    <select name="sort_order" id="sort_order" class="form-control d-inline-block w-auto">
        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
    </select>

    <button type="submit" class="btn btn-primary">Sort</button>
</form>