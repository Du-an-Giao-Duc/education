	<script language="Javascript">

        function redirectToParentPage(){
            window.opener.location.href="<?php echo base_url();?>user_admin/class_admin_role";
            self.close();
        }

    </script>
	<h2>Confirm</h2>
	<?php if (isset($record)): $row = $record?>
	<p>
		<label for="username">User Name:</label>
		<label for='username'><?php echo $row['username'];?></label>
	</p>
	
	<p>
		<label for="role">Role:</label>
		<label for='role'><?php $roles = $this->config->item('roles');echo $roles[$row['role']];?></label>
	</p>
	
	<p>
		<label for="subject_name">Subject:</label>
		<label for='subject_name'><?php echo $row['subject_name'];?></label>
	</p>
	
	<p>
		<label for="classes">Classes:</label>
		<ul>
		<?php foreach ($classes as $class) {?>
			<li><?php echo $class->name;?></li>
		<?php }?>
		</ul>
	</p>
	<p>
		Action is processed successfully.
	</p>
	
	<?php else: ?>
	<p>Error</p>
	<?php endif;
	$js = 'onClick="redirectToParentPage()"';
	echo form_button('button', 'Back', $js);
	?>
	