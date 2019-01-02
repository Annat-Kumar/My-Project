<?php
$user = "";
$loguser = $this->request->session()->read('Auth.User');
if(!empty($loguser)){
    $user = $loguser['username'];
    $user_id = $loguser['id'];
}
?>

<!-- BEGIN STYLE CUSTOMIZER -->
    <div class="color-panel hidden-sm" style="display:none">
      <div class="color-mode-icons icon-color"></div>
      <div class="color-mode-icons icon-color-close"></div>
      <div class="color-mode">
        <p>THEME COLOR</p>
        <ul class="inline">
          <li class="color-red current color-default" data-style="red"></li>
          <li class="color-blue" data-style="blue"></li>
          <li class="color-green" data-style="green"></li>
          <li class="color-orange" data-style="orange"></li>
          <li class="color-gray" data-style="gray"></li>
          <li class="color-turquoise" data-style="turquoise"></li>
        </ul>
      </div>
    </div>
    <!-- END BEGIN STYLE CUSTOMIZER --> 

    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>+1 456 6717</span></li>
                        <li><i class="fa fa-envelope-o"></i><span>info@keenthemes.com</span></li>
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
				<?php if(!empty($loguser)){ 
				?>
				<div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right nav navbar-nav pull-right">
                       
                        <li class="dropdown dropdown-user">						
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">							
							<span class="username username-hide-on-mobile">
							Hello <?php echo $user;?> </span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<?php echo $this->Html->link('<i class="icon-user"></i> My Profile','/updateProfile/'.$user_id ,['escape' => false]);?>
								
							</li>
						</ul>
						</li>
						<li >
						<?php echo $this->Html->link('Log Out','/logout') ;?>
						</li>
                    </ul>
					
                </div>
				<?php } else {?>
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
                        <li>
						<a href="login">Login</a>
						<!--<a class="btn1 default" data-toggle="modal" href="#basic">
						Login
						</a>-->
						</li>
                         <li><a href="signup">Sign Up</a></li>
                    </ul>
                </div>
				<?php } ?>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->
    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="javascript:void(0);">		
		<?php echo $this->Html->image('/assets/frontend/layout/img/logos/logo-corp-red.png', ['alt' => 'Metronic FrontEnd']); ?>
        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
          <ul>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Home 
                
              </a>
                
              <ul class="dropdown-menu">
                <li class="active"><a href="javascript:void(0);">Home Default</a></li>
                <li><a href="javascript:void(0);">Home with Header Fixed</a></li>
                <li><a href="javascript:void(0);">Home without Top Bar</a></li>
              </ul>
            </li>
           


            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Pages 
                
              </a>
                
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0);">About Us</a></li>
                <li><a href="javascript:void(0);">Services</a></li>
                <li><a href="javascript:void(0);">Prices</a></li>
                <li><a href="javascript:void(0);">FAQ</a></li>
                <li><a href="javascript:void(0);">Gallery</a></li>
                <li><a href="javascript:void(0);">Search Result</a></li>
                <li><a href="javascript:void(0);">404</a></li>
                <li><a href="javascript:void(0);">500</a></li>
                <li><a href="javascript:void(0);">Login Page</a></li>
                <li><a href="javascript:void(0);">Forget Password</a></li>
                <li><a href="javascript:void(0);">Signup Page</a></li>
                <li><a href="javascript:void(0);">Careers</a></li>
                <li><a href="javascript:void(0);">Site Map</a></li>
                <li><a href="javascript:void(0);">Contact</a></li>                
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Features 
                
              </a>
                
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0);">Typography</a></li>
                <li><a href="javascript:void(0);">Buttons</a></li>
                <li><a href="javascript:void(0);">Forms</a></li>
                
                <li class="dropdown-submenu">
                  <a href="javascript:void(0);">Multi level <i class="fa fa-angle-right"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:void(0);">Second Level Link</a></li>
                    <li><a href="javascript:void(0);">Second Level Link</a></li>
                    <li class="dropdown-submenu">
                      <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:void(0);">
                        Second Level Link 
                        <i class="fa fa-angle-right"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="javascript:void(0);">Third Level Link</a></li>
                        <li><a href="javascript:void(0);">Third Level Link</a></li>
                        <li><a href="javascript:void(0);">Third Level Link</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Portfolio 
                
              </a>
                
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0);">Portfolio 4</a></li>
                <li><a href="javascript:void(0);">Portfolio 3</a></li>
                <li><a href="javascript:void(0);">Portfolio 2</a></li>
                <li><a href="javascript:void(0);">Portfolio Item</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Blog 
                
              </a>
                
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0);">Blog Page</a></li>
                <li><a href="javascript:void(0);">Blog Item</a></li>
              </ul>
            </li>

             <li class="dropdown dropdown-megamenu">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                Mega Menu
                
              </a>
              <ul class="dropdown-menu">
                <li>
                  <div class="header-navigation-content">
                    <div class="row">
                      <div class="col-md-4 header-navigation-col">
                        <h4>Footwear</h4>
                        <ul>
                          <li><a href="javascript:void(0);">Astro Trainers</a></li>
                          <li><a href="javascript:void(0);">Basketball Shoes</a></li>
                          <li><a href="javascript:void(0);">Boots</a></li>
                          <li><a href="javascript:void(0);">Canvas Shoes</a></li>
                          <li><a href="javascript:void(0);">Football Boots</a></li>
                          <li><a href="javascript:void(0);">Golf Shoes</a></li>
                          <li><a href="javascript:void(0);">Hi Tops</a></li>
                          <li><a href="javascript:void(0);">Indoor Trainers</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 header-navigation-col">
                        <h4>Clothing</h4>
                        <ul>
                          <li><a href="javascript:void(0);">Base Layer</a></li>
                          <li><a href="javascript:void(0);">Character</a></li>
                          <li><a href="javascript:void(0);">Chinos</a></li>
                          <li><a href="javascript:void(0);">Combats</a></li>
                          <li><a href="javascript:void(0);">Cricket Clothing</a></li>
                          <li><a href="javascript:void(0);">Fleeces</a></li>
                          <li><a href="javascript:void(0);">Gilets</a></li>
                          <li><a href="javascript:void(0);">Golf Tops</a></li>
                        </ul>
                      </div>
                      <div class="col-md-4 header-navigation-col">
                        <h4>Accessories</h4>
                        <ul>
                          <li><a href="javascript:void(0);">Belts</a></li>
                          <li><a href="javascript:void(0);">Caps</a></li>
                          <li><a href="javascript:void(0);">Gloves</a></li>
                        </ul>

                        <h4>Clearance</h4>
                        <ul>
                          <li><a href="javascript:void(0);">Jackets</a></li>
                          <li><a href="javascript:void(0);">Bottoms</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </li>   

            <li><a href="javascript:void(0);" >E-Commerce</a></li>
            <li><a href="javascript:void(0);" >One Page</a></li>
            <li><a href="http://keenthemes.com/preview/metronic/theme/templates/admin" target="_blank">Admin theme</a></li>

            <!-- BEGIN TOP SEARCH -->
            <li class="menu-search">
              <span class="sep"></span>
              <i class="fa fa-search search-btn"></i>
              <div class="search-box">
                <form action="#">
                  <div class="input-group">
                    <input type="text" placeholder="Search" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                  </div>
                </form>
              </div> 
            </li>
            <!-- END TOP SEARCH -->
          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
	<!-- model box start -->
	
			
								<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="users form">
											<?= $this->Flash->render() ?>
											<?= $this->Form->create('Post', array('url' => '/login')); ?>
												<fieldset>
													<legend><?= __('Please enter your username and password') ?></legend>
													<?= $this->Form->control('username') ?>
													<?= $this->Form->control('password') ?>
												</fieldset>
																								
											<?= $this->Form->button(__('Login')); ?>
											<?= $this->Form->end() ?>
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							
		<!-- End -->
    <!-- Header END -->