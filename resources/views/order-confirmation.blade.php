@extends('layouts.app')

@section('content')
<style>
    .order-confirmation-container {
        padding-top:100px;
        display: flex;
        align-items: center;
        justify-content: center;
      
    }

    .order-confirmation-card {
        background-color: #ffe6e6; /* White background for the card */
        padding: 2rem; /* 2rem padding */
        border-radius: 0.5rem; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        max-width: 32rem; /* Max width of the card */
        width: 100%;
        text-align: center; /* Center text */
    }

    .order-confirmation-title {
        font-size: 1.875rem; /* 3xl text size */
        font-weight: 700; /* Bold text */
        color: #ec4899; /* Pink color */
        margin-bottom: 1rem; /* Margin bottom */
    }

    .order-confirmation-text {
        color: #191a1c; /* Gray text color */
        margin-bottom: 1.5rem; /* Margin bottom */
    }

    .order-confirmation-link {
        display: inline-block;
        color: #ffffff; /* White text */
        background-color:  #9AC8CD; /* Blue background */
        font-weight: 600; /* Semi-bold text */
        text-decoration: none; /* Remove underline */
        padding: 0.75rem 1.5rem; /* Padding */
        border-radius: 9999px; /* Fully rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transition: background-color 0.3s, box-shadow 0.3s; /* Smooth transition */
    }

    .order-confirmation-link:hover {
        color: #2563eb; /* Darker blue on hover */
    }
</style>
<div class="order-confirmation-container">
    <div class="order-confirmation-card flex justify-evenly">
        <h1 class="order-confirmation-title">Order Confirmation</h1>
        <p class="order-confirmation-text">Your order has been successfully placed. Thank you for shopping with us!</p>
        <a href="{{ route('dashboard') }}" class="order-confirmation-link">
            Return to Home
        </a>
        <a href="{{ route('dashboard') }}" class="order-confirmation-link">
            View status
        </a>
    </div>
</div>
@endsection

