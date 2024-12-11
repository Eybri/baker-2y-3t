<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $pendingOrders = Order::with(['items.product'])
            ->where('status', 'pending')
            ->paginate(4); // Adjust the number of items per page

        $cancellationRequestedOrders = Order::with(['items.product'])
            ->where('status', 'cancellation_requested')
            ->paginate(4); // Adjust the number of items per page

        $deliveredOrders = Order::with(['items.product'])
            ->where('status', 'delivered')
            ->paginate(4); // Adjust the number of items per page

        return view('admin.orders.index', compact('pendingOrders', 'cancellationRequestedOrders', 'deliveredOrders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,delivered,cancellation_requested,accepted',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
