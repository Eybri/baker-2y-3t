$(document).ready(function () {
    var table = $('#employeesTable').DataTable({
        ajax: {
            url: "/api/employees",
            dataSrc: ""
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdf',
                title: 'Employee List',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: ':visible:not(.no-export)' // Exclude columns with the class 'no-export'
                },
                customize: function (doc) {
                    doc.styles.title = {
                        color: '#FF7777',
                        fontSize: '20',
                        alignment: 'center'
                    };
                    doc.styles.tableHeader = {
                        fillColor: '#B692C2',
                        color: 'white',
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
                title: 'Employees',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: ':visible:not(.no-export)' // Exclude columns with the class 'no-export'
                }
            },
            {
                text: 'Add Employee',
                className: 'btn btn-primary',
                action: function (e, dt, node, config) {
                    $("#employeeForm").trigger("reset");
                    $('#employeeModal').modal('show');
                    $('#employeeUpdate').hide();
                    $('#employeeSubmit').show();
                    $('#display').empty(); // Clear any existing images
                    $('#display').hide(); // Hide image display area
                }
            }
        ],
        columns: [
            {
                data: 'image',
                title: 'Image',
                className: 'centered-image', 
                render: function (data, type, row) {
                    if (data) {
                        return `<img src="/${data}" width="90" height="80" style="margin-right: 5px;">`;
                    }
                    return '';
                }
            },
            { data: 'name', title: 'Name' },
            { data: 'email', title: 'Email' },
            { data: 'position.position_name', title: 'Assigned Position' },
            {
                data: null,
                title: 'Actions',
                className: 'actions-column no-export centered-image', 
                render: function (data, type, row) {
                    return `<a href='#' class='editBtn' data-id="${data.id}"><i class='fas fa-edit' style='font-size:24px'></i></a>
                            <a href='#' class='deleteBtn' data-id="${data.id}"><i class='fas fa-trash-alt' style='font-size:24px; color:red'></i></a>`;
                }
            }
        ]
    });

    // Fetch positions for the select dropdown
    $.ajax({
        type: 'GET',
        url: '/api/positions',
        success: function (data) {
            var $positionSelect = $('#position');
            $positionSelect.empty().append('<option value="">Select a Position</option>');
            $.each(data, function (index, position) {
                $positionSelect.append('<option value="' + position.id + '">' + position.position_name + '</option>');
            });
        },
        error: function (error) {
            console.log("Error fetching positions:", error);
        }
    });

    // Handle Add Employee form submission
    $("#employeeSubmit").on('click', function (e) {
        e.preventDefault();
        var data = $('#employeeForm')[0];
        let formData = new FormData(data);
        $.ajax({
            type: "POST",
            url: "/api/employees",
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $("#employeeModal").modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Handle Edit Employee button click
    $('#employeesTable tbody').on('click', 'a.editBtn', function (e) {
        e.preventDefault();
        $('#employeeSubmit').hide();
        $('#employeeUpdate').show();
        $("#employeeForm").trigger("reset");
        var id = $(this).data('id');
        $('#employeeModal').modal('show');

        $.ajax({
            type: "GET",
            url: `/api/employees/${id}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#employeeId').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#position').val(data.position_id);

                $('#display').empty(); // Clear existing images
                if (data.image) {
                    var imagePaths = data.image.split(',');
                    imagePaths.forEach(function (path) {
                        $('#display').append(`<img src="/${path}" alt="Employee Image" width="80" height="60" style="margin-right: 5px;">`);
                    });
                    $('#display').show(); // Show image display area
                } else {
                    $('#display').hide();
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Handle Update Employee form submission
    $("#employeeUpdate").on('click', function (e) {
        e.preventDefault();
        var id = $('#employeeId').val();
        var data = $('#employeeForm')[0];
        let formData = new FormData(data);
        formData.append("_method", "PUT");

        $.ajax({
            type: "POST",
            url: `/api/employees/${id}`,
            data: formData,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                $('#employeeModal').modal("hide");
                table.ajax.reload();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Handle Delete Employee button click
    $('#employeesTable tbody').on('click', 'a.deleteBtn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var $row = $(this).closest('tr');
        bootbox.confirm({
            message: "Do you want to delete this employee?",
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
                        url: `/api/employees/${id}`,
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
