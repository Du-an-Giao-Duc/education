	<h2>Add Class</h2>
	<?php echo form_open('admin/chuong_admin/add'); ?>
	<p>
		<label for="subject">Class:</label>
		<input type='text' name='subject' id='subject' readonly='true' value='<?php echo $class_name;?>'>
	</p>
	<p>
		<?php echo form_label('Order Number:', 'order_number'); ?>
		<?php echo form_dropdown('order_number', $order_number_options, 
			set_value('order_number', $order_number), 'id="order_number"'); ?>
	</p>
	<p>
		<?php echo form_label('Semester:', 'semester'); ?>
		<?php $semester_options = array(
				'1' => '1',
				'2' => '2'
		);
			echo form_dropdown('semester', $semester_options, 
			set_value('semester', '1'), 'id="semester"'); ?>
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
	