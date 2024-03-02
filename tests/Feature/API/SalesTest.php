<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesTest extends TestCase
{
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

    public function test_post_create_sale_endpoint(): void
    {
        $response = $this->postJson(route('api.sales.create'));
        $response->assertStatus(200);
    }

    public function test_post_cancel_sale_endpoint(): void
    {
        $response = $this->postJson(route('api.sales.cancel', 1));
        $response->assertStatus(200);
    }

    public function test_post_add_product_to_sale_endpoint(): void
    {
        $response = $this->postJson(route('api.sales.products.add', 1));
        $response->assertStatus(200);
    }

    
}