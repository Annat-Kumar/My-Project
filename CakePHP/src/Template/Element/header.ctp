<?php
$user = "";
$loguser = $this->request->session()->read('Auth.User');
if(!empty($loguser)){
    $user = $loguser['username'];
    $user_id = $loguser['id'];
}
?>

	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="javascript:;">
			<?php echo $this->Html->image('/assets/admin/layout/img/logo.png', ['alt' => 'logo'] ,['class' => 'logo-default']); ?>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- BEGIN NOTIFICATION DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<!--<a href="home" class="dropdown-toggle" title="visit site" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">-->
					
					<?php echo $this->Html->link('<i class="icon-bell"></i>','/' ,['escape' => false ,'title' => 'visit site']);?>
					
				</li>
				
				<!-- END TODO DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<?php echo $this->Html->image('/assets/admin/layout/img/avatar3_small.jpg', ['alt' => 'logo'] ,['class' => 'img-circle']); ?>
					<span class="username username-hide-on-mobile">
					 Hello <?php echo $user ;?> </span>
					<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							
							 <?php echo $this->Html->link('<i class="icon-user"></i> My Profile','/updateProfile/'.$user_id ,['escape' => false]);?>
						</li>
						<li>
							<a href="#">
							<i class="icon-calendar"></i> My Calendar </a>
						</li>
						
						<li class="divider">
						</li>
						<li>
							<a href="#">
							<i class="icon-lock"></i> Lock Screen </a>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="icon-key"></i> Log Out','/logout' ,['escape' => false]);?>
						</li>
					</ul>
				</li>
				
				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
