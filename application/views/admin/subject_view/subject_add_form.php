	<h2>Add Subject</h2>
	<?php echo form_open('admin/subject_admin/add'); ?>
	
	<p>
		<?php echo form_label('Subject Name:', 'name'); ?>
		<?php echo form_input('name', set_value('name'), 'id="name"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Subject Description:', 'description'); ?>
		<?php echo form_input('description', set_value('description'), 'id="description"'); ?>
	</p>
	
	<p>
		<?php echo form_submit('submit', 'Submit'); ?>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	