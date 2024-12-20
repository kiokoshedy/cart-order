<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public'); // Store image in 'storage/app/public/products'
        }

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function index()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->image_url = $product->image ? asset('storage/' . $product->image) : null; // Return full image URL
        }
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
}

