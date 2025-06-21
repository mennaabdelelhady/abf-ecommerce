<?php

use App\Http\Controllers\Api\QuoteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers;
use App\Models\User;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Test Route
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::post('/forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLink']);
Route::post('/verify-code', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'verifyCode']);
Route::post('/reset-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'resetPassword']);


//products
Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'index']);
Route::get('/products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);

//Quotes
Route::post('/quotes', [QuoteController::class, 'store']);