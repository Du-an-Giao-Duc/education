
<script>
    function showConfirmDelete(id)
    {
        var c = confirm("Bạn có chắc chắn muốn xóa chuyên đề này?");
        if (c)
        	window.location ="chuyen_de_admin/delete/" + id;
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
    			$('#class').change();
    		}
    	});
    	
    	return false;
    }

    function get_chuong_options() {
    	var form_data = {
        		class_id: $('#class').val(),
        		ajax: '1'		
        };
        	
        $.ajax({
        	url: "<?php echo site_url('admin/ajax/get_chuong_options'); ?>",
        	type: 'POST',
        	data: form_data,
        	success: function(msg) {
        		$('#chuong').html(msg);
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
 echo form_open('admin/chuyen_de_admin');?>
		
		<div>
			<?php echo form_label('Môn Học:', 'subject'); ?>
			<?php $js = 'id="subject" onChange="get_class_options();"';echo form_dropdown('subject', $subject_options, 
				set_value('subject', $subject_id), $js); ?>
		</div>
		
		<div id='class_options'>
			<?php echo form_label('Lớp Học:', 'class'); ?>
			<?php $js = 'id="class" onChange="get_chuong_options();"';echo form_dropdown('class', $class_options, 
				set_value('class', $class_id), $js); ?>
		</div>
		<div id='chuong_options'>
			<?php echo form_label('Chương:', 'chuong'); ?>
			<?php echo form_dropdown('chuong', $chuong_options, 
				set_value('chuong', $chuong_id), 'id="chuong"'); ?>
		</div>
		<div>
			<?php echo form_submit('submit', 'Tìm Kiếm'); ?>
		</div>
<?php echo form_close(); ?>
	
<?php if(isset($records)):
$fields = array(
		'id' => 'ID',
		'order_number' => 'Số Thứ Tự',
		'name' => 'Tên Chuyên Đề',
		'chuong_name' => 'Chương',
		'class_name' => 'Lớp Học',
		'subject_name' =>'Môn Học',
		'description' => 'Mô Tả Chuyên Đề'
);
?>
<table class='tblOverview'>
  <tr>
    <th style='width: 10%'></th>
    <th style='width: 10%'></th>
    <?php foreach($fields as $field_name => $field_display): ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
				<?php echo anchor("admin/chuyen_de_admin/index/$chuong_id/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display); ?>
			</th>
	<?php endforeach; ?>
  </tr>
  
  <?php foreach ($records as $chuyende): ?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("admin/chuyen_de_admin/update/$chuyende->id", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Sửa</image>",$pop_up_atts);?>
        </td>
         <td>
             <a href='#' onclick='showConfirmDelete(<?php echo $chuyende->id;?>)'>
                <image src='<?php echo $base_url;?>images/delete/delete_16x16.png' alt='Delete'>Xóa</image>
             </a>
        </td>
        <td><?php echo $chuyende->id;?></td>
        <td><?php echo $chuyende->order_number;?></td>
        <td><?php echo anchor("admin/dang_bai_admin/index/$chuyende->id", "$chuyende->name");?></td>
         <td><?php echo $chuyende->chuong_name;?></td>
        <td><?php echo $chuyende->class_name;?></td>
         <td><?php echo $chuyende->subject_name;?></td>
        <td><?php echo $chuyende->description;?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php if (strlen($pagination)): ?>
	<div>
		Pages: <?php echo $pagination; ?>
	</div>
<?php endif; ?>
<?php else: ?>
<h2>Không tìm thấy chuyên đề nào</h2>
<?php endif;?>
<?php if(isset($chuong_id) && $chuong_id != 0){ echo anchor_popup("admin/chuyen_de_admin/add", "<image src='$base_url/images/add/add_16x16.png' alt='Add'>Thêm Chuyên Đề</image>", $pop_up_atts);}?>
