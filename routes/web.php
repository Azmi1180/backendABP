<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Assuming you still use this for login/register logic
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DigestController;
use App\Http\Controllers\PageController; // For static pages or home

// Basic Laravel Auth Routes (if you installed Breeze/Jetstream or make them manually)
// For this example, let's assume you have simple login/register views and AuthController handles POST
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// Home page (News Feed)
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/home', [ArticleController::class, 'index'])->name('home.alias'); // Alias if needed

// AI Features
Route::post('/daily-digest/generate', [DigestController::class, 'generateDailyDigest'])->name('digest.generate')->middleware('auth');
Route::get('/articles/{article}/summarize', [ArticleController::class, 'showSummary'])->name('articles.summarize.view')->middleware('auth'); // To show a summary

// Saved Articles (Authenticated)
Route::middleware('auth')->group(function () {
    Route::post('/articles/{article}/save', [ArticleController::class, 'saveForLater'])->name('articles.save');
    Route::delete('/articles/{article}/unsave', [ArticleController::class, 'unsaveArticle'])->name('articles.unsave');
    Route::get('/saved-articles', [ArticleController::class, 'listSaved'])->name('articles.saved');
});

// Categories (example)
Route::get('/categories', function() {
    return \App\Models\Category::all(); // For AJAX if you still need it, or pass to views
})->name('categories.index');