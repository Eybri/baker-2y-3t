
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
<style>
    .custom-sidebar {
    background-color: #9AC8CD !important;
    font-family: "Roboto", sans-serif;
    font-weight: 300;
    color: rgb(41, 39, 36);
    font-size:19px;
    
}
.header-card {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .header-card h1 {
            margin-bottom: 20px;
        }

        .header-container {
            padding: 0 15px;
        }
        .pagination-sm .page-link {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    line-height: 1.25;
}

.pagination-sm .page-item {
    margin: 0 0.2rem;
}

.pagination-sm .page-item.disabled .page-link {
    cursor: not-allowed;
}

</style>
</head>
<body style="background-color:  #fae4e8;">
    <div class="min-vh-100 d-flex flex-column">
        <!-- Navigation -->
        <header class="shadow-sm bg-dark">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="h4 font-weight-bold">
                        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    </div>
                    <div>
                        <a href="{{ route('logout') }}" class="ml-4 text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Sidebar and Content -->
<div class="d-flex flex-1">
  <!-- Sidebar -->
<div class="color">
<aside class="bg-light shadow-sm custom-sidebar" style="width: 250px; height: 300vh;  border-right: 1px solid #dee2e6;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary custom-sidebar">
        <ul class="list-unstyled">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class=" nav-link">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class=" nav-link">
                    Manage Categories
                </a>
            </li> 
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class=" nav-link ">
                    Manage Products
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Manage Employees
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('admin.position.index') }}">Employee Position</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('admin.employee.index') }}">Employees</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class=" nav-link ">
                    Manage Orders
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class=" nav-link ">
                    Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.inventory') }}" class=" nav-link ">
                    Manage Inventory
                </a>
            </li>
        </ul>
    </nav>
</aside>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function () {
    var links = document.querySelectorAll('aside nav ul li a');

    links.forEach(function(link) {
        link.addEventListener('mouseover', function() {
            link.style.backgroundColor = '#f0f0f0'; // Light background color on hover
            link.style.color = '#'; // Change text color on hover
        });

        link.addEventListener('mouseout', function() {
            link.style.backgroundColor = ''; // Reset background color
            link.style.color = ''; // Reset text color
        });
    });
});
</script>


            <!-- Main Content -->
            <main class="container-fluid p-4">
                @yield('content')
            </main>
            
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JavaScript -->
  
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
    @yield('scripts')


</html>
