<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegistrationController extends Controller
{
    //show the registration form
    public function showForm(){
        return view('register');
    }

    //checking the fields and storing the details in the database
    public function register(Request $request){
        if($request ->isMethod('post')){
            $validInput = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);
        
 

            try{
                User::create([
                    'name' => $validInput['name'],
                    'email' => $validInput['email'],
                    'password' => $validInput['password'], 
                ]);
                
               
            
            
                  
                


                return redirect('/nav')->with('success', 'You have completed Registration');
            }
            catch(PDOexception $ex){
                return back()->withInput()->withErrors(['An error occurred' => 'Please try again. Registration failed']);

            }
        }
    }
}
