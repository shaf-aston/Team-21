<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerDetailsController extends Controller
{


  // Display the form
  public function edit()
  {
    return view('customerUpdate');
  }

  public function adminedit($id)
  {
    $user = User::findOrFail($id);
    return view('admincustomer.edit', compact('user'));
  }

  public function index(Request $request)
  {

    // Retrieve all users from the database
    $users = User::all();
    return view('admincustomer.index', compact('users'));
  }

  public function show($user_id)
  {
    return view('admincustomer.show', ['user' => User::find($user_id)]);
  }


  public function remove($user_id)
  {
    $user = User::findorFail($user_id);
    $user->basketItems()->delete();
    $user->delete();


    return redirect()->route('adminusers.index')->with('sucess', 'Product has been removed from database');
  }




  // Update the customer's details
  // public function update(Request $request)
  // {
  //     $customer = Auth::user();

  //     // Validate the input data
  //     $validatedData = $request->validate([
  //         'name' => 'required|string|max:255',
  //         'email' => 'required|email|max:255|unique:users,email,',
  //         'phone' => 'required|string|min:10|max:15|regex:/^[0-9+\-\s()]*$/',
  //     ]);

  //     // Update the customer's details
  //     $customer->update($validatedData);

  //     return redirect()->route('edit')->with('success', 'Your details have been updated successfully.');
  // }
  public function update(Request $request)
  {
    $customer = Auth::user();

    // Validate the input data
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255|unique:users,email,' . $customer->id, // Unique email validation
      'password' => 'required|string|min:8', // Optional password field
    ]);

    // Update the customer's details
    $customer->name = $validatedData['name'];
    $customer->email = $validatedData['email'];


    // If a new password is provided, hash and update it
    if ($request->filled('password')) {
      $customer->password = Hash::make($validatedData['password']);
    }

    // Save the changes
    $customer->save();

    return redirect()->route('customer.edit')->with('success', 'Your details have been updated successfully.');
  }


  public function adminupdate(Request $request, $user_id)
  {
    $customer = User::findOrFail($user_id);

    // Validate the input data
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255|unique:users,email,' . $customer->id, // Unique email validation
      'password' => 'required|string|min:8', // Optional password field
    ]);

    // Update the customer's details
    $customer->name = $validatedData['name'];
    $customer->email = $validatedData['email'];


    // If a new password is provided, hash and update it
    if ($request->filled('password')) {
      $customer->password = Hash::make($validatedData['password']);
    }

    // Save the changes
    $customer->save();

    return redirect()->route('adminusers.show', $user_id)->with('success', 'Your details have been updated successfully.');
  }

  // Delete account
  public function delete(Request $request)
  {
    $customer = Auth::user();

    // Validate the password
    $request->validate([
      'password' => 'required',
    ]);

    // Check if the password is correct
    if (!Hash::check($request->password, $customer->password)) {
      return redirect()->route('edit')->withErrors(['password' => 'Incorrect password.']);
    }

    $customer->delete();

    return redirect('/home')->with('success', 'Your account has been deleted successfully.');
  }
}
