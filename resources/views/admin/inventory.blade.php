@extends('layouts.master')
@section('content')
<body>
    <div class="container mt-5">
            <div class="container-fluid header-container">
                <div class="card header-card">
                    <h1 class="card-title text-center">˚ · .✧ Inventory Management ✧ ˚ · .</h1>
                   
                </div>
            </div>
            <div class="table-responsive mt-3">
            <table id="inventoriesTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Stocks</th>
                        <th>Supplier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="inventoryBody">
                    <!-- Table rows will be dynamically populated by DataTables -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Add/Edit Inventory -->
    <div class="modal fade" id="inventoryModal" tabindex="-1" aria-labelledby="inventoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="inventoryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="inventoryModalLabel">Add Inventory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="inventoryId" name="inventoryId" />
                        <div class="form-group">
                            <label for="item">Item</label>
                            <input type="text" id="item" name="item" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="supplier">Supplier</label>
                            <input type="text" id="supplier" name="supplier" class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="inventorySubmit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="inventoryUpdate" class="btn btn-primary" style="display:none;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection
