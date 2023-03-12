<script>
    $(function(){
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/users/data`,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
            },
            success: function(response) {
                if (response.success) {
                    $("#name").val(response?.data?.name || "");
                    $("#email").val(response?.data?.email || "");
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

        <?php if ($this->input->get('forgot-password', TRUE) === 'true'): ?>
          let uri = window.location.toString();
          let clean_uri = uri.substring(0,uri.indexOf("?"));
          window.history.replaceState({},document.title,clean_uri);
        <?php endif; ?>
    });

    $('#update-account').submit(function(e){
        e.preventDefault();
        data_verification();
    });

    function data_verification() {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();

        if (email != "" && name != "") {
            process_update(name, email, password);
        } else {
            if (name == "") {
                Swal.fire({
                    icon: 'error',
                    text: ("Name Cannot Be Empty")
                });
            }
            if (email == "") {
                Swal.fire({
                    icon: 'error',
                    text: ("Email Cannot Be Empty")
                });
            }
        }
    }

    function process_update(name, email, password) {
        let object = {
            email: $('#email').val(),
            name: $('#name').val()
        };

        if ($('#password').val() != "") {
            object.password = $('#password').val();
        }

        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/users/data/change`,
            type: 'PUT',
            data: JSON.stringify(object),
            contentType: "application/json",
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
                $('#btn-update').html('Processing...');
                $('#btn-update').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
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
            complete: function() {
                $('#btn-update').prop('disabled', false);
                $('#btn-update').html('Update');
            }
        });
    }

</script>