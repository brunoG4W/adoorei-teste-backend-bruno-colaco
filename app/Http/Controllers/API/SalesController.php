<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalesController extends Controller
{
    public function listProducts() : Response 
    {     
        return response()->json(['ok'], 200);
    }

    public function addSale() : Response 
    {     
        return response()->json(['ok'], 200);
    }

    public function listSales() : Response 
    {     
        return response()->json(['ok'], 200);
    }

    public function getSale() : Response 
    {     
        return response()->json(['ok'], 200);
    }

    public function cancelSale() : Response 
    {     
        return response()->json(['ok'], 200);
    }

    public function addProductsToSale() : Response 
    {     
        return response()->json(['ok'], 200);
    }
}