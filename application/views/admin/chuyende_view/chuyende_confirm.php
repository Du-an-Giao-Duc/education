	<script language="Javascript">

        function redirectToParentPage(){
            window.opener.location.href="<?php echo base_url();?>admin/chuyen_de_admin";
            self.close();
        }

    </script>
	<h2>Confirm</h2>
	<?php if (isset($record)): $row = $record[0]?>
	<p>
		<label for="order_number">Order Number:</label>
		<label for='order_number'><?php echo $row->order_number;?></label>
	</p>
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
	
	