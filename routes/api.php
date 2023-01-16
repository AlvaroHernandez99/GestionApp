<?php


use App\Http\Controllers\CompanycarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('/customers')->group(function() {
    Route::get('', [CustomerController::class, 'getAll']);
    Route::get('/{id}', [CustomerController::class, 'getId']);
    Route::post('', [CustomerController::class, 'create']);
    Route::delete('/{id}', [CustomerController::class, 'delete']);
    Route::patch('/{id}', [CustomerController::class, 'modify']);
});

Route::prefix('/customers')->group(function() {
    Route::middleware('verifyId')->get("/{id}",[CustomerController::class, 'getId']);
    Route::middleware('verifyId')->delete("/{id}",[CustomerController::class, 'delete']);
    Route::middleware('verifyId')->patch("/{id}",[CustomerController::class, 'modify']);
});


Route::prefix('/companycars')->group(function() {
    Route::get('', [CompanycarController::class, 'getAll']);
    Route::get('/{id}', [CompanycarController::class, 'getId']);
    Route::post('', [CompanycarController::class, 'create']);
    Route::delete('/{id}', [CompanycarController::class, 'delete']);
    Route::patch('/{id}', [CompanycarController::class, 'modify']);
});

Route::prefix('/companycars')->group(function() {
    Route::middleware('verifyId')->get("/{id}",[CompanycarController::class, 'getId']);
    Route::middleware('verifyId')->delete("/{id}",[CompanycarController::class, 'delete']);
    Route::middleware('verifyId')->patch("/{id}",[CompanycarController::class, 'modify']);
});

Route::prefix('/employees')->group(function() {
    Route::get('', [EmployeeController::class, 'getAll']);
    Route::get('/{id}', [EmployeeController::class, 'getId']);
    Route::post('', [EmployeeController::class, 'create']);
    Route::delete('/{id}', [EmployeeController::class, 'delete']);
    Route::patch('/{id}', [EmployeeController::class, 'modify']);
});

Route::prefix('/employees')->group(function() {
    Route::middleware('verifyId')->get("/{id}",[EmployeeController::class, 'getId']);
    Route::middleware('verifyId')->delete("/{id}",[EmployeeController::class, 'delete']);
    Route::middleware('verifyId')->patch("/{id}",[EmployeeController::class, 'modify']);
});

Route::prefix('/roles')->group(function() {
    Route::get('', [RoleController::class, 'getAll']);
    Route::get('/{id}', [RoleController::class, 'getId']);
    Route::post('', [RoleController::class, 'create']);
    Route::delete('/{id}', [RoleController::class, 'delete']);
    Route::patch('/{id}', [RoleController::class, 'modify']);
});

Route::prefix('/roles')->group(function() {
    Route::middleware('verifyId')->get("/{id}",[RoleController::class, 'getId']);
    Route::middleware('verifyId')->delete("/{id}",[RoleController::class, 'delete']);
    Route::middleware('verifyId')->patch("/{id}",[RoleController::class, 'modify']);
});
