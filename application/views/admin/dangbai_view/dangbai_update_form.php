	<h2>Cập Nhật Dạng Bài</h2>
	<?php if (isset($record)): $row = $record[0];?>
	
	<?php echo form_open('admin/dang_bai_admin/update'); ?>
	
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		
		<label for="chuyen_de">Chuyên Đề:</label>
		<input type='text' name='chuyen_de' id='chuyen_de' readonly='true' value='<?php echo $chuyen_de_name;?>'>
	</p>
	
	<p>
		<?php echo form_label('Số Thứ Tự:', 'order_number'); ?>
		<?php echo form_dropdown('order_number', $order_number_options, 
			set_value('order_number', $row->order_number), 'id="order_number"'); ?>
	</p>
	
	<p>	
		<label for="name">Tên Dạng Bài:</label>
		<input type='text' name='name' id='name' value='<?php echo $row->name;?>'>
	</p>
	
	<p>
		<label for="description">Mô Tả Dạng Bài:</label>
		<input type='text' name='description' id='description' value='<?php echo $row->description;?>'>
	</p>
	
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>
	<?php else: ?>
	<h2>Không tìm thấy dạng bài nào</h2>
	<?php endif;?>