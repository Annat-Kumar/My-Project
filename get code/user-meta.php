
<?php $user_info = get_userdata(get_current_user_id());
$name= $user_info->user_firstname.' '.$user_info->user_lastname;
$email= $user_info->user_email;
?>
<?php

if($_REQUEST["status"] == "done")
    {
	$userID = $_REQUEST["usrid"];
	update_usermeta( $userID, order, 'done');
	
	$date = current_time('mysql');	
	$order_completed = get_user_meta( $userid, "order_completed", true );
	if($order_completed == " ")
	{
		add_user_meta($userID, order_completed, $date);
	}
	else
	{
		update_user_meta($userID, order_completed, $date);
	}
	
	echo "<script>window.location='".get_option('home')."/home-page/'</script>";
    }
	
?>

<?php

$date = current_time('Y-m-d');

        add_user_meta( $user_ID, amount, $amount);

        add_user_meta( $user_ID, order, 'process');

        add_user_meta( $user_ID, order_date, $date);

        add_user_meta( $user_ID, shipping_options, $shipping);

        add_user_meta( $user_ID, transaction_id, $response_array[6]);
		
		
		 $account_id = get_user_meta(get_current_user_id(),'wepay_account_id',true);

		 $access_token = get_user_meta(get_current_user_id(),'wepay_access_token',true);
?>

<?php

 update_post_meta($_POST['request_for_post'],'applicants',$old_app_array);

      update_post_meta($_POST['request_for_post'],'applicants_request_date_'.$us_id,$date);

       update_post_meta($_POST['request_for_post'],'applicants_message_'.$us_id,$des);

       update_post_meta($_POST['request_for_post'],'applicants_media_'.$us_id,$movefile['url'

$approved_applicants1 =get_post_meta($id1,'approved_applicants',true);
$applicants1=get_post_meta($id1,'applicants',true);	   
?>
<?php

elseif ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Email Already in use');
    }
    

 
    
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'  =>  $email,
        'user_email'  =>  $email,
        'user_pass'   =>  $password,
        'first_name'  =>  $first_name,
        'last_name'   =>  $last_name
    
    );
        $user_id = wp_insert_user( $userdata );
        $user = get_user_by( 'id', $user_id );
if( $user ) {
wp_set_current_user( $user_id, $user->user_login );
wp_set_auth_cookie( $user_id );
do_action( 'wp_login', $user->user_login, $user);
}
?>