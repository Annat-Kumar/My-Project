<div class="users form">
<form method="post" accept-charset="utf-8" action="" enctype="multipart/form-data">
<div style="display:none;"><input name="_method" value="POST" type="hidden"></div>  
  <fieldset>
        <legend>Add Features</legend>
        <div class="input text required">
			<label for="features-title">Title</label>
			<input name="features_title"  maxlength="50" id="features_title" required type="text">
		</div> 		
		<div class="input text required">
			<label for="features-desc">Description</label>			
			<div class="portlet-body form">
							
			<div class="form-body">
				<div class="form-group">										
					<div class="col-md-11">											
						<textarea rows="20" cols="50" name="features_desc" id="summernote_1"></textarea>
					</div>
				</div>
			</div>
							
		  </div>
	  </div>
					
  </fieldset>
 
<button type="submit">Submit</button>
</form>
</div>

<div class="row">
<div class="col-md-12">
	<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box red">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-cogs"></i>All Features
		</div>
		
	</div>
	<div class="portlet-body">
		<div class="table-scrollable">
			<table class="table table-hover">
			<thead class="th-center">
			<tr>
				<th>
					 #
				</th>
				<th>
					 Features Title
				</th>
				
				<th>
					 Features Description
				</th>
				
				<th>
					 Action
				</th>
			</tr>
			</thead>
			<tbody>
			
			<?php 
			$i = 1;
			foreach ($featureslist as $features) { 
				//print_r($banner);die; 
				$id = $features['id']?>
			<tr>	
				<td><?php echo $i;?></td>
				<td><?php echo $features['title'];?></td>
				<td><?php echo $features['description'];?></td>
				
				<td><a href="updatefeatures/<?php echo $id ;?>" class="btn green">Edit</a><a href="deletefeatures/<?php echo $id ;?>" class="btn red" onclick="return confirm('Are you sure to delete ?')">Delete</a></td>
													
			</tr>	
			<?php $i++ ;}?>
						
		</tbody>
	</table>
		</div>
	</div>
</div>
	<!-- END SAMPLE TABLE PORTLET-->
</div>
				
</div>
