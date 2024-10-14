<?php

use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Route untuk login
Route::post('login', [AuthController::class, 'login']);

// Route untuk logout, dilindungi oleh middleware sanctum
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route untuk mendapatkan data user yang sedang login
Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');

// Route::apiResource('products', ProductController::class);