<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');  // This will return your contact page view
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|email',
            'subject' => 'required|min:2|max:255',
            'pwho' => 'nullable|in:hr,admin,services,management,ceo,nsure',
            'message' => 'required|min:10|max:1000'
        ]);

         

        // Redirect back with success message
        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}

