	<h2>Thêm Loại Câu Hỏi</h2>
	<?php echo form_open('admin/question_type_admin/add'); ?>
	
	<p>
		<?php echo form_label('Loại Câu Hỏi:', 'name'); ?>
		<?php echo form_input('name', set_value('name'), 'id="name"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Mô Tả:', 'description'); ?>
		<?php echo form_input('description', set_value('description'), 'id="description"'); ?>
	</p>
	
	<p>
		<?php echo form_submit('submit', 'Submit'); ?>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	