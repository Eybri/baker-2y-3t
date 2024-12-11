@extends('layouts.masteruser')

@section('content')
<style>
    .order-history {
        background-color: #f8f9fa;
        padding: 20px;
    }
    .order-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 20px;
        padding: 20px;
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: #ffffff;
    }
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .order-header {
        color: #e91e63;
        font-weight: bold;
        font-size: 1.3em;
        margin-bottom: 15px;
    }
    .order-details {
        color: #333;
        line-height: 1.6;
    }
    .order-status {
        color: #007bff;
        font-weight: bold;
        margin-top: 10px;
    }
    .order-details p {
        margin: 5px 0;
    }
    .order-details ul {
        margin: 10px 0;
        padding-left: 20px;
    }
    .order-details li {
        margin-bottom: 5px;
    }
    .order-details .row {
        margin-bottom: 15px;
    }
    .order-details .col-md-6 {
        padding: 0 15px;
    }
    .cancel-button {
        margin-top: 10px;
        background-color: #dc3545;
        color: #ffffff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
    }
    .cancel-button:hover {
        background-color: #c82333;
    }
</style>
<div class="container-fluid order-history">
    <h1 class="my-4 text-center">˚ · .✧ Your order status ✧ ˚ · .</h1>
    @forelse ($orders as $order)
        <div class="order-card">
            <div class="order-header">
                Order #{{ $order->id }}
            </div>
            <div class="order-details">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Recipient Name:</strong> {{ $order->recipient_name }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                        <p><strong>Date Placed:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>City:</strong> {{ $order->city }}</p>
                        <p><strong>Postal Code:</strong> {{ $order->postal_code }}</p>
                        <p><strong>Country:</strong> {{ $order->country }}</p>
                        <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
                        <p class="order-status"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                    </div>
                </div>
                <p><strong>Products:</strong></p>
                <ul>
                    @foreach ($order->items as $item)
                        <li>{{ $item->product->name }} (Quantity: {{ $item->quantity }}) - ${{ number_format($item->price, 2) }}</li>
                    @endforeach
                </ul>
                @if($order->status === 'pending')
                    <form action="{{ route('order.cancel', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="cancel-button">Request Cancellation</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p class="text-center">No pending orders found.</p>
    @endforelse
</div>
@endsection
