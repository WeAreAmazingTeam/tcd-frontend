<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var userData;
    var table;
    var table2;

    $(function(){
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
                url: "<?= $_ENV['API_URL']; ?>/datatables/flow/emoney",
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
                    data: "status",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "amount",
                    render: function(data, type, row) {
                        return formatRupiah(data);
                    }
                },
                {
                    data: "note",
                    render: function(data, type, row) {
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

        table2 = $('#dataTable_theCloud_2').DataTable({
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
                url: "<?= $_ENV['API_URL']; ?>/datatables/withdrawal",
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
                    data: "status",
                    render: function(data, type, row) {
                        return data;
                    }
                },
                {
                    data: "amount",
                    render: function(data, type, row) {
                        return formatRupiah(data);
                    }
                },
                {
                    data: "note",
                    render: function(data, type, row) {
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

        $('#dataTable_theCloud_2_wrapper .dataTables_filter input').unbind().bind('keyup',function(e) {
            if (e.keyCode == 13 || this.value == '') {
                if (this.value == '') {
                    if (!empty) {
                        table2.search(this.value).draw();
                        empty = true;
                    }
                } else {
                    table2.search(this.value).draw();
                    empty = false;
                }
            }
        });

        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/users/data`,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
            },
            success: function(response) {
                if (response.success) {
                    userData = response?.data;
                    $("#balance").html(formatRupiah(response?.data?.e_money || 0));
                    if ((response?.data?.e_money || 0) > 0) {
                        $('#card-body-withdrawal').html(`<form id="form-withdraw"><div class="form-group">
                            <label for="amount">Amount</label>
                            <input class="form-control" id="amount" data-type="number" type="text">
                        </div>
                        <div class="form-group">
                            <label for="information">Withdrawal Request Note/Information</label>
                            <textarea class="form-control" rows="8" style="padding-bottom: 24px;" id="information" placeholder="[EXAMPLE]

Hi, i want to make a withdrawal to my bank account, here is my bank account information:

Bank Name: BCA
Account Number: 6820686657
Account Name: Muhammad Saleh Solahudin"></textarea>
                        </div>
                        <button id="btn-withdraw" class="btn btn-primary btn-sm btn-block" type='submit'>Send Withdrawal Request</button></form>`);

                        initFormWithdraw();
                        inputMask();
                    } else {
                        $('#card-body-withdrawal').html("<p class='mb-0'><b>Info:</b><br>Can not withdraw because your balance is 0.</p>");
                    }
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
    });

    function initFormWithdraw() {
        $('#form-withdraw').submit(function(e){
            e.preventDefault();

            if ($('#amount').val() == "") {
                Swal.fire({
                    icon: 'warning',
                    text: "Amount can not be empty!"
                });
                return
            }

            if ($('#amount').val() > userData.e_money) {
                Swal.fire({
                    icon: 'warning',
                    text: "The amount cannot be higher than your e-money balance!"
                });
                return
            }

            if ($('#information').val() == "") {
                Swal.fire({
                    icon: 'warning',
                    text: "Withdraw information can not be empty!"
                });
                return
            }

            $.ajax({
                url: "<?= $_ENV['API_URL']; ?>/users/withdraw",
                type: 'POST',
                data: JSON.stringify({
                    amount: parseInt($('#amount').val()),
                    note: $('#information').val()
                }),
                contentType: "application/json",
                dataType: 'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                    $('#btn-withdraw').html('Processing...');
                    $('#btn-withdraw').prop('disabled', true);
                },
                success: function(response) {
                    if (response.success) {
                        let code = CryptoJS.enc.Base64.stringify(CryptoJS.enc.Utf8.parse(JSON.stringify(userData)));
                        let text = encodeURIComponent(`*[WITHDRAWAL REQUEST]*

*REQUEST CODE:*
${code}

*AMOUNT:*
${formatRupiah($('#amount').val())}

*NOTE OR INFORMATION:*
${$('#information').val()}`);

                        location.href = `https://api.whatsapp.com/send/?phone=628974842870&text=${text}&type=phone_number&app_absent=0`;
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
                    $('#btn-withdraw').prop('disabled', false);
                    $('#btn-withdraw').html('Send Withdrawal Request');
                }
            });
        });
    }
</script>