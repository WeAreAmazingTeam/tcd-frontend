<?php $this->load->view('auth/header_auth'); ?>

<div class="container">
    <div class="row d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="min-height: 506px;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back, Please Login!</h1>
                                </div>
                                <form class="user" id="form-login">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    </div>
                                    <button name="btn_login" type="submit" id="btn_login" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= site_url('auth/forgot-password'); ?>">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= site_url('auth/register'); ?>">Don't have an account? Create an Account!</a>
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
    $("#form-login").submit(function(e) {
        e.preventDefault();
        data_verification();
    });

    function data_verification() {
        var email = $('#email').val();
        var password = $('#password').val();

        if (email != "" && password != "") {
            process_login(email, password)
        } else {
            if (email == "") {
                Swal.fire({
                    icon: 'error',
                    text: ("Email Cannot Be Empty")
                })
            }
            if (password == "") {
                Swal.fire({
                    icon: 'error',
                    text: ("Password Cannot Be Empty")
                })
            }
        }
    }

    function process_login(email, password) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url("auth/process_login")?>',
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn_login').prop('disabled', true);
                $('#btn_login').html('Processing...');
            },
            complete: function() {
                $('#btn_login').prop('disabled', false);
                $('#btn_login').html('Login');
            },
            data: {
                email: email,
                password: password
            },
            success: function (result) {
                if (result.status == true) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Login Success',
                        text: 'Please wait, you will be redirect.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(() => {
                        location.href = "<?= site_url('user/dashboard'); ?>";
                    }, 1000);
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