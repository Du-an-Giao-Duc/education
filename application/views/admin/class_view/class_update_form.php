	<h2>Cập Nhật Lớp Học</h2>
	<?php if (isset($record)): $row = $record[0];?>
	
	<?php echo form_open('admin/class_admin/update'); ?>
	
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		
		<label for="subject">Môn Học:</label>
		<input type='text' name='subject' id='subject' readonly='true' value='<?php echo $subject_name;?>'>
	</p>
	<p>	
		<label for="name">Tên Lớp Học:</label>
		<input type='text' name='name' id='name' value='<?php echo $row->name;?>'>
	</p>
	
	<p>
		<label for="description">Mô Tả Lớp Học:</label>
		<input type='text' name='description' id='description' value='<?php echo $row->description;?>'>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>
	<?php else: ?>
	<h2>Không tìm thấy lớp học nào</h2>
	<?php endif;?>