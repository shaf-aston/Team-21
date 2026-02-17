<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordControllerTest extends TestCase
{
   
    /** @test */
    public function test_reset_password_with_valid_data()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('oldpassword'),
        ]);

        $response = $this->post(route('forgot.password.reset'), [
            'email' => 'test@example.com',
            'new_password' => 'newsecurepassword',
            'new_password_confirmation' => 'newsecurepassword',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('status', 'Your password has been changed');

        $this->assertTrue(Hash::check('newsecurepassword', $user->fresh()->password));
    }
    /** @test */
    public function test_reset_password_with_invalid_email()
    {
        $response = $this->post(route('forgot.password.reset'), [
            'email' => 'nonexistent@example.com',
            'new_password' => 'newsecurepassword',
            'new_password_confirmation' => 'newsecurepassword',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
    
    /** @test */
    public function test_reset_password_with_unconfirmed_password()
    {
        $user = User::factory()->create([
            'email' => 'test2@example.com',
        ]);

        $response = $this->post(route('forgot.password.reset'), [
            'email' => 'test2@example.com',
            'new_password' => 'newsecurepassword',
            'new_password_confirmation' => 'mismatchedpassword',
        ]);

        $response->assertSessionHasErrors(['new_password']);
    }
}
