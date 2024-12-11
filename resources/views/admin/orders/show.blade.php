@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Order Details</h1>
    <p><strong>ID:</strong> {{ $order->id }}</p>
    <p><strong>User:</strong> {{ $order->user->name }}</p>
    <p><strong>Product:</strong> {{ $order->product->name }}</p>
    <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processed" {{ $order->status == 'processed' ? 'selected' : '' }}>Processed</option>
                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
