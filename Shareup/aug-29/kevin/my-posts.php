<?php 
/**
 * Template Name: My Posts Page
 *
 * 
 *
 * @author Ahmad Awais
 * @since 1.0.0
 */
get_header(); ?>


<div class="chek-div">



</div>

<div class="container">
    <div class="row enigma_blog_wrapper posts-div">
  
<?php
if(isset($_POST['release_payment']))
{

    require 'wepay.php';
 $approved_id=$_POST['applicant_approved_id'];
 $user = get_user_by( 'ID',  $approved_id );
 $email= $user->user_email;
 $message=$_POST['message'];
 $author_name=$_POST['author_id'];
 $login_user_id = get_current_user_id();
 $login_user = get_user_by( 'ID',  $login_user_id );
 $login_user_name = $login_user->display_name;
 $login_user_email = $login_user->user_email;
 $pre_budget = $_POST['pre_budget'];
 
    // application settings
  $client_id = get_option('client_id');
  $client_secret = get_option('client_secret');
  
  $access_token = get_user_meta($approved_id,'wepay_access_token',true);
  $account_id    = get_user_meta($approved_id,'wepay_account_id',true);
    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);
	
    // create an account for a user
    $response = $wepay->request('credit_card/create', array(
   'client_id' =>  $client_id,
   "user_name" => $login_user_name,
   "email" => $login_user_email,
   "cc_number" => get_option('credit_card_number'),
   "cvv" => get_option('credit_card_cvv'),
   "expiration_month" => get_option('credit_card_month'),
   "expiration_year" => get_option('credit_card_year'),
   "address" => array("country" => 'US',
      "postal_code" => get_option('postal_code'))));



// credit card id to charge
$credit_card_id = $response->credit_card_id;


$wepay1 = new WePay($access_token);

// charge the credit card
$response1 = $wepay1->request('checkout/create', array(
    'account_id'          => $account_id,
    'amount'              => $pre_budget,
    'currency'            => 'USD',
    'short_description'   => 'Release Payment',
    'long_description'   => $message,
    'type'                => 'donation',
    'payment_method'      => array(
        'type'            => 'credit_card',
        'credit_card'     => array(
            'id'          => $credit_card_id
        )
    )
));

// display the response
//print_r($response1);
if($response1->state=="authorized")
{
  $date = date('F d, Y', time());
  update_post_meta($_POST['post_id'],'final_release','yes');
  update_post_meta($_POST['post_id'],'approved_applicants', $approved_id);
  update_post_meta($_POST['post_id'],'release_payment_date', $date);
  update_post_meta($_POST['post_id'],'release_message',$message);
  update_post_meta($_POST['post_id'],'release_checkout_id',$response1->checkout_id);
  $headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
  $headers .= "From: Kevin Bendict <".get_option('admin_email').">" . "\r\n";
  $message="Hello ".$name.",<br> <br>You have recieved money $".$pre_budget." from ".$author_name."<br><br> Thanks";
      wp_mail($email, 'You have recieved money', $message, $headers);
	  echo '<div class="container">';
		echo '<div class="msg">You have successfullly  release your fund.';

            echo  '</div></div>';
  }
}

if(isset($_POST['release_payment_refund']))
{
  require 'wepay.php';
   $p_id=$_POST['post_id_refund'];
   $admin_fees = (12 / 100 ) * $_POST['post_budget_refund'];
  $deduct_admin_fee= $_POST['post_budget_refund']-$admin_fees;
 $client_id = get_option('client_id');
 $client_secret = get_option('client_secret');
 
$access_token = get_option('access_token');
  // checkout to refund
   $checkout_id = get_post_meta($p_id,'checkout_id',true);

  // change to useProduction for live environments
  Wepay::useStaging($client_id, $client_secret);

  $wepay = new WePay($access_token);

  // refund the checkout
  $response2 = $wepay->request('checkout/refund', array(
    'checkout_id' => $checkout_id,
    'refund_reason' => 'Not Interested',
    'amount' => $deduct_admin_fee
  ));

 
   wp_delete_post($p_id,true); 

}
if(isset($_POST['delete_request_user']))
{
   $post_id=$_POST['post_id_request'];
   $app_id= $_POST['post_applicant_delete'];
  $app_requests=get_post_meta($post_id,'applicants',true);
  $app_requests_new= explode(',', $app_requests);
  if (($key = array_search($app_id, $app_requests_new)) !== false) unset($app_requests_new[$key]);
  $new_value= implode(',', $app_requests_new);
  update_post_meta($post_id,'applicants',$new_value);
}

