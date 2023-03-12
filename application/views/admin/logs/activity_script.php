<script>
    $(document).ready(function() {
        var table = $('#dataTable_theCloud').DataTable({
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
                url: "<?= $_ENV['API_URL']; ?>/admin/datatables/logs/activity",
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                },
                error: function(xhr, error, code) {
                    $('#dataTable_theCloud_processing').hide();
                    $('#dataTable_theCloud > tbody').html(`<tr><td colspan="5" class="dataTables_empty">${(xhr?.responseJSON?.message || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`)}</td></tr>`);
                }
            },
            columnDefs: [{
                targets: [0],
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
                    data: "content",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "user_agent",
                    render: function(data, type, row) {
                        if (data == "") {
                            return "-";
                        }
                        return data;
                    }
                },
                {
                    data: "ip_address",
                    render: function(data, type, row) {
                        if (data == "127.0.0.1") {
                            return "-";
                        }
                        return data;
                    }
                },
                {
                    data: "created_at",
                    render: function(data, type, row) {
                        return data;
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

        setTimeout(() => {
            table.order([4, 'DESC']).draw();
        }, 1000);
    });
</script>