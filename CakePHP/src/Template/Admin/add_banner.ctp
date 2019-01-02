
<div class="users form">
<form method="post" accept-charset="utf-8" action="" enctype="multipart/form-data">
<div style="display:none;"><input name="_method" value="POST" type="hidden"></div>  
<?= $this->Flash->render() ?>
<div  class="err_form">
<?php
if(isset($err_msg))
{	
	foreach($err_msg as $err)
	{	
		echo $err."<br>";
		
	}
}
?>
</div>
  <fieldset>
        <legend>Add Banner</legend>
        <div class="input text required">
			<label for="slide-title">Slide Title</label>
			<input name="slide_title"  maxlength="50" id="slide_title"  type="text" required>
		</div> 
		<div class="input text required">
			<label for="slide-subtitle">Slide Sub Title</label>
			<input name="slide_subtitle"  maxlength="50" id="slide_subtitle"  type="text" required>
		</div> 
		<div class="input text required">
			<label for="slide_desc">Slide Desc</label>
			<input name="slide_desc"  maxlength="50" id="slide_desc" type="text" required>
		</div> 
		
		<div class="input file required">
			 <label for="add image">Add Image</label>
			 <input name="banner_image" type="file" id="banner_image "  size="50" required/>
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
								<i class="fa fa-cogs"></i>Banner List
							</div>
							<div class="tools">
								<a href="#" class="add-user">Banner</a>
								<a href="javascript:;" class="collapse">
								</a>
								
								
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
										 Banner Title
									</th>
									<th>
										 Banner Subtitle
									</th>
									<th>
										 Banner Description
									</th>
									<th>
										 Image
									</th>
									<th>
										 Action
									</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$i = 1;
								foreach ($bannerlist as $banner) { 
									//print_r($banner);die; 
									$id = $banner['id']?>
								<tr>	
									<td><?php echo $i;?></td>
									<td><?php echo $banner['slide_title'];?></td>
									<td><?php echo $banner['slide_subtitle'];?></td>
									<td><?php echo $banner['slide_desc'];?></td>
									<td>
										<img class="pull-left" src="img/banner/<?php echo $banner['img_name'];?>" alt="">
									</td>
									<td><a href="updatebanner/<?php echo $id ;?>" class="btn green">Edit</a><a href="deletebanner/<?php echo $id ;?>" class="btn red" onclick="return confirm('Are you sure to delete ?')">Delete</a></td>
																		
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
<style>
	.pull-left {
    width: 90px;
    height: 78px;
}	
</style>	