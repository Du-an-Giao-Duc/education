	<h2>Add Class</h2>
	<?php echo form_open('admin/chuyen_de_admin/add'); ?>
	<p>
		<label for="subject">Chuong:</label>
		<input type='text' name='subject' id='chuong'>
	</p>
	<p>
		<label for="subject">Order number</label>
		<input type='text' name='order_number' id='order_number'>
	</p>
	<p>
		<label for="name">Chuong Name:</label>
		<input type='text' name='name' id='name'>
	</p>
	
	<p>
		<label for="description">Chuong Description:</label>
		<input type='text' name='description' id='description'>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>
	