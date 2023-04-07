<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth')->group(function () {
    // Get all categories
    Route::get('/categories', [CategoryController::class, 'index']);
});
// Get all categories
Route::get('/categories', [CategoryController::class, 'index']);

// Get a specific category
Route::get('/categories/{id}', [CategoryController::class, 'show']);

// Create a new category
Route::post('/categories', [CategoryController::class, 'store']);

// Update a category
Route::put('/categories/{id}', [CategoryController::class, 'update']);

// Soft-delete a category
Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);



// Get all blogs
Route::get('/blogs', [BlogController::class, 'index']);

// Get a specific blog
Route::get('/blogs/{id}', [BlogController::class, 'show']);

// Create a new blog
Route::post('/blogs', [BlogController::class, 'store']);

// Update a blog
Route::put('/blogs/{id}', [BlogController::class, 'update']);

// Soft-delete a blog
Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);
