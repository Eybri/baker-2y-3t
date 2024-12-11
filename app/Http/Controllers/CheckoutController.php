<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function place(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        try {
            // Begin transaction
            \DB::beginTransaction();

            // Create order
            $order = new Order();
            $order->user_id = $user->id;
            $order->recipient_name = $request->recipient_name;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->city = $request->city;
            $order->postal_code = $request->postal_code;
            $order->country = $request->country;
            $order->total_price = 0; // Initialize to 0, will update later
            $order->status = 'pending';
            $order->save();

            // Process selected cart items
            $cartItems = Cart::where('user_id', $user->id)->where('is_selected', true)->get();
            $totalPrice = 0;

            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem->product_id);

                if (!$product) {
                    continue; 
                }

                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cartItem->product_id;
                $orderItem->quantity = $cartItem->quantity;
                $orderItem->price = $product->price; // Use sale_price here
                $orderItem->save();

                $totalPrice += $cartItem->quantity * $product->price;
            }

            // Update order total price
            $order->total_price = $totalPrice;
            $order->save();

            // Clear selected items from cart
            Cart::where('user_id', $user->id)->where('is_selected', true)->delete();

            // Commit transaction
            \DB::commit();

               return response()->json([
            'redirect_url' => route('order.confirmation', ['order' => $order->id])
        ]);
        } catch (\Exception $e) {
            // Rollback transaction
            \DB::rollBack();

            return response()->json(['message' => 'Failed to place order. Please try again.'], 500);
        }
    }
}
