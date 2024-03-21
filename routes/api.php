<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// CUSTOMERS
Route::get('/customers', [CustomerController::class, 'index']);

Route::post("/customers", [CustomerController::class, 'create']);

Route::get('/users', [UserController::class,'index']);

