<?php

get_header(); 
require 'wepay.php';
// application settings
$user = wp_get_current_user();
get_current_user_id();
if ( in_array( 'administrator', (array) $user->roles ) )
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

?>


<?php
/*** complete process ***/
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
    Wepay::useProduction($client_id, $client_secret);

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

	  
  if($response->state=="authorized")
{
$post_id = wp_insert_post(array('comment_status'  => 'open','ping_status'   => 'closed','post_author'   => $author_id,'post_content' => $your_content,'post_title'    => 'job','post_status'   => 'publish','post_type'   => 'task')

        ); 
}
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
  Wepay::useProduction($client_id, $client_secret);

  $wepay = new WePay($access_token);

  // refund the checkout
  $response2 = $wepay->request('checkout/refund', array(
    'checkout_id' => $checkout_id,
    'refund_reason' => 'Not Interested',
    'amount' => $deduct_admin_fee
  ));

  // account update 
   $response1 = $wepay->request('account/get_update_uri', array(
                'account_id'    => $account_id,
               'redirect_uri'  => get_bloginfo('url').'/withdrawl',
               'mode'          => 'iframe'
            ));
             
 
   wp_delete_post($p_id,true); 
	
	// change to useProduction for live environments
  Wepay::useStaging($client_id, $client_secret);

  $wepay = new WePay($access_token);

  // refund the checkout
  $response2 = $wepay->request('checkout/refund', array(
    'checkout_id' => $checkout_id,
    'refund_reason' => 'Not Interested',
    'amount' => $deduct_admin_fee
  ));
  
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
