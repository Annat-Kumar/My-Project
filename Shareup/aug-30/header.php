<!DOCTYPE html>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta charset="<?php bloginfo('charset'); ?>" />  
  <?php $wl_theme_options = weblizar_get_options(); ?>
  <?php if($wl_theme_options['upload_image_favicon']!=''){ ?>
  <link rel="shortcut icon" href="<?php  echo esc_url($wl_theme_options['upload_image_favicon']); ?>" /> 
  <?php } ?>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet"> 
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">-->

  <?php wp_head(); ?>
  <script src="<?php echo get_bloginfo('template_url');?>/js/jquery.validate.min.js"></script>
<script src="<?php echo get_bloginfo('template_url');?>/js/additional-methods.js"></script>

<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<!--<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->
 <script type="text/javascript" src="<?php echo get_bloginfo('template_url');?>/js/jquery.searchabledropdown-1.0.8.min.js"></script>
 
  <script type="text/javascript">
    jQuery(document).ready(function () {
    jQuery(".wallet").click(function(){
    jQuery(".wallet_div").toggle();
});
    });
  </script>
</head>
<body <?php body_class(); ?>>
<div>
  <!-- Header Section -->
  <div class="header_section hd_cover" >    
    
  
      <!-- Logo & Contact Info -->
      <div class="row ">
        <div class="col-md-6 col-sm-3 wl_rtl" >          
          <div claSS="logo">            
          <a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
          <?php if($wl_theme_options['upload_image_logo']){ ?>
            <img class="img-responsive" src="<?php echo $wl_theme_options['upload_image_logo']; ?>" style="height:<?php if($wl_theme_options['height']!='') { echo $wl_theme_options['height']; }  else { "80"; } ?>px; width:<?php if($wl_theme_options['width']!='') { echo $wl_theme_options['width']; }  else { "200"; } ?>px;" />
            <?php } else {
              echo get_bloginfo('name');
            } ?>
          </a>
          <p><?php bloginfo( 'description' ); ?></p>
          </div>
        </div>
        <div class="col-md-6 col-sm-8">
        <div class="navigation_menu "  data-spy="affix" data-offset-top="95" id="enigma_nav_top">
    
    <div class="navbar-container" >
      <nav class="navbar navbar-default " role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
           
            <span class="sr-only"><?php _e('Toggle navigation','enigma');?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="menu" class="collapse navbar-collapse "> 
        <?php /*wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'weblizar_fallback_page_menu',
            'walker' => new weblizar_nav_walker(),
            )
            );*/
        if(is_user_logged_in())
        {
          wp_nav_menu( array ('menu' => 'login',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'weblizar_fallback_page_menu',
            'walker' => new weblizar_nav_walker()) );
        }
        else
        {
          wp_nav_menu( array ('menu' => 'logout',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'weblizar_fallback_page_menu',
            'walker' => new weblizar_nav_walker()) );
        }

              ?>        
        </div>  
      </nav>
      <div class="wallet_div" style="display: none;">
      <?php 
  
  $args = array(
    'post_type'  => 'task',
    'post_status'    => 'publish',
    'author' => get_current_user_id(),
    'meta_query' => array(
       array(
           'key' => 'final_release',
           'value' => 'no',
           'compare' => 'LIKE',
       )
   )
);

$query = new WP_Query( $args ); 
?>
<div class="row wallet_details">


