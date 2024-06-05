<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//AUTHENTICATION
Route::get('/401', [AuthController::class, 'unauthorized'])->name("login");
Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware('api')->group(function () {
    Route::fallback(function () {
        return response()->json([
            'message' => 'Rota não encontrada'
        ], 404);
    });
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post("/auth/validate",[AuthController::class, 'validate']);
    Route::post("/auth/logout",[AuthController::class, 'logout']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post("/customers", [CustomerController::class, 'create']);
    Route::put("/customers/{id}", [CustomerController::class, 'update']);
    Route::delete("/customers/{id}", [CustomerController::class, 'delete']);
    Route::get('/users', [UserController::class, 'index']);

    Route::get('/persons', [PersonController::class, 'index']);
    Route::post('/persons', [PersonController::class, 'create']);
});






// CUSTOMERS
