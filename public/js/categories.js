$(document).ready(function () {
    var table = $('#categoriesTable').DataTable({
        columnDefs: [
            { width: '15%', targets: '_all' } // Sets all columns to 15% width
        ],
        ajax: {
            url: "/api/categories",
            dataSrc: ""
        },
        dom: 'Bfrtip',
        buttons: [
            'pdf',
            'excel',
            {
                text: 'Add Category',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    $("#categoriesForm").trigger("reset");
                    $('#categoriesModal').modal('show');
                    $('#categoriesModalLabel').text('Add Category'); // Set modal title to "Add Category"
                    $('#categoriesUpdates').hide();
                    $('#categorySubmit').show();
                }
            }
        ],
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'name', title: 'Name' },
            { data: 'description', title: 'Description' },
            {
                data: null,
                title: 'Actions',
                render: function (data, type, row) {
                    return `<a href='#' class='editBtn' data-id="${data.id}"><i class='fas fa-edit' style='font-size:24px'></i></a>
                            <a href='#' class='deleteBtn' data-id="${data.id}"><i class='fas fa-trash-alt' style='font-size:24px; color:red'></i></a>`;
                }
            }
        ]
    });

    // Handle Add Category form submission
    $("#categoriesForm").on('submit', function (e) {
        e.preventDefault();
        var data = new FormData(this);
        var id = $('#categoriesId').val();
        $.ajax({
            type: id ? "PUT" : "POST",
            url: id ? `/api/categories/${id}` : "/api/categories",
            data: data,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (response) {
                $("#categoriesModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Handle Edit Category button click
    $('#categoriesTable tbody').on('click', 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (!id) {
            console.error("Invalid ID:", id);
            return;
        }
        $('#categoriesModalLabel').text('Edit Category');
        $('#categorySubmit').hide();
        $('#categoriesUpdates').show();
        
        // Reset the form before populating it
        $('#categoriesForm').trigger("reset");
    
        $.ajax({
            type: "GET",
            url: `/api/categories/${id}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#categoriesId').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
            },
            error: function (error) {
                console.log(error);
            }
        });
    
        $('#categoriesModal').modal('show');
    });
    
    // Handle Update Category form submission
    $("#categoriesUpdates").on('click', function (e) {
        e.preventDefault();
        var id = $('#categoriesId').val();
        var data = $('#categoriesForm')[0];
        let formData = new FormData(data);
        formData.append("_method", "PUT");
    
        $.ajax({
            type: "POST",
            url: `/api/categories/${id}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#categoriesModal').modal("hide");
                table.ajax.reload(); // Reload the DataTable
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    
    // Handle Delete Category button click
    $('#categoriesTable tbody').on('click', 'a.deleteBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        bootbox.confirm({
            message: "Do you want to delete this category?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        type: "DELETE",
                        url: `/api/categories/${id}`,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        dataType: "json",
                        success: function (data) {
                            table.row($row).remove().draw();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
            }
        });
    });
});
