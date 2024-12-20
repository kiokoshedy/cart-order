<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;

Route::post('/register', function (Request $request) {
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ]);

    // Save user to database
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash the password
    ]);

    // Generate an API token
    $token = $user->createToken('API Token')->plainTextToken;

    // Return response
    return response()->json(['token' => $token, 'user' => $user]);
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('API Token')->plainTextToken;

    return response()->json(['token' => $token]);
});

// Cart routes
Route::middleware('auth:sanctum')->group(function () {
    // Product routes
    Route::get('/products', [ProductController::class, 'index']); // List products
    Route::post('/products', [ProductController::class, 'store']); // Add a product
    Route::get('/products/{id}', [ProductController::class, 'show']); // Fetch single product

    // Cart routes
    Route::get('/cart', [CartController::class, 'index']); // View cart
    Route::post('/cart', [CartController::class, 'store']); // Add to cart
    Route::delete('/cart/{id}', [CartController::class, 'destroy']); // Remove from cart

    // Order routes
    Route::post('/orders', [OrderController::class, 'placeOrder']); // Place an order
    Route::get('/orders', [OrderController::class, 'index']); // View orders
});
