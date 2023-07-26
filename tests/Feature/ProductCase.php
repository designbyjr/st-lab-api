<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductCase extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_products()
    {
        $user = User::factory()->create();
        $this->assertCount(0, $user->tokens);

        $this->actingAs($user);

        $response = $this->getJson('/api/products');
        $response->assertJson(fn (AssertableJson $json) =>
        $json->has('data')
            ->has('data.0.id')

        )->assertStatus(201);
    }
    public function test_store_product()
    {
        $user = User::factory()->create();

       $this->actingAs($user, 'sanctum')
        ->postJson('/api/products',[
            "name" => "Mint world of lather",
            "color"  => "green",
            "price"  => 14.99,
            "category"  => "soap"
        ],["Accept:"=> "application/json"])
           ->assertJson(fn (AssertableJson $json) =>
           $json->has('data')
               ->has('data.id')

        )->assertStatus(201);
    }

    public function test_update_product()
    {
        $user = User::factory()->create();
        $product = Products::latest()->first();
        $this->actingAs($user, 'sanctum')
            ->putJson('/api/products/'.(int)$product->id,[
                "name" => "Mint world of lather",
                "color"  => "LimeGreen",
                "price"  => 15.99,
                "category"  => "lux-soap"
            ],["Accept:"=> "application/json"])
            ->assertStatus(201);
    }

    public function test_destroy_product()
    {
        $user = User::factory()->create();
        $product = Products::latest()->first();

        $this->actingAs($user, 'sanctum')
            ->deleteJson('/api/products/'.(int)$product->id,[],["Accept:"=> "application/json"])
            ->assertStatus(204);
    }



}
