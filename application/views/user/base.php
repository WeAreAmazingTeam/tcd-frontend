<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('user/components/head'); ?>
    <body class="nav-fixed">
        <?php $this->load->view('user/components/navigation'); ?>
        <div id="layoutSidenav">
            <?php $this->load->view('user/components/side_navigation'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <?= @$content; ?>
                </main>
                <?php $this->load->view('user/components/footer'); ?>
            </div>
        </div>
        <?php $this->load->view('user/components/script'); ?>
    </body>
</html>