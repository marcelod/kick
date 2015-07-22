<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('create_group_heading');?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">

    	<p><?php echo lang('create_group_subheading');?></p>

		<div id="infoMessage"><?php echo $message;?></div>

		<?php echo form_open("auth/create_group");?>

		      <p>
		            <?php echo lang('create_group_name_label', 'group_name');?> <br />
		            <?php echo bs_form_input($group_name);?>
		      </p>

		      <p>
		            <?php echo lang('create_group_desc_label', 'description');?> <br />
		            <?php echo bs_form_input($description);?>
		      </p>

		      <p><?php echo bs_form_submit('submit', lang('create_group_submit_btn'));?></p>

		<?php echo form_close();?>

    </div>
    <!-- /.col-lg-12 -->
</div>