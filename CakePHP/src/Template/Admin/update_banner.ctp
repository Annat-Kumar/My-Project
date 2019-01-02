<div class="users form">
<form method="post" accept-charset="utf-8" action="" enctype="multipart/form-data">
<div style="display:none;"><input name="_method" value="POST" type="hidden"></div>  
<?= $this->Flash->render() ?>
  <fieldset>
        <legend>Update Banner</legend>
        <div class="input text required">
			<label for="slide-title">Slide Title</label>
			<input name="slide_title"  maxlength="50" id="slide_title" required type="text" value="<?php echo $banner['slide_title'];?>">
		</div> 
		<div class="input text required">
			<label for="slide-subtitle">Slide Sub Title</label>
			<input name="slide_subtitle"  maxlength="50" id="slide_subtitle" required type="text" value="<?php echo $banner['slide_subtitle'];?>">
		</div> 
		<div class="input text required">
			<label for="slide_desc">Slide Desc</label>
			<input name="slide_desc"   id="slide_desc" type="text" required value="<?php echo $banner['slide_desc'];?>">
		</div> 
		
		<div class="input file">
			 <div class="img-update">
				<?php echo $this->Html->image('/img/banner/'.$banner["img_name"].'',['class' => 'pull-left']); ?>
			 </div>	
			<div style="clear:both"></div>			 
			 <label for="update image" style="margin-top:2%">Update Image</label>
			 <input name="banner_image" type="file" id="banner_image"  />
		</div> 	
		
  </fieldset>
 <?php echo $this->Html->link('Back','/addbanner' ,['class' => 'btn blue bck-btn fl-rt']);?>
<button type="submit">Update</button>
</form>
</div>
