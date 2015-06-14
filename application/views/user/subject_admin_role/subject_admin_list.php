
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
echo form_open('user_admin/subject_admin_role'); ?>

<div>
		<?php echo form_label('Username:', 'username'); ?>
		<?php echo form_input('username', set_value('username'), 'id="username"'); ?>
</div>

<div>
		<?php echo form_submit('submit', 'Search'); ?>
</div>

<?php echo form_close(); 
if(isset($records)):
$fields = array(
		'username' => 'Username',
		'role'     => 'Role',
		'subjects'   => 'Subjects'
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
  		 echo anchor_popup("user_admin/subject_admin_role/update/$username", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Edit</image>",$pop_up_atts);?>
        </td>
        <td><?php echo $user['username'];?></td>
        <td><?php $roles = $this->config->item('roles'); echo $roles[$user['role']];?></td>
        <td><ul><?php $subjects = $user['subjects'];
        			  if($subjects) {
        			  	foreach ($subjects as $subject) {?>
        			  		<li><?php echo $subject->name;?></li>
        			  	<?php }
        			  }
        ?></ul></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php else: ?>
<h2>No records found</h2>
<?php endif;?>
