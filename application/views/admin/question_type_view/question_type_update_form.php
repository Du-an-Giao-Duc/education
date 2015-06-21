	<h2>Cập Nhật Loại Câu Hỏi</h2>
	<?php if (isset($record)): $row = $record[0];
		  $hidden = array('id' => $row->id);
	?>
	
	<?php echo form_open('admin/question_type_admin/update','',$hidden); ?>
	
	<p>
		<?php echo form_label('Loại Câu Hỏi:', 'name'); ?>
		<?php echo form_input('name', $row->name, 'id="name"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Mô Tả:', 'description'); ?>
		<?php echo form_input('description', $row->description, 'id="description"'); ?>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	<?php else: ?>
	<h2>Không tìm thấy loại câu hỏi nào</h2>
	<?php endif;?>