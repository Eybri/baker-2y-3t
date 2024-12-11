$(document).ready(function () {
    var table = $('#inventoriesTable').DataTable({
        columnDefs: [
            { width: '15%', targets: '_all' } // Sets all columns to 15% width
        ],
        ajax: {
            url: "/api/inventories",
            dataSrc: ""
        },
        dom: 'Bfrtip',
        buttons: [
            'pdf',
            'excel',
            {
                text: 'Add Item',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    $("#inventoryForm").trigger("reset");
                    $('#inventoryModal').modal('show');
                    $('#inventoryModalLabel').text('Add Item'); // Set modal title to "Add Item"
                    $('#inventoryUpdate').hide();
                    $('#inventorySubmit').show();
                }
            }
        ],
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'item', title: 'Item' },
            { data: 'stock', title: 'Stock' },
            { data: 'supplier', title: 'Supplier' },
            {
                data: null,
                title: 'Actions',
                className:'centered-image',
                render: function (data, type, row) {
                    return `<a href='#' class='editBtn' data-id="${data.id}"><i class='fas fa-edit' style='font-size:24px'></i></a>
                            <a href='#' class='deleteBtn' data-id="${data.id}"><i class='fas fa-trash-alt' style='font-size:24px; color:red'></i></a>`;
                }
            }
        ]
    });

    // Handle Add Inventory form submission
    $("#inventoryForm").on('submit', function (e) {
        e.preventDefault();
        var data = new FormData(this);
        var id = $('#inventoryId').val();
        $.ajax({
            type: id ? "PUT" : "POST",
            url: id ? `/api/inventories/${id}` : "/api/inventories",
            data: data,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (response) {
                $("#inventoryModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Handle Edit Inventory button click
    $('#inventoriesTable tbody').on('click', 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (!id) {
            console.error("Invalid ID:", id);
            return;
        }
        $('#inventoryModalLabel').text('Edit Item');
        $('#inventorySubmit').hide();
        $('#inventoryUpdate').show();
        
        // Reset the form before populating it
        $('#inventoryForm').trigger("reset");
    
        $.ajax({
            type: "GET",
            url: `/api/inventories/${id}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#inventoryId').val(data.id);
                $('#item').val(data.item);
                $('#stock').val(data.stock);
                $('#supplier').val(data.supplier);
            },
            error: function (error) {
                console.log(error);
            }
        });
    
        $('#inventoryModal').modal('show');
    });
    
    // Handle Update Inventory form submission
    $("#inventoryUpdate").on('click', function (e) {
        e.preventDefault();
        var id = $('#inventoryId').val();
        var data = $('#inventoryForm')[0];
        let formData = new FormData(data);
        formData.append("_method", "PUT");
    
        $.ajax({
            type: "POST",
            url: `/api/inventories/${id}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#inventoryModal').modal("hide");
                table.ajax.reload(); // Reload the DataTable
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    
    // Handle Delete Inventory button click
    $('#inventoriesTable tbody').on('click', 'a.deleteBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        bootbox.confirm({
            message: "Do you want to delete this item?",
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
                        url: `/api/inventories/${id}`,
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
