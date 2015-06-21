	<h2>Thêm Chuyên Đề</h2>
	<?php echo form_open('admin/chuyen_de_admin/add'); ?>
	<p>
		<?php echo form_label('Chương');?>
		<?php echo form_input('chuong', set_value('chuong', $chuong_name), 'id="chuong" readonly="true"');?>
	</p>
	<p>
		<?php echo form_label('Số Thứ Tự:', 'order_number'); ?>
		<?php echo form_dropdown('order_number', $order_number_options, 
			set_value('order_number', $order_number), 'id="order_number"'); ?>
	</p>
	
	<p>
	<?php echo form_label('Tên Chuyên Đề');?>
	<?php echo form_input('name', set_value('name',''), 'id="name"');?>
	</p>	
	
	<p>
	<?php echo form_label('Mô Tả Chuyên Đề');?>
	<?php echo form_input('description', set_value('description',''), 'id="description"');?>
	</p>
	
	<p>
	<?php echo form_submit('submit','Submit');?>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>