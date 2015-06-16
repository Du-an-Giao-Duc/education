<style>
		.sort_asc:after {
			content: "▲";
		}
		.sort_desc:after {
			content: "▼";
		}
		label {
			display: inline-block;
			width: 120px;
		}
</style>

<script>
    function showConfirmDelete(id)
    {
        var c = confirm("Bạn có chắc chắn muốn xóa chương này?");
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
			<?php echo form_label('Subject:', 'subject'); ?>
			<?php $js = 'id="subject" onChange="get_class_options();"';echo form_dropdown('subject', $subject_options, 
				set_value('subject', $subject_id), $js); ?>
		</div>
		
		<div id='class_options'>
			<?php echo form_label('Class:', 'class'); ?>
			<?php echo form_dropdown('class', $class_options, 
				set_value('class', $class_id), 'id="class"'); ?>
		</div>
		<div id='chuong_options'>
			<?php echo form_label('Chuong:', 'chuong'); ?>
			<?php echo form_dropdown('chuonG', $chuong_options, 
				set_value('chuong', $chuong_id), 'id="chuong"'); ?>
		</div>
		<div id='chuyen_de_options'>
			<?php echo form_label('ChuyenDe:', 'chuyen_de'); ?>
			<?php echo form_dropdown('ChuyenDe', $chuyen_de_options, 
				set_value('chuyen_de', $chuyen_de_id), 'id="chuyen_de"'); ?>
		</div>
		<div>
			<?php echo form_submit('submit', 'Search'); ?>
		</div>
<?php echo form_close(); ?>
	
<?php if(isset($records)):
$fields = array(
		'id' => 'ID',
		'order_number' => 'Order Number',
		'name' => 'Name',
		'class_name' => 'Class',
		'chuong_name' => 'Chuong',
		'subject_name' =>'Subject',
		'chuyen_de_name' => 'ChuyenDe',
		'description' => 'Description'
);
?>
<table class='tblOverview'>
  <tr>
    <th style='width: 10%'></th>
    <th style='width: 10%'></th>
    <?php foreach($fields as $field_name => $field_display): ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
				<?php echo anchor("admin/dang_bai_admin/index/$class_id/$chuyen_de_id/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display); ?>
			</th>
	<?php endforeach; ?>
  </tr>
  
  <?php foreach ($records as $dangbai): ?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("admin/dang_bai_admin/update/$dangbai->id", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Edit</image>",$pop_up_atts);?>
        </td>
         <td>
             <a href='#' onclick='showConfirmDelete(<?php echo $dangbai->id;?>)'>
                <image src='<?php echo $base_url;?>images/delete/delete_16x16.png' alt='Delete'>Delete</image>
             </a>
        </td>
        <td><?php echo $dangbai->id;?></td>
        <td><?php echo $dangbai->order_number;?></td>
        <td><?php echo anchor("admin/dang_bai_admin/index/$dangbai->id", "$dangbai->name");?></td>
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
<h2>No records found</h2>
<?php endif;?>
<div id='add_chuong'>
<?php if(isset($class_id) && $class_id != 0){ echo anchor_popup("admin/chuyen_de_admin/add", "<image src='$base_url/images/add/add_16x16.png' alt='Add'>Add Chuong</image>", $pop_up_atts);}?>
</div>
