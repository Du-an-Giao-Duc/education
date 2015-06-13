	<h2>Add Class</h2>
	<?php echo form_open('admin/class_admin/add'); ?>
	<p>
		<label for="subject">Subject:</label>
		<input type='text' name='subject' id='subject' readonly='true' value='<?php echo $subject_name;?>'>
	</p>
	<p>
		<label for="name">Class Name:</label>
		<input type='text' name='name' id='name'>
	</p>
	
	<p>
		<label for="description">Class Description:</label>
		<input type='text' name='description' id='description'>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>
	