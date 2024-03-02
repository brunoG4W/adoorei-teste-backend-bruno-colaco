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
        $response->assertJsonCount($products->count());

        $response->assertJson(function (AssertableJson $json) use($products){
            $json->whereAllType([
                '0.id' => 'integer',
                '0.name' => 'string',                 
                '0.description'=> 'string'
            ]);

            $json->hasAll(['0.id', '0.name', '0.price', '0.description']);

        });



    }

}
