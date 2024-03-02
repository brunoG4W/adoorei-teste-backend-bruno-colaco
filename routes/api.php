<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\SalesController;

//Listar produtos disponíveis
Route::get('products', [ProductsController::class, 'listProducts']);

//Cadastrar nova venda
Route::post('sale', [SalesController::class, 'addSale']);

//Consultar vendas realizadas
Route::get('sales', [SalesController::class, 'listSales']);

//Consultar uma venda específica
Route::get('sales/{id}', [SalesController::class, 'getSale']);

//Cancelar uma venda
Route::post('sale/{id}/cancel', [SalesController::class, 'cancelSale']);

//Cadastrar novas produtos a uma venda]
Route::post('sale/{id}/add_products', [SalesController::class, 'addProductsToSale']);
