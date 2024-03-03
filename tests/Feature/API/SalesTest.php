<?php

namespace Tests\Feature\API;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Sale;
use Database\Seeders\SaleSeeder;
use App\Models\Product;
use Database\Seeders\ProductSeeder;

class SalesTest extends TestCase
{
    // use RefreshDatabase;
    

    public function test_post_create_sale_endpoint(): void
    {         
        $sale_array = Sale::factory()->has(Product::factory()->count(2) )->make()->toArray();       
        $sale_array['products'] = Product::factory()->count(2)->create()->toArray();
        $sale_array['amount'] = collect($sale_array['products'])->sum(function ($item) {
            return $item['price'];
        });

        $response = $this->postJson(
            route('api.sales.create'),
            $sale_array,
        );
        
        $response->assertCreated();           
        $this->assertDatabaseHas('sales', [
            'id' => $response['data']['id'],
        ]);
    }

    public function test_post_add_product_to_sale_endpoint(): void
    {

               // $this->seed(SaleSeeder::class);

            //    dd(Product::all());
               // dd(Sale::all());
        // dump('test_post_add_product_to_sale_endpoint');
        // $sale = Sale::factory()->has(Product::factory()->count(2) )->create();
        // $products = Product::factory(2)->make()->pluck('id')->toArray();

        // $response = $this->postJson(route( 'api.sales.products.add', $sale->id), ['products' => $products] );
    
        // dd($sale->products->toArray());


        // $response->assertStatus(200);
    }

    public function test_get_sales_endpoint(): void
    {
        $response = $this->getJson(route('api.sales.list'));
        $response->assertStatus(200);
    }

    public function test_get_sale_details_endpoint(): void
    {
        $response = $this->getJson(route('api.sales.detail', 1));
        $response->assertStatus(200);
    }

    public function test_post_cancel_sale_endpoint(): void
    {
        $response = $this->postJson(route('api.sales.cancel', 1));
        $response->assertStatus(200);
    }



    
}