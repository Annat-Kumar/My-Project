
<?php

require 'wepay.php';
		
$client_id         = get_option('wepay_client_id');
$client_secret     = get_option('wepay_client_secret');
$access_token_live = get_option('wepay_access_token');

// change to useStaging for live environments

$site_url = site_url();

if($site_url == "https://dev.raiseitfast.com")
{
	Wepay::useStaging($client_id, $client_secret);
}
else
{
	Wepay::useProduction($client_id, $client_secret);

}
$wepay = new WePay(NULL);

// register new merchant

$response = $wepay->request('user/register/', array(
	'client_id'        => $client_id,
	'client_secret'    => $client_secret,
	'email'            => $_POST['wepay_email'],
	'scope'            => 'manage_accounts,collect_payments,view_user,preapprove_payments,send_money',
	'first_name'       => $_POST['wepay_f_name'],
	'last_name'        => $_POST['wepay_l_name'],
	'original_ip'      => '74.125.224.84',
	'original_device'  => 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6;
		en-US) AppleWebKit/534.13 (KHTML, like Gecko)
		Chrome/9.0.597.102 Safari/534.13',
		'tos_acceptance_time' => 1209600
	));

$expire_in = $response->expires_in;


if($expire_in != 0)
{

	$access_token = $response->access_token;
	$wepay1 = new WePay($access_token);
	// create an account for a user
	$response1 = $wepay1->request('user/send_confirmation/', array());
	$wepay2 = new WePay($access_token);

	// create an account for a user
	$response2 = $wepay2->request('account/create/', array(
		'name'         => $_POST['wepay_f_name'].' '.$_POST['wepay_l_name'],
		'description'  => $_POST['wepay_f_name'].' '.$_POST['wepay_l_name'].' description'
	));
	$account_id = $response2->account_id;
	update_user_meta($id,'account_id',$account_id);
	update_user_meta($id,'access_token',$access_token);
	update_user_meta($id,'client_id',$client_id);
	update_user_meta($id,'client_secret',$client_secret);
}


?>