?>

<div id="black_overlay1" style="width:100%; display:none;"> 
<div class="added1">
<a class="close">&times;</a>
 
      
        <form name="situation" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="post_budget_refund" name="post_budget_refund">
         <input type="hidden" class="post_id_refund" name="post_id_refund"/>
       
       <h2>Remove Post ?</h2>
       <span class="refund_des">All Requests for this post will be permanently deleted and you will be refunded.</span>
       <span>*12% of all refunds are withheld to encourage consummation.</span>
      
        <input type="submit" class="send_request_post" name="release_payment_refund" value="Get Refund and Remove Post"/>
        </form>      
        </div>
              
    </div>

<div id="black_overlay_request" style="width: 100%; display: none;"> 
<div class="request_delete_confirm">
<a class="close1">&times;</a>
 
      
        <form name="situation" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="post_applicant_delete" name="post_applicant_delete">
         <input type="hidden" class="post_id_request" name="post_id_request"/>
       
       <h2>Remove Request ?</h2>
       <span class="refund_des">Are you sure to delete the request from this user ?</span>
      
        <input type="submit" class="send_request" name="delete_request_user" value="Yes, Delete it"/>
        </form>      
        </div>
              
    </div>
<div id="black_overlay_release" style="width: 100%; display: none;"> 
<div class="release_confirm">
<a class="close2">&times;</a>
    <form name="release" method="post" action="">
<input type="hidden" value="<?php echo $v; ?>" name="applicant_approved_id" class="applicant_approved_id">
<input type="hidden" value="<?php echo $pay_amount; ?>" name="post_budget" class="post_budget">
<input type="hidden" value="<?php echo $budget; ?>" name="pre_budget" class="pre_budget">
<input type="hidden" value="<?php echo $id; ?>" name="post_id" class="post_id">
<input type="hidden" value="<?php echo $id; ?>" name="author_id" class="author_id">
<h2>Share Money?</h2>
 <span class="refund_des">You have decided to share your money with someone in need of it!<br>Would you like to share any words with your recipient? Now is your chance.</span>
<textarea name="message" placeholder='"Stay motivated, I have faith in you!"'></textarea>
<input type="submit" class="send_request" id="btn_submit" value="Send & Share" name="release_payment"></form>
</div>
</div> 

<div class="panel-group" id="accordion">


   <?php  
$user = wp_get_current_user();


 
  if ( in_array( 'administrator', (array) $user->roles ) ) {
 
   $args = array(
    'post_type'  => 'task',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    //'author' => get_current_user_id(),
    'meta_query' => array(
       array(
           'key' => 'final_release',
           'value' => 'no',
           'compare' => 'LIKE'
       )
   )
);
}
else
{
 
   $args = array(
    'post_type'  => 'task',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'author' => get_current_user_id(),
    'meta_query' => array(
       array(
           'key' => 'final_release',
           'value' => 'no',
           'compare' => 'LIKE'
       )
   )
);
}
 $query_posts = new WP_Query( $args );

 echo '<div class="col-md-12 table_header-new"><h2 class="count_posts post-click">Posts ('.$query_posts->post_count.')</h2> <h2 class="count_posts hist-click">History '.$query->post_count.'</h2> <span class="edit_right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span><span class="done_right" style="display:none;">Done
