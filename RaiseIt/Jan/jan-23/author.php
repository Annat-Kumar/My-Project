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

    $user_roles = $user->roles;

global $wpdb;
$user_data = $wpdb->get_results("SELECT * FROM wp_postmeta where meta_key = 'csv_author_email ' AND  meta_value = '".$author_emails."' ");

foreach ($user_data as $key => $idd) {
  $post_id = $idd->post_id;
}
$arg = array(
    'ID' => $post_id,
    'post_author' => $user_ids,
);
wp_update_post( $arg );

if(isset($_POST['send_mail']))
{

  $send_message = $_POST['msg_to_raisit'];
  $send_zip = $_POST['send_zip'];         

  $user_info   = get_userdata(1);

  $admin_name  = $user_info->user_login;

  $admin_email = get_option( 'admin_email' );


  @$header3 .= "MIME-Version: 1.0\n";
  $header3 .= "Content-Type: text/html; charset=utf-8\n";
  @$headers3 .= "From:" . $admin_email;

  $sends_message .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
  <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> Raise It</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$admin_name) . 
  "</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
  $sends_message .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">Zip code.'.$send_zip.' and message is'.$send_message.' ','piereg</div>') . "</br</div>";

  $sends_message .='</div><div style=color: #999;padding: 50px 30px">
  <div style="">Regards,</div>
  <div style="">Raise It Team</div>            
  </div></body></html>';

  $subject3 = "Raise It Notification";
  $subject3 = "=?utf-8?B?" . base64_encode($subject3) . "?=";

  $to3 = $admin_email;

          // send the email to reatiler
  $email3 = wp_mail($to3, $subject3, $sends_message, $header3);

}



if(isset($_POST['save_its']))
{

/*echo "<pre>";
print_r($_POST);
die('******************************************');*/

  //retailer data info 

  $business_id = $_POST['reta_id'];
  $business_name = $_POST['get_value'];
  $business_auth_id = $_POST['r_author_id'];

  //fundraiser data info

  $funf_id = $_POST['f_post_id'];
  $fund_post_name = get_the_title( $funf_id );
  $fund_event_date = get_field('select_date', $funf_id );
  $fund_event_s_time = get_field('start_time', $funf_id );
  $fund_event_e_time = get_field('end_time', $funf_id );
  $fund_event_e_date = get_field('event_expire_date', $funf_id );

  $event_auth_name = $_POST['fund_author_name'];
  $event_auth_email = $_POST['fund_author_email'];
  $fund_auth_id = $_POST['fund_author_id'];

 //formating date
  $date  = date_create($_POST['f_strt_date']);
  $fund_dated = date_format($date,"Y/m/d");

  $tablename=$wpdb->prefix.'post_relationships';
  $data=array(
    'r_id' => $business_id, 
    'r_name' => $business_name,
    'rr_author_id' =>$business_auth_id,          
    'f_id' => $funf_id, 
    'f_name' => $fund_post_name,
    'f_date' => $fund_dated, 
    'f_end_date' => $fund_event_e_date,
    'f_start_time' => $fund_event_s_time, 
    'f_end_time' => $fund_event_e_time,
    'status' => none,
    'f_auth_name' => $event_auth_name,
    'f_auth_email' => $event_auth_email,
    'f_auth_id' => $fund_auth_id,
    'donor_id' =>0,
  );
  $insert = $wpdb->insert( $tablename, $data);

  if($insert)
  {

    // retailer info

    $retailer_info = get_userdata($business_auth_id);
    $retailer_name = $retailer_info->user_login;
    $retailer_email = $retailer_info->user_email;


    // admin info
    $user_info   = get_userdata(1);

    $admin_name  = $user_info->user_login;
    
    $admin_email = get_option( 'admin_email' );


        // write the email content for Retailer
    @$header_new1 .= "MIME-Version: 1.0\n";
    $header_new1 .= "Content-Type: text/html; charset=utf-8\n";
    @$headers_new1 .= "From:" . $admin_email;

    $message_new1 .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
    <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> Raise It</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$retailer_name) . 
    "</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
    $message_new1 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">A fundraiser is interted to host their Event in your Business. Plesae login for proved their Events. ','piereg</div>') . "</br></div>";

    $message_new1 .='</div><div style=color: #999;padding: 50px 30px">
    <div style="">Regards,</div>
    <div style="">Raise It Team</div>            
    </div></body></html>';

    $subject_new1 = "Raise It Notification";
    $subject_new1 = "=?utf-8?B?" . base64_encode($subject_new1) . "?=";

    $to_new1 = $retailer_email;

    // send the email to reatiler
    $email_new1 = wp_mail($to_new1, $subject_new1, $message_new1, $header_new1);


        // write the email content for fundraiser
    @$header_new2 .= "MIME-Version: 1.0\n";
    $header_new2 .= "Content-Type: text/html; charset=utf-8\n";
    @$headers_new2 .= "From:" . $admin_email;

    $message_new2 .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
    <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> Raise It</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$event_auth_name) . 
    "</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
    $message_new2 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">A Request have been sent to Retailer.Please wait for approvel ','piereg</div>') . "</br></div>";

    $message_new2 .='</div><div style=color: #999;padding: 50px 30px">
    <div style="">Regards,</div>
    <div style="">Raise It Team</div>            
    </div></body></html>';

    $subject_new2 = "Raise It Notification";
    $subject_new2 = "=?utf-8?B?" . base64_encode($subject_new2) . "?=";

    $to_new2 = $event_auth_email;

    // send the email to fundraiser
    $email_new2 =wp_mail($to_new2, $subject_new2, $message_new2, $header_new2);
  } 

  if($email_new2){
    ?>

    <script>
      $(document).ready(function(){
        $('.snt_email').trigger('click');
        $('.save-succes').html('Your request for hosting event has been successfully sent to retailer. The owner of this business event have recieved your request and will be in touch with you shortly.');
      });
    </script>
    <?Php 
  }

}

$user_id = get_query_var( 'author' );
$cover_image = get_field('banner_user_image', 'user_'.$user_id);
$profile_image = get_field('profile_user_image', 'user_'.$user_id);

?>
<div class="white_bkkk">
<div class="container-fluid profile_page">
  <div class="container">
    <div class="row">
      <div class="pp_border">
      <div class="col-md-12 col-sm-12 profile_border">
        <div class="profile_top">
          <div class="col-md-2 col-sm-3 col-xs-12 profile_name tabs_profile profile_left">




            <div class="pp_imge">
            <div class="img_profiles">
              <?php if($profile_image) { ?>
              <img class="img-responsive center-block profile-img" src="<?php echo $profile_image['url']; ?>">
              <?php } else {?>
              <img src="<?php echo site_url();?>/wp-content/uploads/2018/01/profile_img.png" class="img-responsive center-block profile-img">
              
              <?php } ?>
              <?php 
              if(is_user_logged_in())
              { 
                global $current_user;
                get_currentuserinfo();
                $username =  $current_user->user_nicename;
                if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                {
                  ?>
                  <div class="camera">
                  <button id="profile_picture" type="button" class="btn btn-info btn-default" data-toggle="modal" data-target="#edit_profile_popup" data-original-title="" title=""><i class="fa fa-camera" aria-hidden="true"></i></button></div>
                  <?php } } ?>

</div>

                </div>
                
                <!-- <button class="btn-default edit_profile">Edit</button> -->

                <ul class="nav nav-tabs tabs-right">
          <li class="active" style="display:none;"><a href="#tab_default_0" data-toggle="tab" style="display: none !important;"></a></li>



                  <li <?php if(!is_user_logged_in()){ ?> class="active hide" <?php } else  {?> class="hide" <?php } ?>><a href="#tab_default_1" data-toggle="tab">
                    <span><i class="fa fa-users" aria-hidden="true"></i></span> About Me
                  </a></li>

                  <li class="dropdownw myevent">
                    <a href="#" class="dropdown-togglew" data-toggle="dropdown">
                      <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span> My Fundraising Events
                    </a>

                    <ul class="dropdown-menuw nested_events">

                      <?php 
                      if(is_user_logged_in())
                      { 
                        global $current_user;
                        get_currentuserinfo();
                        $username =  $current_user->user_nicename;
                        if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                        {
                          ?>

                          <li><a href="<?Php echo site_url();?>/create-fundraising-event-page/" ><span><i class="fa fa-plus" aria-hidden="true"></i></span>Add Event</a></li>

                          <?php } } ?>


                          <li>
                            <a href="#tab_default_2" role="tab" data-toggle="tab">
                              <span><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>Approved</a></li>

                              <?php 
                              if(is_user_logged_in())
                              { 
                                global $current_user;
                                get_currentuserinfo();
                                $username =  $current_user->user_nicename;
                                if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                                {
                                  ?>


                                  <li><a href="#tab_default_3" role="tab" data-toggle="tab"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>Pending</a></li>


                                  <?php } }?>
                                </ul>
                              </li>


                              <li class="dropdownw myevents">
                                <a href="#" class="dropdown-togglew new-link" data-toggle="dropdown">
                                  <span><i class="fa fa-briefcase" aria-hidden="true"></i></span> My Business
                                </a>

                                <ul class="dropdown-menuw nested_events">


                                 <?php 
                                 if(is_user_logged_in())
                                 { 
                                  global $current_user;
                                  get_currentuserinfo();
                                  $username =  $current_user->user_nicename;
                                  if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                                  {
                                    ?>

                                    <li><a href="<?php echo site_url();?>/create-fundraising-host-page" ><span><i class="fa fa-plus" aria-hidden="true"></i></span>Add Business</a></li>



                                    <?php } }?>

                                    <li class="all_business">
                                      <a href="#tab_default_7" role="tab" data-toggle="tab"><span><i class="fa fa-briefcase" aria-hidden="true"></i></span>All Businesses </a></li>

                                      <?php 
                                      if(is_user_logged_in())
                                      { 
                                        global $current_user;
                                        get_currentuserinfo();
                                        $username =  $current_user->user_nicename;
                                       if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                                        {
                                          ?>
                                          <li class="apd_disapd"><a class="bus_tab2" href="#tab_default_12" role="tab" data-toggle="tab"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>Approve/Disapprove <br> Events</a></li>

                                          <?php } } ?>
										  
										   <li class="apd_disapd"><a class="bus_tab2" href="#tab_coupon_code" role="tab" data-toggle="tab"><span><i class="fa fa-tags" aria-hidden="true"></i></span>Total Coupon</a></li>
                                        </ul>


                                      </li>

                                      <?php 
                                      if(is_user_logged_in())
                                      { 
                                        global $current_user;
                                        get_currentuserinfo();
                                        $username =  $current_user->user_nicename;
                                       if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                                        {
                                          ?>


                                          <li class="hide"><a href="#tab_default_8" data-toggle="tab">
                                            <span><i class="fa fa-search" aria-hidden="true"></i></span>Search Businesses
                                          </a></li>



                                          <li class="hide"><a href="#tab_default_9" data-toggle="tab">
                                           <span><i class="fa fa-history" aria-hidden="true"></i></span>Donation History</a>

                                         </li>

                                         <?php } }?>

                                         <?php 
                                         if(is_user_logged_in())
                                         { 
                                          global $current_user;
                                          get_currentuserinfo();
                                          $username =  $current_user->user_nicename;
                                          if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                                          {
                                            ?> 

                                            <li class="hide"><a href="#" class="dropdown-togglew" data-toggle="dropdownw">
                                              <span><i class="fa fa-cog" aria-hidden="true"></i></span> Account Settings </a>

                                              <ul class="dropdown-menuw nested_events">

                                                <li class="hide">
                                                  <a type="button" class="btn  edit_info" data-toggle="modal" data-target="#edit_info_popup">
                                                    <span><i class="fa fa-pencil" aria-hidden="true"></i></span> Edit info </a>
                                                  </li> 

                                                  <li class="hide">
                                                    <a type="button" class="btn  edit_infos" data-toggle="modal" data-target="#change_password_popup">
                                                      <span><i class="fa fa-unlock" aria-hidden="true"></i></span> Change password </a>
                                                    </li>

                                                    <li class="hide">
                                                      <a type="button" class="btn  edit_infos" data-toggle="modal" data-target="#add_wepay_popup">
                                                        <span><i class="fa fa-plus" aria-hidden="true"></i></span> Add Wepay Info </a>
                                                      </li>



                                                    </ul>  

                                                  </li>

                                                  <?php } }?>
                                                </ul>
                                              </div>
                                            </div>




                                            <div class="col-md-10 col-sm-9 col-xs-12 tabs_profile2">  
                                              <div class="profile_right">




                                                <?php 
                                                if(is_user_logged_in()){
                                                 if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles))){
                                                  require 'wepay.php';
      $client_id         = get_option('wepay_client_id');
      $client_secret     = get_option('wepay_client_secret');
/*
      $client_id         = "167968";
      $client_secret     = "d1bc41a2d7";*/
                                                  $account_id = get_user_meta($user_id,'account_id',true);
                                                  $access_token = get_user_meta($user_id,'access_token',true);

                                                  if($account_id !="" AND $access_token !="")
                                                  {  
                                                   Wepay::useStaging($client_id, $client_secret);
                                                   $wepay = new WePay($access_token);

                                                   
                                                   $response = $wepay->request('account', array(
                                                    'account_id'    => $account_id
                                                  ));

                                                   $state = $response->state;

                                                   if($state =="pending" )
                                                   {   

                                                    ?>
                                                    <p class="alert alert-danger">Your wepay account is not verified yet. Please check your email and verify your wepay account, so that you can get payments from donors to your account.</p>
                                                    <?Php
                                                  }
                                                }
                                              }
                                            }
                                            ?>



                                                <div class="tab-content">

