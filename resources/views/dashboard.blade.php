{{-- 

<!DOCTYPE html>
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
        /* Custom styles for the bakery shop */
        body {
            background-color: #ffe4e1; /* Light pink background */
            font-family: 'Nunito', sans-serif;
        }
        .navbar {
            background-color: #ffb6c1; /* Pink navbar */
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar-nav .nav-link {
            color: #d84315;
        }
        .navbar-nav .nav-link:hover {
            color: #bf360c;
        }
        .container {
            margin-top: 50px;
        }
        .header {
            text-align: center;
            padding: 50px;
            background-color: #ffb6c1; /* Pink header */
            border-radius: 15px;
        }
        .header h1 {
            font-size: 3em;
            color: #d84315;
        }
        .header p {
            font-size: 1.5em;
            color: #bf360c;
        }
        .featured-products {
            margin-top: 30px;
        }
        .featured-product {
            margin: 20px 0;
        }
        .featured-product img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }
        .featured-product h3 {
            color: #d84315;
        }
        .featured-product p {
            color: #bf360c;
        }
    </style>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom scripts -->
    @yield('scripts')
</head>
<body>
    <div class="container-fluid">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo.png') }}" alt="Bakery Shop Logo">
                   CrustCrumb
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
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

        <!-- Header -->
        <div class="header">
            <h1>Welcome to our Bakery Shop!!</h1>
            <p>delicious sweets and treats</p>
        </div>

        <!-- Featured Products -->
        <div class="featured-products">
            <h2 class="text-center">Featured Products</h2>
            <div class="row" id="products-container">
                <!-- JavaScript will add featured products here -->
            </div>
        </div>

        <!-- Page Content -->
        @yield('content')

    </div>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Sample featured products data
            const featuredProducts = [
                {
                    name: "Choco Kek",
                    image: "{{ asset('images/chocokek.jpg') }}",
                    description: "filled with chocolates that makes so fudgey"
                },
                {
                    name: "Cupkek",
                    image: "{{ asset('images/cupkek.jpg') }}",
                    description: "yummy cupcakes"
                },
                {
                    name: "Kookie Monster",
                    image: "{{ asset('images/kookie.jpg') }}",
                    description: "delicious kookie"
                }
            ];

            // Function to add featured products to the page
            function addFeaturedProducts(products) {
                const container = $("#products-container");
                products.forEach(product => {
                    const productHTML = `
                        <div class="col-md-4 featured-product">
                            <img src="${product.image}" alt="${product.name}">
                            <h3>${product.name}</h3>
                            <p>${product.description}</p>
                        </div>
                    `;
                    container.append(productHTML);
                });
            }

            // Add featured products to the page
            addFeaturedProducts(featuredProducts);
        });
    </script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap" rel="stylesheet">


    <!-- Styles -->
    <style>
        /* Custom styles for the bakery shop */
        body {
            background-color: #ffe4e1; /* Light pink background */
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #ffb6c1; /* Pink navbar */
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar-nav .nav-link {
            color: #d84315;
        }
        .navbar-nav .nav-link:hover {
            color: #bf360c;
        }
        .container {
            margin-top: 50px;
        }
        .header {
            text-align: center;
            padding: 50px;
            background-color: #ffb6c1; /* Pink header */
            border-radius: 15px;
        }
        .header h1 {
            font-size: 3em;
            color: #d84315;
        }
        .header p {
            font-size: 1.5em;
            color: #bf360c;
        }
        .featured-products {
            margin-top: 30px;
        }
        .featured-product {
            margin: 20px 0;
        }
        .featured-product img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }
        .featured-product h3 {
            color: #d84315;
        }
        .featured-product p {
            color: #bf360c;
        }
        .about-us {
            margin: 50px 0;
            padding: 30px;
            background-color: #ffcccb; /* Light pink background for about us section */
            border-radius: 15px;
            text-align: center;
        }
        .about-us h2 {
            color: black;
        }
        .about-us p {
            color: #bf360c;
            font-size: 1.2em;
        }
        footer {
            background-color: #ffb6c1; /* Pink footer */
            padding: 20px 0;
            text-align: center;
            color: #d84315;
            margin-top: 50px;
        }
    </style>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom scripts -->
    @yield('scripts')
</head>
<body>

    <div class="container-fluid p-5">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo.png') }}" alt="Bakery Shop Logo">
                   CrustCrumb
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
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

                    <input type="text" id="search" placeholder="Search products...">

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

        <!-- Header -->
        <div class="header">
            <h1>Welcome to our Bakery Shop!!</h1>
            <p>delicious sweets and treats</p>
        </div>

        <!-- Featured Products -->
        <div class="featured-products">
            <h2 class="text-center">Featured Products</h2>
            <div class="row" id="products-container">
                <!-- JavaScript will add featured products here -->
            </div>
        </div>

        <!-- About Us -->
        <div class="about-us">
            <h2>About Us</h2>
            <p>Welcome to CrustCrumb, your new favorite bakery shop!  CrustCrumb is the creation of our founder, Kiaveha. Our mission is to bring joy and sweetness into your life with our delicious and fun pastries.

                At CrustCrumb, we believe that every bite should be a delightful experience. Our bakery offers a wide variety of cute and delicious pastries that are perfect for any occasion. From our rich and fudgy Choco Kek to our adorable and yummy Cupkeks, and the irresistible Kookie Monsters, theres something for everyone to enjoy.
                
                Our founder, Kiaveha, has a passion for baking and a vision to create a space where people can enjoy their favorite treats in a warm and welcoming environment. Every pastry is made with love and the finest ingredients to ensure that each one is as delightful as the last.
                
                Whether youre looking for a sweet treat to brighten your day, a delicious gift for a loved one, or a centerpiece for your celebration, CrustCrumb has got you covered. Come visit us and discover why were the new go-to spot for delicious and fun pastries.</p>
        </div>

        <!-- Page Content -->
        @yield('content')

    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 CrustCrumb Bakery Shop. All rights reserved.</p>
    </footer>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#search').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route("search") }}',
                        data: {
                            query: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.label,
                                    value: item.value
                                };
                            }));
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                },
                select: function(event, ui) {
                    // Optionally handle item selection
                    console.log('Selected: ' + ui.item.value);
                }
            });


            // Sample featured products data
            const featuredProducts = [
                {
                    name: "Choco Kek",
                    image: "{{ asset('images/chocokek.jpg') }}",
                    description: "filled with chocolates that makes so fudgey"
                },
                {
                    name: "Cupkek",
                    image: "{{ asset('images/cupkek.jpg') }}",
                    description: "yummy cupcakes"
                },
                {
                    name: "Kookie Monster",
                    image: "{{ asset('images/kookie.jpg') }}",
                    description: "delicious kookie"
                }
                ,
                {
                    name: "Kookie Monster",
                    image: "{{ asset('images/kookie.jpg') }}",
                    description: "delicious kookie"
                }
            ];

            // Function to add featured products to the page
            function addFeaturedProducts(products) {
                const container = $("#products-container");
                products.forEach(product => {
                    const productHTML = `
                        <div class="col-md-3 featured-product">
                            <img src="${product.image}" alt="${product.name}">
                            <h3>${product.name}</h3>
                            <p>${product.description}</p>
                        </div>
                    `;
                    container.append(productHTML);
                });
            }

            // Add featured products to the page
            addFeaturedProducts(featuredProducts);
        });
    </script>
</body>
</html>
