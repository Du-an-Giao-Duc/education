	<h2>Update</h2>
	<?php if (isset($record)): $row = $record[0];
	?>
	
	<?php echo form_open('user_admin/role_assign/update'); ?>
	
	<p>
		<?php echo form_label('User Name:', 'username'); ?>
		<?php echo form_input('username', $row->username, 'id="username" readonly="true"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Role:', 'role'); ?>
		<?php echo form_dropdown('role', $role_options, set_value('role', $row->role),'id="role"');?>
	</p>
	
	<p>
		<?php echo form_label('Role Post:', 'role_post'); ?>
		<?php echo form_checkbox('role_post', set_value('role_post', '1'), ($row->role_post=='1'?TRUE:FALSE),'id="role_post"');?>
	</p>
	
	<p>
		<?php echo form_label('Role Edit:', 'role_edit'); ?>
		<?php echo form_checkbox('role_edit', set_value('role_edit', '1'), ($row->role_edit=='1'?TRUE:FALSE),'id="role_edit"');?>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	<?php else: ?>
	<h2>No record to update</h2>
	<?php endif;?>