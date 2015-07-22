<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('index_heading');?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <p><?php echo lang('index_subheading');?></p>

		<div id="infoMessage"><?php echo $message;?></div>

		<table class="table table-condensed table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th><?php echo lang('index_fname_th');?></th>
					<!-- <th><?php //echo lang('index_lname_th');?></th> -->
					<th><?php echo lang('index_email_th');?></th>
					<?php if ($this->ion_auth->is_admin()): ?>
						<th><?php echo lang('index_groups_th');?></th>
					<?php endif ?>
					<th><?php echo lang('index_status_th');?></th>
					<th><?php echo lang('index_action_th');?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $user):?>
				<tr>
		            <!-- <td><?php //echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td> -->
		            <td><?php echo htmlspecialchars($user->first_name . ' ' . $user->last_name,ENT_QUOTES,'UTF-8');?></td>
		            <!-- <td><?php //echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td> -->
		            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
		            <?php if ($this->ion_auth->is_admin()): ?>
						<td>
							<ul>
							<?php foreach ($user->groups as $group):?>
								<!-- <li><?php //echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ;?></li> -->
								<li><?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?></li><!-- <br /> -->
			                <?php endforeach?>

							</ul>

						</td>
		        	<?php endif ?>
					<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
					<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>

		<p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>

    </div>
    <!-- /.col-lg-12 -->
</div>