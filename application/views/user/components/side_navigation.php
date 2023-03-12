<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <div class="sidenav-menu-heading">Main Menu</div>
                <a class="nav-link" href="<?= site_url('user/dashboard'); ?>">
                    <div class="nav-link-icon"><i data-feather="home"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="<?= site_url('user/campaigns'); ?>">
                    <div class="nav-link-icon">
                        <i data-feather="gift"></i>
                    </div>
                    Campaigns
                </a>
                <a class="nav-link" href="<?= site_url('user/transactions'); ?>">
                    <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                    Transactions
                </a>
                <a class="nav-link" href="<?= site_url('user/settings'); ?>">
                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                    Account Setting
                </a>
                <a class="nav-link" href="<?= site_url('user/wallet'); ?>">
                    <div class="nav-link-icon"><i data-feather="pocket"></i></div>
                    Wallet Management
                </a>
                <div class="sidenav-menu-heading">Front Page Menu</div>
                <a class="nav-link" href="<?= site_url(); ?>">
                    <div class="nav-link-icon"><i data-feather="home"></i></div>
                    Home Page
                </a>
                <a class="nav-link" href="<?= site_url('donations'); ?>">
                    <div class="nav-link-icon"><i data-feather="gift"></i></div>
                    List of Donations
                </a>
                <a class="nav-link" href="<?= site_url('about'); ?>">
                    <div class="nav-link-icon"><i data-feather="info"></i></div>
                    About Us
                </a>
            </div>
        </div>
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title"><?= $this->session->userdata('name'); ?></div>
            </div>
        </div>
    </nav>
</div>