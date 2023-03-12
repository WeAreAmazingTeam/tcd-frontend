<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <a class="navbar-brand" href="<?= base_url('admin/dashboard'); ?>">The Cloud Donation</a>
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i data-feather="menu"></i></button>
    <ul class="navbar-nav align-items-center ml-auto">
        <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= base_url("assets/img/avatar.svg"); ?>" alt="Avatar" /></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="<?= base_url("assets/img/avatar.svg"); ?>" alt="Avatar" />
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name"><?= $this->session->userdata('name'); ?></div>
                        <div class="dropdown-user-details-email"><?= $this->session->userdata('email'); ?></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('admin/wallet'); ?>">
                    <div class="dropdown-item-icon"><i data-feather="pocket"></i></div>
                    Wallet Management
                </a>
                <a class="dropdown-item" href="<?= base_url('admin/settings'); ?>">
                    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                    Account Setting
                </a>
                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>