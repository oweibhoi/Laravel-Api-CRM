<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\SettingsTodosController;
use App\Http\Controllers\Api\V1\TodosController;
use App\Http\Controllers\LoginContoller;
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

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
    Route::apiResource('settings-todos', SettingsTodosController::class);
    Route::apiResource('todos', TodosController::class);
    Route::post('invoices/bulk', [InvoiceController::class, 'bulkstore']);
    Route::post('logout', [LoginContoller::class, 'logout']);
    Route::get('prospects', [CustomerController::class, 'prospects']);
    Route::put('customer-status/{id}', [CustomerController::class, 'status']);
    Route::put('todos-status/{id}', [SettingsTodosController::class, 'status']);
    Route::put('complete-todo/{id}/{id2}', [TodosController::class, 'complete']);
});
Route::group(['prefix' => 'v1'], function () {
    Route::post('login', [LoginContoller::class, 'login']);
});
