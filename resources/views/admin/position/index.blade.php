@extends('layouts.master')
@section('content')
<body>
    <div class="container mt-5">
        <div class="container-fluid header-container">
            <div class="card header-card">
                <h1 class="card-title text-center">˚ · .✧ Employee Position Management ✧ ˚ · .</h1>
               
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table id="positionsTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="positionBody">
                    <!-- Table rows will be dynamically populated by DataTables -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Add/Edit position -->
    <div class="modal fade" id="positionsModal" tabindex="-1" aria-labelledby="positionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="positionsForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="positionsModalLabel">Add position</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="positionId" name="positionId" />
                        <div class="form-group">
                            <label for="position_name">Position Name</label>
                            <input type="text" id="position_name" name="position_name" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="number" id="salary" name="salary" class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="positionSubmit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="positionsUpdates" class="btn btn-primary" style="display:none;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection
