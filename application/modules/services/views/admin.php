<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('adm_service_heading');?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">

		<p><?php echo lang('group_subheading');?></p>

		<div id="infoMessage"><?php echo $message;?></div>

		<table class="table table-condensed table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th><?php echo lang('group_name_th');?></th>
					<th><?php echo lang('group_desc_th');?></th>
					<?php if ($this->ion_auth->is_admin()): ?>
						<th><?php echo lang('group_action_th');?></th>
					<?php endif ?>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($groups as $group):?>
				<tr>
		            <td><?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?></td>
		            <td><?php echo htmlspecialchars($group->description,ENT_QUOTES,'UTF-8');?></td>
		            <?php if ($this->ion_auth->is_admin()): ?>
						<td><?php echo anchor("groups/edit_group/".$group->id, 'Edit') ;?></td>
		        	<?php endif ?>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>

		<?php if ($this->ion_auth->is_admin()): ?>
			<?php echo anchor('groups/create_group', lang('index_create_group_link'))?></p>
		<?php endif ?>

    </div>
    <!-- /.col-lg-12 -->
</div>