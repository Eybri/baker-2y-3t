{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* Customize any additional styles here */
    </style>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom scripts -->
    @yield('scripts') <!-- Include custom scripts if necessary -->
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Bakery Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <!-- Dashboard Links -->
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        @endauth
                    </ul>
                    <!-- Authentication Links -->
                    <ul class="navbar-nav">
                        @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        @yield('content')

    </div>
</body>
</html> --}} 

{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffe6e6; /* Light pink */
        }

        .navbar-brand {
            font-weight: bold;
            color: #e91e63; /* Dark pink */
        }

        .navbar-nav .nav-link {
            color: #333; /* Dark grey */
        }

        .navbar-nav .nav-link:hover {
            color: #e91e63; /* Dark pink on hover */
        }

        .jumbotron {
            background-color: #fff3f5; /* Light peach */
            padding: 3rem;
            margin-bottom: 2rem;
        }

        .jumbotron h1 {
            color: #e91e63; /* Dark pink */
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
            color: #e91e63; /* Dark pink */
            font-weight: bold;
        }

        .card-text {
            color: #555; /* Dark grey */
        }

        .btn-primary {
            background-color: #e91e63; /* Dark pink */
            border-color: #e91e63; /* Dark pink */
        }

        .btn-primary:hover {
            background-color: #ff80ab; /* Light pink on hover */
            border-color: #ff80ab; /* Light pink on hover */
        }
    </style>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom scripts -->
    @yield('scripts') <!-- Include custom scripts if necessary -->
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Bakery Shop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <!-- Dashboard Links -->
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        @endauth
                    </ul>
                    <!-- Authentication Links -->
                    <ul class="navbar-nav">
                        @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-4">Welcome to Our Cute Bakery Shop!</h1>
                <p class="lead">Explore our delightful range of freshly baked goods.</p>
            </div>
        </div>

        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-primary">View Details</button>
                            </div>
                            <small class="text-muted">${{ $product->price }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">


    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ffe6e6; /* Light pink */
        }

        .navbar-brand {
            font-weight: bold;
            color: #e91e63; /* Dark pink */
        }

        .navbar-nav .nav-link {
            color: #333; /* Dark grey */
        }

        .navbar-nav .nav-link:hover {
            color: #e91e63; /* Dark pink on hover */
        }

        .jumbotron {
            background-color: #fff3f5; /* Light peach */
            padding: 3rem;
            margin-bottom: 2rem;
        }

        .jumbotron h1 {
            color: #e91e63; /* Dark pink */
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
            color: #e91e63; /* Dark pink */
            font-weight: bold;
        }

        .card-text {
            color: #555; /* Dark grey */
        }

        .btn-primary {
            background-color: #e91e63; /* Dark pink */
            border-color: #e91e63; /* Dark pink */
        }

        .btn-primary:hover {
            background-color: #ff80ab; /* Light pink on hover */
            border-color: #ff80ab; /* Light pink on hover */
        }
    </style>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom scripts -->
    @yield('scripts') <!-- Include custom scripts if necessary -->
    <style>
        .navbar {
    height: 100px; /* Adjust height as needed */
    display: flex;
    align-items: center; /* Vertically centers the content */
}

 /* Apply font to navbar links */
 .navbar-nav .nav-link {
            font-family: 'Roboto', sans-serif; /* Apply the custom font */
            font-size: 20px; /* Adjust font size as needed */
            font-weight: 500; /* Adjust font weight as needed */
        }
      
.btn-pink {
background-color: #9AC8CD;
border: none;
color: white;
}

.btn-pink:hover {
    background-color: #63998d;
    color: white;
}
.cart-icon {
    font-size: 30px; 
}


</style>


    </style>
</head>
<body>
    <div class="container-fluid pl-2 pr-2 sticky-top">
        <!-- Navbar -->
         
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img width=150 height=auto src="{{ asset('images/logo.png') }}" alt="Bakery Shop Logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <!-- Dashboard Links -->
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orderhistory.index')}}">Order History</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link  text-danger">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endauth
                    </ul>
                   
                    
                    
                    <!-- Authentication Links -->
                    <ul class="navbar-nav">
                        @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                        @endguest
                        @auth
                        <!-- <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li> -->
                        @endauth
                    </ul>
                </div>
                <!-- cart eklabush -->
                <div class="d-flex justify-content-end my-4 shadow-none">
                    <a href="/cart" class="btn btn-pink cart-icon position-relative">
                    <i class="bi bi-bag-heart" ></i>
                        <span id="cart-count" class="badge badge-light position-absolute" style="top: -10px; right: -10px;">0</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Page Content -->
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="{{ asset('js/cart.js') }}"></script>
</html>
