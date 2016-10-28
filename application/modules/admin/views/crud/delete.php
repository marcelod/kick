<div class="container">

    <?php echo form_open('admin/crud/deleteRow', array('id'=>'form-delete-crud', 'class'=>'form-dialog-remove')); ?>

    <?php echo form_hidden('id', $crud->id); ?>

	<p>
        Deseja realmente apagar o item do crudo <strong><?php echo $crud->name ?></strong>?
    </p>

    <?php echo form_close(); ?>

</div> <!-- /container -->
