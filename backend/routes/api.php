<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware(['throttle:api'])->group(function () {
    Route::post('register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);

    Route::apiResource('categories', \App\Http\Controllers\Api\V1\CategoryController::class)->only(['index','show']);
    Route::apiResource('products', \App\Http\Controllers\Api\V1\ProductController::class)->only(['index','show']);
    
    Route::apiResource('comments', \App\Http\Controllers\Api\V1\CommentController::class)->only(['index']);
});

Route::prefix('v1')->middleware(['throttle:api', 'auth:sanctum'])->group(function () {
    
    Route::apiResource('products', \App\Http\Controllers\Api\V1\ProductController::class)->only(['store', 'destroy','update']);
    Route::apiResource('categories', \App\Http\Controllers\Api\V1\CategoryController::class)->only(['store', 'destroy','update']);
    Route::apiResource('comments', \App\Http\Controllers\Api\V1\CommentController::class)->only(['store', 'destroy', 'update']);

    Route::apiResource('purchases', \App\Http\Controllers\Api\V1\PurchaseController::class)->only(['store', 'index', 'update', 'destroy', 'show']);
    Route::get('purchases/all', [\App\Http\Controllers\Api\V1\PurchaseController::class, 'all']); //Need allow only for admin

    Route::apiResource('purchase_items', \App\Http\Controllers\Api\V1\PurchaseItemController::class)->only(['update','destroy']);
    
    Route::get('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);
});

