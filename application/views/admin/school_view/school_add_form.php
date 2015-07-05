	<h2>Thêm Trường</h2>
	<?php echo form_open('admin/school_admin/add'); ?>
	
	<p>
		<?php echo form_label('Tên Trường:', 'name'); ?>
		<?php echo form_input('name', set_value('name'), 'id="name"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Mô tả:', 'description'); ?>
		<?php echo form_input('description', set_value('description'), 'id="description"'); ?>
	</p>
	
	<p>
		<?php echo form_submit('submit', 'Submit'); ?>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	