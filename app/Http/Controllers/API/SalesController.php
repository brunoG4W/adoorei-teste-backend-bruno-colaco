<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Sale;
use App\Models\Product;

use App\Http\Requests\CreateSaleRequest;


class SalesController extends Controller
{
    public function __construct(private Sale $sale)
    {
    }

    public function listProducts() : Response 
    {     
        return response()->json(['ok'], 200);
    }

    public function addSale( CreateSaleRequest $request) : Response 
    {   
        $request = $request->validated();

        $products_ids = array_column($request['products'], 'id');
        $products = Product::whereIn('id', $products_ids)->get();

        try {
            $sale = $this->sale->create(['amount' => $request['amount']]);        
            $sale->products()->saveMany($products);
            $sale->refresh();
        } catch (\Throwable $th) {
            return response()->json([
                'success'   => false,
                'message'   => $th->getMessage(),
                'data'      => ''
            ], 201); 
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Sale created',
            'data'      => $sale
        ], 201); 
    }

    public function addProductsToSale(Sale $sale, Request $request) : Response 
    {   

        dump($sale->toArray());

        dd($request->products);

        $products = Product::whereIn('id', $request->products)->get();
        
        dd($products);
        die();
        // $products = Product::whereIn('id', $request->all())->get();
        


        // dd($products);

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


}