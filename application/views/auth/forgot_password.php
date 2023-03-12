<?php $this->load->view('auth/header_auth'); ?>

<div class="container">
    <div class="row d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-password-image" style="min-height: 506px;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                </div>
                                <form id="form-reset-password" class="user">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email" placeholder="Enter Email Address..." required>
                                    </div>
                                    <button id="btn-reset-password" type="submit" class="btn btn-primary btn-user btn-block">
                                        Request Reset Password
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= site_url('auth/register'); ?>">Don't have an account? Create an Account!</a>
                                </div>
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
    // $('#form-reset-password').submit(function(e){
    //     e.preventDefault();
    //     Swal.fire({
    //         icon: 'info',
    //         html: "Sorry, the password reset process hasn't been completed, if you really want to reset your password, you can contact the following WhatsApp (WhatsApp/text only): <a href='https://wa.me/628974848270' target='_blank'>+628974848270</a>.<br><br>Thank you very much for understanding!"
    //     });
    // });

    $("#form-reset-password").submit(function(e) {
        e.preventDefault();
        data_verification();
    });

    function data_verification() {
        var email = $('#email').val();

        if (email != "") {
            processRequest(email)
        } else {
            Swal.fire({
                icon: 'error',
                text: 'Email cannot be empty'
            })
        }
    }

    function processRequest(email) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url("auth/request_forgot_password")?>',
            dataType: 'JSON',
            beforeSend: function() {
                $('#btn-reset-password').prop('disabled', true);
                $('#btn-reset-password').html('Processing...');
            },
            complete: function() {
                $('#btn-reset-password').prop('disabled', false);
                $('#btn-reset-password').html('Request Reset Password');
            },
            data: {
                email: email
            },
            success: function (result) {
                if (result.status == true) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Request Success',
                        text: result.message
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.error
                    });
                }
            }
        });
    }
</script>