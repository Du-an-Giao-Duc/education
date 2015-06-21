	<h2>Thêm Dạng Bài</h2>
	<?php echo form_open('admin/dang_bai_admin/add'); ?>
	<p>
		<?php echo form_label('Chuyên Đề');?>
		<?php echo form_input('chuyen_de', set_value('chuyen_de', $chuyen_de_name), 'id="chuyen_de" readonly="true"');?>
	</p>
	<p>
		<?php echo form_label('Số Thứ Tự:', 'order_number'); ?>
		<?php echo form_dropdown('order_number', $order_number_options, 
			set_value('order_number', $order_number), 'id="order_number"'); ?>
	</p>
	
	<p>
	<?php echo form_label('Tên Dạng Bài');?>
	<?php echo form_input('name', set_value('name',''), 'id="name"');?>
	</p>	
	
	<p>
	<?php echo form_label('Mô Tả Dạng Bài');?>
	<?php echo form_input('description', set_value('description',''), 'id="description"');?>
	</p>
	
	<p>
	<?php echo form_submit('submit','Submit');?>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>