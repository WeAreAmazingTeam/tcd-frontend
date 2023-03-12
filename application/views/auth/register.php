<?php $this->load->view('auth/header_auth'); ?>

<div class="container">
    <div class="row d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-register-image" style="min-height: 506px;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <form class="user" id="form-register">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="firstname" name="firstname" placeholder="First Name">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email" placeholder="Email Address">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <button type="submit" name="btn_register" id="btn_register" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= site_url('auth/login'); ?>">Already have an account? Login!</a>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= site_url(); ?>">← Or Back to Home Page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('auth/footer_auth'); ?>

<script>
    $("#form-register").submit(function(e){
        e.preventDefault();
        data_verification();
    });

    function data_verification() {
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var password = $('#password').val();

        if (email != "" && password != "" && firstname != "" && lastname != "") {
            process_register(firstname, lastname, email, password);
        } else {
            if (firstname == "") {
                Swal.fire({
                    icon: 'error',
                    text: ("First Name Cannot Be Empty")
                });
            }
            if (lastname == "") {
                Swal.fire({
                    icon: 'error',
                    text: ("Last Name Cannot Be Empty")
                });
            }
            if (email == "") {
                Swal.fire({
                    icon: 'error',
                    text: ("Email Cannot Be Empty")
                });
            }
            if (password == "") {
                Swal.fire({
                    icon: 'error',
                    text: ("Password Cannot Be Empty")
                });
            }
        }
    }

    function process_register(firstname, lastname, email, password) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url("auth/process_register")?>',
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn_register').prop('disabled', true);
                $('#btn_register').html('Processing...');
            },
            complete: function() {
                $('#btn_register').prop('disabled', false);
                $('#btn_register').html('Register Account');
            },
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                password: password
            },
            success: function (result) {
                if (result.status == true) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Register Success',
                        text: 'Please wait, you will be redirect to Dashboard.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(() => {
                        location.href = '<?= site_url("user/dashboard"); ?>';
                    }, 2500);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: (result.error)
                    });
                }
            }
        });
    }
</script>