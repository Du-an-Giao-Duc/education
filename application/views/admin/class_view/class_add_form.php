	<h2>Thêm Lớp Học</h2>
	<?php echo form_open('admin/class_admin/add'); ?>
	<p>
		<label for="subject">Môn Học:</label>
		<input type='text' name='subject' id='subject' readonly='true' value='<?php echo $subject_name;?>'>
	</p>
	<p>
		<label for="name">Tên Lớp Học:</label>
		<?php echo form_input('name', set_value('name',''), 'id="name"');?>
	</p>
	
	<p>
		<label for="description">Mô Tả Lớp Học:</label>
		<?php echo form_input('description', set_value('description',''), 'id="description"')?>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>
	