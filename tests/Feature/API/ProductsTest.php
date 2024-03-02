<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{

    public function test_get_products_endpoint(): void
    {
        $response = $this->get(route('api.products.list'));
        $response->assertStatus(200);
    }

}
