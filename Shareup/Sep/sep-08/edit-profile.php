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
<!--<li class="fb_link"> <a data-toggle="tab" href="#link_fb">Link Facebook</a> </li>-->
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
    Wepay::useProduction($client_id, $client_secret);

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
     //wp_redirect(get_bloginfo('url').'/sign-up');
     // exit;
	  $wepay_msg="Please check your email to activate your WePay account";
} 



    // display the response
   // print_r($response);
     
?>


<?php echo $msg;?>
<div class="tab-content">

<div id="bank_details" class="tab-pane fade in active">
<div id="withdrawal_div">
<div class="wepay_msg">
<?php echo $wepay_msg;?>
</div>
</div>
</div>

<?php //echo $wepay_msg;?>
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
      
   $pic = $_FILES['upload_image'];
   $upload_overrides = array( 'test_form' => false );

     $reg_errors = new WP_Error;

  if (empty( $pic ) ) {
     
     $reg_errors->add('upload_image', 'Profile Pic is required');
    
    } 
 
     
$filename = basename($pic['name']);

 $wp_filetype = wp_check_filetype($filename, null );

 $uploadedfile = array(
            'name'     => $_FILES['upload_image']['name'],
            'type'     => $_FILES['upload_image']['type'],
            'tmp_name' => $_FILES['upload_image']['tmp_name'],
            'error'    => $_FILES['upload_image']['error'],
            'size'     => $_FILES['upload_image']['size']	

        );

        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
if (!$movefile['error']) {
    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_parent' => $parent_post_id,
        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attachment_id = wp_insert_attachment( $attachment, $movefile['file']);
    if (!is_wp_error($attachment_id)) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata( $attachment_id, $movefile['file'] );
        wp_update_attachment_metadata( $attachment_id,  $attachment_data );
    }
    update_user_meta($user,'wp_user_avatar',$attachment_id);


  echo '<div class="msg">You have update your profile picture </div>';

            
        header( "refresh:5;url=".get_bloginfo('url')."/edit-profile/" );

  }
  else
  {
    foreach ( $reg_errors->get_error_messages() as $error ) {
           
            echo '<div class="error">'.$error.'</div>';
        }
  }
  

}

?>
<?php $current_user = wp_get_current_user();?>
<div id="profile" class="tab-pane fade">

    <form name="picture" action="" method="post" id="picture" enctype="multipart/form-data">
	<div class="display_name" ><?php echo ucwords($current_user->display_name) ;?> </div>
   <b style="display: block;">Your Current Profile Picture: </b><?php echo get_avatar( $user, 100 ); ?>
      <div class="form-group">
               
          <input type="hidden" id="my_hidden_input" name="profile_pic" value="<?php echo $pic; ?>">
		  
		 <div class="choose-profile-pic">
			<label class="select" for="afu_field_517465067">
				<i class="afuico afuico-upload-cloud"></i> <span data-text="choose file"> Choose File</span>
			</label>
			 <input type="file" name="upload_image" id="files" class="input-file">
		</div>	
		<div class="gallery" id="list"></div>
		<div style="clear:both"></div>
       
        </div> 
         <div class="form-group">
           
           
                <input type="submit" id="submit_pic"  value="Update" name="submit" class="form-control">
               
               
          
        </div>
      
    </form>
    
</div>


</div>

</div>

</div>
</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function($)
{
	//alert("check");
	
	
$(function() {
    $("#files").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function(){ // set image data as background of div
                $("#list").css("background-image", "url("+this.result+")");
            }
        }
    });
});


});
  
</script>
<style>
.gallery img {
    height: 52px;
    border: 1px solid #000;
    margin: 10px 4px 0 0;
	
}
#list {
    width: 11%;
    height: 56px;
    background-position: center;      
    display: inline-block;
	float:left;
    margin: 2% 0 0 2%;	
}
</style>
<?php get_footer();?>