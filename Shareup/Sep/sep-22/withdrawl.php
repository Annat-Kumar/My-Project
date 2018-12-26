<?php
/**
 * Template Name: Withdrawl Page
 *
 *
 * @author Ahmad Awais
 * @since 1.0.0
 */
get_header(); 
?>


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
   echo $account_id;die; 
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
     //echo $account_id;die;
    $response2= $wepay->request('checkout/find',array("account_id" => $account_id));
    //$response3= $wepay->request('withdrawal/find',array("account_id" => $account_id));
    
    
}
else
{
     wp_redirect(get_bloginfo('url').'/sign-up');
      exit;
} 



    // display the response
if(isset($_POST['send_message']))
{	
  $checkout_id=$_POST['checkout_id']; 
  $message=$_POST['message'];
  $email=$_POST['user_email'];
  $posts = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE meta_key='release_checkout_id' AND meta_value= $checkout_id");
foreach ( $posts as $post ){
$id = $post->post_id;
update_post_meta($id,'thanks_message',$_POST['message']);

$headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
$headers .= "From: Kevin Bendict <".get_option('admin_email').">" . "\r\n";
$message="Hello ,<br> <br>".$message;
wp_mail($email, 'Thanks for share money', $message, $headers);

}
   }  
?>
<div id="black_overlay" style="width:100%; display:none;"> 
<div class="added">
<a class="close">&times;</a>
 
      
        <form name="situation" action="" method="post" enctype="multipart/form-data">
       
       <input type="hidden" class="user_email" name="user_email"/>
       <input type="hidden" class="checkout_id" name="checkout_id"/>
       
       <h2>Send Thanks</h2>
      <span class="refund_des">You have received money from a person who was<br> influenced by your story</span>
      <span class="refund_des">This is your chance to let them know how much<br> it meant to you and to express thanks.</span>
      <textarea name="message" placeholder='"Thank you so much!"'></textarea>
        <input type="submit" class="send_request" name="send_message" value="Send Message"/>
        </form>      
        </div>
              
    </div>
<div class="container">
<?php echo $msg;?>

<div class="col-md-12 withdrawal_lists">
<h3>Withdrawls(<?php echo count($response2);?>)</h3>
<div class="head_table">
<div class="col-md-2 col-sm-2 col-xs-2"> <span class="heading">From User</span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading">Email</span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading">Delivered 2-5 Business Days From</span></div>
<div class="col-md-2 col-sm-2 col-xs-2"><span class="heading">Amount</span></div>
<div class="col-md-2 col-sm-2 col-xs-2"></div>
</div>
</div>

<div class="panel-group first_pan" id="accordion">
<?php $i=1;

//echo "<pre>";print_r($response2);die;
foreach ($response2 as $key => $value) {
	$checkout_id = $value->account_id;
	//echo $checkout_id;
	$posts = $wpdb->get_results("SELECT * FROM `wp_postmeta` WHERE meta_key='release_checkout_id' AND meta_value= $checkout_id");
	foreach ( $posts as $post ){
		$id = $post->meta_id;
		echo $id;
		$thank_message = get_post_meta($id,'thanks_message',true);
	}	
	if($thank_message !='')
	{
		$msg_class= " ";
	}
	else
	{
		$msg_class= "heading send_thanks";
	}
  ?>
   <div class="panel panel-default sec_pan">
   <div class="panel-heading third_pan">
      <div class="col-md-12 collapse_head" data-toggle="collapse" data-parent="#accordion" data-target="#collapse<?php echo $i; ?>">
     
<div class="col-md-2 col-sm-2 col-xs-2"><span class="round"></span> <span class="heading"><?php echo $value->payer->name; ?> </span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading"><?php echo $value->payer->email; ?></span></div>
<div class="col-md-3 col-sm-3 col-xs-3" ><span class="heading"><?php echo gmdate("F d, Y", $value->create_time); ?> </span></div>
<div class="col-md-2 col-sm-2 col-xs-2"><span class="heading prize">$<?php echo $value->amount;?></span></div>
<div class="col-md-2 col-sm-2 col-xs-2"><span class="<?php echo $msg_class;?>" data-checkout_id="<?php echo $value->checkout_id; ?>" data-email="<?php echo $value->payer->email; ?>">Send Thanks</span>
</div>
</div>
</div>
<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
<div class="panel-body">

<div class="col-md-12 col-sm-12 withdrawl_tables_inner"><span class="heading prize"><?php echo $value->long_description; ?></span>
</div>


 </div>
 </div>

</div>
 <?php $i++;
  } ?>
</div>


</div>

<script type="text/javascript">
jQuery(document).ready(function () { 
jQuery('.send_thanks').click(function() {
    
var h = jQuery("body").height() + '<span id="IL_AD12" class="IL_AD">px</span>';
     jQuery("#black_overlay").css({"height":h,"display":"block","visibility":"visible"});
     jQuery(".added").css('display','block');
     jQuery('.user_email').val(jQuery(this).attr('data-email'));
     jQuery('.checkout_id').val(jQuery(this).attr('data-checkout_id'));    
     //jQuery(this).parent().parent().removeAttr('data-toggle');
     //jQuery(this).parent().parent().attr("data-toggle", "collapse123");
     //jQuery(".third_pan").find(".collapse_head").attr("data-toggle", "collapse123");
     jQuery(".collapse_head").attr("data-toggle", "collapse123");
	 
   
  });
  
 
  jQuery(".close").click(function() {
     jQuery(".added").css('display','none');
     jQuery("#black_overlay").css("display","none");
	 jQuery(".collapse_head").attr("data-toggle", "collapse");
  });
});
</script>
<style type="text/css">
.send_thanks{cursor:pointer}
</style>
<?php get_footer();?>