<div class="tab-pane active" id="tab_default_0">

                  <?php 
              if(is_user_logged_in())
              { 
                global $current_user;
                get_currentuserinfo();
                $username =  $current_user->user_nicename;
                if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                {
                  ?>
                  <div class="col-md-12 col-sm-12 edit_all">
                    <ul class="list-inline list-unstyled profile_buttons">
                      <li><a href="<?php echo site_url();?>/create-fundraising-host-page/" ><button type="button">Sponsor Fundraiser</button></a></li>
                      <li><a href="<?php echo site_url();?>/create-fundraising-event-page/" ><button type="button">Request Fundraiser</button></a></li>
                      <?php if($state == "action_required" || $state == "active") {?>
                      <li><a href="https://go.wepay.com/" ><button type="button">Go to the Wepay account</button></a></li>
                      <?php } ?>
                      <li><?php echo do_shortcode('[logout_to_home]'); ?></li>
                    </ul>
                  </div>

                 <?PHP }} ?>
               </div>

                                                  <!-- Tab panes -->

                                                  <div <?php if(!is_user_logged_in()){ ?> class="active tab-pane info_about" <?php } else  {?> class="tab-pane info_about" <?php } ?> id="tab_default_1"> 
                                                    <h2>Your Profile Info</h2>
                                                    <div class="chng_extra">
                                                    </div>
                                                    <h3>Name :<br><span><div class="icon_mail"><i class="fa fa-user-o" aria-hidden="true"></i></div><?php echo ucfirst(get_the_author_meta('first_name', $user_id )) .' '.ucfirst(get_the_author_meta('last_name', $user_id ));?></span></h3>
                                                    <h4>Email Address :<br><span><div class="icon_mail"><i class="fa fa-envelope-o" aria-hidden="true"></i></div> <a href= "mailto:<?php echo get_the_author_meta('email', $user_id); ?>"><?php echo get_the_author_meta('email', $user_id); ?></a></span></h4>
                                                    <h5>Contact No. : <br><span><div class="icon_mail"><i class="fa fa-phone" aria-hidden="true"></i>
                                                    </div><a href="tel:<?php echo get_usermeta($user_id , $meta_key = 'user_phone' );?>">
                                                     <?php 
                                                     if(get_field( "phone" )){
                                                      echo get_field( "phone" );
                                                    }
                                                    else{
                                                     echo get_usermeta($user_id , $meta_key = 'user_phone' );
                                                   }
                                                   ?></a></span></h5>

                                                 </div>


                                                 <!-- if event is approved -->

                                                 <div class="tab-pane" id="tab_default_2">
                                                  <div class="info_about">
                                                    <h2>Your Approved Events</h2>
                                                  </div>
                                                  <div>

                   <?php
                   global $paged1; global $args1;
                   $paged1 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                   $args1= null;
                   $args1 = array( 'post_type' => 'fundraiser', 'posts_per_page' => 10,'post_status' =>'publish','paged' => $paged,'author' =>  $user_id);
                   $loop1 = new WP_Query( $args1 );
                   if( $loop1->have_posts())
                   {
                    while ( $loop1->have_posts() ) : $loop1->the_post();
                      ?>

                      <?php

                          //$feature_image_app = get_field('feature_image_1',$POST_ID);
                          $feature_image_app = get_the_post_thumbnail_url($POST_ID); 


                      ?>

                      <div class="col-md-4 col-sm-6 post_list">
                       <figure>

                        <div class="post_border">
                          <div class="thumb_image">
                            <div class="blanks">
                              <?php if($feature_image_app){
                                echo'<img class="img-responsive innerimages" src="'.$feature_image_app.'">';
                              }
                              else{
                                echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                              </div>
                            </div>
                            <div class="com_div">
                            <div class="col-sm-12 col-md-12 post_titl1">
                              <?php $trimtitle = get_the_title(); $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                              echo '<h4>' . '<a class="post_titles" href="' . get_permalink() . '" >' . ucfirst($shorttitle) . '</a></h4>';?>
                            </div>
                            <div class="col-sm-12 col-md-12 post_titl">
                              <?php echo '<p class="aaa">'; echo wp_trim_words( get_the_content(), '5', '..' );  echo'</p>';?>
                              <h5 class="hvrnone">
                              <?php

                             $fundraiser_id = $post->ID;
                              global $wpdb;
                              $aproved_query = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$fundraiser_id");
                              $count = count($aproved_query);
                              foreach ($aproved_query as $key => $new_approved)
                              {
                                $rr_id11 = $new_approved->r_id;
                                $post_slug11 = get_post_field( 'post_name', $rr_id11 );
                              }
                              
                              $approved_new_qry = $wpdb->get_results("SELECT * FROM wp_post_relationships where r_id = $rr_id11 AND f_id = $fundraiser_id");
                             // echo $count = count($approved_new_qry);

                              foreach ($approved_new_qry as $key => $newquery11)
                              {
                                $r_new11 = $newquery11->r_name;
                                $r_neww22 = $newquery11->f_auth_name;
                                $outh_id = $newquery11->rr_author_id;
                                $auth_name= get_the_author_meta('first_name', $outh_id).' '.get_the_author_meta('last_name', $outh_id);
                                ?>
                                <?php echo ucfirst($auth_name);?>
                                <?php  }
                              
                                ?>
                                </h5>
                              </div>
                            </div>
                            </div>
                            <?php
                            if(is_user_logged_in())
                            {  
                             if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                             { 
                              ?>
                              <figcaption>
                                <ul class="list-inline list-unstyled hvrbtn">
                                  <li><a href="<?php echo get_permalink(); ?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                  <li><a href="<?php echo home_url();?>/edit-events/?edit_id=<?php echo the_ID();?>" data-toggle="tooltip2" title="Edit!"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                  <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_fund<?php echo the_ID();?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                </ul>
                              </figcaption>
                              <?php } } ?>

                                <div class="modal fade" id="myModal33_fund<?php echo the_ID();?>" role="dialog">
                                  <div class="modal-dialog delete_modal">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Delete Event!</h4>
                                              </div>
                                      <div class="modal-body">
                                        <h3>Are you sure you want to delete your Event Name?</h3>
                                        <!-- <h4>This <u> cannot </u> be undone</h4> -->
                                        <form action="" method="post" class="form_delete">
                                          <ul class="list-inline list-unstyled">
                                            <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                                            <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_id1=<?php echo the_ID();?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>

                                          </ul>
                                        </form> 
                                      </div>
                                    </div>

                                  </div>
                                </div>


                            </figure>
                          </div>



                          <?php 
                        endwhile;
                        wp_reset_query();
                      }
                      else{
                        echo "<div class='alert alert-warning fs-error-fund'><span style='color:red;'> There is no event available. You haven't added any events yet, please click on add event button to start fundraising</span></div>";
                      }

                      if(isset($_GET['del_id1'])){
                        $else_del_id1 = $_GET['del_id1'];
                        wp_trash_post($else_del_id1);
                        header("location:".site_url()."/user/".$username);
                      }

                      ?>
                    </div>

                  </div>



                  <!-- if event is pending -->

                  <div class="tab-pane" id="tab_default_3">
                    <div class="info_about">
                      <h2>Your Pending Events</h2>
                    </div>

                    <div>

                  <!-- ============================ --> 
<div id="panding_acco" class="main">
      <div class="accordions">
      <div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-1">Your Pending Events</a>
        <div id="accordion-1" class="accordion-section-content">
            <div class="border_acc1">

        <?php



          global $paged2; global $args2;
          $paged2 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
          $args2 = null;


          $args2 = array( 'post_type' => 'fundraiser', 'posts_per_page' => 10,'post_status' =>'draft','paged' => $paged,'author' =>  $user_id);

          $loop2 = new WP_Query($args2);
          if( $loop2->have_posts()){

            while ( $loop2->have_posts() ) : $loop2->the_post();
        ?>

        <?php
        $pending_ids = get_the_ID();

        $check_stats = $wpdb->get_results("SELECT * FROM wp_post_relationships where r_id=$rr_id2 AND f_id=$pending_ids");
        ?>


        <div class="col-md-4 col-sm-6 post_list pending_list">
          <figure>
            <div class="post_border">
              <div class="thumb_image">
                <div class="blanks">

                  <?php 

                         $pending_ids = get_the_ID();

                        // $pending_img  = get_field('feature_image_1',$pending_ids);
                         $prnding_url1 = get_the_post_thumbnail_url($pending_ids); 


                  if($prnding_url1){
                    echo'<img class="img-responsive innerimages" src="'.$prnding_url1.'">';
                  }
                  else{
                    echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                  </div>
              </div>
              <div class="com_div">
                  <div class="col-sm-12 col-md-12 post_titl1">
                    <?php $trimtitle = get_the_title(); $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                    echo '<h4 class="title_event">' . '<a class="post_titles" href="' . get_permalink() . '" >' . ucfirst($shorttitle) . '</a></h4>'; ?>
                  </div>
                   <div class="col-sm-12 col-md-12 post_titl">
                  <?php echo '<p>'; echo wp_trim_words( get_the_content(), '3', '...' );  echo'</p>';?>
                   <p class="hvrnone"><span>Status:</span> Pending <p/>
                   </div>
                 </div>

            </div>

               <?php 
                 if(is_user_logged_in())
                 { 
                 if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                  {
              ?>
                <figcaption>
                  <ul class="list-inline list-unstyled hvrbtn">
                    <li><a href="<?php echo home_url();?>/fundraiser/?p=<?php echo the_ID();?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo home_url();?>/edit-events/?edit_id=<?php echo the_ID();?>" data-toggle="tooltip2" title="Edit!"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                    <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_pend<?php the_ID();?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                  </ul>
                </figcaption>


              <?php 
                  }
                }
              ?>
                 <!-- popup for delete -->
                  <div class="modal fade" id="myModal33_pend<?php the_ID();?>" role="dialog">
                    <div class="modal-dialog delete_modal">

                      <!-- Modal content-->
                      <div class="modal-content">
                    <div class="modal-header">    
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete pending event!</h4>
        </div>

                        <div class="modal-body">
                          <h3>Are you sure you want to delete your pending event? </h3>
                          <!-- <h4>This <u> cannot </u> be undone</h4> -->
                          <form action="" method="post" class="form_delete" id="del<?php the_ID();?>">
                            <ul class="list-inline list-unstyled">
                              <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                              <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_id111=<?php echo the_ID();?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>
                            </ul>
                          </form> 
                        </div>


                      </div>

                    </div>
                  </div>  





          </figure>
        </div>


        <?php
            endwhile;

            wp_reset_query();
          }
          else
          {
            echo "<div class='alert alert-warning fs-error-fund'><span style='color:red;'> No event available </span></div>";
          }

          if(isset($_GET['del_id111']))
          {

            $else_del_id2 = $_GET['del_id111'];
            wp_trash_post($else_del_id2);
            header("location:".site_url()."/user/".$username);
          }

          ?>


            </div>

        </div><!--end .accordion-section-content-->
      </div><!--end .accordion-section-->

      <div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-2">Your Requested Events</a>
        <div id="accordion-2" class="accordion-section-content">
          <div class="border_acc">

            <?php

            global $res_paged; global $res_args;
            $res_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $res_args  = null;
            $res_args  = array( 'post_type' => 'fundraiser', 'posts_per_page' => -1,'post_status' =>'none','paged' => $paged,'author' =>  $user_id);
            $res_loop = new WP_Query($res_args);
            if( $res_loop->have_posts()){
             while ( $res_loop->have_posts() ) : $res_loop->the_post();
            ?>

           <?php

                  $fundraiser_id2 = $post->ID;

                  global $wpdb;
                  $new_query2 = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $fundraiser_id2");
                  foreach ($new_query2 as $key => $new_qry2)
                  {
                   $rr_id2 = $new_qry2->r_id;
                   $post_slug2 = get_post_field( 'post_name', $rr_id2 );
                 }

                 $test_qery2 = $wpdb->get_results("SELECT * FROM wp_post_relationships where r_id=$rr_id2 AND f_id=$fundraiser_id2");
                 foreach ($test_qery2 as $key => $new_qq22)
                 {
                  $test_qery22 = $new_qq22->r_name;
                  $test_qery2211 = $new_qq22->status;
            ?>

            <?php
            if($test_qery2211 == 'none' || $test_qery2211== '0'){



        //$res_image = get_field('feature_image_1',$fundraiser_id2);
        $res_imageurl =  get_the_post_thumbnail_url($fundraiser_id2);

            ?>
            <div class="col-md-4 col-sm-6 post_list pending_list">
              <figure>
                <div class="post_border">
                  <div class="thumb_image">
                    <div class="blanks">
                      <?php if($res_imageurl){
                        echo'<img class="img-responsive innerimages" src="'.$res_imageurl.'">';
                      }
                      else{
                        echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                      </div>
                    </div>

<div class="com_div">
                  <div class="col-sm-12 col-md-12 post_titl1">
                  <?php $trimtitle = get_the_title(); $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                  echo '<h4 class="title_event">' . '<a class="post_titles" href="' . get_permalink() . '" >' . ucfirst($shorttitle) . '</a></h4>'; ?>
                  </div>

            <div class="col-sm-12 col-md-12 post_titl">
            <?php echo '<p>'; echo wp_trim_words( get_the_content(), '5', '...' );  echo'</p>';?>
              <p class="hvrnone"><span>Requested To:</span>  <a href="<?php site_url()?>/retailer/<?php echo $post_slug2;?>"><?php echo wp_trim_words($test_qery22, '3', '...');?></a></p>

            </div>
          </div>
                </div>



                  <?php 
                  if(is_user_logged_in())
                  { 
                   if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                    {

                    ?>

                <figcaption>
                  <ul class="list-inline list-unstyled hvrbtn">
                    <li><a href="<?php echo home_url();?>/fundraiser/?p=<?php echo the_ID();?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo home_url();?>/edit-events/?edit_id=<?php echo the_ID();?>" data-toggle="tooltip2" title="Edit!" ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                    <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_req<?php the_ID();?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                  </ul>

                </figcaption>
                    <?php 
                  }
                }
                    ?>

 <!-- popup for delete -->
                  <div class="modal fade" id="myModal33_req<?php the_ID();?>" role="dialog">
                    <div class="modal-dialog delete_modal">

                      <!-- Modal content-->
                      <div class="modal-content">

          <div class="modal-header">    
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete requested event!</h4>
        </div>


                        <div class="modal-body">
                          <h3>Are you sure you want to delete your requested event?</h3>
                          <!-- <h4>This <u> cannot </u> be undone</h4> -->
                          <form action="" method="post" class="form_delete" id="del<?php the_ID();?>">
                            <ul class="list-inline list-unstyled">
                              <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                              <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_idres=<?php echo the_ID();?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>
                            </ul>
                          </form> 
                        </div>


                      </div>

                    </div>
                  </div>  



              </figure>
            </div>
            <?Php }?>

             <?php
                   }
                endwhile;
                wp_reset_query();
              }
              if(isset($_GET['del_idres']))
              {
                $else_del_res = $_GET['del_idres'];
                wp_trash_post($else_del_res);
                header("location:".site_url()."/user/".$username);
              }
            ?>


          </div>
        </div><!--end .accordion-section-content-->
      </div><!--end .accordion-section-->

      <div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-3">Your Disapproved Events</a>
        <div id="accordion-3" class="accordion-section-content">
          <div class="border_acc">
            <?php
            $res_args  = array( 'post_type' => 'fundraiser', 'posts_per_page' => -1,'post_status' =>'none','author' =>  $user_id);
            $res_loop = new WP_Query($res_args);
            if( $res_loop->have_posts()){
              while ( $res_loop->have_posts() ) : $res_loop->the_post();
                $fundraiser_id22 = $post->ID;

                $new_query_dis = $wpdb->get_results("SELECT * FROM wp_post_relationships where status = 2 AND f_id = $fundraiser_id22");
               $count = count($new_query_dis);

               foreach ($new_query_dis as $key => $dis_status)
               {

              $dis_post_fund_id = $dis_status->f_id;
              $dis_post_name    = $dis_status->f_name;
              $post_slug = get_post_field( 'post_name', $dis_post_fund_id );
              $dis_f_img_url =  get_the_post_thumbnail_url($dis_post_fund_id);
              ?>
               <div class="col-md-4 col-sm-6 post_list pending_list">
                <figure>

                  <div class="post_border">
                        <div class="thumb_image">
                          <div class="blanks">
                            <?php if($dis_f_img_url){
                              echo'<img class="img-responsive innerimages" src="'.$dis_f_img_url.'">';
                            }
                            else{
                              echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                            </div>
                          </div>
                          <div class="com_div">

                          <div class="col-sm-12 col-md-12 post_titl1">
                            <?php $trimtitle = $dis_post_name; $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                            echo '<h4 class="title_event"><a href ="'.site_url().'/?post_type=fundraiser&p='.$dis_post_fund_id.'&preview=true">'.$shorttitle.'</a><h4>';


                            ?>
                          </div>
                          <div class="col-sm-12 col-md-12 post_titl">
                            <?php echo '<p>'; echo wp_trim_words( get_the_content(), '3', '...' );  echo'</p>';?>
                           </div>
                         </div>
                  </div>

                  <?php 
                  if(is_user_logged_in())
                  { 
                    if($current_user->ID == $user_id)
                    {

                      ?>
                      <figcaption>
                        <ul class="list-inline list-unstyled hvrbtn">
                          <li><a href="<?php echo home_url();?>/fundraiser/?p=<?php echo the_ID();?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                          <li><a href="<?php echo home_url();?>/edit-events/?edit_id=<?php echo $dis_post_fund_id;?>" data-toggle="tooltip2" title="Edit!"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                          <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_dis<?php echo $dis_post_fund_id;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                        </ul> 

                      </figcaption>

                      <!-- popup for delete -->
                      <div class="modal fade" id="myModal33_dis<?php echo $dis_post_fund_id;;?>" role="dialog">
                        <div class="modal-dialog delete_modal">

                          <!-- Modal content-->
                          <div class="modal-content">



                           <div class="modal-header">                           

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Disapproved event!</h4>
                          </div>

                          <div class="modal-body">
                            <h3>Are you sure you want to delete your disapproved event?</h3>
                            <!-- <h4>This <u> cannot </u> be undone</h4> -->
                            <form action="" method="post" class="form_delete" id="del<?php the_ID();?>">
                              <ul class="list-inline list-unstyled">
                                <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                                <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_id_dis=<?php echo $dis_post_fund_id;?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>
                              </ul>
                            </form> 
                          </div>


                        </div>

                      </div>
                    </div> 


                      <?php 

                    } } 

                    if(isset($_GET['del_id_dis']))
                    {

                      $else_del_id2 = $_GET['del_id_dis'];
                      wp_trash_post($else_del_id2);
                      header("location:".site_url()."/user/".$username);
                    }



                    ?>


                </figure>
               </div>

             <?php 
             } 

              endwhile;
            }


            else{
              echo "<div class='alert alert-warning fs-error-fund'><span style='color:red;'> No disapproved event!</span></div>";
            }
            ?>

          </div>
        </div><!--end .accordion-section-content-->
      </div><!--end .accordion-section-->
    </div><!--end .accordion-->      
</div>


<script>
  jQuery(document).ready(function() {
  function close_accordion_section() {
    jQuery('.accordions .accordion-section-title').removeClass('active');
    jQuery('.accordions .accordion-section-content').slideUp(300).removeClass('open');
  }

  jQuery('.accordion-section-title').click(function(e) {
    // Grab current anchor value
    var currentAttrValue = jQuery(this).attr('href');

    if(jQuery(e.target).is('.active')) 
  {
      close_accordion_section();
    }else {
      close_accordion_section();

      // Add active class to section title
      jQuery(this).addClass('active');
      // Open up the hidden content panel
      jQuery('.accordions ' + currentAttrValue).slideDown(300).addClass('open'); 
    }

    e.preventDefault();
  });
});</script>


</div>


    <!-- =============End accordion=============== -->



                                    </div>

                                    <!-- if post_meta is retailer -->

                                    <div class="tab-pane" id="tab_default_7">
                                      <div class="info_about">
                                        <h2>Your All Business</h2>
                                      </div>

                                      <div class="search_ret loader_serach1">

                                       <div id="search12"> 

                                         <input id="search_ret_names" name="search_ret_names" class="form-control input-lg" placeholder="Search business name">
                                         <!-- <input type="button" id="serach_retas" class="btn btn-default" value="Go"> -->
                                       </div>
                                       <div class="loader12">
                                         <div id="dvLoading1" style="display:none;"></div>
                                       </div>
                                     </div>

                                     <div>

                                       <?php

                                       global $paged3; global $args3;
                                       $paged3 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                                       $args3 = null;
                                       $args3 = array( 'post_type' => 'retailer', 'posts_per_page' => 10,'post_status' =>'publish','paged' => $paged,'author' =>  $user_id);
                                       $loop3 = new WP_Query( $args3 );
                                       if( $loop3->have_posts()){
                                        while ( $loop3->have_posts() ) : $loop3->the_post();
                                          ?>



                                          <div class="col-md-4 col-sm-6 post_list nnew_post">
                                            <figure>
                                              <div class="post_border">
                                                <div class="thumb_image">
                                                  <div class="blanks">
                                                    <?php

                                    //$feature_image_1 = get_field('feature_image_1',$post->ID);
                                    $feature_image1 =  get_the_post_thumbnail_url($post->ID);
                                                    ?>


                                                    <?php if($feature_image1){
                                                      echo'<img class="img-responsive innerimages" src="'.$feature_image1.'">';
                                                    }
                                                    else{
                                                      echo'<img class="img-responsive innerimages" src="'.site_url().'/wp-content/uploads/2017/09/dummy_img.jpg">'; } ?>
                                                    </div>
                                                  </div>
                                                  <div class="com_div">
                                                  <div class="col-sm-12 col-md-12 post_titl1">

                                                    <?php $trimtitle = get_the_title(); $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
                                                    echo '<h4 class="title_event">' . '<a class="post_titles" href="' . get_permalink() . '" >' . ucfirst($shorttitle) . '</a></h4>';?>
                                                  </div>
                                                  <div class="col-sm-12 col-md-12 post_titl">
                                                    <?php echo '<p>'; echo wp_trim_words( get_the_content(), '4', '...' );  echo'</p>';?>
                                                    <?php $retailer_id1 = $post->ID; 
                                                    ?>
                                                  </div>
                                                </div>
                                              </div>
                                                <?php 
                                                if(is_user_logged_in())
                                                { 
                                                  if($current_user->ID == $user_id || (in_array("administrator", $user_roles)) || (in_array("editor", $user_roles)))
                                                  {

                                                    ?>
                                                    <figcaption>
                                                      <ul class="list-inline list-unstyled hvrbtn">
                                                        <li><a href="<?php echo get_permalink(); ?>"  data-toggle="tooltip" title="View!"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                        <li><a href="<?php echo home_url();?>/edit-business-event?ids=<?php the_ID(); ?>" data-toggle="tooltip2" title="Edit!"  ><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a type="button" data-toggle="modal" title="Delete!" data-target="#myModal33_bus<?php echo the_ID();?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                      </ul>

                                                    </figcaption>

                                                    <?php } } ?>
           <!-- popup for delete -->
                    <div class="modal fade" id="myModal33_bus<?php echo the_ID();?>" role="dialog">
                      <div class="modal-dialog delete_modal">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Business event!</h4>
        </div>

                          <div class="modal-body">
                            <h3>Are you sure you want to delete your Business Name? </h3>
                            <!-- <h4>This <u> cannot </u> be undone</h4> -->
                            <form action="" method="post" class="form_delete" id="">
                              <ul class="list-inline list-unstyled">
                                <li><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></li>
                                <li><a href='<?php echo site_url();?>/user/<?php echo $username; ?>/?del_id=<?php echo the_ID();?>'><button type="button" class="btn btn-default" name="delete_else1">Delete</button></a></li>
                              </ul>
                            </form> 
                          </div>


                        </div>

                      </div>
                    </div>  
                                                  </figure>
                                                </div>

                                                <?php 
                                              endwhile;
                                              wp_reset_query();
                                            }
                                            else{
                                              /*echo "<h5>No business event available</h5>";*/
                                              echo "<div class='alert alert-warning fs-error-fund'><span style='color:red;'> No business event available</span></div>";
                                            }
                                            if(isset($_GET['del_id'])){
                                              $else_del_id = $_GET['del_id'];
                                              wp_trash_post($else_del_id);
global $wpdb;
$del = $wpdb->query('DELETE FROM wp_post_relationships where r_id =  "'.$else_del_id.'"');

                                              header("location:".site_url()."/user/".$username);
                                            }
                                            ?>
                                          </div>

                                          <div id="show_posts"></div>

                                        </div>



                                        <!-- code for search retalier -->

                                        <div class="tab-pane" id="tab_default_8">
                                          <div class="info_about">
                                            <h2>Search Business</h2>
                                          </div>

                                          <div class="container-fluid back_table loader_serach">
                                            <div class="row">


                                              <div class="col-md-12 col-sm-12 local_head2 text-center">
                                                <h1>Find a Local Business</h1>

                                              </div>

                                              <div class="col-md-12 col-sm-12 text-center fieldset_4">
                                                <!-- <form class="form_search search_zip" role="search" name="search_form" action="#" method="post"> -->
                                                  <div id="search">
                                                    <!-- <input type="button" id="newsearchsubmit" class="btn btn-default go_zip" value="Go"> -->
                                                    <!-- <button type="button" class="btn btn-default go_zip">Go</button> -->
                                                    <input id="search-input_1" name="search_zip_code" class="form-control input-lg" placeholder="Enter Zip Code OR City">
                                                  </div>
                                                  <div id="dvLoading" style="display:none;"></div>
                                                  <!-- </form> -->

                                                  <div id="show_results"></div>   

                                                </div>
                                              </div>
                                            </div>



                                          </div>


                                          <!-- code for payment history -->

                                          <div class="tab-pane" id="tab_default_9">

                                            <div class="info_about">

                                              <h2>Your Donation History</h2>
                                            </div>


                                            <div class="row">
                                              <div class="col-sm-12 col-md-12">

                                               <?php  
                                               $user = wp_get_current_user();
                                               global $wpdb;
                                               $get_donate_post = $wpdb->get_results("SELECT * FROM wp_donation WHERE donars_id =$user_id");

                                               $post_count = count($get_donate_post);  


                                               echo '<table class="table table-bordered first_business_event">
                                               <h3 class="count_posts">History ('.$post_count.')</h3>
                                               <thead>
                                               <tr>

                                               <th>No.</th>       
                                               <th>Name</th>
                                               <th>Event Name</th>
                                               <th>Amount</th>
                                               </tr>
                                               </thead>';


                                               $i=1;
                                               foreach ($get_donate_post as $key => $newid)  {

?>




<tbody>                   

  <tr>
   <td><?php echo $i;?></td>
   <td><?php echo $newid->fund_auth_name; ?></td>
   <td> <?php echo $newid->fund_name; ?></td>
   <td> <?php echo "$".$newid->donation_amt; ?></td>


 </tr>
</tbody>

<?php
$i++;
}

?>
</table>
</div>
</div>
</div>




<!-- ==================================== -->


<!-- Couplon Code List -->

					  <div class="tab-pane" id="tab_coupon_code">

						<div class="info_about">

						  <h2>Total Couplon Generated</h2>
						</div>

						<div class="row">
						  <div class="col-sm-12 col-md-12">
						   
						   <h3 class="count_posts">Total Coupon (10)</h3>
						   <table class="table table-bordered first_business_event">
							<thead>                   

							  <tr>
							   <th>S.No.</th>
							   <th>Business Name</th>
								<th>Total Coupon</th>
								<th>Coupon Code</th>
							 </tr>
							</thead>
							
								<?php

                                       global $paged4; global $args4;
                                       $paged4 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                                       $args4 = null;
                                       $args4 = array( 'post_type' => 'retailer', 'posts_per_page' => 10,'post_status' =>'publish','paged' => $paged,'author' =>  $user_id);
                                       $loop4 = new WP_Query( $args4 );
                                       if( $loop4->have_posts()){
										   $i=1;
                                        while ( $loop4->have_posts() ) : $loop4->the_post();
										
										$trimtitle = get_the_title(); 
										$shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
										
										 $coupon_values = get_post_meta( get_the_ID(), 'coupen_code' );
										
										 $coupon_code = $coupon_values[0];
										
								  ?>	
								<tr>
								<td><?php echo $i ?></td>
								<td><?php  echo ucfirst($shorttitle);?></td>
								<td></td>
								<td><?php echo $coupon_code ?></td>
								</tr>
								<?php
								endwhile ;
								$i++;
									   }
								?>
							</table>
							</div>
							</div>
						</div>
		<!-- End Coupon Code List -->


<!-- approved disapproved events start-->

<div class="tab-pane" id="tab_default_12">
  <div class="info_about">

    <h2>Approve/Disapprove Events</h2>
  </div>

  <div class="col-sm-12 col-md-12 approved_disapproved">
    <div class="panel-group" id="accordion">
      <h4> All Your Business Events List</h4>
      <div class="panel-heading main">
       <!-- <span class="event-id">Event ID</span> --> <span class="event-name">Business Location Name</span>
     </div>
     <?php

     if(isset($_POST['submit']) && !empty($_POST['submit']))
     {
      $r_id   = $_POST['r_id'];
      $f_id   = $_POST['f_id'];
      $f_email   = $_POST['f_email'];
      $f_title   = $_POST['f_title'];
      $f_auth_name   = $_POST['f_auth_name'];

      $status = $_POST['status'];

      $admin_email = get_option( 'admin_email' );

      if($status == 'disapprove')
      {
        $status = '0';
      }elseif($status == 'approve'){

        $status = '1';
      }elseif($status == 'disapp'){

        $status = '2';
      }

      global $wpdb;

      $Update = $wpdb->query("UPDATE wp_post_relationships SET status = '$status' WHERE r_id = '$r_id' AND f_id = '$f_id' ");

          //$wpdb->show_errors();

      if($Update && $status == 1)
      {
        $pub = 'publish';
        $post_update = array( 'ID' => $f_id, 'post_status' => $pub );
        wp_update_post($post_update);

        @$header .= "MIME-Version: 1.0\n";
        $header .= "Content-Type: text/html; charset=utf-8\n";
        @$headers .= "From:" . $admin_email;

        $message .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
        <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> Raise It</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$f_auth_name) . 
        "</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
        $message .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">Congratulations, your request for '.$f_title.'  has been approved by retailer.','piereg</div>') . "</br></div>";

        $message .='</div><div style=color: #999;padding: 50px 30px">
        <div style="">Regards,</div>
        <div style="">Raise It Team</div>            
        </div></body></html>';

        $subject = "Event Approval Notification";
        $subject = "=?utf-8?B?" . base64_encode($subject) . "?=";

            // send the email to fundraiser
        $email1=wp_mail($f_email, $subject, $message, $header);

      }
      header("location:".site_url()."/user");

    }

    /******************** Event Disapproval functionality*****************************/

    if(isset($_POST['submit_disap_event']) && !empty($_POST['submit_disap_event']))
    {

     // $s_date = $_POST['s_date'];
    $s_time = $_POST['s_time'];

    $f_s_dates = date_create($_POST['s_date']);

    $s_date = date_format($f_s_dates,"Y/m/d");

    $f_e_dates = date_create($_POST['e_date']);

    $e_date = date_format($f_e_dates,"Y/m/d");


      //$e_date = $_POST['e_date'];
      $e_time = $_POST['e_time'];
      $email  = $_POST['email'];
      $e_id   = $_POST['e_id'];
      $r_id   = $_POST['r_id'];
      $e_title = $_POST['e_title'];
      $f_auth_name = $_POST['f_auth_name'];
      $f_comment = $_POST['comment'];

      $status = '0';
      $admin_email = get_option( 'admin_email' );

          //Send Email For Event Disaaproval

      global $wpdb;
      $Update = $wpdb->query("UPDATE wp_post_relationships SET status = '$status' WHERE r_id = '$r_id' AND f_id = '$e_id' ");

      $status="draft";
      $post_update = array( 'ID' => $e_id, 'post_status' => $status );
      wp_update_post($post_update); 

            // write the email content for fundraiser
      @$header .= "MIME-Version: 1.0\n";
      $header .= "Content-Type: text/html; charset=utf-8\n";
      @$headers .= "From:" . $admin_email;

      $message1 .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
      <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> Raise It</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$f_auth_name) . 
      "</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
      $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 25px;">Your request for '.$e_title.'  has been disapproved by retailer.','piereg</div>') . "</div>";

      $message1 .= __('<p style="padding: 0px 0;font-size: 18px;line-height: 30px;">No problem, you can still make a request to host your event with this retailer event by providing the new availability date and timing of your event.</p> <p style="padding: 0px 0;font-size: 18px;line-height: 30px;">Please check the new available date and time of the requested retailer event as below.</p>');

      $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">Start Date :-'.$s_date,'piereg</div>') . "</div>";

      $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">Expire Date:-'.$s_time,'piereg</div>') . "</div>";  

      $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">End time:-'.$e_date,'piereg</div>') . "</div>";

      $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">End time:-'.$e_time,'piereg</div>') . "</div>"; 

      $message1 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 30px;">Message:-'.$f_comment,'piereg</div>') . "</div>"; 


      $message1 .='</div><div style=color: #999;padding: 50px 30px">
      <div style="">Regards,</div>
      <div style="">Raise It Team</div>            
      </div></body></html>';

      $subject = "Event Disapproval Notification";
      $subject = "=?utf-8?B?" . base64_encode($subject) . "?=";

          // send the email to fundraiser
      $email1=wp_mail($email, $subject, $message1, $header);

      header("location:".site_url()."/user");



    }

    global $wp_query;
    global $current_user;

          //get_currentuserinfo(); 

    $user = wp_get_current_user();

    $cc_user_email = $user->user_email;

    $args = array( 'author' => $user->ID,'post_type' => 'retailer', 'posts_per_page' => -1,'post_status' =>'publish');

    $query = new WP_Query( $args);

    if($query->have_posts())
    {
      $i=1;
      $post = get_the_ID(); 

      while ($query->have_posts()) : $query->the_post(); 
        ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">

              <!-- <span class="event_id"> <?php //the_id(); ?> </span> --> 
              <a class="collapsed" aria-expanded="false" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i ;?>" title="Click to see list of requested fundraiser events for this retailer."><?php the_title();?></a>

            </h4>
          </div>

          <div id="collapse<?php echo $i ;?>" class="panel-collapse collapse chcek_collapse">

            <?php

            global $wpdb;
            $count_data =$wpdb->get_results("SELECT *
              FROM wp_post_relationships as post
              JOIN wp_postmeta as meta
              on post.f_id = meta.post_id
              where meta_key = 'event_expire_date' and  r_id =".get_the_ID()."");
            $counnt = count($count_data);
            if($counnt == 0)
            {
              echo "<p>No request available</p>";
            }
            else{
              ?>

              <table class="widefat table table-bordered show_fnd">
                <thead>
                  <tr>
                    <!-- <th>ID</th> -->
                    <th>Fundraiser Name</th>
                    <th>Event Name</th>                        
                    <th>Event Start Date And Time</th>                        
                    <th>Event End  Date  And Time </th>                                               
                    <th>Approve/Disapprove</th>
                    <th>Status</th>
                    <th>Save</th>
                  </tr>
                </thead>
                <tbody>                   

                  <?php 
                  global $wpdb;
                // $data = $wpdb->get_results("SELECT * FROM wp_post_relationships where r_id =".get_the_ID()."") ;

                  $data =$wpdb->get_results("SELECT *
                    FROM wp_post_relationships as post
                    JOIN wp_postmeta as meta
                    on post.f_id = meta.post_id
                    where meta_key = 'event_expire_date' and  r_id =".get_the_ID()."");

                 // print_r($data);
                 // echo $count = count($data);
                
                foreach($data as $nData)
                {
                  $f_id      = $nData->f_id;
                  $f_name    = $nData->f_name;
                  $f_auth_id = $nData->f_auth_id;
                  $statusN    = $nData->status;
                  $f_auth_name = $nData->f_auth_name;
                  $f_auth_email = $nData->f_auth_email;
                  $f_date       = $nData->f_date;
                  $f_stime = $nData->f_start_time;
                  $f_etime = $nData->f_end_time;
                  // $my_date = $f_date;
                  $end_date = $nData->meta_value;
                  
                  ?>              

                  <form method="post" action="#" class="approve_disapprove"> 

                    <tr>
                     <!-- <td><?php echo $f_id; ?></td> -->

                     <td><?php echo $f_auth_name; ?></td>

                     <td><?php echo $f_name; ?></td>

                     <td><?php echo  date(' jS F , Y', strtotime($f_date)); ?>                   
                       <?php echo date("g:i A", strtotime($f_stime)); ?></td>

                       <td><?php echo date(' jS F , Y', strtotime($end_date)); ?>                   
                         <?php echo date("g:i A", strtotime($f_etime)); ?></td>


                         <td>

                          <label class="radio-inline">
                            <input type="radio" name="status" value="approve" <?php if($statusN == 1) echo 'checked ="checked"'; ?> data-rid_new="<?php echo get_the_ID(); ?>" data-f_id_new="<?php echo $f_id;?>" data-f_email_new="<?php echo $f_auth_email;?>" data-f_title_new="<?php echo $f_name; ?>" f_auth_name_new="<?php echo $f_auth_name;?>"> Approve</label>

                            <label class="radio-inline">
                              <input type="radio" name="status" value="disapp" <?php if($statusN == 2) echo 'checked ="checked"'; ?> data-rid_new2="<?php echo get_the_ID(); ?>" data-f_id_new="<?php echo $f_id;?>" data-f_email_new="<?php echo $f_auth_email;?>" data-f_title_new="<?php echo $f_name; ?>" f_auth_name_new="<?php echo $f_auth_name;?>">Disapprove</label>

                              <label class="radio-inline">
                                <input type="radio" name="status" value="disapprove" 
                                <?php if($statusN == 'none')
                                {

                                }elseif($statusN == 0)
                                {
                                  echo 'checked ="checked"';
                                }
                                ?> data-title="<?php echo $f_name; ?>" data-fauthname="<?php echo $f_auth_name; ?>" data-email="<?php echo $f_auth_email; ?>" data-id="<?php echo $f_id; ?>" data-rid="<?php echo get_the_ID(); ?>">Change Time</label>

                              </td>
                              <td>
                               <?php 
                               if($statusN == 'none'){
                                 echo '<span style="color:red">pending</span>';

                               }else{
                                 if($statusN == 1)
                                 {
                                   echo '<span style="color:green">Approved</span>';
                                 }elseif($statusN == 0) {
                                   echo '<span style="color:red">Change Time Requested</span>';
                                 }elseif($statusN == 2)                   {
                                   echo '<span style="color:#333">Disapproved</span>';
                                 }elseif($statusN == 'none')                   {
                                   echo '<span style="color:#333">pending</span>';
                                 }
                               }
                               ?>
                             </td>
                             <td>
                               <input class="r_id_new" type="hidden" name="r_id" value="<?php echo get_the_ID(); ?>">
                               <input class="f_id_new" type="hidden" name="f_id" value="<?php echo $f_id; ?>">
                               <input class="f_email_new" type="hidden" name="f_email" value="<?php echo $f_auth_email; ?>">
                               <input class="f_title_new" type="hidden" name="f_title" value="<?php echo $f_name; ?>">
                               <input class="f_auth_name_new" type="hidden" name="f_auth_name" value="<?php echo $f_auth_name; ?>">
                               <input type="submit" value="Save" name="submit" class="approve_disapprove">
                               <!-- <span class="save_button"><i class="fa fa-floppy-o" aria-hidden="true"></i></span> -->

                             </td>
                           </tr>
                         </form>


                         <?php }?> 

                       </tbody>
                     </table>
                     <?php } ?>
                   </div>
                 </div>

                 <?php   
                 $i++;
               endwhile;
               wp_reset_query();

             }else{
              echo "<div class='no_event alert alert-warning'>";
              echo '<tr>';
              echo '<td class="alert alert-warning">No event created!</td>';
              echo '</tr>';
              echo "</div>";
            } 
            ?>  

            <input id="rid_new" type="hidden"  value="">
            <input id="f_id_new" type="hidden"  value="">
            <input id="f_email_new" type="hidden"  value="">
            <input id="f_title_new" type="hidden"  value="">
            <input id="f_auth_name_new" type="hidden"  value="">
       
       <input id="divid" type="hidden"  value="">
       <input id="app_disapp_val" type="hidden"  value="">


    </table>        
  </div> <!-- Div-- accordion-->
</div> <!--- Div--container-->

<!-- approve popup start -->

<div class="modal fade" id="accept_deny" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
       <h4 class="modal-title custom_align" id="Heading">Raise It</h4>
     </div>
     <form method="post" action="#" name="approve_event" id="app_form">
       <div class="modal-body">

        <div class="alert alert-danger" style="display: none;">
          <strong>Error:</strong> <span>Please select checkbox!</span>
        </div>
<div class="col-sm-12 col-md-12">


          <table class="widefatn">
            <tbody>   

              <tr>
                <td>
                  <label>Accept</label>
                  <div class="form-group">
                   <input type="radio" name="accept_deny" value="Accept">
                 </div>
               </td>
               <td>
                <label>Deny</label>
                <div class="form-group">            
                 <input type="radio" name="accept_deny" value="Deny">
               </div>

             </td>
           </tr>

      </tbody>
    </table>

  </div>



</div>
<div class="modal-footer ">
<!--   <input id="email" class="form-control" type="hidden" name="email" value=""> 
  <input id="e_id" class="form-control" type="hidden" name="e_id" value="">
  <input id="r_id" class="form-control" type="hidden" name="r_id" value="">
  <input id="e_title" class="form-control" type="hidden" name="e_title" value="">
  <input id="f_auth_name" class="form-control" type="hidden" name="f_auth_name" value="">
  <input id="chnage_time_req" class="form-control" type="hidden" name="chnage_time_req" value=""> -->
  <div class="col-md-12 col-md-12">
    <input type="submit" name="submit_approv_event" class="btn btn-primary  btn-md" style="width: 30%;" value="Save" />
  </div>
</div>
</form>
</div>
</div>

</div>


<!-- approve popup end -->






<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
       <h4 class="modal-title custom_align" id="Heading">Raise It</h4>
     </div>
     <form method="post" action="#" name="disapprove_event" id="dis_app_form">
       <div class="modal-body">

        <div class="alert alert-danger">
          <strong>Error:</strong> <span>Please select date!</span>
        </div>

        <h5>Let this fundraiser notify the reason for disapproval of their event and share the availability of date and time of your event through email.</h5>
        <span>Please select the date and time for the availability of the event for fundraiser below.</span>

        <div class="col-sm-12 col-md-12">

          <table class="widefatn">
            <tbody>   

              <tr>
                <td>
                  <label>Event Start Date</label>
                  <div class="form-group">
                   <input id="e_s_date" class="form-control" type="text" name="s_date" placeholder="Start Date">
                 </div>
               </td>
               <td>
                <label>Event Start Time</label>
                <div class="form-group">            
                 <input type="text" id='e_s_time' placeholder="Start Time" class="timepicker form-control mycls e_s_time" name="s_time" value="8:00am" />

                 <input id="e_s_time2" class="mycls " type="hidden" name="s_time" value="">
               </div>

             </td>
           </tr>
           <tr>
            <td>
             <label>Event Expire Date</label>
             <div class="form-group">
               <input id="e_e_date" class="form-control" type="text" name="e_date" placeholder="Expire Date">
             </div>
           </td>

           <td>
             <label>Event End Time</label>
             <div class="form-group">           

               <input type="text" id='e_e_time' placeholder="End Time" class="timepicker form-control mycls e_e_time" name="e_time" value="12:00pm" />



               <input id="e_e_time2" class="mycls" type="hidden" name="e_time"  value="">        
             </div> 
           </td>
         </tr>

         <tr>
           <td colspan="3">
            <div class="cmnt">
              <label for="comment">Message:</label>
              <textarea class="form-control" rows="3" id="comment" placeholder="Your message to fundraiser" name="comment"></textarea>
            </div>
          </td>
        </tr>

      </tbody>
    </table>
  </div>
</div>
<div class="modal-footer ">
  <input id="email" class="form-control" type="hidden" name="email" value=""> 
  <input id="e_id" class="form-control" type="hidden" name="e_id" value="">
  <input id="r_id" class="form-control" type="hidden" name="r_id" value="">
  <input id="e_title" class="form-control" type="hidden" name="e_title" value="">
  <input id="f_auth_name" class="form-control" type="hidden" name="f_auth_name" value="">
  <input id="chnage_time_req" class="form-control" type="hidden" name="chnage_time_req" value="">
  <div class="col-md-12 col-md-12">
    <input type="submit" name="submit_disap_event" class="btn btn-primary  btn-md" style="width: 30%;" value="Update" />
  </div>
</form>
</div>
</div>

</div>

</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


 <!-- Approve and Disapprove -->

<script>
$(document).ready(function()
{
  $(".approve_disapprove").submit(function(event)
  { 
    //alert('cheeckkk');
    
    event.preventDefault();
     
    var r_id_new    = $('#rid_new').val();
    var f_id_new    = $('#f_id_new').val();
    var f_email_new = $('#f_email_new').val();
    var f_title_new = $('#f_title_new').val();
    var f_auth_name_new = $('#f_auth_name_new').val();
    
    /*var r_id_new2    = $('#r_id_new2').val();
    var f_id_new2    = $('#f_id_new2').val();
    var f_email_new2 = $('#f_email_new2').val();
    var f_title_new2 = $('#f_title_new2').val();
    var f_auth_name_new2 = $('#f_auth_name_new2').val();*/
    
    var divid = $('#divid').val();
    var app_disapp_val = $('#app_disapp_val').val();
    /*var appr_val = $('#appr_val').val();
    var disapp_val = $('#disapp_val').val();*/
    
    var url='<?php echo admin_url('admin-ajax.php'); ?>';     
    $.ajax({
          url :url ,
          type : 'post',
          //dataType: 'json',
          data : {
            action      : 'approve_disapprove_event',
            //Approve Data
            r_id_new    : r_id_new,
            f_id_new    : f_id_new,
            f_email_new : f_email_new,
            f_title_new : f_title_new,
            f_auth_name_new : f_auth_name_new,
            
            //Disaapp Data
            /*r_id_new2    : r_id_new2,
            f_id_new2    : f_id_new2,
            f_email_new2 : f_email_new2,
            f_title_new2 : f_title_new2,
            f_auth_name_new2 : f_auth_name_new2,*/
            
            //Get Div id and select button values
            divid : divid,
            app_disapp_val :app_disapp_val
            /*appr_val : appr_val,
            disapp_val : disapp_val*/
            
                    },
          
          beforeSend: function() 
          {
                       //jQuery('#msform #dvLoading').show(); 

                            setTimeout(function()
              {
                jQuery.LoadingOverlay("show", {
                image       : "",
                fontawesome : "fa fa-spinner fa-spin"
                });
                
                   
                jQuery.LoadingOverlay("hide");
                
                  
              }, 1000);  

              
             
                   },

          success : function(response) 
          {
                          
            var str = response;
                        var arr = str.split("-");
            
            var rid = arr[0];
            
            var fid = arr[1];
            
            jQuery(".myvalue").load("<?php echo get_template_directory_uri();?>/return-data.php",{r_id: rid, f_id: fid});
            
                }
        });
  });
});
</script>
   
   
  <script>
  
   $('input[name="status"]').change(function() 
   {
     if($(this).is(':checked') && $(this).val() == 'disapprove') 
     {
      $('#edit').modal('show');
    var chnage_time_req    = $(this).val();
      var email = $(this).attr("data-email");
      var e_id = $(this).attr("data-id");
      var r_id = $(this).attr("data-rid");
      var e_title = $(this).attr("data-title");
      var f_auth_name = $(this).attr("data-fauthname");
      
      $('#email').val(email);
      $('#e_id').val(e_id);
      $('#r_id').val(r_id);
      $('#e_title').val(e_title);
      $('#f_auth_name').val(f_auth_name);
    $('#chnage_time_req').val(chnage_time_req);
    
    $("td span").removeClass('myvalue');
     
    $(this).closest('td').next('td').find('span').addClass('myvalue');
    
     }
   
   else if($(this).is(':checked') && $(this).val() == 'approve') 
     {
      $('#accept_deny').modal('show');
     
    var appr_val    = $(this).val();
      var rid_new     = $(this).attr("data-rid_new");
      var f_id_new    = $(this).attr("data-f_id_new");
      var f_email_new = $(this).attr("data-f_email_new");
      var f_title_new = $(this).attr("data-f_title_new");
      var f_auth_name_new = $(this).attr("f_auth_name_new");
    
      $('#rid_new').val(rid_new);
      $('#f_id_new').val(f_id_new);
      $('#f_email_new').val(f_email_new);
      $('#f_title_new').val(f_title_new);
      $('#f_auth_name_new').val(f_auth_name_new);
    $('#app_disapp_val').val(appr_val);
         
    $("td span").removeClass('myvalue');
     
    $(this).closest('td').next('td').find('span').addClass('myvalue');
    
     }
   
  else if($(this).is(':checked') && $(this).val() == 'disapp') 
     {
      var disapp_val   = $(this).val();
      var rid_new2     = $(this).attr("data-rid_new2");
      var f_id_new2    = $(this).attr("data-f_id_new");
      var f_email_new2 = $(this).attr("data-f_email_new");
      var f_title_new2 = $(this).attr("data-f_title_new");
      var f_auth_name_new2 = $(this).attr("f_auth_name_new");
    
      $('#rid_new').val(rid_new2);
      $('#f_id_new').val(f_id_new2);
      $('#f_email_new').val(f_email_new2);
      $('#f_title_new').val(f_title_new2);
      $('#f_auth_name_new').val(f_auth_name_new2);
    $('#app_disapp_val').val(disapp_val);
    
    $("td span").removeClass('myvalue');
     
    $(this).closest('td').next('td').find('span').addClass('myvalue');
     
     }
   
   //$(this).closest("div").css({"color": "red", "border": "2px solid red"});
   
   var divid = $(this).closest("div").attr('id');
   //alert(divid);
   
   $('#divid').val(divid);
   
   });
  
  
  $("#dis_app_form").submit(function(event)
  {
      var x = document.getElementsByClassName("e_s_time");
      var xx = document.getElementsByClassName("e_e_time");
  
    var e_s_date = jQuery('#e_s_date').val();
    var e_s_time = jQuery('.e_s_time').val();
    var e_e_date = jQuery('#e_e_date').val();
    var e_e_time = jQuery('.e_e_time').val();
    
    //alert(e_s_time);
    
    if ($.trim(e_s_date).length == 0) 
    {
      document.getElementById("e_s_date").style.borderColor = "#E34234";
      jQuery('.alert-danger').html('<span style="color:red;"><strong>Error:</strong> Please select Start date !</span>');
      jQuery('.alert-danger').show();
      return false;
    }else{    
      document.getElementById("e_s_date").style.borderColor = "#006600";    
    }
    
    if ($.trim(e_s_time).length == 0) 
    {
      
      x[0].style.borderColor = "#E34234";
      jQuery('.alert-danger').html('<span style="color:red;"><strong>Error:</strong> Please select start time !</span>');
      jQuery('.alert-danger').show();
      return false;
    }else{    
      x[0].style.borderColor = "#006600";
         document.getElementById('e_s_time2').value = e_s_time;     
    }

    if ($.trim(e_e_date).length == 0) 
    {
      document.getElementById("e_e_date").style.borderColor = "#E34234";
      jQuery('.alert-danger').html('<span style="color:red;"><strong>Error:</strong> Please select Expire date !</span>');
      jQuery('.alert-danger').show();
      return false;
    }else{    
      document.getElementById("e_e_date").style.borderColor = "#006600";    
    }

    
    if ($.trim(e_e_time).length == 0) 
    {
      
      
      xx[0].style.borderColor = "#E34234";
      jQuery('.alert-danger').html('<span style="color:red;"><strong>Error:</strong> Please select end time !</span>');
      jQuery('.alert-danger').show();
      return false;
    
    }else{    
      xx[0].style.borderColor = "#006600";
      document.getElementById('e_e_time2').value = e_e_time;
      //return true;  

        event.preventDefault();
     
    var email    = $('#email').val();
    var e_id     = $('#e_id').val();
    var r_id     = $('#r_id').val();
    var e_title  = $('#e_title').val();
    var f_auth_name = $('#f_auth_name').val();
    
    var e_s_date    = $('#e_s_date').val();
    var e_s_time    = $('#e_s_time').val();
    var e_e_date    = $('#e_e_date').val();
    var e_e_time    = $('#e_e_time').val();
    var comment     = $('#comment').val();
    
    
    
    var url='<?php echo admin_url('admin-ajax.php'); ?>';     
    $.ajax({
          url :url ,
          type : 'post',
          //dataType: 'json',
          data : {
            action      : 'change_time_req_event',
            //Approve Data
            email : email,
            e_id  : e_id,
            r_id  : r_id,
            e_title : e_title,
            f_auth_name : f_auth_name,
            
            e_s_date : e_s_date,
            e_s_time : e_s_time,
            e_e_date : e_e_date,
            e_e_time : e_e_time,
            comment  : comment
            
            
                    },
          
          beforeSend: function() 
          {
                       //jQuery('#msform #dvLoading').show(); 

                            setTimeout(function()
              {
                jQuery.LoadingOverlay("show", {
                image       : "",
                fontawesome : "fa fa-spinner fa-spin"
                });
                
                   
                jQuery.LoadingOverlay("hide");
                
                  
              }, 1000);  

              
             
                   },

          success : function(response) 
          {
                          
            //alert(response);  
              
            var str = response;
                        var arr = str.split("-");
            
            var rid = arr[0];
            
            var fid = arr[1];
            
            jQuery(".myvalue").load("<?php echo get_template_directory_uri();?>/change-time-req.php",{r_id: rid, f_id: fid});
            
            jQuery('#edit').modal('hide');
            
                }
        });

    
    }
    
  });
  
 /* //Date Picker
   var date1 = jQuery("#e_s_date").datepicker({
         autoclose: true,
         startDate: new Date(),
         format: "mm-dd-yyyy"
    });

    jQuery("#e_e_date").datepicker({
         autoclose: true,
         startDate: new Date(),
         format: "mm-dd-yyyy"
    });*/

   //Date Picker
/*   $('#e_s_date').datepicker({
  Format: 'mm-dd-yyyy',
  autoclose:true,
  startDate: new Date(),
    }).on('changeDate',function(e){
  $('#e_e_date').datepicker('setStartDate',e.date)
    });

    $('#e_e_date').datepicker({
      Format: 'mm-dd-yyyy',
      autoclose:true,
    }).on('changeDate',function(e){
      $('#e_s_date').datepicker('setEndDate',e.date)
    });
*/

/*$('#e_s_date').datepicker({
  Format: 'mm-dd-yyyy',
  autoclose:true,
  startDate: new Date(),
}).on('changeDate',function(events){
  $('#e_e_date').datepicker('setStartDate',events.date)
});

$('#e_e_date').datepicker({
  Format: 'mm-dd-yyyy',
  autoclose:true,
}).on('changeDate',function(event){
  $('#e_s_date').datepicker('setEndDate',event.date)
}); 
*/



 </script>    

          </div>




          <!-- approved disapproved events end -->





        </div>
      </div>



    </div>

  </div>
</div>
</div>

</div>
<style>
#app_disapp_event_popup, #app_disapp_event_popup2 .modal-header {
  border-bottom: 1px solid #e5e5e5;
  border-radius: 4px;
  padding: 15px;
}

</style>
<!--             <div class="container-fluid edit_btn_check">
              <div class="container">
                <div class="row"> -->

<!--                 </div>
              </div>
            </div> --> 

</div>
</div>
      <!--   call add event and add business popup -->

      <?php include('add_event.php'); ?>

      <?php include('add_business.php'); ?>

      <?php include('edit_info.php'); ?>

      <?php include('edit_profileimg.php'); ?>

      <?php include('change_pass.php'); ?>

      <?php include('add_wepay.php'); ?>
                                        
      <!-- code for popup noticification -->
      <button type="button" class="btn btn-info btn-lg snt_email" data-toggle="modal" data-target="#myModal987" style="display: none;">dsfsdfdssdf</button>

      <div class="modal fade" id="myModal987" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content model-cont modelcont-2">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Success!</h4>
            </div>
            <div class="modal-body">
              <p class="save-succes">Your request for hosting event has been sent successfully. The owner of this business event have recieved your request and will be in touch with you shortly.</p>
            </div>
          </div>
        </div>
      </div>


      <!-- author all script -->

      <script>

        $(document).ready(function(){

          var minlength = 5;

          $('#search-input_1').keyup(function(){

            var zip_code = $('#search-input_1').val();


            if (zip_code.length >= minlength ) 
            {


              var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";

              $.post(ajaxUrl,{
       //alert("welcome to Alor");
       type: 'POST',
       action:"author_search_retaile",
       zip_codes : zip_code,

       beforeSend: function() 
       {
        jQuery('.loader_serach #dvLoading').show();    
      },

    }).success(function(posts){

      jQuery('.loader_serach #dvLoading').hide();

      setTimeout(function()
      {
/*      $.LoadingOverlay("show", {
      image       : "",
      fontawesome : "fa fa-spinner fa-spin"
    }); */ 
    $("#show_results").html(posts); 
    $(".fieldset_4").addClass("fieldset_44");
    /*$.LoadingOverlay("hide");*/
  }, 1000); 
    });
  }

});
        });
      </script>


      <script>

        $(document).ready(function(){


/*$('#serach_reta').click(function(){

var retailer_name = $('#search_ret_name').val();

var newajaxUrl="<?php echo admin_url('admin-ajax.php')?>";

  $.post(newajaxUrl,{

      type: 'POST',
      action:"serach_reat_post",
      search_ret_names : retailer_name,

      }).success(function(posts){
        setTimeout(function()
     {

        $("#show_post").html(posts);
        $("#tab_default_4 .new_post").hide();
              }, 1000);
       
      });


    });*/

/*if(document.getElementById("search_ret_names").value == ""){
  alert("heloooo");

  $("#tab_default_7 .nnew_post").show();

}*/


    var minlength11 = 1;
    $('#search_ret_names').keyup(function(){

      var zip_code11 = $('#search_ret_names').val();

      var myInput = document.getElementById("search_ret_names");
      if (myInput && myInput.value)
      {
        $("#tab_default_7 .nnew_post").hide();
        $(".fs-error-fund").show();
        $("#show_posts").show();
        

      }
      else
      {
       $("#tab_default_7 .nnew_post").show();
       $(".fs-error-fund").hide();
       $("#show_posts").hide();
      }


      if (zip_code11.length >= minlength11 ) 
      {



        var retailer_names = $('#search_ret_names').val();

        var newajaxUrls="<?php echo admin_url('admin-ajax.php')?>";

        $.post(newajaxUrls,{

          type: 'POST',
          action:"search_reat_post",
          search_ret_namess : retailer_names,

          beforeSend: function() 
          {
            jQuery('.loader_serach1 #dvLoading1').show();    
          },

        }).success(function(posts){

          jQuery('.loader_serach1 #dvLoading1').hide();


          setTimeout(function()
          {
     /* $.LoadingOverlay("show", {
      image       : "",
      fontawesome : "fa fa-spinner fa-spin"
    });  */
    $("#show_posts").html(posts);
    $("#tab_default_7 .nnew_post").hide();
    $.LoadingOverlay("hide");
  }, 1000);

        });
      }

    });


  });
</script>
<!-- =====================Events========================= -->

<script>

  $(document).ready(function(){


   var minlength1123 = 5;
   $('#search_event_names').keyup(function(){

    var zip_code1123 = $('#search_event_names').val();


    if (zip_code1123.length >= minlength1123 ) 
    {



      var retailer_names12 = $('#search_event_names').val();

      var newajaxUrls="<?php echo admin_url('admin-ajax.php')?>";

      $.post(newajaxUrls,{

        type: 'POST',
        action:"search_reat_post",
        search_event_namess : retailer_names12,

        beforeSend: function() 
        {
          jQuery('.loader_serach1 #dvLoading1').show();    
        },

      }).success(function(posts){

        jQuery('.loader_serach1 #dvLoading1').hide();


        setTimeout(function()
        {
     /* $.LoadingOverlay("show", {
      image       : "",
      fontawesome : "fa fa-spinner fa-spin"
    });  */
    $("#show_posts").html(posts);
    $("#tab_default_7 .nnew_post").hide();
    $.LoadingOverlay("hide");
  }, 1000);

      });
    }

  });


 });
</script>

<!-- ======================================== -->
<script>
  $(".nested_events > li ").click(function() {
   /* $(this).toggleClass("active").removeClass('active');*/
   $(".nested_events > li").removeClass('active');
 });


</script>
<!-- ========================================== -->

<style>
.nav li.accordion a {
 /* background-image: url(../img/template/plus-minus.gif);*/
 background-repeat: no-repeat;
 background-position: top right;
 /*padding-right: 20px;*/
}
.nav li.accordion a.accordionExpanded {
  background-position: 100% -15px;
}
.profile_left .nav li.accordion li a {
  background-image: none; /* undo above for sub links */
  padding-right: 0px;
}
</style>

<script>
  $(document).ready(function() 
  {
  /*$('.nav > li > ul').hide();

  $('.nav > li > a').click(function () 
  {
    $(this).siblings('ul').addClass('myclass');
    
    var $ul = $(this).siblings('ul');
    if ($ul.length > 0) {
      $ul.toggle(600);
      return false;     
      //$ul.show(600);
    }
  });*/
  
  
  $('.nav > li > ul').hide();  

  $('.nav > li:has(ul)').addClass('accordion');  
  $('.nav > li:has(ul) > a').click(function() {

    $(this).toggleClass('accordionExpanded'); 
    
    $(this).next('ul').slideToggle('slow');
    
    $(this).parent().siblings('li').children('ul:visible').slideUp('slow')
    .parent('li').find('a').removeClass('accordionExpanded');

    $(".nav > li.active").removeClass("active");
    
    /*$(".nav > li > ul > li.active").removeClass("active");
    $('.nav > li > ul > li').addClass("active");*/

    return false;
  });
  
  $('.nav > li > a').click(function(){

      //$(this).next('ul').slideToggle('slow');
      $(this).parent().siblings('li').children('ul:visible').hide('slow')
      .parent('li').find('a').removeClass('accordionExpanded');

    });
  
  /*$('.all_business').click(function(){
    $( ".apd_disapd" ).removeClass( "active" );
    $( ".all_business" ).addClass( "active" );
        
  });
  $('.apd_disapd').click(function(){
    $( ".all_business" ).removeClass( "active" );
    $( ".apd_disapd" ).addClass( "active" );
        
  });*/

  /*$(".nav > li > ul > a").click(function()
  {
    //$(this).siblings('li').addClass("active");  
      $(this).siblings('li').removeClass("active");
    });*/

    $(".table-condensed").addClass("calender_table");
    $('.back_table').css('background-image', 'url(<?php echo site_url();?>/wp-content/uploads/2017/11/local.jpg)');
  });
</script>
<script>
     $(document).ready(function(){

    $(this).scrollTop(0);

   });

</script> 


 <style type="text/css">

 #dvLoading1 {
  background: #e1e1e1 url("<?php echo home_url();?>/wp-content/themes/twentyfifteen/images/image-loader.gif") no-repeat scroll center center;
  height: 34px;
  margin: auto;
  z-index: 1000;
  width: 300px;
}

.loader12 {
  display: inline-block;
  margin-top: 15px;
  width: 100%;
}


#dvLoading {
  background: #e1e1e1 url("<?php echo home_url();?>/wp-content/themes/twentyfifteen/images/image-loader.gif") no-repeat scroll center center;
  height: 34px;
  margin: auto;
  z-index: 1000;
  width: 300px;
}

#search #dvLoading {
  background: #e1e1e1 url("<?php echo home_url();?>/wp-content/themes/twentyfifteen/images/image-loader.gif") no-repeat scroll center center;
  height: 34px;
  margin: auto;
  z-index: 1000;
  width: 300px;
  margin-left: 31%;
}  

