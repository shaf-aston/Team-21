<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ForgotPasswordController extends Controller
{
  //

  public function resetPassword(Request $request)
  {
    $validated = $request->validate([
      'email' => 'required|email|exists:users,email',
      'new_password' => 'required|string|min:8|confirmed',

    ]);


    $user = User::where('email', $request->email)->first();

    if ($user) {
      $user->update([
        'password' => Hash::make($request->new_password),

      ]);
      return redirect()->route('login')->with('status', 'Your password has been changed');
    }

    return back()->withErrors(['email' => 'No user found with this email']);
  }
}
