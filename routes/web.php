<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DigestController;
// use App\Http\Controllers\CategoryController; // We'll create this too

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to News Aggregator API']);
});

// --- Authentication ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth');


// --- News Articles (Public) ---
Route::get('/articles', [ArticleController::class, 'index']); // News Feed Display, Filtering, Search
Route::get('/articles/{article}', [ArticleController::class, 'show']); // Single article view


// --- AI Features (Public, but could be authenticated) ---
Route::get('/articles/{article}/summarize', [ArticleController::class, 'summarize']); // Article Summarization
Route::get('/daily-digest', [DigestController::class, 'generateDailyDigest']); // AI Daily Digest


// --- User Specific Features (Authenticated) ---
Route::middleware('auth')->group(function () {
    Route::post('/articles/{article}/save', [ArticleController::class, 'saveForLater']);
    Route::delete('/articles/{article}/unsave', [ArticleController::class, 'unsaveArticle']);
    Route::get('/saved-articles', [ArticleController::class, 'listSaved']);
});

// --- Categories (Optional - for listing categories) ---
Route::get('/categories', function() {
    return response()->json(\App\Models\Category::all());
});