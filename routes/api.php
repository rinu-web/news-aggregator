<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserPreferenceController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index']); // Fetch & search articles
    Route::get('/articles/{id}', [ArticleController::class, 'show']); // Fetch single article
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/preferences', [UserPreferenceController::class, 'updatePreferences']);
    Route::get('/preferences', [UserPreferenceController::class, 'getPreferences']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/personalized-news', [ArticleController::class, 'personalizedNews']);
});

