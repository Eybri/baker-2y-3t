@extends('layouts.masteruser')

@section('content')
<style>
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #f8f9fa;
    }
        
    .card {
        border: none;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-title {
        color: #e91e63;
        font-weight: bold;
    }

    .card-text {
        color: #555;
    }

    .btn-primary {
        background-color: #e91e63;
        border-color: #e91e63;
    }

    .btn-primary:hover {
        background-color: #ff80ab;
        border-color: #ff80ab;
    }
</style>
<div class="container-fluid">
    <h1 class="my-4"> ˚ · .✧ Crust Crumb Products ✧ ˚ · .</h1>
    <p>happy shopping !!! +*:ꔫ:*﹤</p>
    <div id="pagination-container" class="mt-4">
        <!-- Pagination controls will be dynamically loaded here -->
    </div><br>
    <div class="row" id="productContainer">
        <!-- Products will be dynamically loaded here -->
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

@endsection
