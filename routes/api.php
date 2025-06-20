<?php

use App\Http\Controllers\Api\QuoteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers;
use App\Models\User;

// Public Routes
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json([
        'message' => 'User registered successfully',
        'token' => $user->createToken('auth_token')->plainTextToken
    ], 201);
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    return response()->json([
        'token' => $user->createToken('auth_token')->plainTextToken
    ]);
});

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