	<script language="Javascript">

        function redirectToParentPage(){
            window.opener.location.href="<?php echo base_url();?>admin/chuyen_de_admin";
            self.close();
        }

    </script>
	<h2>Xác Nhận</h2>
	<?php if (isset($record)): $row = $record[0]?>
	<p>
		<label for="order_number">Số Thứ Tự:</label>
		<label for='order_number'><?php echo $row->order_number;?></label>
	</p>
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		<label for="name">Tên Chuyên Đề:</label>
		<label for='name'><?php echo $row->name;?></label>
	</p>
	
	<p>
		<label for="desciption">Mô Tả Chuyên Đề:</label>
		<label for='description'><?php echo $row->description;?></label>
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
	
	