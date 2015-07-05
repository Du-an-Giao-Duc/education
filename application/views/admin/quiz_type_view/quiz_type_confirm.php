	<script language="Javascript">

        function redirectToParentPage(){
            window.opener.location.href="<?php echo base_url();?>admin/quiz_type_admin";
            self.close();
        }

    </script>
	<h2>Confirm</h2>
	<?php if (isset($record)): $row = $record[0]?>
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		<label for="name">Name:</label>
		<label for='name'><?php echo $row->name;?></label>
	</p>
	
	<p>
		<label for="desciption">Description:</label>
		<label for='description'><?php echo $row->description;?></label>
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
	
	