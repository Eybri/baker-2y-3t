@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrustCrumb Bakery - Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        
        /* Your custom styles here */
        .custom-alert {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .custom-alert-content {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            text-align: center;
            position: relative;
        }

        .custom-alert-content span {
            display: block;
            margin-bottom: 20px;
            color: #ff4081; /* Pink color for the message */
            font-weight: bold;
        }

        .custom-alert-close {
            background: #ff4081; /* Pink color for the close button */
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .custom-alert-close:hover {
            background: #e33371; /* Darker pink color on hover */
        }
    </style>
</head>
<body class="bg-pink-50">
    <div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-pink-600 mb-6">Shopping Cart</h1>
        
        <table class="table-auto w-full mb-6 border-collapse border border-pink-200">
            <thead class="bg-pink-100 ">
                <tr>
                    <th class="border px-4 py-2 flex items-center justify-evenly"> Check all <input type="checkbox" id="select-all" class="form-checkbox text-pink-600" /></th>
                    <th class="border px-4 py-2 text-pink-600">Product</th>
                    <!-- <th class="border px-4 py-2 text-pink-600">Image</th> -->
                    <!-- <th class="border px-4 py-2 text-pink-600">Quantity</th> -->
                    <!-- <th class="border px-4 py-2 text-pink-600">Price</th> -->
                    <th class="border px-4 py-2 text-pink-600">Total</th>
                    <th class="border px-4 py-2 text-pink-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr class="border-b border-pink-200">
                    <td class="border px-4 py-2 items-center justify-evenly">
                        <input type="checkbox" class="item-checkbox form-checkbox text-pink-600" data-id="{{ $item->product_id }}" data-price="{{ $item->product->price }}" data-quantity="{{ $item->quantity }}" {{ $item->is_selected ? 'checked' : '' }}>
                    </td>
                    <td class="border px-4 py-2 flex items-center justify-center">{{ $item->product->name }}</td>
                    <td class="border px-4 py-2 flex items-center justify-center">
                        @php
                            $images = explode(',', $item->product->image);
                            $firstImage = $images[0];
                        @endphp
                        <img src="{{ asset($firstImage) }}" alt="Product Image" width=100 class="w-28 h-28 object-cover mb-2">
                    </td>
                    <td class="border px-4 py-2  flex items-center justify-evenly">
                        <button class="decrease-quantity-btn bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" data-id="{{ $item->product_id }}">-</button>
                        {{ $item->quantity }}
                        <button class="increase-quantity-btn bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded" data-id="{{ $item->product_id }}">+</button>
                    </td>
                    <td class="border px-4 py-2 flex items-center justify-evenly space-x-2">
                        <span class="font-bold text-gray-800" style="font-size:20px;">Price:</span>
                        <span class="text-gray-600">${{ $item->product->price }} <br>(per piece)</span>
                    </td>
                    <td class="border px-4 py-2 ">${{ $item->quantity * $item->product->price }}.00</td>
                    <td class="border px-4 py-2  ">
                        <button class="remove-from-cart-btn bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" data-id="{{ $item->product_id }}">Remove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mb-6">
            <span class="text-xl font-bold text-pink-600">Total Amount: $<span id="total-amount">0.00</span></span>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('checkout.view') }}" id="checkout-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Checkout
            </a>
        </div>
    </div>

    <div id="custom-alert" class="custom-alert" style="display: none;">
        <div class="custom-alert-content">
            <span id="custom-alert-message"></span>
            <button id="custom-alert-close" class="custom-alert-close">Close</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="{{ asset('js/cart.js') }}"></script> -->
</body>
</html>
@endsection
