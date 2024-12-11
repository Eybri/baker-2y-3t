<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    { 
        $products = Product::paginate(8); 

        if ($request->ajax()) {
            return response()->json([
                'products' => $products->items(),
                'total' => $products->total(),
                'perPage' => $products->perPage()
            ]);
        }

        return view('products.index', ['products' => $products]);
    }

    public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $productId = $request->input('product_id');
    $userId = Auth::id();

    $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

    if ($cartItem) {
        $cartItem->increment('quantity');
    } else {
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => 1,
        ]);
    }

    return response()->json(['message' => 'Product added to cart successfully!']);
}

}

