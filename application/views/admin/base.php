<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('admin/components/head'); ?>
    <body class="nav-fixed">
        <?php $this->load->view('admin/components/navigation'); ?>
        <div id="layoutSidenav">
            <?php $this->load->view('admin/components/side_navigation'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <?= @$content; ?>
                </main>
                <?php $this->load->view('admin/components/footer'); ?>
            </div>
        </div>
        <?php $this->load->view('admin/components/script'); ?>
    </body>
</html>