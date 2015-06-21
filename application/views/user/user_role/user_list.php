<script>
    function showConfirmDelete(id)
    {
        var c = confirm("Bạn có chắc chắn muốn xóa User này?");
        if (c)
        	window.location ="role_assign/delete/" + id;
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
		'username' => 'Username',
		'role'     => 'Loại User',
		'role_post'   => 'Quyền Đăng Câu Hỏi',
		'role_edit'   => 'Quyền Sửa Xóa Câu Hỏi',
		'email'       => 'Email',
		'reg_date'    => 'Ngày Tạo'
);
?>
<?php echo form_open('user_admin/role_assign'); ?>

<div>
		<?php echo form_label('Username:', 'username'); ?>
		<?php echo form_input('username', set_value('username'), 'id="username"'); ?>
</div>

<div>
		<?php echo form_submit('submit', 'Tìm Kiếm'); ?>
</div>

<?php echo form_close(); ?>
<table class='tblOverview'>
  <tr>
    <th style='width: 10%'></th>
    <th style='width: 10%'></th>
    <?php foreach($fields as $field_name => $field_display): ?>
			<th> <?php echo $field_display;?></th>
	<?php endforeach; ?>
  </tr>
  
  <?php foreach ($records as $user): ?>
  <tr>
  		<td>
  		 <?php 
  		 echo anchor_popup("user_admin/role_assign/update/$user->username", "<image src='$base_url/images/edit/edit_16x16.png' alt='Edit'>Sửa</image>",$pop_up_atts);?>
        </td>
         <td>
             <a href='#' onclick='showConfirmDelete("<?php echo $user->username;?>")'>
                <image src='<?php echo $base_url;?>images/delete/delete_16x16.png' alt='Delete'>Xóa</image>
             </a>
        </td>
        <td><?php echo $user->username;?></td>
        <td><?php $roles = $this->config->item('roles'); echo $roles[$user->role];?></td>
        <td><?php echo $user->role_post;?></td>
        <td><?php echo $user->role_edit;?></td>
        <td><?php echo $user->email;?></td>
        <td><?php echo $user->reg_date;?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php else: ?>
<h2>Không tìm thấy User nào</h2>
<?php endif;?>
