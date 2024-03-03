<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Sale;
use App\Models\Product;

use App\Http\Requests\CreateSaleRequest;
use App\Http\Requests\AddProductsToSaleRequest;
use Illuminate\Database\Eloquent\Collection;

class SalesController extends Controller
{
    public function __construct(private Sale $sale)
    {
    }

    public function addSale( CreateSaleRequest $request) : Response 
    {   
        $request = $request->validated();

        $products = $this->getProductsCollectionFromRequest($request['products']);

        $products_ids = array_column($request['products'], 'id');
        $products = Product::whereIn('id', $products_ids)->get();

        try {
            $sale = $this->sale->create(['amount' => $request['amount']]);        
            $sale->products()->saveMany($products);
            $sale->refresh();
            $sale->load('products');
        } catch (\Throwable $th) {
            return response()->json([
                'success'   => false,
                'message'   => $th->getMessage(),
                'data'      => ''
            ], 500); 
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Sale created',
            'data'      => $sale->toArray()
        ], 201); 
    }

    public function addProductsToSale(Sale $sale, AddProductsToSaleRequest $request) : Response 
    {   
        $request = $request->validated();
        $products = $this->getProductsCollectionFromRequest($request['products']);

        try {    
            $sale->products()->saveMany($products);
            $sale->refresh();
            $sale->load('products');
        } catch (\Throwable $th) {
            return response()->json([
                'success'   => false,
                'message'   => $th->getMessage(),
                'data'      => ''
            ], 500); 
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Products added to sale',
            'data'      => $sale->toArray(),
        ], 201);
    }

    public function listSales() : Response 
    {     
        $sales = $this->sale->with('products')->get();
        return response()->json([
            'success'   => true,
            'message'   => '',
            'data'      => $sales->toArray()
        ], 200);         
    }

    public function getSale(Sale $sale) : Response 
    {     
        $sale->load('products');

        return response()->json([
            'success'   => true,
            'message'   => '',
            'data'      => $sale->toArray()
        ], 200);   
    }

    public function cancelSale(Sale $sale) : Response 
    {    
        $sale->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Venda cancelada com sucesso',
            'data'      => []
        ], 200);   
    }



    public function getProductsCollectionFromRequest($products) : Collection
    {
        $products_ids = array_column($products, 'id');
        $products = Product::whereIn('id', $products_ids)->get();
        return $products;
    }
}