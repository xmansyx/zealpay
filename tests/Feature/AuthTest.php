<?php

namespace Tests\Feature;

use App\Models\AParent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_name()
    {
        $user = AParent::factory()->create();

        $response = $this->postJson('/api/login',[
            'name' => $user->name,
        ])->assertOk();

        $this->assertArrayHasKey('token', $response->json());
    }

    public function test_if_parent_name_is_not_wrong_then_it_return_error()
    {
        $this->postJson('/api/login',[
            'name' => 'any not avaialble name',
        ])->assertUnauthorized();
    }

}