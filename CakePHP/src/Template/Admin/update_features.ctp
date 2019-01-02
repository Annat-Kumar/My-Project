<div class="users form">
<form method="post" accept-charset="utf-8" action="" enctype="multipart/form-data">
<div style="display:none;"><input name="_method" value="POST" type="hidden"></div>  
<?= $this->Flash->render() ?> 
<fieldset>

        <legend>Update Features</legend>
        <div class="input text required">
			<label for="features-title">Title</label>
			<input name="features_title"  maxlength="50" id="features_title" required type="text" value="<?php echo $features['title'] ;?>">
		</div> 		
		<div class="input text required">
			<label for="features-desc">Description</label>						
			<div class="portlet-body form">
							
			<div class="form-body">
				<div class="form-group">
					<div class="col-md-11">						
						<textarea rows="12" cols="50" name="features_desc" id="summernote_1" required><?php echo $features['description'] ;?></textarea>						
					</div>
				</div>
			</div>
		
		</div>
	</div>
			
  </fieldset>
 <?php echo $this->Html->link('Back','/addfeatures' ,['class' => 'btn blue bck-btn fl-rt']);?>
<button type="submit">Submit</button>
</form>
</div>