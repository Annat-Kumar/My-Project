<?php 
/**
 * Template Name: Edit profile template
 *
 *
 * @author Ahmad Awais
 * @since 1.0.0
 */
get_header(); 
 ?>
 <div class="row enigma_blog_wrapper">
<div class="container inner_page">
<div class="inner3">
<ul class="nav nav-tabs edit_profile">
<li class="active"><a data-toggle="tab" href="#bank_details">Edit Your bank Details</a></li>
<li> <a data-toggle="tab" href="#profile">Edit Your Profile</a> </li>
<li class="fb_link"> <a data-toggle="tab" href="#link_fb">Link Facebook</a> </li>
</ul>

<?php
$msg='';

    // WePay PHP SDK - http://git.io/mY7iQQ
    require 'wepay.php';

    // application settings
$user = wp_get_current_user();
if ( in_array( 'administrator',$user->roles ) )
 {
   $account_id = get_option('account_id');
   $access_token = get_option('access_token');
  }
  else
  {
     $account_id = get_user_meta(get_current_user_id(),'wepay_account_id',true);
     $access_token = get_user_meta(get_current_user_id(),'wepay_access_token',true);
  }
    $client_id = get_option('client_id');
    $client_secret = get_option('client_secret');
    
if($account_id !="" AND $access_token!="")
{  
    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);

    //check the state of account
     $response = $wepay->request('account', array(
        'account_id'    => $account_id
    ));

    $state= $response->state;
           if($state=="pending" )
           { 

            $msg="Your account has not been approved yet. Check your email and click the link to see your received funds.";
          }
          else if($state=="disabled")
          {
            $msg="Your wepay account has been disabled please enable it.";
          }
          else if($state=="deleted")
          {
            $msg="Your wepay account has been deleted.";
          }
          /*else if($state=="action_required")
          {
            $msg="Please very your information in your wepay account.";
          }*/
          else 
          {
         
            // create the withdrawal
            $response1 = $wepay->request('account/get_update_uri', array(
                'account_id'    => $account_id,
               'redirect_uri'  => get_bloginfo('url').'/withdrawl',
               'mode'          => 'iframe'
            ));
             
        }

       /* else
        {
            echo '<div class="container"><div class="error">Please check your email and confirm your wepay account</div></div>';
        } */
     
   // $response2= $wepay->request('checkout/find',array("account_id" => $account_id));
    //$response3= $wepay->request('withdrawal/find',array("account_id" => $account_id));
    
    
}
else
{
     wp_redirect(get_bloginfo('url').'/sign-up');
      exit;
} 



    // display the response
   // print_r($response);
     
?>


<?php echo $msg;?>
<div class="tab-content">

<div id="bank_details" class="tab-pane fade in active"><div id="withdrawal_div"></div>
</div>

<?php //echo $response1->uri;?>
<script type="text/javascript" src="https://www.wepay.com/min/js/iframe.wepay.js">
</script>
<script type="text/javascript">
    ///WePay.iframe_checkout("withdrawal_div", "https://stage.wepay.com/api/withdrawal/12345");
    WePay.iframe_checkout("withdrawal_div", "<?php echo $response1->uri;?>");
</script>
<?php
$user=get_current_user_id();
if (isset($_POST['submit'])) 
{   
      
   $pic = $_POST['profile_pic'];

     $reg_errors = new WP_Error;

  if (empty( $pic ) ) {
     
     $reg_errors->add('profile_pic', 'Profile Pic is required');
    
    } 
 
     
$filename = basename($pic);
$upload_file = wp_upload_bits($filename, null, file_get_contents($pic));
if (!$upload_file['error']) {
    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_parent' => $parent_post_id,
        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );
    if (!is_wp_error($attachment_id)) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
        wp_update_attachment_metadata( $attachment_id,  $attachment_data );
    }
    update_user_meta($user,'wp_user_avatar',$attachment_id);


  echo '<div class="msg">You have update your profile picture </div>';

            
        header( "refresh:5;url=".get_bloginfo('url')."/posts" );

  }
  else
  {
    foreach ( $reg_errors->get_error_messages() as $error ) {
           
            echo '<div class="error">'.$error.'</div>';
        }
  }
  

}

?>

<div id="profile" class="tab-pane fade">
    <form name="picture" action="" method="post" id="picture">
   <b style="display: block;">Your Current Profile Picture: </b><?php echo get_avatar( $user, 100 ); ?>
      <div class="form-group">
      
          <!-- <label for="inputPassword">Profile Picture <strong class="required">*</strong></label>  -->
          <input type="hidden" id="my_hidden_input" name="profile_pic" value="<?php echo $pic; ?>">
         <?php  echo do_shortcode('[ajax-file-upload  on_success_set_input_value="#my_hidden_input"]'); ?>
         <!-- <input class="up_file" type="file" style="display: none;"> -->
        
       
        </div> 
         <div class="form-group">
           
           
                <input type="submit" id="submit_pic"  value="Update" name="submit" class="form-control">
               
               
          
        </div>
      
    </form>
    
</div>


<div id="link_fb" class="tab-pane fade">

<?php

 echo "hiiii";

$request = new Facebook\FacebookRequest([
  $session,
  'GET',
  '/{100014658097022}/friendlists',
  'app_id' => '609186639275162',
  'app_secret' => 'aec2470b358bb23fc4da560a09c34fd3',
  'default_graph_version' => 'v2.4'
]);

$response = $request->execute();
$graphObject = $response->getGraphObject();

print_r($response);
/* handle the result */

?>


</div>

</div>

</div>
</div>
</div>

<?php get_footer();?>