#searched #dvLoading {
  background: #e1e1e1 url("<?php echo home_url();?>/wp-content/themes/twentyfifteen/images/image-loader.gif") no-repeat scroll center center;
  height: 34px;
  margin: auto;
  z-index: 1000;
  width: 300px;
  /*  margin-left: 31%;*/
}  

</style>
<style>

#change_password_popup .modal-dialog {
  width: 450px;
  margin-top: 5%;
}


.panel-heading.main {
  background: #aaa none repeat scroll 0 0;
}
.panel-title > a { 
  font-size: 14px;
  /*padding-left: 7em;*/
}
/*.event-name {
  padding-left: 5em;
  }*/
  .event-id {
    font-size: 14px;
  }
  .f_id_n {
    padding-left: 10em;
  }
  .f_name_n {
    padding-left: 9em;
  }
  .f_auth_email_n {
    padding-left: 5em;
  }
  .status_n {
    padding-left: 5em;
  }
  .main-2 > span {
    font-weight: bold;
    font-size: 13px;
    padding-left: 11em;
  }
  .main > span {
    font-weight: bold;
  }
  .event_id {
    font-size: 13px;
  }


  .widefatn th {
    padding-bottom: 15px;
    padding-left: 17px;
    padding-top: 20px;
  }

  .widefatn td {
    padding-left: 15px;
  }
  .modal-body > h5 {font-size: 15px; line-height: 25px;}
  #dis_app_form .alert-danger {
    display: none;
  }

  .ng-button {display: none !important;}
  .mycls {
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.07) inset;
    height: 32px;
    padding-left: 15px;
  }
  .mycls::-moz-placeholder {
    opacity: 1;
    color: #999 !important;
  }
  .mycls:focus {border-color: #5b9dd9;}
  .datepicker {
    border-radius: 4px;
    direction: ltr;
    margin-top: 32px;
    padding: 4px;
    background: #f2f5fa none repeat scroll 0 0;
  }
  .ng-comp-main-div {
    border-radius: 4px;
  }

  #accordion > span {
    bottom: 7px;
    position: relative;
    color:#F53753;
  }

  #edit .modal-header {
    background:#19bf7e none repeat scroll 0 0;
    border-bottom: 1px solid #e5e5e5;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    padding: 20px 31px;
  }

  #edit .btn-md {
    width: 100px;
    background:#19bf7e;
    font-weight: bold;
    color: #fff;
    border: 2px solid transparent;
    border-radius: 1px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 4px 0;
    font-family: Roboto;
    letter-spacing: 0.5px;
    padding: 7px 5px;
    font-size: 15px;
  }
  #edit .btn-md:hover, #edit .btn-md:focus, #edit .btn-md:active {
    box-shadow: 0 0 0 2px #fff, 0 0 0 3px#19bf7e;
  }

