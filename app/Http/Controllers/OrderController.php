<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show the checkout view
    public function checkoutView()
    {
        return view('checkout');
    }

    // Handle the checkout process
    public function placeOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'address' => 'required|string|max:255',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,completed',
        ]);
    
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        // Create the order
        $order = new Order();
        $order->user_id = auth()->id();
        $order->recipient_name = $request->recipient_name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->postal_code = $request->postal_code;
        $order->country = $request->country;
        $order->status = 'pending'; // Initial status
        $order->total_price = $this->calculateTotalPrice($cart);
        $order->save();

        // Attach products to the order
        foreach ($cart as $productId => $quantity) {
            $order->products()->attach($productId, ['quantity' => $quantity]);
        }

        // Clear the cart
        session()->forget('cart');

        return redirect()->route('orders.my')->with('success', 'Order placed successfully!');
    }

    // Handle checkout via API (example for API use)
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        $order = Order::create([
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'user_id' => auth()->id(),
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order successfully placed!',
            'order_id' => $order->id
        ]);
    }

    // Show order confirmation view
    public function orderConfirmation($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('order-confirmation', compact('order'));
    }

    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders')); // Make sure you have an orders.index view
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $order = new Order([
            'product_name' => $request->get('product_name'),
            'quantity' => $request->get('quantity'),
            'price' => $request->get('price'),
        ]);

        $order->save();

        return redirect('/orders')->with('success', 'Order has been added');
    }
    public function myOrders()
    {
        $orders = auth()->user()->orders()->with('products')->get();
        return view('my_orders', compact('orders'));
    }

    private function calculateTotalPrice($cart)
    {
        $total = 0;
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }
        return $total;
    }
}
