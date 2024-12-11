<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Get the authenticated user's ID
        $orders = Order::with(['items.product'])
            ->where('user_id', $userId)
            ->whereIn('status', ['pending', 'cancellation_requested'])
            ->get(); // Retrieve pending orders for the authenticated user with product details

        return view('orderhistory.index', compact('orders')); // Return the view with the orders
    }

    public function requestCancellation(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')->withErrors('Unauthorized action.');
        }

        if ($order->status === 'pending') {
            $order->status = 'cancellation_requested';
            $order->save();

            return redirect()->route('orders.index')->with('success', 'Cancellation request has been submitted.');
        }

        return redirect()->route('orders.index')->withErrors('Unable to request cancellation for this order.');
    }
}
