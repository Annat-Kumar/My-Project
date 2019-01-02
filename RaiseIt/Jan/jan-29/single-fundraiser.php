<?php
/**
 * The template for displaying fundraiser post pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
get_header();

global $post;

$author_id = $post->post_author; 

$user_meta = get_userdata($author_id);

$post_user_roles = $user_meta->roles;

$current_users = wp_get_current_user();

$user_roles = $current_users->roles;

?>

<?php 

if($post_user_roles == $user_roles)
{
  ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
   <?php $ee =  $post->post_status ;?> 
 <?php endwhile; ?>
<?php endif; ?>

<?php 
$current_users = wp_get_current_user();

$user_roless = $current_users->roles;

if((in_array("administrator", $user_roless)) ||  (in_array("editor", $user_roless)))
{

  $get_value = get_post_meta( get_the_ID(), 'show_post', true ); 

  if($get_value == "true")
  {
    ?>
    <div class="pending_text">
      <p class="alert alert-warning">Demonstration only</p>
    </div>
    <?php
  }
}
?>

<section id="content">
  <div class="container">
    <div class="row">

      <!-- show when event is not approved start-->

      <?php
      if ((get_post_status ( $post->ID ) == 'draft' )) {  
        ?>
        <div class="pending_text">
          <p class="alert alert-danger">Your event will not be published to raise funds until it gets approval from the requested business or retailer. A notification email will be sent to you immediately after event is approved by your chosen business fundraiser host.</p>
        </div>
        <?php
      }
      ?>

      <!-- show when event is not approved start-->

      <!-- show event image nd donate now button-->

      <div class="col-lg-7 col-md-12 col-12 fund_img_dnte">
       <div class="leftpanel">
        <?php 

        if ( has_post_thumbnail() ) 
        { 
          the_post_thumbnail();

        }else{ ?>

        <img class="img-responsive" src="<?php echo site_url();?>/wp-content/uploads/2017/09/not_avail.jpg">

        <?php } ?>

        <?php 
        global $current_user;
        get_currentuserinfo();
        $id_donor = $current_user->ID;
        global $wpdb;
        $get_donate_posts = $wpdb->get_results("SELECT * FROM wp_donation  WHERE donars_id = $id_donor AND fund_ent_id = $post->ID");
       //$ccount = count($get_donate_posts);
        $user_type = get_usermeta($id_donor , $meta_key = 'user_type' );
        if ( get_post_status ( $post->ID ) == 'publish' ) {
          if(is_user_logged_in()) 
          { 

            global $wpdb;
            $r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

            foreach ($r_id as $key => $lo_url) {
              $llogo_url = $lo_url->retailer_logo;
              $rtlr_id = $lo_url->r_id;
              $post_author_id = $lo_url->f_auth_id;
              $event_auth_name = $lo_url->f_auth_name;
              $f_post_id = $lo_url->f_id;
              $rrr_author_id = $lo_url->rr_author_id;
              $donnor_id = $lo_url->donor_id ;
            }

            ?>

            <!-- <h1 class="ques_org">Donate now to support this cause and get a great deal.</h1> -->      

            <form method="post" action="<?php echo site_url()?>/raiseit-donate">
              <div class="dollar_new">

                <input type="hidden" name="raiseit_amt" value="<?php echo get_field('amount',$post->ID);?>">
                <input type="hidden" name="retail_post_id" value="<?php echo $rtlr_id; ?>">
                <input type="hidden" name="retailer_author" value="<?php echo $rrr_author_id; ?>">
                <input type="hidden" name="fund_author_id" value="<?php echo $post_author_id; ?>">
                <input id="donatenow_fund_name" type="hidden" name="fund_name" value="<?php the_title();?>">
                <input type="hidden" name="event_auth_name" value="<?php echo $event_auth_name;?>">
                <input id="donatenow_ff_id" type="hidden" name="ff_id" value="<?php $post_id = the_ID(); ?>">
                <input type="hidden" name="event_e_date" value="<?php echo $event_date = get_field('event_expire_date',$post->ID); ?>">
                <?php

                $new_client_id = get_post_meta( $post->ID, 'client_id', true);
                $new_client_secret = get_post_meta( $post->ID, 'client_secret', true);
                $new_access_token = get_post_meta( $post->ID, 'access_token', true);
                $new_account_id = get_post_meta( $post->ID, 'account_id', true);
                if($new_client_id){
                  ?>
                  <input type="hidden" name="post_client_id" value="<?php echo $new_client_id; ?>">
                  <input type="hidden" name="post_client_secret" value="<?php echo $new_client_secret; ?>">
                  <input type="hidden" name="post_access_token" value="<?php echo $new_access_token; ?>">
                  <input type="hidden" name="post_account_id" value="<?php echo $new_account_id; ?>">
                  <?php
                }
                else
                {
                  ?>
                  <input type="hidden" name="post_client_id" value="<?php echo $post_client_id = get_field('client_id', 'user_'. $post_author_id ); ?>">
                  <input type="hidden" name="post_client_secret" value="<?php echo $post_client_secret = get_field('client_secret', 'user_'. $post_author_id ); ?>">
                  <input type="hidden" name="post_access_token" value="<?php echo $post_access_token = get_field('access_token', 'user_'. $post_author_id ); ?>">
                  <input type="hidden" name="post_account_id" value="<?php echo $post_account_id = get_field('account_id', 'user_'. $post_author_id ); ?>">
                  <?php } ?>



                  <input type="hidden" name="raiseit_percentage" value="<?php echo $raiseit_percentage = get_field('percentage',$rtlr_id); ?>">

                </div>

                <input type="hidden" name="cerdit_card" value="ccrd">
                <button type="submit" name="raiseit" class="btn btn-default raise_btn2 1">Donate Now</button>

              </form> 
              <?Php
            } 
            else{
              ?>
              <button type="button" class="btn btn-default raise_btn2 11" data-toggle="modal" data-target="#myModal2">Donate Now</button>
              <?php      }
            }
            ?>
          </div> <!-- close leftpanel animated fadeInLeft -->

          <!-- START OLD donation amount code location -->

          <div class="amt_bnt_time">
           <div class="button-box">

             <?php  

             global $wpdb;

             $user_didss = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $post->ID");
             $count = count($user_didss);

             foreach ($user_didss as $key => $check_user_dids) {

               $user_dids = $check_user_dids->donor_id;
             }

             $dnt_amtss = $wpdb->get_results("SELECT * FROM wp_donation where fund_ent_id = ".$post->ID." ");
             foreach ($dnt_amtss as $key => $get_donations) 
             {
               $amt_donations[] = $get_donations->donation_amt;
               $amts = str_replace(',', '', $amt_donations);
             }
             $g_amts = array_sum($amts);
             ?>   
             <?php $post_date = get_the_date();
             $now = time();
             $your_date = strtotime($post_date);
             $datediff = $now - $your_date;
             $dd = floor($datediff / (60 * 60 * 24));
             $month = $dd/30;
             $f_moth = round($month, 0, PHP_ROUND_HALF_UP);
             ?>
             <?php  
             global $wpdb;
             $user_dids = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $post->ID");
             foreach ($user_dids as $key => $check_user_did) {
             }

             $dnt_amts = $wpdb->get_results("SELECT * FROM wp_donation where fund_ent_id = ".$post->ID." ");
             $count = count($dnt_amts);
             foreach ($dnt_amts as $key => $get_donation) 
             {
               $amt_donation[] = $get_donation->donation_amt;

               $amts = str_replace(',', '', $amt_donation);
             }


             $g_amt = array_sum($amts);

             $total_amts = str_replace(',', '', $t_amt);

             $new_ptage = ($g_amt/$total_amts)*100;
             ?>


             <h2>$<?php echo number_format($g_amts);?> <span class="t_amt">of $<?php echo $t_amt = get_field('amount',$post->ID);?> goal </span></h2>
           </div>
           <?php if($new_ptage) { ?>
           <h6>Raised by <?php echo number_format($count);?> donor(s) <?php if($f_moth > 1) {echo $f_moth; echo " "; echo "months ago"; } else { echo $dd; echo " "; echo "day(s)ago"; } ?>  </h6>
           <?php } else{ ?>
           <h6>Campaign created <?php if($f_moth > 1) {echo $f_moth; echo " "; echo "months ago"; } else if($dd < 2) { echo $dd; echo " "; echo "day ago"; } else { echo $dd; echo " "; echo "days ago"; } ?> </h6>
           <?php } ?>

           <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="extra_div">
             <div class="main_date">
               <div class="col-sm-12 col-md-12 s_date">
                <h5>Event Start Date : </h5> <span><?php $s_date = get_post_meta( $post->ID, 'select_date', true);?> <?php echo  date(' F jS , Y', strtotime($s_date)); ?></span>
              </div> 
              <div class="col-sm-12 col-md-12 e_date">
                <h5>Event Expire Date : </h5> <span><?php $e_date = get_post_meta( $post->ID, 'event_expire_date', true);?> <?php echo  date(' F jS , Y', strtotime($e_date)); ?></span>
              </div>    

              <div class="col-sm-12 col-md-12 day_left">
                <h5>Day's Left To Be Expired: </h5><span id="demo"></span>
              </div>       
            </div> 
          </div>

            <script>

              var end_date = "<?php echo get_post_meta( $post->ID, 'event_expire_date', true)?>";

              var end_time = "<?php  echo get_post_meta( $post->ID, 'end_time', true)?>";

              var time_formt ="<?php echo date("H:i", strtotime(get_post_meta( $post->ID, 'end_time', true)))?>";

              var add_td = (end_date + ' ' +time_formt);

// Set the date we're counting down to
var countDownDate = new Date(add_td).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
/*    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);*/
    
    // Output the result in an element with id="demo"
    
