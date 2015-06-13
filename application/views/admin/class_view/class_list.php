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
        var c = confirm("Bạn có chắc chắn muốn xóa lớp học này?");
        if (c)
        	window.location ="class_admin/delete/" + id;
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
 echo form_open('admin/class_admin');?>
		
		<div>
			<?php echo form_label('Subject:', 'subject'); ?>
			<?php echo form_dropdown('subject', $subject_options, 
				set_value('subject', $subject_id), 'id="subject"'); ?>
		</div>
		
		<div>
			<?php echo form_submit('submit', 'Search'); ?>
		</div>
<?php echo form_close(); ?>
	
<?php if(isset($records)):
if(!isset($subject_id)) {
	$subject_id = 0;
}
$fields = array(
		'id' => 'ID',
		'name' => 'Name',
		'subject_name' => 'Subject',
		'description' => 'Description'
);
?>
<table class='tblOverview'>
  <tr>
    <th style='width: 10%'></th>
    <th style='width: 10%'></th>
    <?php foreach($fields as $field_name => $field_display): ?>
			<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
				<?php echo anchor("admin/class_admin/index/$subject_id/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc') ,
					$field_display); ?>
			</th>
	<?php endforeach; ?>
  </tr>
  
  <?php foreach ($records as $class): ?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("admin/class_admin/update/$class->id", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Edit</image>",$pop_up_atts);?>
        </td>
         <td>
             <a href='#' onclick='showConfirmDelete(<?php echo $class->id;?>)'>
                <image src='<?php echo $base_url;?>images/delete/delete_16x16.png' alt='Delete'>Delete</image>
             </a>
        </td>
        <td><?php echo $class->id;?></td>
        <td><?php echo anchor("admin/chuong_admin/index/$class->id", "$class->name");?></td>
        <td><?php echo $class->subject_name;?></td>
        <td><?php echo $class->description;?></td>
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
<?php if(isset($subject_id) && $subject_id != 0){ echo anchor_popup("admin/class_admin/add", "<image src='$base_url/images/add/add_16x16.png' alt='Add'>Add subject</image>", $pop_up_atts);}?>