<?php
if($query->have_posts())
{
  echo '<h4>Money in your wallet:</h4>
<div class="col-md-8"><b>Job Name</b></div>
<div class="col-md-4"><b>Amount</b></div>';

 while ($query->have_posts()) : $query->the_post(); 

?>
<div class="col-md-8"><?php echo get_the_title(); ?></div>
<div class="col-md-4"><?php echo get_post_meta(get_the_ID(),'payment_amount',true); ?></div>

<?php endwhile;
 wp_reset_postdata();
}
else
{
  echo '<div class="col-md-12">No amount in your wallet</div>';
}
?>
</div>
</div>
      </div>
    </div>
        </div>
        <?php if($wl_theme_options['header_social_media_in_enabled']=='1') { ?>
        <div class="col-md-6 col-sm-12">
        <?php if($wl_theme_options['email_id'] || $wl_theme_options['phone_no'] !='') { ?>
        <ul class="head-contact-info">
            <?php if($wl_theme_options['email_id'] !='') { ?><li><i class="fa fa-envelope"></i><a href="mailto:<?php echo $wl_theme_options['email_id']; ?>"><?php echo esc_attr($wl_theme_options['email_id']); ?></a></li><?php } ?>
            <?php if($wl_theme_options['phone_no'] !='') { ?><li><i class="fa fa-phone"></i><a href="tel:<?php echo $wl_theme_options['phone_no']; ?>"><?php echo esc_attr($wl_theme_options['phone_no']); ?></a></li><?php } ?>
        </ul>
        <?php } ?>
          <ul class="social">
          <?php if($wl_theme_options['fb_link']!='') { ?>
             <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="Facebook"><a  href="<?php echo esc_url($wl_theme_options['fb_link']); ?>"><i class="fa fa-facebook"></i></a></li>
          <?php } if($wl_theme_options['twitter_link']!='') { ?>
          <li class="twitter" data-toggle="tooltip" data-placement="bottom" title="Twitter"><a href="<?php echo esc_url($wl_theme_options['twitter_link']); ?>"><i class="fa fa-twitter"></i></a></li>
          <?php } if($wl_theme_options['linkedin_link']!='') { ?>         
          <li class="linkedin" data-toggle="tooltip" data-placement="bottom" title="Linkedin"><a href="<?php echo esc_url($wl_theme_options['linkedin_link']); ?>"><i class="fa fa-linkedin"></i></a></li>
          <?php } if($wl_theme_options['youtube_link']!='') { ?>
          <li class="youtube" data-toggle="tooltip" data-placement="bottom" title="Youtube"><a href="<?php echo esc_url($wl_theme_options['youtube_link']) ; ?>"><i class="fa fa-youtube"></i></a></li>
                  <?php } if($wl_theme_options['gplus']!='') { ?>
          <li class="twitter" data-toggle="tooltip" data-placement="bottom" title="gplus"><a href="<?php echo esc_url($wl_theme_options['gplus']) ; ?>"><i class="fa fa-google-plus"></i></a></li>
                  <?php } if($wl_theme_options['instagram']!='') { ?>
          <li class="facebook" data-toggle="tooltip" data-placement="bottom" title="instagram"><a href="<?php echo esc_url($wl_theme_options['instagram']) ; ?>"><i class="fa fa-instagram"></i></a></li>
                  <?php } if($wl_theme_options['vk_link']!='') { ?>
          <li class="twitter" data-toggle="tooltip" data-placement="bottom" title="vk"><a href="<?php echo esc_url($wl_theme_options['vk_link']) ; ?>"><i class="fa fa-vk"></i></a></li>
                  <?php } if($wl_theme_options['qq_link']!='') { ?>
          <li class="youtube" data-toggle="tooltip" data-placement="bottom" title="qq"><a href="<?php echo esc_url($wl_theme_options['qq_link']) ; ?>"><i class="fa fa-qq"></i></a></li>
                  <?php } if($wl_theme_options['whatsapp_link']!='') { ?>
          <li class="linkedin" data-toggle="tooltip" data-placement="bottom" title="whatsapp"><a href="tel:<?php echo esc_attr($wl_theme_options['whatsapp_link']) ; ?>"><i class="fa fa-whatsapp"></i></a></li>
                  <?php } ?>
          
          </ul> 
        </div>
        <?php } ?>
      </div>
      <!-- /Logo & Contact Info -->
        
  </div>  
  <!-- /Header Section -->
  <!-- Navigation  menus -->
  <!-- <div class="navigation_menu "  data-spy="affix" data-offset-top="95" id="enigma_nav_top">
    <span id="header_shadow"></span>
    <div class="container navbar-container" >
      <nav class="navbar navbar-default " role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
           
            <span class="sr-only"><?php _e('Toggle navigation','enigma');?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="menu" class="collapse navbar-collapse "> 
        <?php /*wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'weblizar_fallback_page_menu',
            'walker' => new weblizar_nav_walker(),
            )
            );*/
        if(is_user_logged_in())
        {
          wp_nav_menu( array ('menu' => 'login',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'weblizar_fallback_page_menu',
            'walker' => new weblizar_nav_walker()) );
        }
        else
        {
          wp_nav_menu( array ('menu' => 'logout',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'weblizar_fallback_page_menu',
            'walker' => new weblizar_nav_walker()) );
        }

              ?>        
        </div>  
      </nav>
      <div class="wallet_div" style="display: none;">
      <?php 
  
  $args = array(
    'post_type'  => 'task',
    'post_status'    => 'publish',
    'author' => get_current_user_id(),
    'meta_query' => array(
       array(
           'key' => 'final_release',
           'value' => 'no',
           'compare' => 'LIKE',
       )
   )
);

$query = new WP_Query( $args ); 
?>
<div class="row wallet_details">


<?php
if($query->have_posts())
{
  echo '<h4>Money in your wallet:</h4>
<div class="col-md-8"><b>Job Name</b></div>
<div class="col-md-4"><b>Amount</b></div>';

 while ($query->have_posts()) : $query->the_post(); 

?>
<div class="col-md-8"><?php echo get_the_title(); ?></div>
<div class="col-md-4"><?php echo get_post_meta(get_the_ID(),'payment_amount',true); ?></div>

<?php endwhile;
 wp_reset_postdata();
}
else
{
  echo '<div class="col-md-12">No amount in your wallet</div>';
}
?>
</div>
</div>
      </div>
    </div> -->
  </div>
  