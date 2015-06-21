	<script language="Javascript">

        function redirectToParentPage(){
            window.opener.location.href="<?php echo base_url();?>user_admin/subject_admin_role";
            self.close();
        }

    </script>
	<h2>Xác Nhận</h2>
	<?php if (isset($record)): $row = $record?>
	<p>
		<label for="username">User Name:</label>
		<label for='username'><?php echo $row['username'];?></label>
	</p>
	
	<p>
		<label for="role">Loại User:</label>
		<label for='role'><?php $roles = $this->config->item('roles');echo $roles[$row['role']];?></label>
	</p>
	<p>
		<label for="subjects">Môn học:</label>
		<ul>
		<?php foreach ($subjects as $subject) {?>
			<li><?php echo $subject->name;?></li>
		<?php }?>
		</ul>
	</p>
	<p>
		Xử lý thành công
	</p>
	
	<?php else: ?>
	<p>Error</p>
	<?php endif;
	$js = 'onClick="redirectToParentPage()"';
	echo form_button('button', 'Back', $js);
	?>
	