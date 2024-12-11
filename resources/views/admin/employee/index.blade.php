@extends('layouts.master')

@section('content')

<div class="container mt-5">
    <div class="container-fluid header-container">
            <div class="card header-card">
                <h1 class="card-title text-center">˚ · .✧ Employee Management ✧ ˚ · .</h1>
     
            </div>
        </div>
    <div class="table-responsive mt-3">
        <table id="employeesTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="no-export">Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                   
                </tr>
            </thead>
            <tbody id="employeeBody">
                <!-- Table rows will be dynamically populated by DataTables -->
            </tbody>
        </table>
    </div>
</div>

<!-- Employee Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="employeeForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeModalLabel">Add/Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="employeeId" name="employeeId">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Assigned Work</label>
                        <select id="position" name="position_id" class="form-select" required></select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <div id="display" class="mt-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="employeeSubmit" class="btn btn-primary">Save</button>
                    <button type="button" id="employeeUpdate" class="btn btn-primary" style="display:none;">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