/*    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";*/

document.getElementById("demo").innerHTML = days + "days ";

    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
  }, 1000);
</script>  
<?php $ee =  $post->post_status ;?>
<?php endwhile; ?>
<?php endif; ?>
<?php if($ee == "publish") { 
  ?>
  <ul class="list-unstyled list-inline social_media k1">
   <li class="tw_fb_sharing"> </li>
   <li><?php echo do_shortcode('[shareaholic app="share_buttons" id="27918547"]');?></li>
 </ul>
 <?php } ?>
</div>
<!-- END fundraiser donation amount code location -->

</div> <!-- close col-lg-7 col-md-12 col-12 -->

<!-- show event image nd donate now button end -->

<!-- close col-lg-5 col-md-12 col-12 start-->

<div class="col-lg-5 col-md-12 col-12">
 <div class="rightpanel-fundrises 1">

  <?php
  $retailer_logo_image = get_field('fundraiser_logo',$post->ID);
  $feature_logo =  $retailer_logo_image['url'];
  if ($retailer_logo_image){
    ?><div class="immm">
      <img class="img-responsive center-block bus_logo" src="<?php echo $feature_logo ;?>">
    </div>
    <?php }
/*                    else {
                      ?>
                      <img class="img-responsive center-block" src="<?php echo site_url('/')?>wp-content/uploads/2017/09/logo_org.jpg">
                      <?php }
*/                      ?>


<h1><?php the_title(); ?></h1>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <h4><?php echo wp_trim_words( get_the_content(), '1000', '.' ); ?></h4>
 <?php $ee =  $post->post_status ;?>    
<?php endwhile; ?>
<?php endif; ?>









<?php $text = get_post_meta( $post->ID, 'tax_deductible', true );

if($text)
{

  echo "<p>We are an organization approved with 501 (c) (3) status.  Your donation is tax deductible.</p>";

}

?>   

<h2>Business Partner Details</h2>

<?php
global $wpdb;
$r_ids = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");
foreach ($r_id as $key => $rent_id)
{
  $rent_nams = $rent_id->r_name;
  $rent_nam = stripslashes(stripslashes(stripslashes(stripslashes(stripslashes($rent_nams)))));
  $rent_ids = $rent_id->r_id;
  $post_slug = get_post_field( 'post_name', $rent_ids );
}
?>

