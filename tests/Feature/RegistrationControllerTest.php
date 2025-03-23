<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;

class RegistrationControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_displays_the_registration_form()
    {
        $response = $this->get(route('register'));
        
        $response->assertStatus(200);
        $response->assertViewIs('signup');
    }

    // /** @test */
    public function it_registers_a_new_user_successfully()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('register.post'), $userData);

        $response->assertRedirect('/nav');
        $response->assertSessionHas('success', 'You have completed Registration');

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    // /** @test */
    public function it_fails_registration_when_email_is_not_unique()
    {
        $existingUser = User::factory()->create(['email' => 'test2@example.com']);

        $userData = [
            'name' => 'New User',
            'email' => 'test2@example.com', // Duplicate email
            'password' => 'password123',
        ];

        $response = $this->post(route('register.post'), $userData);

        $response->assertSessionHasErrors('email');
    }

    // /** @test */
    public function it_fails_registration_when_password_is_too_short()
    {
        $userData = [
            'name' => 'Short Password User',
            'email' => 'shortpass@example.com',
            'password' => '123', // Too short
        ];

        $response = $this->post(route('register.post'), $userData);

        $response->assertSessionHasErrors('password');
    }
}