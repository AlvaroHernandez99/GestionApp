<?php


use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/customer', [CustomerController::class, 'getAll']);
Route::get('/customers/{id}', [CustomerController::class, 'getId']);
Route::post('/customers', [CustomerController::class, 'create']);
Route::delete('/customers/{id}', [CustomerController::class, 'delete']);
Route::patch('/customers/{id}', [CustomerController::class, 'modify']);

Route::middleware('api')->get('/customers/{id}', [CustomerController::class, 'getId']);


