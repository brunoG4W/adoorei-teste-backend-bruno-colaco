<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

use App\Models\Product;
use Database\Seeders\ProductSeeder;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_products_endpoint(): void
    {
        //$products = Product::factory(3)->create();     
        $this->seed(ProductSeeder::class);
        $products = Product::all();

        $response = $this->get(route('api.products.list'));

        $response->assertStatus(200);     
        $this->assertEquals( $products->count(), count($response['data']) );
    }

}
