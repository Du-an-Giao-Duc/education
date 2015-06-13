	<h2>Update</h2>
	<?php if (isset($record)): $row = $record[0];?>
	
	<?php echo form_open('admin/class_admin/update'); ?>
	
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		
		<label for="subject">Subject:</label>
		<input type='text' name='subject' id='subject' readonly='true' value='<?php echo $subject_name;?>'>
	</p>
	<p>	
		<label for="name">Class Name:</label>
		<input type='text' name='name' id='name' value='<?php echo $row->name;?>'>
	</p>
	
	<p>
		<label for="description">Class Description:</label>
		<input type='text' name='description' id='description' value='<?php echo $row->description;?>'>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>
	<?php else: ?>
	<h2>No record to update</h2>
	<?php endif;?>