<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class LoginTest extends TestCase
{
    public function testloginValid(): void
    {
        //delete duplicate entries
        DB::table('users')->where('email', 'anewtest@email.com')->delete();
        $user = array(
            'name' => 'Test User',
            'email' => 'anewtest@email.com',
            'password' => 'password',
            'user_type' => 'admin'
        );
        User::create($user);


        $response = $this->post(route('login.post'),$user);
        $response->assertSessionHas('success', 'Logged in successfully');
        
        //delete data after use
        DB::table('users')->where('email', 'anewtest@email.com')->delete();

        $user = array(
            'name' => 'Test User',
            'email' => 'anewtest@email.com',
            'password' => 'password',
            'user_type' => 'user'
        );
        User::create($user);


        $response = $this->post(route('login.post'),$user);
        $response->assertSessionHas('success', 'Logged in successfully');

    }
    public function testloginInvalid(): void
    {
        //for admin
        //create correct credentials
        DB::table('users')->where('email', 'anewtest@email.com')->delete();
        $user = array(
            'name' => 'Test User',
            'email' => 'anewtest@email.com',
            'password' => 'password',
            'user_type' => 'admin'
        );
        User::create($user);

        //test with wrong email
        //delete duplicate entries and create data
        DB::table('users')->where('email', 'anew@email.com')->delete();
        $userwrong = array(
            'name' => 'TestUser',
            'email' => 'anew@email.com',
            'password' => 'wrongpassword',
            'user_status' => 'user'
        );

        $response = $this->post(route('login.post'),$userwrong);
        $response->assertSessionHasErrors('email','password');

        //clean table for future use
        DB::table('users')->where('email', 'anewtest@email.com')->delete();
        DB::table('users')->where('email', 'anew@email.com')->delete();
    }
}
