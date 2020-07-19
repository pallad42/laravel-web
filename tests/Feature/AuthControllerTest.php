<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_valid_user() {
        $this->withoutExceptionHandling();

        $userStoreResponse = $this->post(route('register'), [
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin_admin',
            'password_confirmation' => 'admin_admin'
        ]);

        $userStoreResponse->assertSessionHasNoErrors();
        $userStoreResponse->assertRedirect(route('home.index'));
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function register_invalid_user() {
        $this->withExceptionHandling();

        $userStoreResponse = $this->post(route('register'), [
//            'name' => 'admin',
//            'email' => 'admin@example.com',
            'password' => 'admin_admin',
            'password_confirmation' => 'admin_admin'
        ]);

        $userStoreResponse->assertSessionHasErrors(['name', 'email']);

        $this->assertCount(0, User::all());
    }

}
