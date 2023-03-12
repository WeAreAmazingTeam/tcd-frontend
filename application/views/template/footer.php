<footer class="footer_home">
    <div class="container" style="padding: 100px 15px 100px;">
        <div class="row">
            <div class="col-xl-6">
                <div class="box_footer_description">
                    <a class="navbar-brand" href="<?= site_url(); ?>">
                        <img class="logo_brand_footer" src="<?= base_url('assets/img/logo.png')?>" alt="Logo The Cloud Donation">
                    </a>
                    <p class="txt_footer_brand">the cloud donation.</p>
                </div>
                <p class="footer_description">
                    Set Aside Your Money to Help Others Who Are In Need!
                </p>
                <p style="color: white; margin-right: 70px" class="footer_description_2">
                    Help others who need your help, make others happy with your help, show your kindness to others, always contribute to spreading goodness in this world! Lets make a change!
                </p>
            </div>
            <div class="col-xl-2">
                <p class="head_menu_footer">EXPLORE</p>
                <div class="box_sub_menu_footer">
                    <?php if ($this->session->has_userdata('id')): ?>
                        <?php if ($this->session->userdata('role') == "user"): ?>
                            <a class="link_menu_footer" href="<?= site_url(); ?>">Home</a>
                            <a class="link_menu_footer" href="<?= site_url('donations'); ?>">Campaigns</a>
                            <a class="link_menu_footer" href="<?= site_url('about'); ?>">About Us</a>
                            <a class="link_menu_footer" href="<?= site_url('user/dashboard'); ?>">User Area</a>
                            <a class="link_menu_footer" href="<?= site_url('auth/logout'); ?>">Logout</a>
                        <?php else: ?>
                            <a class="link_menu_footer" href="<?= site_url(); ?>">Home</a>
                            <a class="link_menu_footer" href="<?= site_url('donations'); ?>">Campaigns</a>
                            <a class="link_menu_footer" href="<?= site_url('about'); ?>">About Us</a>
                            <a class="link_menu_footer" href="<?= site_url('admin/dashboard'); ?>">Admin Area</a>
                            <a class="link_menu_footer" href="<?= site_url('auth/logout'); ?>">Logout</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="link_menu_footer" href="<?= site_url(); ?>">Home</a>
                        <a class="link_menu_footer" href="<?= site_url('donations'); ?>">Campaigns</a>
                        <a class="link_menu_footer" href="<?= site_url('about'); ?>">About Us</a>
                        <a class="link_menu_footer" href="<?= site_url('auth/register'); ?>">Register</a>
                        <a class="link_menu_footer" href="<?= site_url('auth/login'); ?>">Login</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-4">
                <p class="head_menu_footer">OFFICE & SOCIAL MEDIA</p>
                <div class="dflex">
                    <span class="address_footer">
                        Jl. Ardio, Ciwaringin Tanah Sewa RT 05 RW 01, Kel. Cibogor, Kec. Bogor Tengah, Jawa Barat, Indonesia 16124.
                    </span>
                </div>
                <div class="wrapper-link_socmed_footer">
                    <a class="link_socmed_footer" data-toggle="tooltip" data-placement="top" title="Saleh`s Linkedin" href="https://www.linkedin.com/in/muhammad-saleh-solahudin-8444171b2" targe="_blank">
                        <i class="fab fa-linkedin fa-fw" style="color: white;"></i>
                    </a>
                    <a class="link_socmed_footer" data-toggle="tooltip" data-placement="top" title="Ricky`s Linkedin" href="https://www.linkedin.com/in/ricky-romansyah-47831518b" targe="_blank">
                        <i class="fab fa-linkedin fa-fw" style="color: white;"></i>
                    </a>
                    <a class="link_socmed_footer" data-toggle="tooltip" data-placement="top" title="Rifki`s Linkedin" href="https://www.linkedin.com/in/rifkihimawan" targe="_blank">
                        <i class="fab fa-linkedin fa-fw" style="color: white;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div style="background: #E2632B !important; padding: 5px; text-align: center; color: white;">
        &copy; <?= date('Y') ?> &middot; The Cloud Donation &middot; Project For PolarDB Hackaton 2023 created by Saleh, Ricky and Rifki &middot; All Right Reserved
    </div>
</footer>