
<script>
    function showConfirmDelete(id)
    {
        var c = confirm("Bạn có chắc chắn muốn xóa dạng bài này?");
        if (c)
        	window.location ="dang_bai_admin/delete/" + id;
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
        		$('#chuong').change();
        	}
        });
        	
        return false;
    }

    function get_chuyen_de_options() {
    	var form_data = {
        		chuong_id: $('#chuong').val(),
        		ajax: '1'		
        };
        	
        $.ajax({
        	url: "<?php echo site_url('admin/ajax/get_chuyen_de_options'); ?>",
        	type: 'POST',
        	data: form_data,
        	success: function(msg) {
        		$('#chuyen_de').html(msg);
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
 echo form_open('admin/dang_bai_admin');?>
		
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
			<?php $js = 'id="chuong" onChange="get_chuyen_de_options();"';echo form_dropdown('chuong', $chuong_options, 
				set_value('chuong', $chuong_id), $js); ?>
		</div>
		
		<div id='chuyen_de_options'>
			<?php echo form_label('Chuyên Đề:', 'chuyen_de'); ?>
			<?php echo form_dropdown('chuyen_de', $chuyen_de_options, 
				set_value('chuyen_de', $chuyen_de_id), 'id="chuyen_de"'); ?>
		</div>
		<div>
			<?php echo form_submit('submit', 'Tìm Kiếm'); ?>
		</div>
<?php echo form_close(); ?>
	
<?php if(isset($records)):
$fields = array(
		'id' => 'ID',
		'order_number' 		=> 'Số Thứ Tự',
		'name' 				=> 'Tên Dạng Bài',
		'chuyen_de_name' 	=>'Chuyên Đề',
		'chuong_name' 		=> 'Chương',
		'class_name' 		=> 'Lớp Học',
		'subject_name' 		=>'Môn Học',
		'description' 		=> 'Mô Tả Dạng Bài'
);
?>
<table class='tblOverview'>
  <tr>
    <th style='width: 10%'></th>
    <th style='width: 10%'></th>
    <?php foreach($fields as $field_name => $field_display): ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
				<?php echo anchor("admin/dang_bai_admin/index/$chuyen_de_id/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display); ?>
			</th>
	<?php endforeach; ?>
  </tr>
  
  <?php foreach ($records as $dangbai): ?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("admin/dang_bai_admin/update/$dangbai->id", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Sửa</image>",$pop_up_atts);?>
        </td>
         <td>
             <a href='#' onclick='showConfirmDelete(<?php echo $dangbai->id;?>)'>
                <image src='<?php echo $base_url;?>images/delete/delete_16x16.png' alt='Delete'>Xóa</image>
             </a>
        </td>
        <td><?php echo $dangbai->id;?></td>
        <td><?php echo $dangbai->order_number;?></td>
        <td><?php echo $dangbai->name;?></td>
        <td><?php echo $dangbai->chuyen_de_name;?></td>
        <td><?php echo $dangbai->chuong_name;?></td>
        <td><?php echo $dangbai->class_name;?></td>
        <td><?php echo $dangbai->subject_name;?></td>
        <td><?php echo $dangbai->description;?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php if (strlen($pagination)): ?>
	<div>
		Pages: <?php echo $pagination; ?>
	</div>
<?php endif; ?>
<?php else: ?>
<h2>Không tìm thấy dạng bài nào</h2>
<?php endif;?>
<?php if(isset($chuyen_de_id) && $chuyen_de_id != 0){ echo anchor_popup("admin/dang_bai_admin/add", "<image src='$base_url/images/add/add_16x16.png' alt='Add'>Thêm Dạng Bài</image>", $pop_up_atts);}?>
