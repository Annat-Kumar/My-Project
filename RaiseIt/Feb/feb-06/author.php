<?php
/**
* The template for displaying Author bios
*
* @package WordPress
* @subpackage Twenty_Fifteen
* @since Twenty Fifteen 1.0
*/

get_header();

$user = wp_get_current_user();
$user_ids =  $user->ID;
$author_emails = $user->user_email;
$user->roles = $user->roles;

 $user_id = get_query_var( 'author' );

?>

<div class="container">
  <div class="row">
    <div class="div_box">
      <div class="second_divbox">
        <?php include('author-sidebar.php'); ?>
        <div class="col-md-10 col-sm-9 col-xs-12">

          <ul class="nav nav-tabs tabs-right">
            <li class="active" style="display:none;"><a href="#tab_default_0" data-toggle="tab" style="display: none !important;"></a></li>

          </ul>

          <div class="tab-content">

            <?php

                 $current_user = wp_get_current_user();

              $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              $author_page_url = site_url().'/user/'.$username.'/';
              if($actual_link == $author_page_url)
            ?>

            <div class="tab-pane <?php if($actual_link == $author_page_url){ echo "active" ; } ?>" id="tab_default_0">

              <?php 
              if(is_user_logged_in())
              { 
                $username =  $current_user->user_nicename;
                if($current_user->ID == $user->ID || (in_array("administrator", $user->roles)) || (in_array("editor", $user->roles)))
                {

              $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              $author_page_url = site_url().'/user/'.$username.'/';
              if($actual_link == $author_page_url)
              {


                  ?>
                  <div class="col-md-12 col-sm-12 edit_all">
                    <ul class="list-inline list-unstyled profile_buttons">
                      <li><a href="<?php echo site_url();?>/create-fundraising-host-page/" ><button type="button">Sponsor Fundraiser</button></a></li>
                      <li><a href="<?php echo site_url();?>/create-fundraising-event-page/" ><button type="button">Request Fundraiser</button></a></li>
                      <?php if($state == "action_required" || $state == "active") {

                        $site_url = site_url();

                        if($site_url == 'https://dev.raiseitfast.com')
                          {
                            $send_url = 'https://stage-go.wepay.com';
                          }
                          else
                          {

                            $send_url = 'https://go.wepay.com';   
                          }
                          ?>


                          <li><a href="<?php echo $send_url; ?>" ><button type="button">Go to the Wepay account</button></a></li>
                          <?php } ?>
                          <li><?php echo do_shortcode('[logout_to_home]'); ?></li>
                        </ul>
                      </div>

                      <?php } } } ?>
                    </div>

    <!-- Tab panes -->

    <div <?php if($actual_link != $author_page_url){ ?> class="active tab-pane info_about" <?php } else { ?> class="tab-pane info_about" <?php } ?> id="tab_default_1"> 
      <h2>Your Profile Info</h2>
      <div class="chng_extra">
      </div>
      <h3>Name :<br><span><div class="icon_mail"><i class="fa fa-user-o" aria-hidden="true"></i></div><?php echo ucfirst(get_the_author_meta('first_name',  $user_id )) .' '.ucfirst(get_the_author_meta('last_name', $user->ID ));?></span></h3>
      <h4>Email Address :<br><span><div class="icon_mail"><i class="fa fa-envelope-o" aria-hidden="true"></i></div> <a href= "mailto:<?php echo get_the_author_meta('email', $user_id); ?>"><?php echo get_the_author_meta('email',  $user_id); ?></a></span></h4>
      <h5>Contact No. : <br><span><div class="icon_mail"><i class="fa fa-phone" aria-hidden="true"></i>
      </div><a href="tel:<?php echo get_user_meta($user_id , $meta_key = 'user_phone' , true);?>">
       <?php 
       if(get_field( "phone" )){
        echo get_field( "phone" );
      }
      else{
       echo get_user_meta($user_id , $meta_key = 'user_phone' , true );
     }
     ?></a></span></h5>

   </div>
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>

        <?php //get_template_part( 'content', 'allJs' ); ?>
        <?php //get_template_part( 'authorpage', 'alljs' ); ?>
        <?php get_footer();?>