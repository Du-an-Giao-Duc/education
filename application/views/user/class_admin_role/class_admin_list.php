
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
echo form_open('user_admin/class_admin_role'); ?>

<div>
		<?php echo form_label('Username:', 'username'); ?>
		<?php echo form_input('username', set_value('username'), 'id="username"'); ?>
</div>

<div>
		<?php echo form_submit('submit', 'Tìm Kiếm'); ?>
</div>

<?php echo form_close(); 
if(isset($records)):
$fields = array(
		'username'       => 'Username',
		'role'           => 'Loại User',
		'subject_name'   => 'Môn Học',
		'classes'        => 'Lớp Học'
);
?>

<table class='tblOverview'>
  <tr>
    <th style='width: 10%'></th>
    <?php foreach($fields as $field_name => $field_display): ?>
			<th> <?php echo $field_display;?></th>
	<?php endforeach; ?>
  </tr>
  
  <?php foreach ($records as $user): $username = $user['username']?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("user_admin/class_admin_role/update/$username", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Sửa</image>",$pop_up_atts);?>
        </td>
        <td><?php echo $user['username'];?></td>
        <td><?php $roles = $this->config->item('roles'); echo $roles[$user['role']];?></td>
        <td><?php echo $user['subject_name'];?></td>
        <td><ul><?php $classes = $user['classes'];
        			  if($classes) {
        			  	foreach ($classes as $class) {?>
        			  		<li><?php echo $class->name;?></li>
        			  	<?php }
        			  }
        ?></ul></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php else: ?>
<h2>Không tìm thấy User nào</h2>
<?php endif;?>
