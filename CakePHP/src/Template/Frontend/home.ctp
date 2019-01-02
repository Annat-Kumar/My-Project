<?php 
			$i = 1;
			foreach ($bannerlist as $banner) { 
			//echo "<pre>";print_r($banner);die; 
			$id = $banner['id'];
			
			?>
			<!--banner slider -->
            <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="/assets/frontend/pages/img/revolutionslider/thumbs/thumb2.jpg">
              <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
              
			   <?php echo $this->Html->image('/assets/frontend/pages/img/revolutionslider/bg'.$i.'.jpg'); ?>  
              <div class="caption lft slide_title slide_item_left"
                data-x="30"
                data-y="105"
                data-speed="400"
                data-start="1500"
                data-easing="easeOutExpo">
                <?php echo $banner['slide_title'];?>
              </div>
              <div class="caption lft slide_subtitle slide_item_left"
                data-x="30"
                data-y="180"
                data-speed="400"
                data-start="2000"
                data-easing="easeOutExpo">
               <?php echo $banner['slide_subtitle'];?>
              </div>
              <div class="caption lft slide_desc slide_item_left"
                data-x="30"
                data-y="220"
                data-speed="400"
                data-start="2500"
                data-easing="easeOutExpo">
                <?php echo $banner['slide_desc'];?>
              </div>
              <a class="caption lft btn green slide_btn slide_item_left" href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes"
                data-x="30"
                data-y="290"
                data-speed="400"
                data-start="3000"
                data-easing="easeOutExpo">
                Purchase Now!
              </a>                        
              <div class="caption lfb"
                data-x="640" 
                data-y="55" 
                data-speed="700" 
                data-start="1000" 
                data-easing="easeOutExpo">
                
				<?php echo $this->Html->image('/img/banner/'.$banner['img_name'],['class' => 'pull-left'],['alt' => '']); ?>
              </div>
            </li>
			<?php 
			$i++;
			}
			?>
	
			
			