<h4>This event is hosted by <span><a href="<?php echo site_url('/retailer/');?><?php echo $post_slug;?>" style="color: #E84855;"><?php echo $rent_nam;?></a>.</span></h4>

<h2>Coupon Details</h2>

<?php
global $wpdb;
$r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

foreach ($r_id as $key => $lo_url) {
  $llogo_url = $lo_url->retailer_logo;
  $rtlr_id = $lo_url->r_id;
  $post_author_id = $lo_url->f_auth_id;
  $event_auth_name = $lo_url->f_auth_name;
  $f_post_id = $lo_url->f_id;
  $rrr_author_id = $lo_url->rr_author_id;
  $donnor_id = $lo_url->donor_id ;
}
$cc = get_post_meta( $rtlr_id,'discount_selct', true);
$ct = get_post_meta( $rtlr_id,'discount_selct_text', true);

if($cc == 'coupen_10')
{
  $dis = "10%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
    <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>

   <?php
 }
 if($cc == 'coupen_20')
 {
  $dis = "20%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }
 if($cc == 'coupen_30')
 {
  $dis = "30%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>       
   <?php
 }
 if($cc == 'coupen_40')
 {
  $dis = "40%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }
 if($cc == 'coupen_50')
 {
  $dis = "50%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }

 if($cc == 'custom_coupon')
 {
  $dis = get_post_meta( $rID,'extra_benefit', true);
  $diss ="discount on";
  ?>
  <div class="dis_cnts">

    <p>You can get the below discount after donation and can redeem this discount coupon for great deals at retailer store.</p>
    <div class='discount_selct text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <?php
     echo "<div class='discount-coupen'>";

     echo "<h3>$dis</h3>";
     echo "<h4>$diss</h4>";
     echo "</div>";
     echo "<h5 class='discount_text'>$ct</h5>";
     echo "</div></div>";
   }

   if($cc == 'free_coupon')
   {
     ?>
     <div class="dis_cnts">
      <div class='discount_selcts text-center'>

       <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/11/free_coupen.png'>
       <div class='discount-coupen'>
         <h3><?php echo $dis ;?></h3>
         <h4><?php echo $diss;?></h4>
       </div>
       <h5 class='discount_text'><?php echo $ct; ?></h5>
     </div></div>

     <?php
   }
   ?> 

 </div> 
</div>

<!-- close col-lg-5 col-md-12 col-12 end-->
</div>
</div>
</div>
</section>

<?php
}
else if((in_array("editor", $user_roles)) || (in_array("administrator", $user_roles)) || $post_user_roles == editor)
{

  ?>

  <div class="top">
    <main id="main" class="site-main" role="main">
      <div class="container-fluid organisation">
        <div class="container">
          <div class="row">
            <div class="all_fund_div">

              <?php 
              $current_users = wp_get_current_user();

              $user_roless = $current_users->roles;

              if((in_array("administrator", $user_roless)) ||  (in_array("editor", $user_roless)))
              {

                $get_value = get_post_meta( get_the_ID(), 'show_post', true ); 

                if($get_value == "true")
                {
                  ?>
                  <div class="pending_text">
                    <p class="alert alert-warning">Demonstration only</p>
                  </div>
                  <?php
                }
              }

              ?>

              <?php
              if ((get_post_status ( $post->ID ) == 'draft' )) {  
                ?>
                <div class="pending_text">
                  <p class="alert alert-danger">Your event will not be published to raise funds until it gets approval from the requested business or retailer. A notification email will be sent to you immediately after event is approved by your chosen business fundraiser host.</p>
                </div>
                <?php
              }
              ?>
              <section id="content">

                <div class="container">
                  <div class="row">
                   <!-- show event image nd donate now button-->

                   <div class="col-lg-7 col-md-12 col-12 fund_img_dnte">
                     <div class="leftpanel">
                      <?php 

                      if ( has_post_thumbnail() ) 
                      { 
                        the_post_thumbnail();

                      }else{ ?>

                      <img class="img-responsive" src="<?php echo site_url();?>/wp-content/uploads/2017/09/not_avail.jpg">

                      <?php } ?>

                      <?php 
                      global $current_user;
                      get_currentuserinfo();
                      $id_donor = $current_user->ID;
                      global $wpdb;
                      $get_donate_posts = $wpdb->get_results("SELECT * FROM wp_donation  WHERE donars_id = $id_donor AND fund_ent_id = $post->ID");
       //$ccount = count($get_donate_posts);
                      $user_type = get_usermeta($id_donor , $meta_key = 'user_type' );
                      if ( get_post_status ( $post->ID ) == 'publish' ) {
                        if(is_user_logged_in()) 
                        { 

                          global $wpdb;
                          $r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

                          foreach ($r_id as $key => $lo_url) {
                            $llogo_url = $lo_url->retailer_logo;
                            $rtlr_id = $lo_url->r_id;
                            $post_author_id = $lo_url->f_auth_id;
                            $event_auth_name = $lo_url->f_auth_name;
                            $f_post_id = $lo_url->f_id;
                            $rrr_author_id = $lo_url->rr_author_id;
                            $donnor_id = $lo_url->donor_id ;
                          }

                          ?>

                          <!-- <h1 class="ques_org">Donate now to support this cause and get a great deal.</h1> -->      

                          <form method="post" action="<?php echo site_url()?>/raiseit-donate">
                            <div class="dollar_new">

                              <input type="hidden" name="raiseit_amt" value="<?php echo get_field('amount',$post->ID);?>">
                              <input type="hidden" name="retail_post_id" value="<?php echo $rtlr_id; ?>">
                              <input type="hidden" name="retailer_author" value="<?php echo $rrr_author_id; ?>">
                              <input type="hidden" name="fund_author_id" value="<?php echo $post_author_id; ?>">
                              <input id="donatenow_fund_name" type="hidden" name="fund_name" value="<?php the_title();?>">
                              <input type="hidden" name="event_auth_name" value="<?php echo $event_auth_name;?>">
                              <input id="donatenow_ff_id" type="hidden" name="ff_id" value="<?php the_ID(); ?>">
                              <input type="hidden" name="event_e_date" value="<?php echo $event_date = get_field('event_expire_date',$post->ID); ?>">
                              <?php

                              $new_client_id = get_post_meta( $post->ID, 'client_id', true);
                              $new_client_secret = get_post_meta( $post->ID, 'client_secret', true);
                              $new_access_token = get_post_meta( $post->ID, 'access_token', true);
                              $new_account_id = get_post_meta( $post->ID, 'account_id', true);
                              if($new_client_id){
                                ?>
                                <input type="hidden" name="post_client_id" value="<?php echo $new_client_id; ?>">
                                <input type="hidden" name="post_client_secret" value="<?php echo $new_client_secret; ?>">
                                <input type="hidden" name="post_access_token" value="<?php echo $new_access_token; ?>">
                                <input type="hidden" name="post_account_id" value="<?php echo $new_account_id; ?>">
                                <?php
                              }
                              else
                              {
                                ?>
                                <input type="hidden" name="post_client_id" value="<?php echo $post_client_id = get_field('client_id', 'user_'. $post_author_id ); ?>">
                                <input type="hidden" name="post_client_secret" value="<?php echo $post_client_secret = get_field('client_secret', 'user_'. $post_author_id ); ?>">
                                <input type="hidden" name="post_access_token" value="<?php echo $post_access_token = get_field('access_token', 'user_'. $post_author_id ); ?>">
                                <input type="hidden" name="post_account_id" value="<?php echo $post_account_id = get_field('account_id', 'user_'. $post_author_id ); ?>">
                                <?php } ?>
                                <input type="hidden" name="raiseit_percentage" value="<?php echo $raiseit_percentage = get_field('percentage',$rtlr_id); ?>">

                              </div>

                              <input type="hidden" name="cerdit_card" value="ccrd">
                              <button type="submit" name="raiseit" class="btn btn-default raise_btn2 2">Donate Now</button>

                            </form> 
                            <?Php
                          } 
                          else{
                            ?>
                            <button type="button" class="btn btn-default raise_btn2 22" data-toggle="modal" data-target="#myModal2">Donate Now</button>
                            <?php      }
                          }
                          ?>
                        </div> <!-- close leftpanel animated fadeInLeft -->

                        <!-- START OLD donation amount code location -->

                        <div class="amt_bnt_time">
                         <div class="button-box">

                           <?php  

                           global $wpdb;

                           $user_didss = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $post->ID");
                           $count = count($user_didss);

                           foreach ($user_didss as $key => $check_user_dids) {

                             $user_dids = $check_user_dids->donor_id;
                           }

                           $dnt_amtss = $wpdb->get_results("SELECT * FROM wp_donation where fund_ent_id = ".$post->ID." ");
                           foreach ($dnt_amtss as $key => $get_donations) 
                           {
                             $amt_donations[] = $get_donations->donation_amt;
                             $amts = str_replace(',', '', $amt_donations);
                           }
                           $g_amts = array_sum($amts);
                           ?>   
                           <?php $post_date = get_the_date();
                           $now = time();
                           $your_date = strtotime($post_date);
                           $datediff = $now - $your_date;
                           $dd = floor($datediff / (60 * 60 * 24));
                           $month = $dd/30;
                           $f_moth = round($month, 0, PHP_ROUND_HALF_UP);
                           ?>
                           <?php  
                           global $wpdb;
                           $user_dids = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $post->ID");
                           foreach ($user_dids as $key => $check_user_did) {
                           }

                           $dnt_amts = $wpdb->get_results("SELECT * FROM wp_donation where fund_ent_id = ".$post->ID." ");
                           $count = count($dnt_amts);
                           foreach ($dnt_amts as $key => $get_donation) 
                           {
                             $amt_donation[] = $get_donation->donation_amt;

                             $amts = str_replace(',', '', $amt_donation);
                           }


                           $g_amt = array_sum($amts);

                           $total_amts = str_replace(',', '', $t_amt);

                           $new_ptage = ($g_amt/$total_amts)*100;
                           ?>


                           <h2>$<?php echo number_format($g_amts);?> <span class="t_amt">of $<?php echo $t_amt = get_field('amount',$post->ID);?> goal </span></h2>
                         </div>
                         <?php if($new_ptage) { ?>
                         <h6>Raised by <?php echo number_format($count);?> donor(s) <?php if($f_moth > 1) {echo $f_moth; echo " "; echo "months ago"; } else { echo $dd; echo " "; echo "day(s)ago"; } ?>  </h6>
                         <?php } else{ ?>
                         <h6>Campaign created <?php if($f_moth > 1) {echo $f_moth; echo " "; echo "months ago"; } else if($dd < 2) { echo $dd; echo " "; echo "day ago"; } else { echo $dd; echo " "; echo "days ago"; } ?> </h6>
                         <?php } ?>

                         <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                          <div class="extra_div">
                           <div class="main_date">
                             <div class="col-sm-12 col-md-12 s_date">
                              <h5>Event Start Date : </h5> <span><?php $s_date = get_post_meta( $post->ID, 'select_date', true);?> <?php echo  date(' F jS , Y', strtotime($s_date)); ?></span>
                            </div> 
                            <div class="col-sm-12 col-md-12 e_date">
                              <h5>Event Expire Date : </h5> <span><?php $e_date = get_post_meta( $post->ID, 'event_expire_date', true);?> <?php echo  date(' F jS , Y', strtotime($e_date)); ?></span>
                            </div> 
                            <div class="col-sm-12 col-md-12 day_left">
                              <h5>Day's Left To Be Expired: </h5> <span id="demo"></span>
                            </div> 
                          </div>
                        </div>


                          <script>

                            var end_date = "<?php echo get_post_meta( $post->ID, 'event_expire_date', true)?>";

                            var end_time = "<?php  echo get_post_meta( $post->ID, 'end_time', true)?>";

                            var time_formt ="<?php echo date("H:i", strtotime(get_post_meta( $post->ID, 'end_time', true)))?>";

                            var add_td = (end_date + ' ' +time_formt);


/*var momentObj = moment(end_time , ["h:mm A"]);

alert(momentObj);*/


// Set the date we're counting down to
var countDownDate = new Date(add_td).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
/*    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";*/

document.getElementById("demo").innerHTML = days + "days ";


    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
  }, 1000);
</script>  
<?php $ee =  $post->post_status ;?>
<?php endwhile; ?>
<?php endif; ?>



<?php if($ee == "publish") { 
  ?>
  <ul class="list-unstyled list-inline social_media k2">
   <li class="tw_fb_sharing"> </li>
   <li><?php echo do_shortcode('[shareaholic app="share_buttons" id="27918547"]');?></li>
 </ul>
 <?php } ?>
</div>
<!-- END fundraiser donation amount code location -->

</div> <!-- close col-lg-7 col-md-12 col-12 -->

<!-- show event image nd donate now button end -->

<!-- close col-lg-5 col-md-12 col-12 start-->

<div class="col-lg-5 col-md-12 col-12">
 <div class="rightpanel-fundrises 3">
  <?php
  $retailer_logo_image = get_field('fundraiser_logo',$post->ID);
  $feature_logo =  $retailer_logo_image['url'];
  if ($retailer_logo_image){
    ?><div class="immm">
      <img class="img-responsive center-block bus_logo" src="<?php echo $feature_logo ;?>">
    </div>
    <?php }
/*                    else {
                      ?>
                      <img class="img-responsive center-block" src="<?php echo site_url('/')?>wp-content/uploads/2017/09/logo_org.jpg">
                      <?php }
*/                      ?>
<h1><?php the_title(); ?></h1>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <h4><?php echo wp_trim_words( get_the_content(), '1000', '.' ); ?></h4> 
 <?php $ee =  $post->post_status ;?>    
<?php endwhile; ?>
<?php endif; ?>



<?php $text = get_post_meta( $post->ID, 'tax_deductible', true );


if($text)
{

  echo "<p>We are an organization approved with 501 (c) (3) status.  Your donation is tax deductible.</p>";

}

?>


<h2>Business Partner Details</h2>

<?php
global $wpdb;
$r_ids = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");
foreach ($r_id as $key => $rent_id)
{
  $rent_nams = $rent_id->r_name;
  $rent_nam = stripslashes(stripslashes(stripslashes(stripslashes(stripslashes($rent_nams)))));
  $rent_ids = $rent_id->r_id;
  $post_slug = get_post_field( 'post_name', $rent_ids );
}
?>

<h4>This event is hosted by <span><a href="<?php echo site_url('/retailer/');?><?php echo $post_slug;?>" style="color: #E84855;"><?php echo $rent_nam;?></a>.</span></h4>

<h2>Coupon Details</h2>

<?php
global $wpdb;
$r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

foreach ($r_id as $key => $lo_url) {
  $llogo_url = $lo_url->retailer_logo;
  $rtlr_id = $lo_url->r_id;
  $post_author_id = $lo_url->f_auth_id;
  $event_auth_name = $lo_url->f_auth_name;
  $f_post_id = $lo_url->f_id;
  $rrr_author_id = $lo_url->rr_author_id;
  $donnor_id = $lo_url->donor_id ;
}
$cc = get_post_meta( $rtlr_id,'discount_selct', true);
$ct = get_post_meta( $rtlr_id,'discount_selct_text', true);

if($cc == 'coupen_10')
{
  $dis = "10%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
    <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>

   <?php
 }
 if($cc == 'coupen_20')
 {
  $dis = "20%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }
 if($cc == 'coupen_30')
 {
  $dis = "30%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>        
   <?php
 }
 if($cc == 'coupen_40')
 {
  $dis = "40%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }
 if($cc == 'coupen_50')
 {
  $dis = "50%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }
 if($cc == 'custom_coupon')
 {
  $dis = get_post_meta( $rID,'extra_benefit', true);
  $diss ="discount on";
  ?>
  <div class="dis_cnts">

    <p>You can get the below discount after donation and can redeem this discount coupon for great deals at retailer store.</p>
    <div class='discount_selct text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <?php
     echo "<div class='discount-coupen'>";

     echo "<h3>$dis</h3>";
     echo "<h4>$diss</h4>";
     echo "</div>";
     echo "<h5 class='discount_text'>$ct</h5>";
     echo "</div></div>";
   }


   if($cc == 'free_coupon')
   {
     ?>
     <div class="dis_cnts">
      <div class='discount_selcts text-center'>

       <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/11/free_coupen.png'>
       <div class='discount-coupen'>
         <h3><?php echo $dis ;?></h3>
         <h4><?php echo $diss;?></h4>
       </div>
       <h5 class='discount_text'><?php echo $ct; ?></h5>
     </div></div>

     <?php
   }
   ?> 

 </div> 
</div>

<!-- close col-lg-5 col-md-12 col-12 end-->
</div>
</div>
</section>
</div>
</div>
</div>
</div>
</main>
</div>

<?php
}
else if(is_user_logged_in() && (in_array("editor", $post_user_roles) ))
{
  ?>
  <div class="top">
    <main id="main" class="site-main" role="main">
      <div class="container-fluid organisation">
        <div class="container top11">
          <div class="row">
            <div class="all_fund_div" style="width: 97%;height: 300px;">

              <div class="pending_text">
                <p class="alert alert-warning">You don't have permission to show this event.</p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <?php
}
?>
<?php
if(!is_user_logged_in() && (in_array("editor", $post_user_roles) ))
{
  ?>
  <div class="top">
    <main id="main" class="site-main" role="main">
      <div class="container-fluid organisation">
        <div class="container top11">
          <div class="row">
            <div class="all_fund_div" style="width: 97%;height: 300px;">

              <div class="pending_text">
                <p class="alert alert-warning">You don't have permission to show this event.</p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  <?php }
  ?>

  <?php
  if(!is_user_logged_in() && (in_array("subscriber", $post_user_roles) ))
  {
    ?>

    <?php 
    $current_users = wp_get_current_user();

    $user_roless = $current_users->roles;

    if((in_array("administrator", $user_roless)) ||  (in_array("editor", $user_roless)))
    {

      $get_value = get_post_meta( get_the_ID(), 'show_post', true ); 

      if($get_value == "true")
      {
        ?>
        <div class="pending_text">
          <p class="alert alert-warning">Demonstration only</p>
        </div>
        <?php
      }
    }

    ?>


    <section id="content">

      <div class="container">
        <div class="row">

          <?php
          if ((get_post_status ( $post->ID ) == 'draft' )) {  
            ?>
            <div class="pending_text">
              <p class="alert alert-danger">Your event will not be published to raise funds until it gets approval from the requested business or retailer. A notification email will be sent to you immediately after event is approved by your chosen business fundraiser host.</p>
            </div>
            <?php
          }
          ?>

          <!-- show event image nd donate now button-->

          <div class="col-lg-7 col-md-12 col-12 fund_img_dnte">
           <div class="leftpanel">
            <?php 

            if ( has_post_thumbnail() ) 
            { 
              the_post_thumbnail();

            }else{ ?>

            <img class="img-responsive" src="<?php echo site_url();?>/wp-content/uploads/2017/09/not_avail.jpg">

            <?php } ?>

            <?php 
            global $current_user;
            get_currentuserinfo();
            $id_donor = $current_user->ID;
            global $wpdb;
            $get_donate_posts = $wpdb->get_results("SELECT * FROM wp_donation  WHERE donars_id = $id_donor AND fund_ent_id = $post->ID");
       //$ccount = count($get_donate_posts);
            $user_type = get_usermeta($id_donor , $meta_key = 'user_type' );
            if ( get_post_status ( $post->ID ) == 'publish' ) {
              if(is_user_logged_in()) 
              { 

                global $wpdb;
                $r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

                foreach ($r_id as $key => $lo_url) {
                  $llogo_url = $lo_url->retailer_logo;
                  $rtlr_id = $lo_url->r_id;
                  $post_author_id = $lo_url->f_auth_id;
                  $event_auth_name = $lo_url->f_auth_name;
                  $f_post_id = $lo_url->f_id;
                  $rrr_author_id = $lo_url->rr_author_id;
                  $donnor_id = $lo_url->donor_id ;
                }

                ?>

                <!-- <h1 class="ques_org">Donate now to support this cause and get a great deal.</h1> -->      

                <form method="post" action="<?php echo site_url()?>/raiseit-donate">
                  <div class="dollar_new">

                    <input type="hidden" name="raiseit_amt" value="<?php echo get_field('amount',$post->ID);?>">
                    <input type="hidden" name="retail_post_id" value="<?php echo $rtlr_id; ?>">
                    <input type="hidden" name="retailer_author" value="<?php echo $rrr_author_id; ?>">
                    <input type="hidden" name="fund_author_id" value="<?php echo $post_author_id; ?>">
                    <input id="donatenow_fund_name" type="hidden" name="fund_name" value="<?php the_title();?>">
                    <input type="hidden" name="event_auth_name" value="<?php echo $event_auth_name;?>">
                    <input id="donatenow_ff_id" type="hidden" name="ff_id" value="<?php the_ID(); ?>">
                    <input type="hidden" name="event_e_date" value="<?php echo $event_date = get_field('event_expire_date',$post->ID); ?>">
                    <?php

                    $new_client_id = get_post_meta( $post->ID, 'client_id', true);
                    $new_client_secret = get_post_meta( $post->ID, 'client_secret', true);
                    $new_access_token = get_post_meta( $post->ID, 'access_token', true);
                    $new_account_id = get_post_meta( $post->ID, 'account_id', true);
                    if($new_client_id){
                      ?>
                      <input type="hidden" name="post_client_id" value="<?php echo $new_client_id; ?>">
                      <input type="hidden" name="post_client_secret" value="<?php echo $new_client_secret; ?>">
                      <input type="hidden" name="post_access_token" value="<?php echo $new_access_token; ?>">
                      <input type="hidden" name="post_account_id" value="<?php echo $new_account_id; ?>">
                      <?php
                    }
                    else
                    {
                      ?>
                      <input type="hidden" name="post_client_id" value="<?php echo $post_client_id = get_field('client_id', 'user_'. $post_author_id ); ?>">
                      <input type="hidden" name="post_client_secret" value="<?php echo $post_client_secret = get_field('client_secret', 'user_'. $post_author_id ); ?>">
                      <input type="hidden" name="post_access_token" value="<?php echo $post_access_token = get_field('access_token', 'user_'. $post_author_id ); ?>">
                      <input type="hidden" name="post_account_id" value="<?php echo $post_account_id = get_field('account_id', 'user_'. $post_author_id ); ?>">
                      <?php } ?>
                      <input type="hidden" name="raiseit_percentage" value="<?php echo $raiseit_percentage = get_field('percentage',$rtlr_id); ?>">

                    </div>

                    <input type="hidden" name="cerdit_card" value="ccrd">
                    <button type="submit" name="raiseit" class="btn btn-default raise_btn2 3">Donate Now</button>

                  </form> 
                  <?Php
                } 
                else{
                  ?>
                  <button type="button" class="btn btn-default raise_btn2 33" data-toggle="modal" data-target="#myModal2">Donate Now</button>
				  
				  <input id="donatenow_fund_name" type="hidden" name="fund_name" value="<?php echo get_the_title($post->ID);?>">
				  <input id="donatenow_ff_id" type="hidden" name="ff_id" value="<?php the_ID(); ?>">
				  
                  <?php     
				  }
                }
                ?>
              </div> <!-- close leftpanel animated fadeInLeft -->

              <!-- START OLD donation amount code location -->

              <div class="amt_bnt_time">
               <div class="button-box">

                 <?php  

                 global $wpdb;

                 $user_didss = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $post->ID");
                 $count = count($user_didss);

                 foreach ($user_didss as $key => $check_user_dids) {

                   $user_dids = $check_user_dids->donor_id;
                 }

                 $dnt_amtss = $wpdb->get_results("SELECT * FROM wp_donation where fund_ent_id = ".$post->ID." ");
                 foreach ($dnt_amtss as $key => $get_donations) 
                 {
                   $amt_donations[] = $get_donations->donation_amt;
                   $amts = str_replace(',', '', $amt_donations);
                 }
                 $g_amts = array_sum($amts);
                 ?>   
                 <?php $post_date = get_the_date();
                 $now = time();
                 $your_date = strtotime($post_date);
                 $datediff = $now - $your_date;
                 $dd = floor($datediff / (60 * 60 * 24));
                 $month = $dd/30;
                 $f_moth = round($month, 0, PHP_ROUND_HALF_UP);
                 ?>
                 <?php  
                 global $wpdb;
                 $user_dids = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $post->ID");
                 foreach ($user_dids as $key => $check_user_did) {
                 }

                 $dnt_amts = $wpdb->get_results("SELECT * FROM wp_donation where fund_ent_id = ".$post->ID." ");
                 $count = count($dnt_amts);
                 foreach ($dnt_amts as $key => $get_donation) 
                 {
                   $amt_donation[] = $get_donation->donation_amt;

                   $amts = str_replace(',', '', $amt_donation);
                 }


                 $g_amt = array_sum($amts);

                 $total_amts = str_replace(',', '', $t_amt);

                 $new_ptage = ($g_amt/$total_amts)*100;
                 ?>


                 <h2>$<?php echo number_format($g_amts);?> <span class="t_amt">of $<?php echo $t_amt = get_field('amount',$post->ID);?> goal </span></h2>
               </div>
               <?php if($new_ptage) { ?>
               <h6>Campaign created <?php if($f_moth > 1) { echo $f_moth; echo " "; echo "months ago"; } else if($dd < 2) { echo $dd; echo " "; echo "day ago"; } else { echo $dd; echo " "; echo "days ago"; } ?> </h6>
               <?php } else{ ?>
               <h6>Campaign created <?php if($f_moth > 1) {echo $f_moth; echo " "; echo "months ago"; } else { echo $dd; echo " "; echo "days ago"; } ?> </h6>
               <?php } ?>
               <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
               <div class="extra_div">  
                 <div class="main_date">
                   <div class="col-sm-12 col-md-12 s_date">
                    <h5>Event Start Date : </h5> <span><?php $s_date = get_post_meta( $post->ID, 'select_date', true);?> <?php echo  date(' F jS , Y', strtotime($s_date)); ?></span>
                  </div> 
                  <div class="col-sm-12 col-md-12 e_date">
                    <h5>Event Expire Date : </h5> <span><?php $e_date = get_post_meta( $post->ID, 'event_expire_date', true);?> <?php echo  date(' F jS , Y', strtotime($e_date)); ?></span>
                  </div>    

                  <div class="col-sm-12 col-md-12 day_left">
                    <h5>Day's Left To Be Expired:</h5><span id="demo"></span>
                  </div>       
                </div> 
              </div>

                <script>

                  var end_date = "<?php echo get_post_meta( $post->ID, 'event_expire_date', true)?>";

                  var end_time = "<?php  echo get_post_meta( $post->ID, 'end_time', true)?>";

                  var time_formt ="<?php echo date("H:i", strtotime(get_post_meta( $post->ID, 'end_time', true)))?>";

                  var add_td = (end_date + ' ' +time_formt);


/*var momentObj = moment(end_time , ["h:mm A"]);

alert(momentObj);*/


// Set the date we're counting down to
var countDownDate = new Date(add_td).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
/*    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";*/

document.getElementById("demo").innerHTML = days + "days ";

    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
  }, 1000);
</script>
<?php $ee =  $post->post_status ;?>
<?php endwhile; ?>
<?php endif; ?>


<?php if($ee == "publish") { 
  ?>


  <ul class="list-unstyled list-inline social_media k3">
   <li class="tw_fb_sharing"> </li>
   <li><?php echo do_shortcode('[shareaholic app="share_buttons" id="27918547"]');?></li>
 </ul>
 <?php } ?>
</div>
<!-- END fundraiser donation amount code location -->

</div> <!-- close col-lg-7 col-md-12 col-12 -->

<!-- show event image nd donate now button end -->

<!-- close col-lg-5 col-md-12 col-12 start-->

<div class="col-lg-5 col-md-12 col-12">

 <div class="rightpanel-fundrises 2">
  <?php
  $retailer_logo_image = get_field('fundraiser_logo',$post->ID);
  $feature_logo =  $retailer_logo_image['url'];
  if ($retailer_logo_image){
    ?><div class="immm">
      <img class="img-responsive center-block bus_logo" src="<?php echo $feature_logo ;?>">
    </div>
    <?php }
/*                    else {
                      ?>
                      <img class="img-responsive center-block" src="<?php echo site_url('/')?>wp-content/uploads/2017/09/logo_org.jpg">
                      <?php }
*/                      ?>
<h1><?php the_title(); ?></h1>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <h4><?php echo wp_trim_words( get_the_content(), '1000', '.' ); ?></h4> 
 <?php $ee =  $post->post_status ;?>    
<?php endwhile; ?>
<?php endif; ?>


<?php $text = get_post_meta( $post->ID, 'tax_deductible', true );

if($text)
{

  echo "<p>We are an organization approved with 501 (c) (3) status.  Your donation is tax deductible.</p>";

}

?>


<h2>Business Partner Details</h2>

<?php
global $wpdb;
$r_ids = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");
foreach ($r_ids as $key => $rent_id)
{
  $rent_nams = $rent_id->r_name;
  $rent_nam = stripslashes(stripslashes(stripslashes(stripslashes(stripslashes($rent_nams)))));
  $rent_ids = $rent_id->r_id;
  $post_slug = get_post_field( 'post_name', $rent_ids );
}
?>

<h4>This event is hosted by <span><a href="<?php echo site_url('/retailer/');?><?php echo $post_slug;?>" style="color: #E84855;"><?php echo $rent_nam;?></a>.</span></h4>

<h2>Coupon Details</h2>

<?php
global $wpdb;
$r_id = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id=$post->ID");

foreach ($r_id as $key => $lo_url) {
  $llogo_url = $lo_url->retailer_logo;
  $rtlr_id = $lo_url->r_id;
  $post_author_id = $lo_url->f_auth_id;
  $event_auth_name = $lo_url->f_auth_name;
  $f_post_id = $lo_url->f_id;
  $rrr_author_id = $lo_url->rr_author_id;
  $donnor_id = $lo_url->donor_id ;
}
$cc = get_post_meta( $rtlr_id,'discount_selct', true);
$ct = get_post_meta( $rtlr_id,'discount_selct_text', true);

if($cc == 'coupen_10')
{
  $dis = "10%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
    <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>

   <?php
 }
 if($cc == 'coupen_20')
 {
  $dis = "20%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }
 if($cc == 'coupen_30')
 {
  $dis = "30%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>       
   <?php
 }
 if($cc == 'coupen_40')
 {
  $dis = "40%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }
 if($cc == 'coupen_50')
 {
  $dis = "50%";
  $diss ="discount on";
  ?>
  <div class="dis_cnts">
   <div class='discount_selcts text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <div class='discount-coupen'>
       <h3><?php echo $dis ;?></h3>
       <h4><?php echo $diss;?></h4>
     </div>
     <h5 class='discount_text'><?php echo $ct; ?></h5>
   </div></div>
   <?php
 }
 if($cc == 'custom_coupon')
 {
  $dis = get_post_meta( $rID,'extra_benefit', true);
  $diss ="discount on";
  ?>
  <div class="dis_cnts">

    <p>You can get the below discount after donation and can redeem this discount coupon for great deals at retailer store.</p>
    <div class='discount_selct text-center'>

     <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/10/discount_img.png'>
     <?php
     echo "<div class='discount-coupen'>";

     echo "<h3>$dis</h3>";
     echo "<h4>$diss</h4>";
     echo "</div>";
     echo "<h5 class='discount_text'>$ct</h5>";
     echo "</div></div>";
   }

   if($cc == 'free_coupon')
   {
     ?>
     <div class="dis_cnts">
      <div class='discount_selcts text-center'>

       <img class="img-responsive center-block" src='<?php echo site_url();?>/wp-content/uploads/2017/11/free_coupen.png'>
       <div class='discount-coupen'>
         <h3><?php echo $dis ;?></h3>
         <h4><?php echo $diss;?></h4>
       </div>
       <h5 class='discount_text'><?php echo $ct; ?></h5>
     </div></div>

     <?php
   }
   ?> 

 </div> 
</div>

<!-- close col-lg-5 col-md-12 col-12 end-->

</div>
</div>
</section>
<?php
}


?>


<script>
 $(document).ready(function(){

  $('.bxslider').bxSlider({
   speed:2000,
/*   auto: true,
   autoHover: true,
   autoControls: true,*/
   controls:true ,
   moveSlides: 1,
   minSlides: 3,
   maxSlides: 10,
   slideWidth: 1200,
   slideMargin: 5,
   adaptiveHeight: true,
 });

});
 new WOW().init();
</script> 

<style>
.top {margin-top: 20px;margin-bottom: 20px;}

#myModaldonate .modal-header {
  background: #19bf7e none repeat scroll 0 0;
  border-bottom: 1px solid #e5e5e5;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  padding: 20px 31px;
}
#myModaldonate .modal-title {
  color: #fff;
  font-size: 18px;
  font-weight: 700;
  text-align: left;
}
.alert-error {

  font-size: 20px;
  text-align: center;
}

#myModalsignup .modal-header {
  background: #19bf7e none repeat scroll 0 0;
  border-bottom: 1px solid #e5e5e5;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  padding: 20px 31px;
}

#myModalsignup .modal-title {
  color: #fff;
  font-size: 18px;
  font-weight: 700;
  text-align: left;
}

