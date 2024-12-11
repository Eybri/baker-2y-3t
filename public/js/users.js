$(document).ready(function () {
    var table = $('#usersTable').DataTable({
        columnDefs: [
            { width: '15%', targets: '_all' } // Sets all columns to 15% width
        ],
        ajax: {
            url: "/api/users",
            dataSrc: ""
        },
        dom: 'Bfrtip',
        buttons: [
            'pdf',
            'excel',
        ],
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'name', title: 'Name' },
            { data: 'email', title: 'Email' },
            {
                data: 'is_admin',
                title: 'Role',
                render: function (data, type, row) {
                    return `
                        <label class="d-flex align-items-center justify-content-center">
                            <input type="checkbox" class="admin-checkbox me-2" data-id="${row.id}" ${data ? 'checked' : ''}>
                            <span>${data ? 'Admin' : 'User'}</span>
                        </label>
                    `;
                }
            },
            {
                data: 'is_active',
                title: 'Status',
                render: function (data, type, row) {
                    return `
                        <div class="d-flex justify-content-center">
                            <i class="bi bi-circle-fill ${data ? 'text-success' : 'text-danger'}"></i>
                        </div>
                    `;
                }
            },
            {
                data: null,
                title: 'Actions',
                render: function (data, type, row) {
                    return `
                        <div class="d-flex justify-content-evenly">
                            <button class="btn btn-danger btn-deactivate-user" data-id="${row.id}">Deactivate</button>
                            <button class="btn btn-success btn-activate-user" data-id="${row.id}">Activate</button>
                        </div>
                    `;
                }
            }
        ]
    });

    $('#usersTable').on('change', '.admin-checkbox', function () {
        var userId = $(this).data('id');
        var isAdmin = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: `/api/users/${userId}/update-admin`,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                is_admin: isAdmin
            },
            success: function (response) {
                alert(response.message);
                table.ajax.reload();
            }
        });
    });

    $('#usersTable').on('click', '.btn-deactivate-user', function () {
        var userId = $(this).data('id');

        $.ajax({
            url: `/api/users/${userId}/deactivate`,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert(response.message);
                table.ajax.reload();
            }
        });
    });

    $('#usersTable').on('click', '.btn-activate-user', function () {
        var userId = $(this).data('id');

        $.ajax({
            url: `/api/users/${userId}/activate`,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert(response.message);
                table.ajax.reload();
            }
        });
    });
});
