<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Product;

class ProductsController extends Controller
{

    public function __construct(private Product $product)
    {
    }



    public function listProducts() : Response 
    {     
        return response()->json($this->product->all());
        
    }
}




