
<script>
    function showConfirmDelete(id)
    {
        var c = confirm("Bạn có chắc chắn muốn xóa trường/đại học này?");
        if (c)
        	window.location ="school_admin/delete/" + id;
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
if(isset($records)):
$fields = array(
		'id' => 'ID',
		'name' => 'Tên',
		'description' => 'Mô Tả'
);
?>
<table class='tblOverview'>
  <tr>
    <th style='width: 10%'></th>
    <th style='width: 10%'></th>
    <?php foreach($fields as $field_name => $field_display): ?>
			<th> <?php echo $field_display;?></th>
	<?php endforeach; ?>
  </tr>
  
  <?php foreach ($records as $school): ?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("admin/school_admin/update/$school->id", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Sửa</image>",$pop_up_atts);?>
        </td>
         <td>
             <a href='#' onclick='showConfirmDelete(<?php echo $school->id;?>)'>
                <image src='<?php echo $base_url;?>images/delete/delete_16x16.png' alt='Delete'>Xóa</image>
             </a>
        </td>
        <td><?php echo $school->id;?></td>
        <td><?php echo $school->name;?> </td>
        <td><?php echo $school->description;?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php else: ?>
<h2>Không tìm thấy trường/đại học nào</h2>
<?php endif;?>
<?php echo anchor_popup("admin/school_admin/add", "<image src='$base_url/images/add/add_16x16.png' alt='Add'>Thêm Trường/Đại Học</image>", $pop_up_atts);?>
        