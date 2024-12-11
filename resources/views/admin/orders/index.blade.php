@extends('layouts.master')

@section('content')
<style>
    .order-table {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .order-table h2 {
        margin-bottom: 15px;
    }
    .order-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        background-color: #ffffff;
        margin-bottom: 10px;
    }
    .order-card select, .order-card button {
        margin-top: 10px;
    }
    /* Custom pagination styles for smaller buttons */
/* Custom pagination styles for smaller buttons */
.pagination-sm .page-link {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem; /* Smaller font size */
    line-height: 1.25;
    border-radius: 0.2rem; /* Smaller border radius */
}

.pagination-sm .page-item {
    margin: 0 0.1rem; /* Smaller margin */
}

.pagination-sm .page-item.disabled .page-link {
    cursor: not-allowed;
    background-color: #e9ecef; /* Disabled state color */
}


</style>

<div class="container-fluid">
    <h1 class="my-4 text-center">Order Management</h1>
    
    <!-- Pending Orders -->
    <div class="order-table">
        <h2>Pending Orders</h2>
        @if($pendingOrders->count())
            @foreach ($pendingOrders as $order)
                <div class="order-card">
                    <div><strong>Order #:</strong> {{ $order->id }}</div>
                    <div><strong>Recipient Name:</strong> {{ $order->recipient_name }}</div>
                    <div><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</div>
                    <div><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancellation_requested" {{ $order->status === 'cancellation_requested' ? 'selected' : '' }}>Cancellation Requested</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                    </form>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
    {{ $deliveredOrders->links('vendor.pagination.custom') }}
</div>

        @else
            <p>No pending orders.</p>
        @endif
    </div>
    
    <!-- Cancellation Requested Orders -->
    <div class="order-table">
        <h2>Cancellation Requested Orders</h2>
        @if($cancellationRequestedOrders->count())
            @foreach ($cancellationRequestedOrders as $order)
                <div class="order-card">
                    <div><strong>Order #:</strong> {{ $order->id }}</div>
                    <div><strong>Recipient Name:</strong> {{ $order->recipient_name }}</div>
                    <div><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</div>
                    <div><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
                    
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancellation_requested" {{ $order->status === 'cancellation_requested' ? 'selected' : '' }}>Cancellation Requested</option>
                            <option value="accepted" {{ $order->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                    </form>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
    {{ $deliveredOrders->links('vendor.pagination.custom') }}
</div>


        @else
            <p>No cancellation requested orders.</p>
        @endif
    </div>

    <!-- Delivered Orders -->
    <div class="order-table">
        <h2>Delivered Orders</h2>
        @if($deliveredOrders->count())
            @foreach ($deliveredOrders as $order)
                <div class="order-card">
                    <div><strong>Order #:</strong> {{ $order->id }}</div>
                    <div><strong>Recipient Name:</strong> {{ $order->recipient_name }}</div>
                    <div><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</div>
                    <div><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
                    
                    <!-- You may add a form for status updates if needed -->
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
    {{ $deliveredOrders->links('vendor.pagination.custom') }}
</div>

        @else
            <p>No delivered orders.</p>
        @endif
    </div>
</div>
@endsection