</span><div class="post-after"> <div class="col-md-2 col-xs-1">No.</div><div class="col-md-3 col-xs-2">Data Created</div> <div class="col-md-2 col-xs-3">Amount</div> <div class="col-md-3 col-xs-3">Category</div> <div class="col-md-2 col-xs-2">Requests</div></div></div>';
 $i=1;

 while ($query_posts->have_posts()) : $query_posts->the_post(); 
$id=get_the_ID();
$budget =get_post_meta($id,'budget',true);
$pay_amount =get_post_meta($id,'payment_amount',true);
 $applicants=get_post_meta($id,'applicants',true);
$approved =get_post_meta($id,'approved_applicants',true);
$app_arr= explode(',', $applicants);

$checkout_id=get_post_meta($id,'checkout_id',true);
//if($approved=="")
//{
?>

<div class="panel panel-default new_cross">
<i class="fa fa-times refund" aria-hidden="true" style="display:none;" data-id="<?php echo $id;?>" data-budget="<?php echo $pay_amount;?>"></i>

<div class="panel-heading">


<div class="col-md-12 collapsed collapsed-new" data-toggle="collapse" data-parent="#accordion" data-target="#collapse<?php echo $i; ?>">


<div class="date-month-new">
<div class="col-md-2 col-xs-1">
<?php echo $i;?>
</div>
<div class="col-md-3 col-xs-2">
<?php echo get_the_date();?>
</div>
<div class="col-md-2 col-xs-3"><?php echo $budget;?></div>
<div class="col-md-3 col-xs-3">
<?php $terms=get_the_terms( $id,'types' );
foreach($terms as  $v)
{
echo str_replace('and','&',$v->name);
} 
?>
</div>
<div class="col-md-2 col-xs-2"><?php if($app_arr[0]=="")
  {
    $count=0;
  }
  else
  {
    $count=count($app_arr);
  }
   echo $count;?>
   </div>
  </div>
  
</div>
  </div>
<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php if($i==1) { echo 'in';}?>">
<div class="panel-body">


<div class="panel-group" id="nested">
<div class="number-list4-new">
<div class="col-md-2 col-xs-1">No.</div>
<div class="col-md-2 col-xs-2">User</div> 
<div class="col-md-2 col-xs-2">Date</div> 
<div class="col-md-2 col-xs-2">Facebook Verified</div> 
<div class="col-md-2 col-xs-2">Words</div>
<div class="col-md-2 col-xs-2"></div>
</div>

<?php 
if($app_arr[0]!="")
{
  $j=1;
foreach($app_arr as $v)
{
?>

<div class="panel panel-default new_trash">
<i class="fa fa-trash-o delte_request" aria-hidden="true" style="display:none;" data-id="<?php echo $id;?>" data-applicant="<?php echo $v;?>"></i>
 <div class="panel-heading new_cross_heading">
<div  data-toggle="collapse" data-parent="#nested" data-target="#nested-collapse<?php echo $i;?><?php echo $j;?>">

<div class="james-sec">
<div class="col-md-2 col-xs-1"><?php echo $j;?></div>
<?php $user=get_user_by('ID',$v); ?>
<div class="col-md-2 col-xs-2">
<?php echo get_avatar($v,32);  ?>
<?php echo $user->first_name . ' ' . $user->last_name; ?>
</div>
<div class="col-md-2 col-xs-2"><?php echo get_post_meta($id,'applicants_request_date_'.$v,true);?></div>
<div class="col-md-2 col-xs-2 brek-sec">
<?php //echo $user->user_email; ?> 

<?php 
if ($access_token != null) {
  $fb_verified = "Yes"; 
}
else {
  $fb_verified = "No";
}
?>

<?php echo $fb_verified; ?>

</div>
<div class="col-md-2 col-xs-2"><?php echo str_word_count(get_post_meta($id,'applicants_message_'.$v,true)); ?> Words</div>
<div class="col-md-2 col-xs-2">


<a href="#" class="send_money" data-applicant_approved="<?php echo $v; ?>" data-author_id="<?php echo get_the_author();?>" data-budget="<?php echo $pay_amount; ?>" data-pre-budget = "<?php echo $budget;?>" data-post="<?php echo $id; ?>">Release Aid</a>
</div>
</div>
</div>
</div>
<div id="nested-collapse<?php echo $i;?><?php echo $j;?>" class="panel-collapse collapse <?php if($j==1) { echo 'in';}?>">
<div class="panel-body nested_body">
<div class=" next-part">
<p><?php echo get_post_meta($id,'applicants_message_'.$v,true); ?></p>
<img height="100" width="100" src="<?php echo get_post_meta($id,'applicants_media_'.$v,true); ?>">
</div>
</div><!--/.panel-body -->
</div><!--/.panel-collapse --> 
</div>   
<?php 
$j++;
}
}
else
{
  echo '<div class="panel panel-default"><div class="panel-heading"><div class="james-sec">';
  echo '<p>No request is found</p>';
  echo '</div></div></div>';
} ?>
</div>
</div>
</div>
</div>
<?php
//}
$i++;

   endwhile;  
