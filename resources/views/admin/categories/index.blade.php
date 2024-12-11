@extends('layouts.master')
@section('content')
<body>
    <div class="container mt-5">
        <div class="container-fluid header-container">
            <div class="card header-card">
                <h1 class="card-title text-center">˚ · .✧ Category Management ✧ ˚ · .</h1>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table id="categoriesTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="categoryBody">
                    <!-- Table rows will be dynamically populated by DataTables -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Add/Edit Category -->
    <div class="modal fade" id="categoriesModal" tabindex="-1" aria-labelledby="categoriesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="categoriesForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoriesModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="categoriesId" name="categoriesId" />
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="categorySubmit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="categoriesUpdates" class="btn btn-primary" style="display:none;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection
