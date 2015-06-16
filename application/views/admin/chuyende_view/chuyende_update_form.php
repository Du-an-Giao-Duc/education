	<h2>Update</h2>
	<?php if (isset($record)): $row = $record[0];?>
	
	<?php echo form_open('admin/chuyen_de_admin/update'); ?>
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		
		<label for="chuong">Chuong:</label>
		<input type='text' name='class' id='chuong' readonly='true' value='<?php echo $chuong_name;?>'>
	</p>
	<p>
		<label for="order_number">Order number:</label>
		<input type='text' name='class' id='order_number' readonly='true' value='<?php echo $row->order_number;?>'>
	</p>
	<p>	
		<label for="name">Chuyen de Name:</label>
		<input type='text' name='name' id='name' value='<?php echo $row->name;?>'>
	</p>
	
	<p>
		<label for="description">Chuyen de Description:</label>
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