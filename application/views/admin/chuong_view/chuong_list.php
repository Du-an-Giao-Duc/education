
<script>
    function showConfirmDelete(id)
    {
        var c = confirm("Bạn có chắc chắn muốn xóa chương này?");
        if (c)
        	window.location ="chuong_admin/delete/" + id;
    }

    function get_class_options() {
    	var form_data = {
    		subject_id: $('#subject').val(),
    		ajax: '1'		
    	};
    	
    	$.ajax({
    		url: "<?php echo site_url('admin/ajax/get_class_options'); ?>",
    		type: 'POST',
    		data: form_data,
    		success: function(msg) {
    			$('#class').html(msg);
    		}
    	});
    	
    	return false;
    }

</script>
<?php $base_url = base_url();
$pop_up_atts = array(
		'width'      => '800',
		'height'     => '600',
		'scrollbars' => 'yes',
		'status'     => 'yes',
		'resizable'  => 'yes',
		'screenx'    => '400',
		'screeny'    => '300'
);
 echo form_open('admin/chuong_admin');?>
		
		<div>
			<?php echo form_label('Môn Học:', 'subject'); ?>
			<?php $js = 'id="subject" onChange="get_class_options();"';echo form_dropdown('subject', $subject_options, 
				set_value('subject', $subject_id), $js); ?>
		</div>
		
		<div id='class_options'>
			<?php echo form_label('Lớp Học:', 'class'); ?>
			<?php echo form_dropdown('class', $class_options, 
				set_value('class', $class_id), 'id="class"'); ?>
		</div>
		<div>
			<?php echo form_submit('submit', 'Tìm Kiếm'); ?>
		</div>
<?php echo form_close(); ?>
	
<?php if(isset($records)):
$fields = array(
		'id' => 'ID',
		'order_number' => 'Số Thứ Tự',
		'semester' => 'Học Kì',
		'name' => 'Tên Chương',
		'class_name' => 'Lớp Học',
		'description' => 'Mô Tả Chương'
);
?>
<table class='tblOverview'>
  <tr>
    <th style='width: 10%'></th>
    <th style='width: 10%'></th>
    <?php foreach($fields as $field_name => $field_display): ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
				<?php echo anchor("admin/chuong_admin/index/$class_id/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display); ?>
			</th>
	<?php endforeach; ?>
  </tr>
  
  <?php foreach ($records as $chuong): ?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("admin/chuong_admin/update/$chuong->id", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Sửa</image>",$pop_up_atts);?>
        </td>
         <td>
             <a href='#' onclick='showConfirmDelete(<?php echo $chuong->id;?>)'>
                <image src='<?php echo $base_url;?>images/delete/delete_16x16.png' alt='Delete'>Xóa</image>
             </a>
        </td>
        <td><?php echo $chuong->id;?></td>
        <td><?php echo $chuong->order_number;?></td>
        <td><?php echo $chuong->semester;?></td>
        <td><?php echo anchor("admin/chuyen_de_admin/index/$chuong->id", "$chuong->name");?></td>
        <td><?php echo $chuong->class_name;?></td>
        <td><?php echo $chuong->description;?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php if (strlen($pagination)): ?>
	<div>
		Pages: <?php echo $pagination; ?>
	</div>
<?php endif; ?>
<?php else: ?>
<h2>Không tìm thấy chương nào</h2>
<?php endif;?>
<div id='add_chuong'>
<?php if(isset($class_id) && $class_id != 0){ echo anchor_popup("admin/chuong_admin/add", "<image src='$base_url/images/add/add_16x16.png' alt='Add'>Thêm Chương</image>", $pop_up_atts);}?>
</div>