?>


<?php

 wp_reset_postdata();
?>
  
  
</div> 
    </div>      
 </div>
 
 
 <!--/************************** History Div Starts Here *******************************/-->
 
<div class="container">
    <div class="row enigma_blog_wrapper history-div">
  
   <?php  
$user = wp_get_current_user();

  if ( in_array( 'administrator', (array) $user->roles ) ) {

   $args = array(
    'post_type'  => 'task',
    'post_status'    => 'publish',
    //'author' => get_current_user_id(),
    'meta_query' => array(
       array(
           'key' => 'final_release',
           'value' => 'yes',
           'compare' => 'LIKE',
       )
   )
);
}
else
{
	

   $args = array(
    'post_type'  => 'task',
	'posts_per_page' => -1,
    'post_status'    => 'publish',
    'author' => get_current_user_id(),
    'meta_query' => array(
       array(
           'key' => 'final_release',
           'value' => 'yes',
           'compare' => 'LIKE',
       )
   )
);
}
$query = new WP_Query( $args ); 

 echo '<div class="col-md-12 table_header"><h2 class="count_posts post-click yashu">Posts ('.$query_posts->post_count.')</h2><h2 class="count_posts yash">History ('.$query->post_count.')</h2><div class="post-after"> <div class="col-md-2 col-xs-1">No.</div><div class="col-md-3 col-xs-2">Date Released</div> <div class="col-md-2 col-xs-3">Name</div> <div class="col-md-3 col-xs-3">Category</div> <div class="col-md-2 col-xs-2">Amount</div></div></div>'; ?>
<div class="panel-group" id="accordion-test">
 <?php
 $i=1;

 while ($query->have_posts()) : $query->the_post(); 
$id=get_the_ID();
$budget =get_post_meta($id,'budget',true);
$pay_amount =get_post_meta($id,'payment_amount',true);
$re_date=get_post_meta($id,'release_payment_date',true);
$approved =get_post_meta($id,'approved_applicants',true);
//if($approved=="")
//{
?>
 <div class="panel panel-default history1">
   <div class="panel-heading history2">
    <div class="col-md-12 collapse_head1" data-toggle="collapse" data-parent="#accordion-test" data-target="#collapse-test<?php echo $i; ?>">

<div class="date-month-history">
<div class="col-md-2 col-xs-1">
<?php echo $i;?>
</div>
<div class="col-md-3 col-xs-2">
<?php echo $re_date;?>
</div>
<div class="col-md-2 col-xs-3"><?php $user=get_user_by('ID',$approved);  echo $user->first_name . ' ' . $user->last_name;?></div>
<div class="col-md-3 col-xs-3">
<?php $terms=get_the_terms( $id,'types' );
foreach($terms as  $v)
{
echo str_replace('and','&',$v->name);
} 
?>
</div>
<div class="col-md-2 col-xs-2"><?php echo $budget;?>
   </div>
  </div>

</div>
</div>
<div id="collapse-test<?php echo $i; ?>" class="panel-collapse collapse">
<div class="panel-body">
<?php $thank_message = get_post_meta($id,'thanks_message',true);
if($thank_message=='')
	$thank_message = "No message found"?>
