<?php // var_dump($control_sidebar);die(); ?>

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

</div>