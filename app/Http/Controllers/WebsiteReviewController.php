<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteReview;
use Illuminate\Support\Facades\Auth;

class WebsiteReviewController extends Controller
{
    //store website reviews 
    public function store(Request $request){
        $request->validate([
            'review' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',

        ]);

        WebsiteReview::create([
            'user_id' => Auth::id(),
            'review' => $request->review,
            'rating' => $request ->rating,
        ]);

        return redirect()->back()->with('success', 'Review submitted successfully');

    }

    //shows all the reviews
    public function index(){
        $websitereviews = WebsiteReview::all();
        return view('websitereview', compact('websitereviews'));
    }
}
