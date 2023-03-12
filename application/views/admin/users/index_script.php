<script>
    var table;

    $(document).ready(function() {
        table = $('#dataTable_theCloud').DataTable({
            order: [],
            stateSave: false,
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength: 20,
            searchDelay: 500,
            language: {
                lengthMenu: "_MENU_"
            },
            ajax: {
                url: "<?= $_ENV['API_URL']; ?>/admin/datatables/users",
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                },
                error: function(xhr, error, code) {
                    $('#dataTable_theCloud_processing').hide();
                    $('#dataTable_theCloud > tbody').html(`<tr><td colspan="6" class="dataTables_empty">${(xhr?.responseJSON?.message || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`)}</td></tr>`);
                }
            },
            columnDefs: [{
                targets: [0, 5],
                searchable: false,
                orderable: false
            }],
            lengthMenu: [
                [10, 20, 50, 100, 200, 500],
                [10, 20, 50, 100, 200, 500]
            ],
            drawCallback: function(_) {
                $('.dataTables_filter input').attr('placeholder','Type and enter...');
            },
            initComplete: function(_, _) {},
            columns: [
                {
                    data: "no",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "name",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "email",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "role",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "e_money",
                    render: function(data, type, row) {
                        return formatRupiah(data);
                    }
                },
                {
                    data: "id",
                    render: function(data, type, row) {
                        return `
                            <span class="dropdown">
                                <button class="btn btn-dark btn-sm dropdown-toggle" id="dropdownNoAnimation" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions&nbsp;
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownNoAnimation">
                                    <a class="dropdown-item" href="javascript:openFormUpdateUser(${data})">
                                        <div class="dropdown-item-icon">
                                            <i class="fa fa-pen fa-fw"></i>
                                        </div>
                                        Edit Data
                                    </a>
                                    <a class="dropdown-item" href="javascript:deleteUser(${data})">
                                        <div class="dropdown-item-icon">
                                            <i class="fa fa-trash fa-fw"></i>
                                        </div>
                                        Delete
                                    </a>
                                </div>
                            </span>
                        `;
                    }
                }
            ]
        });

        $('.dataTables_filter input').unbind().bind('keyup',function(e) {
            if (e.keyCode == 13 || this.value == '') {
                if (this.value == '') {
                    if (!empty) {
                        table.search(this.value).draw();
                        empty = true;
                    }
                } else {
                    table.search(this.value).draw();
                    empty = false;
                }
            }
        });

        $('#form-create').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "<?= $_ENV['API_URL']; ?>/users",
                type: 'POST',
                data: JSON.stringify({
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    role: $('#role').val(),
                    e_money: parseFloat($('#e_money').val())
                }),
                contentType: "application/json",
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                    $('#btn-create-submit').html('Processing...');
                    $('#btn-create-submit').prop('disabled', true);
                },
                success: function(response) {
                    if (response.success) {
                        table.ajax.reload(null, false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                        $('#modal-create').modal('hide');
                        setTimeout(() => {
                            $('#form-create').trigger('reset');
                        }, 2500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.error
                        });
                    }
                },
                error: function(xhr, error, code) {
                    Swal.fire({
                        icon: 'error',
                        text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                    });
                },
                complete: function() {
                    $('#btn-create-submit').prop('disabled', false);
                    $('#btn-create-submit').html('Create User');
                }
            });
        });
    });

    function openFormUpdateUser(id) {
        $('#modal-edit').modal('show');
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/users/${id}`,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
            },
            success: function(response) {
                if (response.success) {
                    $("#edit-id").val(response?.data?.id || "");
                    $("#edit-email").val(response?.data?.email || "");
                    $("#edit-name").val(response?.data?.name || "");
                    $("#edit-role").val(response?.data?.role || "");
                    $("#edit-e_money").val(response?.data?.e_money || 0);
                } else {
                    $('#modal-edit').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        text: response.error
                    });
                }
            },
            error: function(xhr, error, code) {
                Swal.fire({
                    icon: 'error',
                    text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                });
            },
            complete: function() {}
        });
    }

    $('#form-edit').submit(function(e){
        e.preventDefault();

        let object = {
            email: $('#edit-email').val(),
            name: $('#edit-name').val(),
            e_money: parseFloat($('#edit-e_money').val()),
            role: $('#edit-role').val()
        };

        if ($('#edit-password').val() != "") {
            object.password = $('#edit-password').val();
        }

        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/users/${$('#edit-id').val()}`,
            type: 'PUT',
            data: JSON.stringify(object),
            contentType: "application/json",
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                $('#btn-edit-submit').html('Processing...');
                $('#btn-edit-submit').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    table.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#modal-edit').modal('hide');
                    setTimeout(() => {
                        $('#form-edit').trigger('reset');
                    }, 2500);
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error
                    });
                }
            },
            error: function(xhr, error, code) {
                Swal.fire({
                    icon: 'error',
                    text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                });
            },
            complete: function() {
                $('#btn-edit-submit').prop('disabled', false);
                $('#btn-edit-submit').html('Update');
            }
        });
    });

    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes',
            preConfirm: () => {
                return $.ajax({
                    url: `<?= $_ENV['API_URL']; ?>/users/${id}`,
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response.error
                            });
                        }
                    },
                    error: function(xhr, error, code) {
                        Swal.fire({
                            icon: 'error',
                            text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                        });
                    },
                    complete: function() {}
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {}
        })
    }
</script>