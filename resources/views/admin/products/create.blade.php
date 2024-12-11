<!-- @extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1>Add Product</h1>
        <form id="addProductForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

    <!-- jQuery and jQuery Validate Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addProductForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    description: {
                        required: true,
                        minlength: 10
                    },
                    price: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    image: {
                        required: true,
                        accept: "image/*" // Ensure only image files are accepted
                    }
                },
                messages: {
                    name: {
                        required: "Please enter product name",
                        minlength: "Name must be at least 3 characters"
                    },
                    description: {
                        required: "Please enter product description",
                        minlength: "Description must be at least 10 characters"
                    },
                    price: {
                        required: "Please enter product price",
                        number: "Please enter a valid number",
                        min: "Price must be greater than or equal to 0"
                    },
                    image: {
                        required: "Please select an image",
                        accept: "Only image files are allowed"
                    }
                },
                errorElement: "span", // Wrap error messages in <span>
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-group").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid").addClass("is-valid");
                }
            });
        });
    </script>
@endsection -->
