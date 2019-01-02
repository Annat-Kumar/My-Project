<!-- src/Template/Users/update_profile.ctp -->

<!-- src/Template/Users/add.ctp -->

	<div class="users form">
		<form method="post" accept-charset="utf-8" action="">
			<div style="display:none;">
			<input name="_method" value="POST" type="hidden">
			</div>    
	<fieldset>
        <legend>Update your profile</legend>
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
   </fieldset>
  	
	<?php //echo $this->Html->link('Back','/userlist' ,['class' => 'btn-blue bck-btn fl-rt']);?>
	<button type="submit">Update</button>
</form>
</div>

 <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
	
<style>
.btn-blue {
color: #FFFFFF;
background-color: #3598dc;
padding: 15px 30px;
font-size: 16px;
text-transform: uppercase;
}
.btn-blue:hover {
color: #FFFFFF;
background-color: #3598dc;
}
</style>