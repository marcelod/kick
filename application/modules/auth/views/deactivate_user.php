<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><?php echo lang('deactivate_heading');?></h1>
  </div>
<!-- /.col-lg-12 -->
</div>

<div class="row">
  <div class="col-lg-12">
    <p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

    <?php echo form_open("auth/deactivate/".$user->id);?>

      <p>
        <?php echo lang('deactivate_confirm_y_label', 'confirm');?>
        <input type="radio" name="confirm" value="yes" checked="checked" />
        &nbsp;
        <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
        <input type="radio" name="confirm" value="no" />
      </p>

      <?php echo form_hidden($csrf); ?>
      <?php echo form_hidden(array('id'=>$user->id)); ?>

      <p><?php echo bs_form_submit('submit', lang('deactivate_submit_btn'));?></p>

    <?php echo form_close();?>
  </div>
<!-- /.col-lg-12 -->
</div>