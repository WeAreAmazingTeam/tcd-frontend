<script>
    var table;
    var tableWinnersExclusiveCampaigns;
    var showModalManageImage = true;

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
                url: "<?= $_ENV['API_URL']; ?>/admin/datatables/campaigns",
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                },
                error: function(xhr, error, code) {
                    $('#dataTable_theCloud_processing').hide();
                    $('#dataTable_theCloud > tbody').html(`<tr><td colspan="8" class="dataTables_empty">${(xhr?.responseJSON?.message || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`)}</td></tr>`);
                }
            },
            columnDefs: [{
                targets: [0, 7],
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
                    data: "title",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "goal_amount",
                    render: function(data, type, row) {
                        return formatRupiah(data);
                    }
                },
                {
                    data: "current_amount",
                    render: function(data, type, row) {
                        return formatRupiah(data);
                    }
                },
                {
                    data: "total_image",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return "-";
                        }
                        return `${data} images`;
                    }
                },
                {
                    data: "is_exclusive",
                    render: function(data, type, row) {
                        if (data == "1") {
                            return `<span class="badge badge-pill badge-orange">Yes</span>`;
                        }
                        return `<span class="badge badge-pill badge-dark">No</span>`;
                    }
                },
                {
                    data: "status",
                    render: function(data, type, row) {
                        if (data == "active") {
                            if (row?.finished_at || "" != "") {
                                return `active ~ ${moment(row?.finished_at).format('DD/MM/YY')}`
                            }
                            return `active`;
                        }
                        if (data == "") {
                            return "-";
                        }
                        return data;
                    }
                },
                {
                    data: "id",
                    render: function(data, type, row) {
                        if (row.status == "finished") {
                            return `
                                <span class="dropdown">
                                    <button class="btn btn-dark btn-sm dropdown-toggle" id="dropdownNoAnimation" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions&nbsp;
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownNoAnimation">
                                        <a class="dropdown-item" href="javascript:openModalViewMore(${data})">
                                            <div class="dropdown-item-icon">
                                                <i class="fa fa-eye fa-fw"></i>
                                            </div>
                                            View More
                                        </a>
                                        <a class="dropdown-item" href="javascript:openFormManageImages(${data})">
                                            <div class="dropdown-item-icon">
                                                <i class="fa fa-image fa-fw"></i>
                                            </div>
                                            Manage Images
                                        </a>
                                        <a class="dropdown-item" href="javascript:deleteCampaign(${data})">
                                            <div class="dropdown-item-icon">
                                                <i class="fa fa-trash fa-fw"></i>
                                            </div>
                                            Delete
                                        </a>
                                    </div>
                                </span>
                            `;
                        }

                        let html_exclusive = '';

                        if (row?.is_exclusive || false) {
                            html_exclusive = `<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:openFormEditExclusive(${data})">
                                    <div class="dropdown-item-icon">
                                        <i class="fa fa-pen fa-fw"></i>
                                    </div>
                                    Edit Exclusive
                                </a>
                                <a class="dropdown-item" href="javascript:deleteExclusive(${data})">
                                    <div class="dropdown-item-icon">
                                        <i class="fa fa-trash fa-fw"></i>
                                    </div>
                                    Remove Exclusive
                                </a>
                            <div class="dropdown-divider"></div>`;
                        } else {
                            html_exclusive = `<a class="dropdown-item" href="javascript:openFormSetToExclusive(${data})">
                                <div class="dropdown-item-icon">
                                    <i class="fa fa-gift fa-fw"></i>
                                </div>
                                Set To Exclusive
                            </a>`;
                        }

                        return `
                            <span class="dropdown">
                                <button class="btn btn-dark btn-sm dropdown-toggle" id="dropdownNoAnimation" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions&nbsp;
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownNoAnimation">
                                    <a class="dropdown-item" href="javascript:openModalViewMore(${data})">
                                        <div class="dropdown-item-icon">
                                            <i class="fa fa-eye fa-fw"></i>
                                        </div>
                                        View More
                                    </a>
                                    ${html_exclusive}
                                    <a class="dropdown-item" href="javascript:openFormManageImages(${data})">
                                        <div class="dropdown-item-icon">
                                            <i class="fa fa-image fa-fw"></i>
                                        </div>
                                        Manage Images
                                    </a>
                                    <a class="dropdown-item" href="javascript:openFormUpdateCampaign(${data})">
                                        <div class="dropdown-item-icon">
                                            <i class="fa fa-pen fa-fw"></i>
                                        </div>
                                        Edit Data
                                    </a>
                                    <a class="dropdown-item" href="javascript:deleteCampaign(${data})">
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

        $('#dataTable_theCloud_wrapper .dataTables_filter input').unbind().bind('keyup',function(e) {
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

        tableWinnersExclusiveCampaigns = $('#dataTable_theCloud_exclusive_campaigns').DataTable({
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
                url: "<?= $_ENV['API_URL']; ?>/admin/datatables/campaigns/exclusive",
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                },
                error: function(xhr, error, code) {
                    $('#dataTable_theCloud_exclusive_campaigns_processing').hide();
                    $('#dataTable_theCloud_exclusive_campaigns > tbody').html(`<tr><td colspan="6" class="dataTables_empty">${(xhr?.responseJSON?.message || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`)}</td></tr>`);
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
                    data: "campaign_name",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "winner_user_name",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "reward",
                    render: function(data, type, row) {
                        if ((row.is_reward_money)) {
                            return `(Reward Are Money) ${formatRupiah(data)}`;
                        }
                        return `(Reward Are Not Money) ${data}`;
                    }
                },
                {
                    data: "is_paid_off",
                    render: function(data, type, row) {
                        if (data == "1") {
                            return `<span class="badge badge-pill badge-orange">Yes</span>`;
                        }
                        return `<span class="badge badge-pill badge-dark">No, Please Process!</span>`;
                    }
                },
                {
                    data: "id",
                    render: function(data, type, row) {
                        if (row.is_paid_off == "1") {
                            return "-";
                        }
                        return `
                            <span class="dropdown">
                                <button class="btn btn-dark btn-sm dropdown-toggle" id="dropdownNoAnimation" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions&nbsp;
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownNoAnimation">
                                    <a class="dropdown-item" href="javascript:setAsPaidOff(${data})">
                                        <div class="dropdown-item-icon">
                                            <i class="fa fa-check fa-fw"></i>
                                        </div>
                                        Set as Paid Off
                                    </a>
                                    <a class="dropdown-item" href="javascript:deleteWinner(${data})">
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

        $('#dataTable_theCloud_exclusive_campaigns_wrapper .dataTables_filter input').unbind().bind('keyup',function(e) {
            if (e.keyCode == 13 || this.value == '') {
                if (this.value == '') {
                    if (!empty) {
                        tableWinnersExclusiveCampaigns.search(this.value).draw();
                        empty = true;
                    }
                } else {
                    tableWinnersExclusiveCampaigns.search(this.value).draw();
                    empty = false;
                }
            }
        });

        $.ajax({
            url: "<?= $_ENV['API_URL']; ?>/users",
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
            },
            success: function(response) {
                if (response.success) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#user_id").append(`<option value="${data[i].id}">${data[i].name} (${data[i].email})</option>`);
                    }
                }
            },
            error: function(xhr, error, code) {
                console.log(xhr, error, code);
            }
        });

        $.ajax({
            url: "<?= $_ENV['API_URL']; ?>/campaigns/categories",
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    let data = response.data;
                    for (let i = 0; i < data.length; i++) {
                        $("#category_id, #edit-category_id").append(`<option value="${data[i].id}">${data[i].category}</option>`);
                    }
                }
            },
            error: function(xhr, error, code) {
                console.log(xhr, error, code);
            }
        });

        $('#form-create').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "<?= $_ENV['API_URL']; ?>/campaigns",
                type: 'POST',
                data: JSON.stringify({
                    user_id: parseInt($('#user_id').val()),
                    category_id: parseInt($('#category_id').val()),
                    title: $('#title').val(),
                    short_description: $('#short_description').val(),
                    description: $('#description').val(),
                    goal_amount: parseInt($('#goal_amount').val()),
                    finished_at: $('#finished_at').val(),
                    status: $('#status').val()
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
                        tableWinnersExclusiveCampaigns.ajax.reload(null, false);
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
                    $('#btn-create-submit').html('Create Campaign');
                }
            });
        });
    });

    function openFormUpdateCampaign(id) {
        $('#modal-edit').modal('show');
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/${id}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $("#edit-id").val(response?.data?.id || "");
                    $("#edit-user_id").val(response?.data?.user_id || "");
                    $("#edit-status").val(response?.data?.status || "");
                    $("#edit-finished_at").val(moment(response?.data?.finished_at || "").format("YYYY-MM-DD"));
                    $("#edit-category_id").val(response?.data?.category_id || "");
                    $("#edit-title").val(response?.data?.title || "");
                    $("#edit-goal_amount").val(response?.data?.goal_amount || "");
                    $("#edit-short_description").val(response?.data?.short_description || "");
                    $("#edit-description").val(response?.data?.description || "");
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
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/${$('#edit-id').val()}`,
            type: 'PUT',
            data: JSON.stringify({
                user_id: parseInt($('#edit-user_id').val()),
                status: $('#edit-status').val(),
                finished_at: $('#edit-finished_at').val(),
                category_id: parseInt($('#edit-category_id').val()),
                title: $('#edit-title').val(),
                short_description: $('#edit-short_description').val(),
                description: $('#edit-description').val(),
                goal_amount: parseInt($('#edit-goal_amount').val()),
            }),
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
                    tableWinnersExclusiveCampaigns.ajax.reload(null, false);
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

    function deleteCampaign(id) {
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
                    url: `<?= $_ENV['API_URL']; ?>/campaigns/${id}`,
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload(null, false);
                            tableWinnersExclusiveCampaigns.ajax.reload(null, false);
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

    function openFormManageImages(id) {
        $('#modal-manage-images').modal('show');
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/${id}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#manage-images-campaign-id').val(id);
                    let images = response?.data?.images || {};
                    $('#wrapper-button-images, #images-collapse').html('');
                    if (images.length == 0) {
                        $('#wrapper-button-images').append(`This campaign does not have any images yet.`);
                    } else {
                        for (let i = 0; i < images.length; i++) {
                            $('#wrapper-button-images').append(`
                                <button class="btn btn-primary btn-xs" type="button" data-toggle="collapse" data-target="#imgCollapse-${i+1}">
                                    Image ${i+1}
                                </button>
                            `);
                            $('#images-collapse').append(`
                                <div class="collapse${(i == 0 ? ' show' : '')}" id="imgCollapse-${i+1}">
                                    <div class="wrapper-campaign-image">
                                        <img src="<?= str_replace('/api/v1', '', $_ENV['API_URL']); ?>/${images[i].file_location}" alt="Campaign Image" class="mw-100">
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-danger btn-sm btn-block" type="button" onclick="deleteImage(${images[i].id})">Delete This Image</button>
                                    </div>
                                </div>
                            `);
                        }
                    }
                } else {
                    $('#modal-manage-images').modal('hide');
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

    var ic = $('#images-collapse');
    ic.on('show.bs.collapse', function() {
        ic.find('.collapse.show').collapse('hide');
    });

    function openModalAddNewImage() {
        $('#modal-manage-images').modal('hide');
        $('#modal-add-image').modal('show');
        $('#add-image-campaign_id').val($('#manage-images-campaign-id').val());
    }

    $('#modal-add-image').on('hide.bs.modal', function(){
        if (showModalManageImage) {
            $('#modal-manage-images').modal('show');
        } else {
            showModalManageImage = true;
        }
    });

    $('#form-add-image').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/images`,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                $('#btn-add-image-submit').html('Processing...');
                $('#btn-add-image-submit').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    showModalManageImage = false;
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $('#modal-add-image').modal('hide');
                    $('#modal-manage-images').modal('hide');
                    setTimeout(() => {
                        openFormManageImages($('#manage-images-campaign-id').val());
                        $('#form-add-image').trigger('reset');
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
                $('#btn-add-image-submit').prop('disabled', false);
                $('#btn-add-image-submit').html('Submit');
            }
        });
    });

    function deleteImage(id) {
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
                    url: `<?= $_ENV['API_URL']; ?>/campaigns/images/${id}`,
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                    },
                    success: function(response) {
                        if (response.success) {
                            showModalManageImage = false;
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2500
                            });
                            $('#modal-add-image').modal('hide');
                            $('#modal-manage-images').modal('hide');
                            setTimeout(() => {
                                openFormManageImages($('#manage-images-campaign-id').val());
                                $('#form-add-image').trigger('reset');
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
                    complete: function() {}
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {}
        })
    }

    function openFormSetToExclusive(id) {
        $('#modal-set-to-exclusive').modal('show');
        $('#set-to-exclusive-campaign_id').val(id);
        $('#set-to-exclusive-is_reward_money').trigger('change');
    }

    $('#form-set-to-exclusive').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= $_ENV['API_URL']; ?>/campaigns/exclusive",
            type: 'POST',
            data: JSON.stringify({
                campaign_id: parseInt($('#set-to-exclusive-campaign_id').val()),
                is_reward_money: parseInt($('#set-to-exclusive-is_reward_money').val()),
                reward: $('#set-to-exclusive-reward').val()
            }),
            contentType: "application/json",
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                $('#btn-set-to-exclusive-submit').html('Processing...');
                $('#btn-set-to-exclusive-submit').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    table.ajax.reload(null, false);
                    tableWinnersExclusiveCampaigns.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#modal-set-to-exclusive').modal('hide');
                    setTimeout(() => {
                        $('#form-set-to-exclusive').trigger('reset');
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
                $('#btn-set-to-exclusive-submit').prop('disabled', false);
                $('#btn-set-to-exclusive-submit').html('Set to Exclusive Campaign');
            }
        });
    });

    $('#set-to-exclusive-is_reward_money').change(function(){
        if ($(this).val() == "1") {
            $('#set-to-exclusive-reward').attr('type', 'text');
            $("#set-to-exclusive-reward").inputmask({
				alias: 'numeric',
				groupSeparator: '.',
				autoGroup: true,
				digits: 0,
				digitsOptional: false,
				prefix: 'Rp ',
				autoUnmask: true,
                rightAlign: false
			}).attr('autocomplete', 'off');
        } else {
            $('#set-to-exclusive-reward').attr('type', 'text');
            $("#set-to-exclusive-reward").inputmask('remove').val("");
        }
    });

    function deleteExclusive(id) {
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/campaign/${id}`,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
            },
            success: function(response) {
                if (response.success) {
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
                                url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/${response?.data?.id || "0"}`,
                                type: 'DELETE',
                                beforeSend: function(xhr) {
                                    xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                                },
                                success: function(response) {
                                    if (response.success) {
                                        table.ajax.reload(null, false);
                                        tableWinnersExclusiveCampaigns.ajax.reload(null, false);
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
    }

    function openFormEditExclusive(id) {
        $('#modal-edit-exclusive').modal('show');
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/campaign/${id}`,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
            },
            success: function(response) {
                if (response.success) {
                    $("#edit-exclusive-id").val(response?.data?.id || "");
                    $("#edit-exclusive-campaign_id").val(response?.data?.campaign_id || "");
                    $("#edit-exclusive-is_reward_money").val(response?.data?.is_reward_money?.toString() || "").trigger('change');
                    $("#edit-exclusive-reward").val(response?.data?.reward || "");
                    $("#edit-exclusive-winner_user_id").val(response?.data?.winner_user_id || "");
                    $("#edit-exclusive-is_paid_off").val(response?.data?.is_paid_off || "");
                } else {
                    $('#modal-edit-exclusive').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        text: response.error
                    });
                }
            },
            error: function(xhr, error, code) {
                $('#modal-edit-exclusive').modal('hide');
                Swal.fire({
                    icon: 'error',
                    text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                });
            },
            complete: function() {}
        });
    }

    $('#edit-exclusive-is_reward_money').change(function(){
        if ($(this).val() == "1") {
            $('#edit-exclusive-reward').attr('type', 'text');
            $("#edit-exclusive-reward").inputmask({
				alias: 'numeric',
				groupSeparator: '.',
				autoGroup: true,
				digits: 0,
				digitsOptional: false,
				prefix: 'Rp ',
				autoUnmask: true,
                rightAlign: false
			}).attr('autocomplete', 'off');
        } else {
            $('#edit-exclusive-reward').attr('type', 'text');
            $("#edit-exclusive-reward").inputmask('remove').val("");
        }
    });

    $('#form-edit-exclusive').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/${$('#edit-exclusive-id').val()}`,
            type: 'PUT',
            data: JSON.stringify({
                campaign_id: parseInt($('#edit-exclusive-campaign_id').val()),
                winner_user_id: parseInt($('#edit-exclusive-winner_user_id').val()),
                is_reward_money: parseInt($('#edit-exclusive-is_reward_money').val()),
                reward: $('#edit-exclusive-reward').val(),
                is_paid_off: parseInt($('#edit-exclusive-is_paid_off').val())
            }),
            contentType: "application/json",
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                $('#btn-edit-exclusive-submit').html('Processing...');
                $('#btn-edit-exclusive-submit').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    table.ajax.reload(null, false);
                    tableWinnersExclusiveCampaigns.ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#modal-edit-exclusive').modal('hide');
                    setTimeout(() => {
                        $('#form-edit-exclusive').trigger('reset');
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
                $('#btn-edit-exclusive-submit').prop('disabled', false);
                $('#btn-edit-exclusive-submit').html('Edit Data Exclusive');
            }
        });
    });

    function openModalViewMore(id) {
        $('#modal-view-more').modal('show');
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/${id}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    let status = response?.data?.status || "-";
                    let liveLink = "";

                    $("#view-more-title").html(response?.data?.title || "-");
                    $("#view-more-short_description").html(response?.data?.short_description || "-");
                    $("#view-more-description").html(response?.data?.description || "-");
                    $("#view-more-goal_amount").html(formatRupiah(response?.data?.goal_amount) || 0);
                    $("#view-more-current_amount").html(formatRupiah(response?.data?.current_amount) || 0);
                    $("#view-more-donor_count").html(response?.data?.donor_count || 0);
                    $("#view-more-finished_at").html(moment(response?.data?.finished_at || "").format('DD/MM/YYYY'));
                    $("#view-more-status").html(status);

                    if (status == "active" || status == "finished") {
                        $('#view-more-live-link').html(`, click this link for see campaign live preview: <a href="<?= base_url('donate'); ?>/${id}" target="_blank">see campaign live preview</a>.`);
                    }

                    setUser(response?.data?.user_id);
                    setCategory(response?.data?.category_id);
                } else {
                    $('#modal-view-more').modal('hide');
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

    function setUser(id) {
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/users/${id}`,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
            },
            success: function(response) {
                if (response.success) {
                    $("#view-more-campaign_by").html(response?.data?.name);
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error
                    });
                    $("#view-more-campaign_by").html("-");
                }
            },
            error: function(xhr, error, code) {
                Swal.fire({
                    icon: 'error',
                    text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                });
                $("#view-more-campaign_by").html("-");
            },
            complete: function() {}
        });
    }

    function setCategory(id) {
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/categories/${id}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $("#view-more-category").html(response?.data?.category);
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error
                    });
                    $("#view-more-category").html("-");
                }
            },
            error: function(xhr, error, code) {
                Swal.fire({
                    icon: 'error',
                    text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                });
                $("#view-more-category").html("-");
            },
            complete: function() {}
        });
    }

    function setAsPaidOff(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Yes',
            preConfirm: () => {
                return $.ajax({
                    url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/${id}`,
                    type: 'GET',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                    },
                    success: function(response) {
                        if (response.success) {
                            let set_id = response?.data?.id || "";
                            let set_campaign_id = response?.data?.campaign_id || "";
                            let set_is_reward_money = response?.data?.is_reward_money?.toString() || "";
                            let set_reward = response?.data?.reward || "";
                            let set_winner_user_id = response?.data?.winner_user_id || "";

                            $.ajax({
                                url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/${set_id}`,
                                type: 'PUT',
                                data: JSON.stringify({
                                    campaign_id: parseInt(set_campaign_id),
                                    winner_user_id: parseInt(set_winner_user_id),
                                    is_reward_money: parseInt(set_is_reward_money),
                                    reward: set_reward,
                                    is_paid_off: parseInt(1)
                                }),
                                contentType: "application/json",
                                dataType: 'json',
                                beforeSend: function(xhr) {
                                    xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                                },
                                success: function(response) {
                                    if (response.success) {
                                        table.ajax.reload(null, false);
                                        tableWinnersExclusiveCampaigns.ajax.reload(null, false);
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

    function deleteWinner(id) {
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
                    url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/${id}`,
                    type: 'DELETE',
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload(null, false);
                            tableWinnersExclusiveCampaigns.ajax.reload(null, false);
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