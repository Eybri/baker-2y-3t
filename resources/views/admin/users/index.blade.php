@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<body>
    <div class="container mt-5">
        <div class="container-fluid header-container">
            <div class="card header-card">
                <h1 class="card-title text-center">˚ · .✧ User Management ✧ ˚ · .</h1>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table id="usersTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userBody">
                    <!-- Table rows will be dynamically populated by DataTables -->
                </tbody>
            </table>
        </div>
    </div>
</body>
@endsection
