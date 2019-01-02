<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest (the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
   <?= $this->element('frontend-head') ?> 
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">
    
	 <?= $this->element('frontend-header') ?> 
    <!-- BEGIN SLIDER -->
    <div class="page-slider margin-bottom-40">
      <div class="fullwidthbanner-container revolution-slider">
        <div class="fullwidthabnner">
          <ul id="revolutionul">
            
                    <?= $this->fetch('content') ?>     
			</ul>
                <div class="tp-bannertimer tp-bottom"></div>
            </div>
        </div>
    </div>
    <!-- END SLIDER -->

    <div class="main">
      <div class="container">
	  <div class="row service-box margin-bottom-40">
		<?php $i =1;
		foreach($featureslist as $features)
			{
		?>
		<div class="col-md-4 col-sm-4">
            <div class="service-box-heading">
              <?php if($i==1){?>
			  <em><i class="fa fa-location-arrow blue"></i></em>
			  <?php }else if($i==2){?>
			  <em><i class="fa fa-check red"></i></em>
			  <?php  }else if($i==3){?>
			   <em><i class="fa fa-compress green"></i></em>
			  <?php } else { ?>
				<em><i class="fa fa-location-arrow blue"></i></em>
			  <?php }?>
              <span><?php echo $features['title'] ;?></span>
            </div>
            <p><?php echo $features['description'] ;?></p>
	   </div>
			<?php $i++;}?>
        <!-- BEGIN SERVICE BOX -->   
        
        </div>
        <!-- END SERVICE BOX -->

        <!-- BEGIN BLOCKQUOTE BLOCK -->   
        <div class="row quote-v1 margin-bottom-30">
          <div class="col-md-9">
            <span>Metronic - The Most Complete &amp; Popular Admin &amp; Frontend Theme</span>
          </div>
          <div class="col-md-3 text-right">
            <a class="btn-transparent" href="http://www.keenthemes.com/preview/index.php?theme=metronic_admin" target="_blank"><i class="fa fa-rocket margin-right-10"></i>Preview Admin</a>
          </div>
        </div>
        <!-- END BLOCKQUOTE BLOCK -->

        <!-- BEGIN RECENT WORKS -->
        <div class="row recent-work margin-bottom-40">
          <div class="col-md-3">
            <h2><a href="portfolio.html">Recent Works</a></h2>
            <p>Lorem ipsum dolor sit amet, dolore eiusmod quis tempor incididunt ut et dolore Ut veniam unde voluptatem. Sed unde omnis iste natus error sit voluptatem.</p>
          </div>
          <div class="col-md-9">
            <div class="owl-carousel owl-carousel3">
              <div class="recent-work-item">
                <em>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/works/img1.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  <a href="javascript:;"><i class="fa fa-link"></i></a>                  
				   <?php echo $this->Html->link('<i class="fa fa-search"></i>','/assets/frontend/pages/img/works/img1.jpg' ,['escapeTitle' => false ,'class' => 'fancybox-button' ,'title' => 'Project Name #1' ,'data-rel' => 'fancybox-button']);?>
                </em>
                <a class="recent-work-description" href="javascript:;">
                  <strong>Amazing Project</strong>
                  <b>Agenda corp.</b>
                </a>
              </div>
              <div class="recent-work-item">
                <em>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/works/img2.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  <a href="javascript:;"><i class="fa fa-link"></i></a>
				  <?php echo $this->Html->link('<i class="fa fa-search"></i>','/assets/frontend/pages/img/works/img2.jpg' ,['escapeTitle' => false ,'class' => 'fancybox-button' ,'title' => 'Project Name #2' ,'data-rel' => 'fancybox-button']);?>
                </em>
                <a class="recent-work-description" href="javascript:;">
                  <strong>Amazing Project</strong>
                  <b>Agenda corp.</b>
                </a>
              </div>
              <div class="recent-work-item">
                <em>
                  <?php echo $this->Html->image('/assets/frontend/pages/img/works/img3.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  <a href="javascript:;"><i class="fa fa-link"></i></a>
				  <?php echo $this->Html->link('<i class="fa fa-search"></i>','/assets/frontend/pages/img/works/img3.jpg' ,['escapeTitle' => false ,'class' => 'fancybox-button' ,'title' => 'Project Name #3' ,'data-rel' => 'fancybox-button']);?>
                </em>
                <a class="recent-work-description" href="javascript:;">
                  <strong>Amazing Project</strong>
                  <b>Agenda corp.</b>
                </a>
              </div>
              <div class="recent-work-item">
                <em>
                  <?php echo $this->Html->image('/assets/frontend/pages/img/works/img4.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  <a href="javascript:;"><i class="fa fa-link"></i></a>
                  <?php echo $this->Html->link('<i class="fa fa-search"></i>','/assets/frontend/pages/img/works/img4.jpg' ,['escapeTitle' => false ,'class' => 'fancybox-button' ,'title' => 'Project Name #4' ,'data-rel' => 'fancybox-button']);?>
                </em>
                <a class="recent-work-description" href="javascript:;">
                  <strong>Amazing Project</strong>
                  <b>Agenda corp.</b>
                </a>
              </div>
              <div class="recent-work-item">
                <em>
                  <?php echo $this->Html->image('/assets/frontend/pages/img/works/img5.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  <a href="javascript:;"><i class="fa fa-link"></i></a>
                  <?php echo $this->Html->link('<i class="fa fa-search"></i>','/assets/frontend/pages/img/works/img5.jpg' ,['escapeTitle' => false ,'class' => 'fancybox-button' ,'title' => 'Project Name #5' ,'data-rel' => 'fancybox-button']);?>
                </em>
                <a class="recent-work-description" href="javascript:;">
                  <strong>Amazing Project</strong>
                  <b>Agenda corp.</b>
                </a>
              </div>
              <div class="recent-work-item">
                <em>
                  <?php echo $this->Html->image('/assets/frontend/pages/img/works/img6.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  <a href="javascript:;"><i class="fa fa-link"></i></a>
				  <?php echo $this->Html->link('<i class="fa fa-search"></i>','/assets/frontend/pages/img/works/img6.jpg' ,['escapeTitle' => false ,'class' => 'fancybox-button' ,'title' => 'Project Name #6' ,'data-rel' => 'fancybox-button']);?>
                </em>
                <a class="recent-work-description" href="javascript:;">
                  <strong>Amazing Project</strong>
                  <b>Agenda corp.</b>
                </a>
              </div>
              <div class="recent-work-item">
                <em>
                  <?php echo $this->Html->image('/assets/frontend/pages/img/works/img3.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  <a href="javascript:;"><i class="fa fa-link"></i></a>
                  <?php echo $this->Html->link('<i class="fa fa-search"></i>','/assets/frontend/pages/img/works/img3.jpg' ,['escapeTitle' => false ,'class' => 'fancybox-button' ,'title' => 'Project Name #3' ,'data-rel' => 'fancybox-button']);?>
                </em>
                <a class="recent-work-description" href="javascript:;">
                  <strong>Amazing Project</strong>
                  <b>Agenda corp.</b>
                </a>
              </div>
              <div class="recent-work-item">
                <em>
                  <?php echo $this->Html->image('/assets/frontend/pages/img/works/img4.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  <a href="javascript:;"><i class="fa fa-link"></i></a>
                  <?php echo $this->Html->link('<i class="fa fa-search"></i>','/assets/frontend/pages/img/works/img4.jpg' ,['escapeTitle' => false ,'class' => 'fancybox-button' ,'title' => 'Project Name #4' ,'data-rel' => 'fancybox-button']);?>
                </em>
                <a class="recent-work-description" href="javascript:;">
                  <strong>Amazing Project</strong>
                  <b>Agenda corp.</b>
                </a>
              </div>
            </div>       
          </div>
        </div>   
        <!-- END RECENT WORKS -->

        <!-- BEGIN TABS AND TESTIMONIALS -->
        <div class="row mix-block margin-bottom-40">
          <!-- TABS -->
          <div class="col-md-7 tab-style-1">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-1" data-toggle="tab">Multipurpose</a></li>
              <li><a href="#tab-2" data-toggle="tab">Documented</a></li>
              <li><a href="#tab-3" data-toggle="tab">Responsive</a></li>
              <li><a href="#tab-4" data-toggle="tab">Clean & Fresh</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane row fade in active" id="tab-1">
                <div class="col-md-3 col-sm-3">
                  <a href="javascript:;" class="fancybox-button" title="Image Title" data-rel="fancybox-button">                   
					 <?php echo $this->Html->image('/assets/frontend/pages/img/photos/img7.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  </a>
                </div>
                <div class="col-md-9 col-sm-9">
                  <p class="margin-bottom-10">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Cosby sweater eu banh mi, qui irure terry richardson ex squid Aliquip placeat salvia cillum iphone.</p>
                  <p><a class="more" href="javascript:;">Read more <i class="icon-angle-right"></i></a></p>
                </div>
              </div>
              <div class="tab-pane row fade" id="tab-2">
                <div class="col-md-9 col-sm-9">
                  <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia..</p>
                </div>
                <div class="col-md-3 col-sm-3">
                  <a href="javascript:;" class="fancybox-button" title="Image Title" data-rel="fancybox-button">                    
					<?php echo $this->Html->image('/assets/frontend/pages/img/photos/img10.jpg',['class' => 'img-responsive'],['alt' => 'Amazing Project']); ?>
                  </a>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-3">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
              </div>
              <div class="tab-pane fade" id="tab-4">
                <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
              </div>
            </div>
          </div>
          <!-- END TABS -->
        
          <!-- TESTIMONIALS -->
          <div class="col-md-5 testimonials-v1">
            <div id="myCarousel" class="carousel slide">
              <!-- Carousel items -->
              <div class="carousel-inner">
                <div class="active item">
                  <blockquote><p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur adipisicing sit amet, consectetur adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p></blockquote>
                  <div class="carousel-info">                    
					<?php echo $this->Html->image('/assets/frontend/pages/img/people/img1-small.jpg',['class' => 'pull-left']); ?>
                    <div class="pull-left">
                      <span class="testimonials-name">Lina Mars</span>
                      <span class="testimonials-post">Commercial Director</span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <blockquote><p>Raw denim you Mustache cliche tempor, williamsburg carles vegan helvetica probably haven't heard of them jean shorts austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.</p></blockquote>
                  <div class="carousel-info">
					<?php echo $this->Html->image('/assets/frontend/pages/img/people/img5-small.jpg',['class' => 'pull-left']); ?>
                    <div class="pull-left">
                      <span class="testimonials-name">Kate Ford</span>
                      <span class="testimonials-post">Commercial Director</span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <blockquote><p>Reprehenderit butcher stache cliche tempor, williamsburg carles vegan helvetica.retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid Aliquip placeat salvia cillum iphone.</p></blockquote>
                  <div class="carousel-info">
					<?php echo $this->Html->image('/assets/frontend/pages/img/people/img2-small.jpg',['class' => 'pull-left']); ?>
                    <div class="pull-left">
                      <span class="testimonials-name">Jake Witson</span>
                      <span class="testimonials-post">Commercial Director</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Carousel nav -->
              <a class="left-btn" href="#myCarousel" data-slide="prev"></a>
              <a class="right-btn" href="#myCarousel" data-slide="next"></a>
            </div>
          </div>
          <!-- END TESTIMONIALS -->
        </div>                
        <!-- END TABS AND TESTIMONIALS -->

        <!-- BEGIN STEPS -->
        <div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step1">
              <h2>Goal definition</h2>
              <p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step2">
              <h2>Analyse</h2>
              <p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step3">
              <h2>Implementation</h2>
              <p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
            </div>
          </div>
        </div>
        <!-- END STEPS -->

        <!-- BEGIN CLIENTS -->
        <div class="row margin-bottom-40 our-clients">
          <div class="col-md-3">
            <h2><a href="javascript:;">Our Clients</a></h2>
            <p>Lorem dipsum folor margade sitede lametep eiusmod psumquis dolore.</p>
          </div>
          <div class="col-md-9">
            <div class="owl-carousel owl-carousel6-brands">
              <div class="client-item">
                <a href="javascript:;">
                  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_1_gray.png',['class' => 'img-responsive']); ?>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_1.png',['class' => 'color-img img-responsive']); ?>
				  
                </a>
              </div>
              <div class="client-item">
                <a href="javascript:;">
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_2_gray.png',['class' => 'img-responsive']); ?>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_2.png',['class' => 'color-img img-responsive']); ?>
                </a>
              </div>
              <div class="client-item">
                <a href="javascript:;">
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_3_gray.png' , ['class' => 'img-responsive']); ?>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_3.png' ,['class' => 'color-img img-responsive']); ?>
                </a>
              </div>
              <div class="client-item">
                <a href="javascript:;">
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_4_gray.png' ,['class' => 'img-responsive']); ?>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_4.png' ,['class' => 'color-img img-responsive']); ?>
                </a>
              </div>
              <div class="client-item">
                <a href="javascript:;">
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_5_gray.png' ,['class' => 'img-responsive']); ?>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_5.png' ,['class' => 'color-img img-responsive']); ?>
                </a>
              </div>
              <div class="client-item">
                <a href="javascript:;">
				   <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_6_gray.png' ,['class' => 'img-responsive']); ?>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_6.png' ,['class' => 'color-img img-responsive']); ?>
                </a>
              </div>
              <div class="client-item">
                <a href="javascript:;">
				   <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_7_gray.png' ,['class' => 'img-responsive']); ?>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_7.png' ,['class' => 'color-img img-responsive']); ?>
                </a>
              </div>
              <div class="client-item">
                <a href="javascript:;">
				   <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_8_gray.png' ,['class' => 'img-responsive']); ?>
				  <?php echo $this->Html->image('/assets/frontend/pages/img/clients/client_8.png' ,['class' => 'color-img img-responsive']); ?>
                </a>
              </div>                  
            </div>
          </div>          
        </div>
        <!-- END CLIENTS -->
      </div>
    </div>

    <?= $this->element('frontend-footer') ?> 
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    
    <![endif]--> 
	<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
	<?php echo $this->Html->script('/assets/global/plugins/jquery-migrate.min.js'); ?>
	<?php echo $this->Html->script('/assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>
	<?php echo $this->Html->script('/assets/frontend/layout/scripts/back-to-top.js'); ?>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <?php echo $this->Html->script('/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js'); ?><!-- pop up -->
	<?php echo $this->Html->script('/assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js'); ?>

    <!-- BEGIN RevolutionSlider -->  
	<?php echo $this->Html->script('/assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>
	<?php echo $this->Html->script('/assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js'); ?>
	<?php echo $this->Html->script('/assets/frontend/pages/scripts/revo-slider-init.js'); ?>
    <!-- END RevolutionSlider -->

	<?php echo $this->Html->script('/assets/frontend/layout/scripts/layout.js'); ?>
	
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            RevosliderInit.initRevoSlider();
            Layout.initTwitter();
            //Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
            //Layout.initNavScrolling(); 
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>