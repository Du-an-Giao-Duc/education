	<script language="Javascript">

        function redirectToParentPage(){
            window.opener.location.href="<?php echo base_url();?>admin/question_type_admin";
            self.close();
        }

    </script>
	<h2>Xác Nhận</h2>
	<?php if (isset($record)): $row = $record[0]?>
	<p>
		<input type="hidden" name='id' value=<?php echo $row->id;?>/>
		<label for="name">Loại Câu Hỏi:</label>
		<label for='name'><?php echo $row->name;?></label>
	</p>
	
	<p>
		<label for="desciption">Mô Tả:</label>
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
	
	