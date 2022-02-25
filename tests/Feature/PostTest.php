<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function test_posts_when_visitor_see_post_and_no_params_then_response_success()
    {
        $user = User::where('role', 'visitor')->first();;
        $token = JWTAuth::fromUser($user);

        $baseUrl = Config::get('app.url') . '/api/v1/post';

        $response = $this->json('GET', $baseUrl . '/', (array)'', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'description',
                        'slug',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    /** @test */
    public function test_post_when_writer_see_post_and_params_id_valid_then_response_success()
    {
        $user = User::where('role', 'writer')->first();;
        $token = JWTAuth::fromUser($user);

        $id = 1;
        $baseUrl = Config::get('app.url') . '/api/v1/post/' . $id;

        $response = $this->json('GET', $baseUrl . '/', (array)'', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'title',
                    'description',
                    'slug',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    /** @test */
    public function test_post_when_visitor_cant_create_post_and_no_params_then_response_failed()
    {
        $user = User::where('role', 'visitor')->first();;
        $token = JWTAuth::fromUser($user);

        $baseUrl = Config::get('app.url') . '/api/v1/post/';

        $response = $this->json('POST', $baseUrl . '/', (array)[], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(401)
            ->assertJsonStructure([
                'success',
                'message'
            ]);
    }

    /** @test */
    public function test_post_when_writer_can_create_post_and_params_valid_then_response_success()
    {
        $user = User::where('role', 'writer')->first();;
        $token = JWTAuth::fromUser($user);

        $params = [
            'title' => 'Possimus veritatis omnis vel in.',
            'description' => 'Consectetur et ab inventore ad tempore est qui. Omnis aliquid sit commodi autem sit natus quia. Magni vitae culpa ipsum temporibus.'
        ];

        $baseUrl = Config::get('app.url') . '/api/v1/post/';

        $response = $this->json('POST', $baseUrl . '/', $params, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'title',
                    'description',
                    'slug',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    /** @test */
    public function test_post_when_visitor_cant_update_post_and_params_id_valid_then_response_failed()
    {
        $user = User::where('role', 'visitor')->first();;
        $token = JWTAuth::fromUser($user);

        $id = 1;

        $baseUrl = Config::get('app.url') . '/api/v1/post/'. $id;

        $response = $this->json('PUT', $baseUrl . '/', (array)[], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(401)
            ->assertJsonStructure([
                'success',
                'message'
            ]);
    }

    /** @test */
    public function test_post_when_writer_can_update_post_and_params_valid_then_response_success()
    {
        $user = User::where('role', 'writer')->first();;
        $token = JWTAuth::fromUser($user);

        $id = 1;

        $params = [
            'title' => 'Possimus veritatis omnis vel in.',
            'description' => 'Consectetur et ab inventore ad tempore est qui. Omnis aliquid sit commodi autem sit natus quia. Magni vitae culpa ipsum temporibus.'
        ];

        $baseUrl = Config::get('app.url') . '/api/v1/post/'. $id;

        $response = $this->json('PUT', $baseUrl . '/', $params, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'title',
                    'description',
                    'slug',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    /** @test */
    public function test_post_when_visitor_cant_delete_post_and_params_id_valid_then_response_failed()
    {
        $user = User::where('role', 'visitor')->first();;
        $token = JWTAuth::fromUser($user);

        $id = 1;

        $baseUrl = Config::get('app.url') . '/api/v1/post/'. $id;

        $response = $this->json('DELETE', $baseUrl . '/', (array)[], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(401)
            ->assertJsonStructure([
                'success',
                'message'
            ]);
    }

    /** @test */
    public function test_post_when_writer_can_delete_post_and_params_valid_then_response_success()
    {
        $user = User::where('role', 'writer')->first();;
        $token = JWTAuth::fromUser($user);

        $id = 1;

        $baseUrl = Config::get('app.url') . '/api/v1/post/'. $id;

        $response = $this->json('DELETE', $baseUrl . '/', (array)[], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message'
            ]);
    }
}
