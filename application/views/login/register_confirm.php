<?php if(isset($user)) {?>
<table>
<tr>
<td><?php echo $user->username;?></td>
<td><?php echo $user->password;?></td>
<td><?php echo $user->email;?></td>
</tr>
</table>
<?php }?>
<?php echo validation_errors('<p class="error">');?>