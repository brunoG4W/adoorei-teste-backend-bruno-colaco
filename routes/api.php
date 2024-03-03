<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\SalesController;

//Listar produtos disponíveis
Route::get('products', [ProductsController::class, 'listProducts'])->name('api.products.list');

//Cadastrar nova venda
Route::post('sale', [SalesController::class, 'addSale'])->name('api.sales.create');

//Cadastrar novas produtos a uma venda]
Route::post('sale/{sale}/add_products', [SalesController::class, 'addProductsToSale'])->name('api.sales.products.add');


//Consultar vendas realizadas
Route::get('sales', [SalesController::class, 'listSales'])->name('api.sales.list');

//Consultar uma venda específica
Route::get('sales/{sale}', [SalesController::class, 'getSale'])->name('api.sales.detail');

//Cancelar uma venda
Route::post('sale/{id}/cancel', [SalesController::class, 'cancelSale'])->name('api.sales.cancel');

