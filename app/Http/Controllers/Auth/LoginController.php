<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // password hashing
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //taking the credentials and checking against the database
    public function login(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Attempt login with the default guard
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); // Get authenticated user
    
            // Start session and store user info
            Session::put('user_id', $user->user_id);
            Session::put('user_type', $user->user_type); // Fetch user_type from Auth
            Session::put('email', $user->email);
    
            // Redirect based on user type
            if ($user->user_type === 'admin') {
                return redirect('/adminproducts')->with('success', 'Logged in successfully as Admin');
            } else {
                return redirect('/home')->with('success', 'Logged in successfully');
            }
        }
    
        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }


    //logout the current user logged in
    public function logout(Request $request)
    {
        Session::flush(); // Remove all session data
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}