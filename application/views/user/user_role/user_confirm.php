	<script language="Javascript">

        function redirectToParentPage(){
            window.opener.location.href="<?php echo base_url();?>user_admin/role_assign";
            self.close();
        }

    </script>
	<h2>Xác Nhận</h2>
	<?php if (isset($record)): $row = $record[0]?>
	<p>
		<label for="username">User Name:</label>
		<label for='username'><?php echo $row->username;?></label>
	</p>
	
	<p>
		<label for="role">Loại User:</label>
		<label for='role'><?php $roles = $this->config->item('roles');echo $roles[$row->role];?></label>
	</p>
	<p>
		<label for="role_post">Quyền Đăng Câu Hỏi:</label>
		<label for='role_post'><?php echo $row->role_post;?></label>
	</p>
	<p>
		<label for="role_edit">Quyền Sửa Xóa Câu Hỏi:</label>
		<label for='role_edit'><?php echo $row->role_edit;?></label>
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
	
	