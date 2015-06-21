<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
<script>
    function get_classes() {
    	var form_data = {
    		subject_id: $('#subject').val(),
    		ajax: '1'		
    	};
    	$.ajax({
    		url: "<?php echo site_url('admin/ajax/get_classes'); ?>",
    		type: 'POST',
    		data: form_data,
    		success: function(msg) {
    			$('#classes').html(msg);
    		}
    	});
    	
    	return false;
    }

</script>
	<h2>Cập Nhật User</h2>
	<?php if (isset($record)): $row = $record;
	?>
	
	<?php echo form_open('user_admin/class_admin_role/update'); ?>
	
	<p>
		<?php echo form_label('User Name:', 'username'); ?>
		<?php echo form_input('username', $row['username'], 'id="username" readonly="true"'); ?>
	</p>
	
	<p>
		<?php echo form_label('Loại User:', 'role'); ?>
		<?php $roles = $this->config->item('roles'); echo form_input('role', $roles[$row['role']], 'id="role" readonly="true"'); ?>
	</p>
	
	<?php if($selected_classes) {?>
	<p>
		<?php echo form_label('Môn Học:', 'subject_name'); ?>
		<?php echo form_input('subject', $row['subject_name'], 'id="subject_name" readonly="true"'); ?>
	</p>
	<p>
		<?php echo form_label('Lớp Học:', 'classes'); ?>
		<ul>
		<?php foreach ($classes as $class) {?>
			<li>
			<?php echo form_label($class->name, 'class_name'); ?>
			<?php 
			$check = false;
			foreach ($selected_classes as $selected) { if ($class->id == $selected->id) $check = TRUE; };
			echo form_checkbox('role_code[]', set_value('role_code', $class->id), $check, 'id="role_code"');?>
			</li>
		<?php }
		?>
		</ul>	
	</p>
	<?php } else {?>
		<p>
					<?php echo form_label('Môn Học:', 'subject_name'); ?>
					<?php $js = 'id="subject" onChange="get_classes();"';echo form_dropdown('subject', $subject_options, 
						set_value('subject', '0'), $js); ?>
		</p>
		<div id="classes">
		</div>
	<?php }?>
	<p>
		<input type='submit' name='submit' value='Submit'/>
	</p>
	<?php echo form_close(); ?>
	<?php echo validation_errors('<p class="error">');?>
	<?php else: ?>
	<h2>Không tìm thấy User nào</h2>
	<?php endif;?>