<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{




    public function listProducts() //: Response 
    {     
        $products =  ProductResource::collection(Product::all());      
        return response()->json([
            'success'   => true,
            'message'   => '',
            'data'      => $products
        ], 200);   
    }
}




