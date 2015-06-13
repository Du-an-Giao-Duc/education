	<h2>Update</h2>
	<?php if (isset($record)): $row = $record[0];?>
	
	<?php echo form_open('admin/chuong_admin/update'); ?>
	
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		
		<label for="subject">Class:</label>
		<input type='text' name='class' id='class' readonly='true' value='<?php echo $class_name;?>'>
	</p>
	
	<p>
		<?php echo form_label('Order Number:', 'order_number'); ?>
		<?php echo form_dropdown('order_number', $order_number_options, 
			set_value('order_number', $row->order_number), 'id="order_number"'); ?>
	</p>
	<p>
		<?php echo form_label('Semester:', 'semester'); ?>
		<?php $semester_options = array(
				'1' => '1',
				'2' => '2'
		);
			echo form_dropdown('semester', $semester_options, 
			set_value('semester', $row->semester), 'id="semester"'); ?>
	</p>
	
	<p>	
		<label for="name">Chuong Name:</label>
		<input type='text' name='name' id='name' value='<?php echo $row->name;?>'>
	</p>
	
	<p>
		<label for="description">Chuong Description:</label>
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