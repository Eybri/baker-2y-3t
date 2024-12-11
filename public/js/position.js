$(document).ready(function () {
    var table = $('#positionsTable').DataTable({
        columnDefs: [
            { width: '15%', targets: '_all' } // Sets all columns to 15% width
        ],
        ajax: {
            url: "/api/positions",
            dataSrc: ""
        },
        dom: 'Bfrtip',
        buttons: [
            'pdf',
            'excel',
            {
                text: 'Add position',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    $("#positionsForm").trigger("reset");
                    $('#positionsModal').modal('show');
                    $('#positionsModalLabel').text('Add position'); // Set modal title to "Add position"
                    $('#positionsUpdates').hide();
                    $('#positionSubmit').show();
                }
            }
        ],
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'position_name', title: 'Position' },
            { data: 'salary', title: 'Salary' },
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

    // Handle Add position form submission
    $("#positionsForm").on('submit', function (e) {
        e.preventDefault();
        var data = new FormData(this);
        var id = $('#positionId').val();
        $.ajax({
            type: id ? "PUT" : "POST",
            url: id ? `/api/positions/${id}` : "/api/positions",
            data: data,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (response) {
                $("#positionsModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

     // Handle Edit position button click
     $('#positionsTable tbody').on('click', 'a.editBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (!id) {
            console.error("Invalid ID:", id);
            return;
        }
        $('#positionsModalLabel').text('Edit position');
        $('#positionSubmit').hide();
        $('#positionsUpdates').show();
        
        // Reset the form before populating it
        $('#positionsForm').trigger("reset");
    
        $.ajax({
            type: "GET",
            url: `/api/positions/${id}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#positionId').val(data.id);
                $('#position_name').val(data.position_name);
                $('#salary').val(data.salary);
            },
            error: function (error) {
                console.error("Error fetching position data:", error);
            }
        });
    
        $('#positionsModal').modal('show');
    });

    // Handle Update position form submission
    $("#positionsUpdates").on('click', function (e) {
        e.preventDefault();
        var id = $('#positionId').val();
        var data = $('#positionsForm')[0];
        let formData = new FormData(data);
        formData.append("_method", "PUT");

        $.ajax({
            type: "POST",
            url: `/api/positions/${id}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#positionsModal').modal("hide");
                table.ajax.reload(); // Reload the DataTable
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Handle Delete position button click
    $('#positionsTable tbody').on('click', 'a.deleteBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        bootbox.confirm({
            message: "Do you want to delete this position?",
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
                        url: `/api/positions/${id}`,
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

    // Search function for positions table
    $('#positionSearch').keyup(function () {
        table.search($(this).val()).draw();
    });
});