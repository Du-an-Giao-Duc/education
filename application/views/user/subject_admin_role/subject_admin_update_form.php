	<h2>Update</h2>
	<?php if (isset($record)): $row = $record;
	?>
	
	<?php echo form_open('user_admin/subject_admin_role/update'); ?>
	
	<p>
		<?php echo form_label('User Name:', 'username'); ?>
		<?php echo form_input('username', $row['username'], 'id="username" readonly="true"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Role:', 'role'); ?>
		<?php $roles = $this->config->item('roles'); echo form_input('role', $roles[$row['role']], 'id="role" readonly="true"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Subjects:', 'subjects'); ?>
		<ul>
		<?php foreach ($subjects as $subject) {?>
			<li>
			<?php echo form_label($subject->name, 'subject_name'); ?>
			<?php 
			$check = false;
			foreach ($selected_subjects as $selected) { if ($subject->id == $selected->id) $check = TRUE; };
			echo form_checkbox('role_code[]', set_value('role_code', $subject->id), $check, 'id="role_code"');?>
			</li>
		<?php }
		?>
		</ul>	
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	<?php else: ?>
	<h2>No record to update</h2>
	<?php endif;?>