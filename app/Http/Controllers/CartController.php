<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function selectItems(Request $request)
{
    $productIds = $request->input('product_ids');
    $userId = Auth::id();

    \Log::info('Selecting items for user ' . $userId, ['product_ids' => $productIds]);

    if (empty($productIds)) {
        return response()->json(['message' => 'No items selected'], 400);
    }

    $affectedRows = Cart::where('user_id', $userId)
        ->whereIn('product_id', $productIds)
        ->update(['is_selected' => true]);

    \Log::info('Rows updated (select): ' . $affectedRows);

    return response()->json(['message' => 'Items selected successfully']);
}

public function deselectItems(Request $request)
{
    $productIds = $request->input('product_ids');
    $userId = Auth::id();

    \Log::info('Deselecting items for user ' . $userId, ['product_ids' => $productIds]);

    if (empty($productIds)) {
        return response()->json(['message' => 'No items deselected'], 400);
    }

    $affectedRows = Cart::where('user_id', $userId)
        ->whereIn('product_id', $productIds)
        ->update(['is_selected' => false]);

    \Log::info('Rows updated (deselect): ' . $affectedRows);

    return response()->json(['message' => 'Items deselected successfully']);
}



    public function cartCount()
    {
        $userId = Auth::id();
        $cartCount = Cart::where('user_id', $userId)->count();

        return response()->json(['count' => $cartCount]);
    }

    public function viewCart()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)
                    ->with('product') // Load the product relationship
                    ->get();

        return view('cart', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = Auth::id();
    
        Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();
    
        return response()->json(['message' => 'Product removed from cart successfully']);
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

    public function increaseQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        }

        return response()->json(['message' => 'Product quantity increased successfully']);
    }

    public function decreaseQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = Auth::id();

        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
            }
        }

        return response()->json(['message' => 'Product quantity decreased successfully']);
    }
}