</style>

<!-- ========================== -->



<!--<script>

  jQuery(document).ready(function() {

  function close_accordion_section() {
    jQuery('.accordion1 .accordion-section-title').removeClass('active');
    jQuery('.accordion1 .accordion-section-content').slideUp(300).removeClass('open');
  }

  jQuery('.accordion-section-title').click(function(e) {
    // Grab current anchor value
    var currentAttrValue = jQuery(this).attr('href');

   // alert(currentAttrValue);

    if(jQuery(e.target).is('.active')) {
      close_accordion_section();
    }
    else 
    {
      close_accordion_section();

      // Add active class to section title
      jQuery(this).addClass('active');
      // Open up the hidden content panel
      jQuery('.accordion1 ' + currentAttrValue).slideDown(300).addClass('open'); 
    }

    e.preventDefault();
  });
});</script>-->

<style type="text/css">
.accordion1, .accordion1 * {
  -webkit-box-sizing:border-box; 
  -moz-box-sizing:border-box; 
  box-sizing:border-box;
}

.accordion1 {
  overflow:hidden;
  box-shadow:0px 1px 3px rgba(0,0,0,0.25);
  border-radius:3px;
  background:#f7f7f7;
}

/*----- Section Titles -----*/
.accordion-section-title {
  width:100%;
  padding:15px;
  display:inline-block;
  border-bottom:1px solid #1a1a1a;
  background:#333;
  transition:all linear 0.15s;
  /* Type */
  font-size:1.200em;
  text-shadow:0px 1px 0px #1a1a1a;
  color:#fff;
}

.accordion-section-title.active, .accordion-section-title:hover {
  background:#4c4c4c;
  /* Type */
  text-decoration:none;
}

.accordion-section:last-child .accordion-section-title {
  border-bottom:none;
}

/*----- Section Content -----*/
.accordion-section-content {
  padding:15px;
  display:none;
}


.modal-header {
    padding: 20px 18px;
    border-bottom: 1px solid #e5e5e5;
    background: #19BF7E;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

</style>
<?php get_template_part( 'content', 'allJs' ); ?>
<?php get_footer();?>