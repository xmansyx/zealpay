<?php

namespace Tests\Feature;

use App\Models\ABaby;
use App\Models\AParent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BabiesApiTest extends TestCase
{
    /** @test */
    public function test_if_data_returned_unauthenticated()
    {

       $this->getJson('/api/babies')->assertUnauthorized();

    }

    /** @test */
    public function a_parent_can_view_their_babies()
    {

        $parent = AParent::factory()->create();
        $response = $this->actingAs($parent)->getJson('/api/babies');


        $response->assertOk()->assertJson([]);
    }
 
    /** @test */
    public function a_parent_can_view_single_baby()
    {
        $parent = AParent::factory()->create();
        $baby = ABaby::factory()->create(
            ['parent_id' => $parent->id]
        );
        
        $response = $this->actingAs($parent)->getJson('/api/babies/'.$baby->id);
        
        $response->assertOk()->assertJson([
            'name' => $baby->name
        ]);
    }

    /** @test */
    public function a_parent_can_not_view_other_parents_babies()
    {
        $parent = AParent::factory()->create();
        $baby = ABaby::factory()->create();
        
        $response = $this->actingAs($parent)->getJson('/api/babies/'.$baby->id);
        
        $response->assertUnauthorized();
    }
 
    /** @test */
    public function authenticated_parents_can_create_a_new_baby()
    {
        $parent = AParent::factory()->create();
        
        $this->actingAs($parent)->postJson('/api/babies', [
            'name' => 'ahmed',
        ])->assertOk();

    }

    /** @test */
    public function unauthenticated_parents_can_not_create_a_new_baby()
    {
        
        $this->postJson('/api/babies',[
            'name' => 'ahmed',
        ])->assertUnauthorized();

    }

 
    /** @test */
    public function authorized_user_can_update_the_task(){

        $parent = AParent::factory()->create();
        $baby = ABaby::factory()->create(
            ['parent_id' => $parent->id]
        );

        $baby->name = "Updated Title";

        $this->actingAs($parent)->putJson('/api/babies/'.$baby->id, $baby->toArray())->assertOk();

    }
 
    /** @test */
    public function unauthorized_user_can_not_update_the_task(){

        $parent = AParent::factory()->create();
        $baby = ABaby::factory()->create();

        $baby->name = "Updated Title";

        $this->actingAs($parent)->putJson('/api/babies/'.$baby->id, $baby->toArray())->assertUnauthorized();

    }
 
     /** @test */
     public function authorized_user_can_delete_the_task(){

        $parent = AParent::factory()->create();
        $baby = ABaby::factory()->create(
            ['parent_id' => $parent->id]
        );

        $this->actingAs($parent)->deleteJson('/api/babies/'.$baby->id)->assertOk();

    }
 
    /** @test */
    public function unauthorized_user_can_not_delete_the_task(){

        $parent = AParent::factory()->create();
        $baby = ABaby::factory()->create();


        $this->actingAs($parent)->deleteJson('/api/babies/'.$baby->id)->assertUnauthorized();

    }
}