#myModalsignup .modal-dialog{
  margin-top:5%;
}

#dsform input, #msform textarea {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-bottom: 15px;
  width: 100%;
  box-sizing: border-box;
  font-family: montserrat;
  color: #2C3E50;
  font-size: 14px;
  border-radius: 0;
}
#dsform .action-button {
  width: 100px;
  background: #19bf7e;
  font-weight: bold;
  color: #fff;
  border: 2px solid transparent;
  border-radius: 1px;
  cursor: pointer;
  padding: 10px 5px;
  margin: 10px 5px 4px;
  font-family: Roboto;
  letter-spacing: 0.5px;
  padding: 7px 5px;
  font-size: 15px;
}
#dsform fieldset {
  background: #fff;
  border: 0 none;
  border-radius: 3px;
  box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
  padding: 20px 30px;
  box-sizing: border-box;
  width: 80%;
  margin: 0 10%;

  position: relative;
}

</style>
<script>
  $(".raise_btn2").click(function(){  
  //alert('hiiii Yashu');
  
  /*var donatenow_fund_name = $("#donatenow_fund_name").val();
  var donatenow_ff_id     = $("#donatenow_ff_id").val();
  
  alert(donatenow_fund_name);
  alert(donatenow_ff_id);*/
  
  /*$("#myModal2 #msform").append('<input id="donatenow_fund_name" type="hidden" name="donatenow_fund_name" value="">'); 
  $("#myModal2 #msform").append('<input id="donatenow_ff_id" type="hidden" name="donatenow_ff_id" value="">');
  
  $("#donatenow_fund_name").val(donatenow_fund_name);
  $("#donatenow_ff_id").val(donatenow_ff_id);
  */
  
  var myurl = window.location.href;
  
  $("#myModal2 #msform").append('<input id="donor_signup" type="hidden" name="donor_signup" value="">');
  
  $("#donor_signup").val(myurl);
   
});


$(".donate_btn_clk_login_show").click(function(){
	
	$('#myModal2').modal('hide');
	$('#myModal').modal('show');
	
});

</script>

<?php get_footer(); ?>