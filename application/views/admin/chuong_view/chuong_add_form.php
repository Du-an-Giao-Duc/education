	<h2>Thêm Chương</h2>
	<?php echo form_open('admin/chuong_admin/add'); ?>
	<p>
		<?php echo form_label('Lớp Học');?>
		<?php echo form_input('class', set_value('class', $class_name), 'id="class" readonly="true"');?>
	</p>
	<p>
		<?php echo form_label('Số Thứ Tự:', 'order_number'); ?>
		<?php echo form_dropdown('order_number', $order_number_options, 
			set_value('order_number', $order_number), 'id="order_number"'); ?>
	</p>
	<p>
		<?php echo form_label('Học Kì:', 'semester'); ?>
		<?php $semester_options = array(
				'1' => '1',
				'2' => '2'
		);
			echo form_dropdown('semester', $semester_options, 
			set_value('semester', '1'), 'id="semester"'); ?>
	</p>
	
	<p>
	<?php echo form_label('Tên Chương');?>
	<?php echo form_input('name', set_value('name',''), 'id="name"');?>
	</p>	
	
	<p>
	<?php echo form_label('Mô Tả Chương');?>
	<?php echo form_input('description', set_value('description',''), 'id="description"');?>
	</p>
	
	<p>
	<?php echo form_submit('submit','Submit');?>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">'); ?>
	