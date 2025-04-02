<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

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

// Public API endpoints (no authentication required)
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/items', [ItemController::class, 'index']);

// Protected API endpoints (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users', UserController::class)->except(['index']);
    Route::resource('categories', CategoryController::class)->except(['index']);
    Route::resource('items', ItemController::class)->except(['index']);

    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});
