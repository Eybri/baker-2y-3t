@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Your Orders</h1>
    <table class="table-auto w-full mb-6">
        <thead>
            <tr>
                <th class="px-4 py-2">Order ID</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td class="border px-4 py-2">{{ $order->id }}</td>
                <td class="border px-4 py-2">{{ $order->created_at }}</td>
                <td class="border px-4 py-2">{{ $order->total }}</td>
                <td class="border px-4 py-2">{{ $order->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
