<div class="row" style="margin-top: 1%;">
				<div class="col-md-6">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>User List
							</div>
							<div class="tools">
								<a href="userlist" class="userlist">User List</a>
								<a href="javascript:;" class="collapse">
								</a>
								
								
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
								<thead class="th-center-1">
								<tr>
									<th>
										 #
									</th>
									<th>
										 User Name
									</th>
									<th>
										 Email
									</th>
									<th>
										 Phone
									</th>
									<th>
										 Role
									</th>
									
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$i = 1;
								foreach ($users as $user) { 
									
									$id = $user['id']?>
								<tr>	
									<td><?php echo $i;?></td>
									<td><?php echo $user['username'];?></td>
									<td><?php echo $user['email'];?></td>
									<td><?php echo $user['phone'];?></td>
									<td><?php echo $user['role'];?></td>									
																		
								</tr>	
								<?php $i++ ;
								
								if($i == 6)
								{
									break;
								}
								}?>

								
								
								</tbody>
								</table>
							</div>
						</div>
						<?php echo $this->Html->link('Check full user list','/userlist' ,['class' => 'btn red bck-btn']);?>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
				
				<div class="col-md-6">
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
										 Banner <br> Title
									</th>
									<th>
										 Banner <br>Subtitle
									</th>
									<th>
										 Banner <br>Description
									</th>
									<th>
										 Image
									</th>
									
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$i = 1;
								foreach ($bannerlist as $banner) { 
									
									$id = $banner['id']?>
								<tr>	
									<td><?php echo $i;?></td>
									<td><?php echo $banner['slide_title'];?></td> 
									<td><?php echo $banner['slide_subtitle'];?></td>
									<td><?php echo substr($banner['slide_desc'],0 , 45);?></td>
									<td>
										<img class="pull-left" src="img/banner/<?php echo $banner['img_name'];?>" alt="">
									</td>
									
																		
								</tr>	
								<?php $i++ ;
								
								if($i == 5)
								{
									break;
								}
								
								}?>

								
								
								</tbody>
								</table>
							</div>
						</div>
						<?php echo $this->Html->link('Check full list','/addbanner' ,['class' => 'btn red bck-btn']);?>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
				
			</div>
			
<style>
.pull-left{
	max-height: 100px;
}
</style>