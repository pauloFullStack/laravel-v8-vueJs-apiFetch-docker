<?php

use App\Http\Controllers\ArticleController;
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


// List articles
Route::get('articles', [ArticleController::class, 'index']);

// List single article
Route::get('article/{id}', [ArticleController::class, 'show']);

// Create new article
Route::post('article', [ArticleController::class, 'store']);

// Update article
Route::put('article', [ArticleController::class, 'store']);

// Delete article
Route::delete('article/{id}', [ArticleController::class, 'destroy']);
