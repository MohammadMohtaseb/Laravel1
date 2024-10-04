<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// مسارات المصادقة
Route::post(uri: '/signup', action: [AuthController::class, 'signup']);
Route::post(uri: '/login', action: [AuthController::class, 'login']);

// حماية المسارات التالية باستخدام المصادقة
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', action: [ProductController::class, 'create']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);

    Route::post(uri: '/logout', action: [AuthController::class, 'logout']);
});
