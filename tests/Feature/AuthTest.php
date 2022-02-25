<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use JWTAuth;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function test_login_when_user_and_password_valid_then_response_success()
    {
        $baseUrl = Config::get('app.url') . '/api/v1/auth/login';

        $response = $this->json('POST', $baseUrl . '/', [
            'email' => 'writer@test.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    public function test_register_when_params_valid_then_response_success()
    {
//        $user = User::first();
//        $token = JWTAuth::fromUser($user);
        $params = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'password',
            'role' => 'visitor'
        ];

        $baseUrl = Config::get('app.url') . '/api/v1/auth/register';

        $response = $this->json('POST', $baseUrl . '/', $params, [
            'Accept' => 'application/json',
//            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'role',
                    'updated_at',
                    'created_at'
                ]
            ]);
    }
}
