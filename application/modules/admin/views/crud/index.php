<section class="content-header">
    <?php echo $pagetitle; ?>
    <?php echo $breadcrumb; ?>
</section>



<section class="content">
    <div class="row">
        <div class="col-md-12">
             <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo lang('crud_title'); ?></h3>
                </div>
                <div class="box-body">
                    <?php echo anchor('admin/crud/create', '<i class="fa fa-plus"></i> '. lang('crud_create'), array('class' => 'btn btn-primary btn-flat')); ?>

                    <hr>

                    <?php echo form_open(); ?>

                        <table id="tb_crud" class="table table-striped table-hover table-condensed table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo lang('crud_name');?></th>
                                    <th><?php echo lang('crud_description');?></th>
                                    <th><?php echo lang('crud_action');?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    <?php echo form_close(); ?>
                </div>
            </div>
         </div>
    </div>
</section>

<!-- MODALS -->
<div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModelDelete" aria-hidden="true"></div>
