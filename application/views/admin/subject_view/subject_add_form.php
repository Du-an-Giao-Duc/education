	<h2>Thêm Môn Học</h2>
	<?php echo form_open('admin/subject_admin/add'); ?>
	
	<p>
		<?php echo form_label('Tên Môn Học:', 'name'); ?>
		<?php echo form_input('name', set_value('name'), 'id="name"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Mô Tả Môn Học:', 'description'); ?>
		<?php echo form_input('description', set_value('description'), 'id="description"'); ?>
	</p>
	
	<p>
		<?php echo form_submit('submit', 'Submit'); ?>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	