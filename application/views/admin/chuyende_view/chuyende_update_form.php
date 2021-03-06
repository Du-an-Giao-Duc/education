	<h2>Cập Nhật Chuyên Đề</h2>
	<?php if (isset($record)): $row = $record[0];?>
	
	<?php echo form_open('admin/chuyen_de_admin/update'); ?>
	
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		
		<label for="subject">Chương:</label>
		<input type='text' name='chuong' id='class' readonly='true' value='<?php echo $chuong_name;?>'>
	</p>
	
	<p>
		<?php echo form_label('Số Thứ Tự:', 'order_number'); ?>
		<?php echo form_dropdown('order_number', $order_number_options, 
			set_value('order_number', $row->order_number), 'id="order_number"'); ?>
	</p>
	
	<p>	
		<label for="name">Tên Chuyên Đề:</label>
		<input type='text' name='name' id='name' value='<?php echo $row->name;?>'>
	</p>
	
	<p>
		<label for="description">Mô Tả Chuyên Đề:</label>
		<input type='text' name='description' id='description' value='<?php echo $row->description;?>'>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>
	<?php else: ?>
	<h2>Không tìm thấy chuyên đề nào</h2>
	<?php endif;?>