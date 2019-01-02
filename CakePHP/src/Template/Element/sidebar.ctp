<?php
$loguser = $this->request->session()->read('Auth.User');

		if(!empty($loguser)){

			$user_role = $loguser['role'];

			$user_id = $loguser['id'];
						
		}
?>
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper" style="margin: 2% 0px;padding: 3% 0px;">
					
				</li>
				<!--class="active open"-->
				<li>
					<a href="javascript:;">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<?php echo $this->Html->link('Home','/dashboard');?>
						</li>
						
					</ul>
				</li>
				<li class="start">
					<a href="javascript:;">
					<i class="fa fa-home"></i>
					<span class="title">Home Page Content</span>
					<span class="selected"></span>
					<span class="arrow open"></span>
					</a>
					<?php 
					if($user_role == "admin")
					{
					?>
					<ul class="sub-menu">
						<li>
							
							<?php echo $this->Html->link('Add Users','/adduser');?>
							
						</li>
						<li>
							
							<?php echo $this->Html->link('User List','/userlist');?>
						</li>
						<li class="active">
							<?php echo $this->Html->link('Add Banner','/addbanner');?>
						</li>
						<li>							
							<?php echo $this->Html->link('Add Features','/addfeatures');?>
						</li>
						
					</ul>
					<?php } else {?>
					<ul class="sub-menu">
						<li>
							 <a href="javascript:;">update your profile</a>
						</li>
					</ul>
					<?php }?>
				</li>								
				
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>