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
    use RefreshDatabase;
    

    public function test_post_create_sale_endpoint(): void
    {       
        $this->seed(ProductSeeder::class);

        $sale_array = Sale::factory()->has(Product::factory()->count(2) )->make()->toArray();       
        $sale_array['products'] = Product::select('id','name','price')->limit(2)->get()->toArray();
        //adiciona uma quantidade
        $sale_array['products'] = collect( $sale_array['products'] )->map( function($item){
            $item['amount'] = rand(1,5);
            return $item;
        });
        $sale_array['amount'] = $sale_array['products']->sum(function ($item) {
            return $item['price'] * $item['amount'];
        });
        number_format($sale_array['amount'] , 2, '.', '');
        
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
        $this->seed(SaleSeeder::class);
        // pego a primeira que tiver no db pra testar
        $sale = Sale::with('products')->first()->toArray();

        //pego um produto que não esteja nessa venda
        $products = Product::whereNotIn('id', array_column($sale['products'], 'id'))
                            ->select('id','name','price')
                            ->limit(2)
                            ->get();
        $products->map( function($item){
            $item['amount'] = rand(1,5);
            return $item;
        });
        $soma = count($sale['products']) + $products->count();


   

        $response = $this->postJson(
            route( 'api.sales.products.add', $sale['id']), 
            ['products' => $products] 
        );
        
        $response->assertCreated();          
        $this->assertEquals( $soma, count($response['data']['products']) );

    }

    public function test_get_sales_endpoint(): void
    {
        $this->seed(SaleSeeder::class);
        $sales_count = Sale::all()->count();

        $response = $this->getJson(route('api.sales.list'));

        $response->assertStatus(200);
        $this->assertEquals( $sales_count, count($response['data']) );
    }

    public function test_get_sale_details_endpoint(): void
    {
        $this->seed(SaleSeeder::class);
        $sale = Sale::inRandomOrder()->first();        

        $response = $this->getJson(route('api.sales.detail', $sale->id));

        $response->assertStatus(200);
        $this->assertEquals( $sale->id, $response['data']['id'] );
    }

    public function test_post_cancel_sale_endpoint(): void
    {
        $this->seed(SaleSeeder::class);
        $sale = Sale::inRandomOrder()->first();  

        $response = $this->postJson(route('api.sales.cancel', $sale->id));
        $response->assertStatus(200);
        $this->assertSoftDeleted($sale);
        
    }

    
}