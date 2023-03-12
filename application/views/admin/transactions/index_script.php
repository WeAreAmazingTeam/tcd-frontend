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
                url: "<?= $_ENV['API_URL']; ?>/admin/datatables/transactions",
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
                targets: [0, 6, 7],
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
                    data: "user_id",
                    render: function(data, type, row) {
                        if (data == "-1" || data == "0") {
                            return "Anonymous";
                        }
                        return row.user_name;
                    }
                },
                {
                    data: "amount",
                    render: function(data, type, row) {
                        return formatRupiah(data);
                    }
                },
                {
                    data: "status",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "code",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "comment",
                    render: function(data, type, row) {
                        if (data == "") {
                            return "-";
                        }
                        return data;
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
                                    <a class="dropdown-item" href="javascript:openModalViewMore(${data})">
                                        <div class="dropdown-item-icon">
                                            <i class="fa fa-eye fa-fw"></i>
                                        </div>
                                        View More
                                    </a>
                                    <a class="dropdown-item" href="javascript:deleteTransaction(${data})">
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
    });

    function deleteTransaction(id) {
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
                    url: `<?= $_ENV['API_URL']; ?>/transactions/${id}`,
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

    function openModalViewMore(id) {
        $('#modal-view-more').modal('show');
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/transactions/${id}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $("#view-more-amount").html(formatRupiah(response?.data?.amount) || 0);
                    $("#view-more-status").html(response?.data?.status || "-");
                    $("#view-more-code").html(response?.data?.code || "-");
                    $("#view-more-comment").html(response?.data?.comment || "-");
                    $("#view-more-payment_url").html(`<a href="${(response?.data?.payment_url || "")}" target="_blank">${(response?.data?.payment_url || "-")}</a>`);
                    $("#view-more-payment_token").html(response?.data?.payment_token || "-");

                    setCampaign(response?.data?.campaign_id);
                    if (response?.data?.user_id > 0) {
                        setUser(response?.data?.user_id);
                    } else {
                        $("#view-more-user").html("Anonymous");
                    }
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
                    $("#view-more-user").html(response?.data?.name);
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error
                    });
                    $("#view-more-user").html("-");
                }
            },
            error: function(xhr, error, code) {
                Swal.fire({
                    icon: 'error',
                    text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                });
                $("#view-more-user").html("-");
            },
            complete: function() {}
        });
    }

    function setCampaign(id) {
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/${id}`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    $("#view-more-campaign").html(response?.data?.title);
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.error
                    });
                    $("#view-more-campaign").html("-");
                }
            },
            error: function(xhr, error, code) {
                Swal.fire({
                    icon: 'error',
                    text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
                });
                $("#view-more-campaign").html("-");
            },
            complete: function() {}
        });
    }
</script>