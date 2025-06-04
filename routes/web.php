<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DigestController;



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Home page
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/home', [ArticleController::class, 'index'])->name('home.alias');

// AI Features
Route::post('/daily-digest/generate', [DigestController::class, 'generateDailyDigest'])->name('digest.generate')->middleware('auth');
Route::get('/articles/{article}/summarize', [ArticleController::class, 'showSummary'])->name('articles.summarize.view')->middleware('auth'); // To show a summary

Route::middleware('auth')->group(function () {
    Route::post('/articles/{article}/save', [ArticleController::class, 'saveForLater'])->name('articles.save');
    Route::delete('/articles/{article}/unsave', [ArticleController::class, 'unsaveArticle'])->name('articles.unsave');
    Route::get('/saved-articles', [ArticleController::class, 'listSaved'])->name('articles.saved');
});


Route::get('/categories', function() {
    return \App\Models\Category::all(); 
})->name('categories.index');