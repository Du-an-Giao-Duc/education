<script>
    function showConfirmDelete(id)
    {
        var c = confirm("Bạn có chắc chắn muốn xóa loại câu hỏi này?");
        if (c)
        	window.location ="question_type_admin/delete/" + id;
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
		'name' => 'Loại Câu Hỏi',
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
  
  <?php foreach ($records as $question_type): ?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("admin/question_type_admin/update/$question_type->id", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Sửa</image>",$pop_up_atts);?>
        </td>
         <td>
             <a href='#' onclick='showConfirmDelete(<?php echo $question_type->id;?>)'>
                <image src='<?php echo $base_url;?>images/delete/delete_16x16.png' alt='Delete'>Xóa</image>
             </a>
        </td>
        <td><?php echo $question_type->id;?></td>
        <td><?php echo $question_type->name ;?></td>
        <td><?php echo $question_type->description;?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php else: ?>
<h2>Không tìm thấy loại câu hỏi nào</h2>
<?php endif;?>
<?php echo anchor_popup("admin/question_type_admin/add", "<image src='$base_url/images/add/add_16x16.png' alt='Add'>Thêm Loại Câu Hỏi</image>", $pop_up_atts);?>

