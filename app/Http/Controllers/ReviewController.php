<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;




class ReviewController extends Controller
{
    //storing the product reviews
    public function store(Request $request, $productId){
        $request->validate([
            'review' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',

        ]);

        Review::create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'review' => $request->review,
            'rating' => $request ->rating,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully');

    }

    public function show($productId){
        $product = Product::with('review.user')->findOrFail($productId);
        return view('products.reviews', compact('products'));
        
    }
}
