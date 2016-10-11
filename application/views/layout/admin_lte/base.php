<?php if ($mobile === FALSE && $admin_prefs['transition_page'] == TRUE): ?>
    <div class="wrapper animsition">
<?php else: ?>
    <div class="wrapper">
<?php endif; ?>

	<?php echo $header; ?>

    <!-- Page Content -->
    <div class="content-wrapper">
        	<?php echo $main_content; ?>
    </div><!-- /.content-wrapper -->


    <?php echo $footer; ?>

    <?php $this->load->view('layout/admin_lte/ctrl_sidebar'); ?>

</div>