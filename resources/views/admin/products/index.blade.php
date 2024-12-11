@extends('layouts.master')
@section('content')

<body>
    <div class="container mt-5">
        <div class="container-fluid header-container">
            <div class="card header-card">
                <h1 class="card-title text-center">˚ · .✧ Products Management ✧ ˚ · .</h1>
           
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table id="productsTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="no-export">Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Cost Price</th>
                    </tr>
                </thead>
                <tbody id="productBody">
                    <!-- Table rows will be dynamically populated by DataTables -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Add/Edit Product -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="productForm" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="productId" name="productId" />
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category_id" class="form-control" required>
                                <option value="">Select a Category</option>
                                <!-- Populate categories dynamically -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" id="price" name="price" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="cost_price">Cost Price</label>
                            <input type="number" step="0.01" id="cost_price" name="cost_price" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" step="0.01" id="quantity" name="quantity" class="form-control" required />
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="btn btn-outline-secondary" id="image" name="image[]" multiple />
                        </div>
                        <div class="input-group mb-3">
                            <div id="current_image"></div> <!-- To display current images -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="productSubmit" class="btn btn-primary">Save</button>
                        <button type="button" id="productUpdate" class="btn btn-primary" style="display:none;">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

@endsection