<div class="col-md-12 col-sm-12 withdrawl_tables_inner2"><span class="heading prize"><?php echo $thank_message; ?></span>
</div>
</div>
 </div>
 </div>
<?php
//}
$i++;

   endwhile;  
?>


<?php

 wp_reset_postdata();
?>
  
  
</div> 
    </div>    
</div> 
 
 
 
 
 
<script type="text/javascript">
jQuery(document).ready(function () {
	
  jQuery('.history-div').hide();
  jQuery('.hist-click').click(function(){
	   jQuery('.history-div').show();
     jQuery('.yash').addClass("active-his");
	   jQuery('.posts-div').hide();
     jQuery('.yashu').removeClass("active-his"); 
	        
	});
	
	jQuery('.post-click').click(function(){
	   jQuery('.history-div').hide();
	   jQuery('.posts-div').show();
     jQuery('.post-click').addClass("active-his");    
	});

  jQuery('.edit_right').click(function(e) {
   jQuery(this).hide();
   jQuery('.done_right').show();
   jQuery('.fa-trash-o').show();
   jQuery('.fa-times').show();
});
  jQuery('.done_right').click(function(e) {
   jQuery(this).hide();
   jQuery('.edit_right').show();
   jQuery('.fa-trash-o').hide();
   jQuery('.fa-times').hide();
});
  jQuery('.refund').click(function() {
    
var h = jQuery("body").height() + '<span id="IL_AD12" class="IL_AD">px</span>';
     jQuery("#black_overlay1").css({"height":h,"display":"block","visibility":"visible"});
     jQuery(".added1").css('display','block');
     jQuery('.post_id_refund').val(jQuery(this).attr('data-id'));
     jQuery('.post_budget_refund').val(jQuery(this).attr('data-budget'));
   
  });
  jQuery(".close").click(function() {
     jQuery(".added1").css('display','none');
     jQuery("#black_overlay1").css("display","none");
  });

   jQuery('.delte_request').click(function() {
var h = jQuery("body").height() + '<span id="IL_AD12" class="IL_AD">px</span>';
     jQuery("#black_overlay_request").css({"height":h,"display":"block","visibility":"visible"});
     jQuery(".request_delete_confirm").css('display','block');
     jQuery('.post_id_request').val(jQuery(this).attr('data-id'));
     jQuery('.post_applicant_delete').val(jQuery(this).attr('data-applicant'));
   
  });
  jQuery(".close1").click(function() {
     jQuery(".request_delete_confirm").css('display','none');
     jQuery("#black_overlay_request").css("display","none");
  });

  jQuery(".send_money").click(function() {
   
    var h = jQuery("body").height() + '<span id="IL_AD12" class="IL_AD">px</span>';
     jQuery("#black_overlay_release").css({"height":h,"display":"block","visibility":"visible"});
     jQuery(".release_confirm").css('display','block');
     jQuery('.applicant_approved_id').val(jQuery(this).attr('data-applicant_approved'));
     jQuery('.post_id').val(jQuery(this).attr('data-post'));
     jQuery('.post_budget').val(jQuery(this).attr('data-budget'));
	 jQuery('.pre_budget').val(jQuery(this).attr('data-pre-budget'));
      jQuery('.author_id').val(jQuery(this).attr('data-author_id'));
     
   });
 jQuery(".close2").click(function() {
     jQuery(".release_confirm").css('display','none');
     jQuery("#black_overlay_release").css("display","none");
  });


});
</script>

<style type="text/css">
  .count_posts {   
    
    color: #666;
    cursor: pointer;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 10px;
    margin-top: 20px;
   
}
/*.count_posts:hover {
    background-color: rgb(139, 201, 50);
    color: #fff;
}*/
.count_posts.yash.active-his {
   
    color: #000;
}

.count_posts.post-click.active-his {
  
    color: #000;
}

</style>


<?php get_footer(); ?>