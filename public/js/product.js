$(document).ready(function () {
    var table = $('#productsTable').DataTable({
        ajax: {
            url: "/api/products",
            dataSrc: ""
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdf',
                title: '˚ · . Crust Crumb Products  ˚ · .',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                },
                customize: function (doc) {
                    doc.styles.title = {
                        color: '#FF7777',
                        fontSize: '2enter'
                    };
                    doc.styles.tableHeader = {
                        fillColor: '#B692C2',
                        color: '0',
                        alignment: 'cwhite',
                        bold: true
                    };
                    doc.styles.tableBodyOdd = {
                        fillColor: '#f3f3f3'
                    };
                    doc.styles.tableBodyEven = {
                        fillColor: '#ffffff'
                    };
                    doc.content[1].table.widths = 
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            },
            {
                extend: 'excel',
                title: 'Products',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: ':visible:not(.no-export)'
                }
            },
            {
                text: 'Add Product',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    $("#productForm").trigger("reset");
                    $('#productModal').modal('show');
                    $('#productUpdate').hide();
                    $('#productSubmit').show();
                    $('#current_image').empty(); 
                    $('#current_image').hide(); 
                }
            }
        ],
        columns: [
            { data: 'quantity', title: 'Available' },
            {
                data: 'image',
                title: 'Image',
                render: function (data, type, row) {
                    if (data) {
                        var imagePaths = data.split(',');
                        return `<img src="/${imagePaths[0]}" width="80" height="60" style="margin-right: 5px;">`;
                    }
                    return '';
                }
            },
            { data: 'name', title: 'Name' },
            { data: 'price', title: 'Price' },
            { data: 'cost_price', title: 'Cost Price' },
            {
                data: null,
                title: 'Actions',
                className: 'actions-column no-export',
                render: function (data, type, row) {
                    return `<a href='#' class='editBtn' data-id="${data.id}"><i class='fas fa-edit' style='font-size:24px'></i></a>
                            <a href='#' class='deleteBtn' data-id="${data.id}"><i class='fas fa-trash-alt' style='font-size:24px; color:red'></i></a>`;
                }
            }
        ]
    });

    $.ajax({
        type: 'GET',
        url: '/api/categories',
        success: function (data) {
            var $categorySelect = $('#category');
            $categorySelect.empty().append('<option value="">Select a Category</option>');
            $.each(data, function (index, category) {
                $categorySelect.append('<option value="' + category.id + '">' + category.name + '</option>');
            });
        },
        error: function (error) {
            console.log("Error fetching categories:", error);
        }
    });

    $("#productSubmit").on('click', function (e) {
        e.preventDefault();
        var data = $('#productForm')[0];
        let formData = new FormData(data);
        $.ajax({
            type: "POST",
            url: "/api/products",
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $("#productModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $('#productsTable tbody').on('click', 'a.editBtn', function (e) {
        e.preventDefault();
        $('#productSubmit').hide();
        $('#productUpdate').show();
        $("#productForm").trigger("reset");
        var id = $(this).data('id');
        $('#productModal').modal('show');

        $.ajax({
            type: "GET",
            url: `/api/products/${id}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#productId').val(data.id);
                $('#category').val(data.category_id);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#price').val(data.price);
                $('#cost_price').val(data.cost_price);
                $('#quantity').val(data.quantity);

                if (data.image) {
                    $('#current_image').html('');
                    data.image.split(',').forEach(image => {
                        $('#current_image').append('<img src="/' + image + '" width="80" height="60" style="margin-right: 5px;">');
                    });
                    $('#current_image').show(); 
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $("#productUpdate").on('click', function (e) {
        e.preventDefault();
        var id = $('#productId').val();
        var data = $('#productForm')[0];
        let formData = new FormData(data);
        formData.append('_method', 'PUT');
        $.ajax({
            type: "POST",
            url: `/api/products/${id}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $("#productModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $('#productsTable tbody').on('click', 'a.deleteBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                type: "DELETE",
                url: `/api/products/${id}`,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function (data) {
                    table.ajax.reload();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    });
});
