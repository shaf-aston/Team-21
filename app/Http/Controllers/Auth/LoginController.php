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
        //validate the inputs
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'user_type' => ['required', 'in:customer,admin']
        ]);

        $hashedPassword = Hash::make($request->password);

        //checking if it is a customer or admin
        if($request->user_type === 'customer') {

            if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::guard('web')->user();
                // Start session and store user info
                Session::put('user_id', $user->user_id);
                Session::put('user_type', 'customer');
                Session::put('email', $user->email);

                return redirect('/home')->with('success', 'Logged in successfully');
            }
        } else {
            $admin = DB::table('admins')->where('email', $request->email)->first();
            if($admin && Hash::check($request->password, $admin->user_password)) {
                // Start session and store admin info
                Session::put('user_id', $admin->admin_id);
                Session::put('user_type', 'admin');
                Session::put('email', $admin->email);

                return redirect('/adminproducts')->with('success', 'Logged in successfully');
            }
        }

        //return with the errors
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    //logout the current user logged in
    public function logout(Request $request)
    {
        Session::flush(); // Remove all session data
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}