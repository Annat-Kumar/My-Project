<!-- src/Template/Users/edit-user.ctp -->

<!-- src/Template/Users/add.ctp -->

<div class="users form">
<?= $this->Flash->render() ?> 
	<form method="post" accept-charset="utf-8" action="">
		<div style="display:none;">
		<input name="_method" value="POST" type="hidden">
	</div>    
	<fieldset>
        <legend>Edit User Details</legend>
        <div class="input text required">
			<label for="username">Username</label>
			<input name="username" required="required" maxlength="50" id="username" type="text" value="<?php echo $user['username']; ?>">
		</div>
       
		<div class="input email required">
			<label for="email">Email</label>
			<input name="email" required="required" maxlength="50" id="email" type="email" value="<?php  echo $user['email']; ?>" readonly>
		</div>	
		<div class="input tel required">
			<label for="phone">Phone</label>
			<input name="phone" required="required" maxlength="50" id="phone" type="tel" value="<?php  echo $user['phone']; ?>">
		</div>  
		<div class="input select required">
			<label for="role">Role</label>
			<select name="role" required="required" id="role">
				<option value="admin" <?php if($user['role'] == 'admin') echo 'selected="selected"'; ?>>Admin</option>
				<option value="author" <?php if($user['role'] == 'user') echo 'selected="selected"'; ?>>User</option>
			</select>
		</div>
		  		
   </fieldset>

<button type="submit">Update</button></form></div> 
 <?php echo $this->Html->link('Back','/userlist' ,['class' => 'btn blue bck-btn fl-rt']);?>

