<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SalesTest extends TestCase
{
    public function test_get_sales_endpoint(): void
    {
        $response = $this->get(route('api.sales.list'));
        $response->assertStatus(200);
    }

    public function test_get_sale_details_endpoint(): void
    {
        $response = $this->get(route('api.sales.detail'));
        $response->assertStatus(200);
    }

    public function test_post_create_sale_endpoint(): void
    {
        $response = $this->get(route('api.sales.create'));
        $response->assertStatus(200);
    }

    public function test_post_cancel_sale_endpoint(): void
    {
        $response = $this->get(route('api.sales.cancel'));
        $response->assertStatus(200);
    }

    public function test_post_add_product_to_sale_endpoint(): void
    {
        $response = $this->get(route('api.sales.products.add'));
        $response->assertStatus(200);
    }

    
}