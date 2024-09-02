<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Routecontroller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//get
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::get('category/delete/{id}', [RouteController::class, 'DeleteCategory']);
Route::get('category/update/{id}', [RouteController::class, 'UpdateCategory']);

//post
Route::post('category/create', [RouteController::class, 'categoryCreate']);
Route::post('category/delete', [RouteController::class, 'categoryDelete']);
Route::post('category/update', [RouteController::class, 'categoryUpdate']);

