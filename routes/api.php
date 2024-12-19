<?php

dd('api.php Loaded');

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;

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
    Route::get('/cart', [CartController::class, 'index']); // Get all items in the user's cart
    Route::post('/cart', [CartController::class, 'store']); // Add item to cart
    Route::delete('/cart/{id}', [CartController::class, 'destroy']); // Remove item from cart

    // Order routes
    Route::post('/orders', [OrderController::class, 'placeOrder']); // Place an order
    Route::get('/orders/history', [OrderController::class, 'getOrderHistory']); // Get order history
});
