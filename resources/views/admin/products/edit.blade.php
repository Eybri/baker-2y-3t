<!-- @extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1>Edit Product</h1>
        <form id="editProductForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @if($product->image)
                    <img id="previewImage" src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editProductForm').submit(function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert('Product updated successfully!');
                        // Optionally redirect or perform other actions after update
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error updating product:', errorThrown);
                        alert('Error updating product!');
                    }
                });

                return false;
            });

            // Optional: Preview image before uploading
            $('#image').change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
@endsection -->
