	<h2>Cập nhập Trường</h2>
	<?php if (isset($record)): $row = $record[0];
		  $hidden = array('id' => $row->id);
	?>
	
	<?php echo form_open('admin/school_admin/update','',$hidden); ?>
	
	<p>
		<?php echo form_label('Tên Trường:', 'name'); ?>
		<?php echo form_input('name', $row->name, 'id="name"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Mô tả Trường:', 'description'); ?>
		<?php echo form_input('description', $row->description, 'id="description"'); ?>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	<?php else: ?>
	<h2>No record to update</h2>
	<?php endif;?>