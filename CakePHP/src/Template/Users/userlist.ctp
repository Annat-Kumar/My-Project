<?= $this->Flash->render() ?> 
<div class="row" style="margin-top: 1%;">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>User List
							</div>
							<div class="tools">
								<a href="adduser" class="add-user">Add User</a>
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
									<th>
										 Action
									</th>
								</tr>
								</thead>
								<tbody>
								
								<?php 
								$i = 1;
								foreach ($users as $user) { 
									//print_r($user);die; 
									$id = $user['id']?>
								<tr>	
									<td><?php echo $i;?></td>
									<td><?php echo $user['username'];?></td>
									<td><?php echo $user['email'];?></td>
									<td><?php echo $user['phone'];?></td>
									<td><?php echo $user['role'];?></td>
									<td><a href="edituser/<?php echo $id ;?>" class="btn green">Edit</a><a href="deleteuser/<?php echo $id ;?>" class="btn red" onclick="return confirm('Are you sure to delete ?')">Delete</a></td>
																		
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
			
				<?php echo $this->Html->link('Add User','/adduser' ,['class' => 'btn red bck-btn']);?>
			 <?= $this->Html->css('my-app.css') ?>