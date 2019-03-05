<?php

/*********** FORGET PASSWORD START CODE HERE***************/


add_action('wp_ajax_nopriv_forget_password', 'forget_password');
add_action('wp_ajax_forget_password', 'forget_password');

function forget_password(){
	 $user_email = $_POST['user_login'];
	 $pie_register_base = new PieReg_Base();
	/*
		*	Sanitizing post data
	*/
	$pie_register_base->piereg_sanitize_post_data( ( (isset($_POST) && !empty($_POST))?$_POST : array() ) );
	$option = get_option('pie_register_2');
	 if(isset($_POST['user_login']) and trim($_POST['user_login']) == ""){
		echo $error[] = '<strong>'.ucwords(__("error:","piereg")).'</strong> '.__('Invalid Username or Email, try again!','piereg');

	}
	 else{
			global $wpdb,$wp_hasher;
			$error 		= array();
			$username = trim($_POST['user_login']);
			$user_exists = false;
			// First check by username
			if ( username_exists( $username ) ){
				$user_exists = true;
				$user = get_user_by('login', $username);
			}
			// Then, by e-mail address
			elseif( email_exists($username) ){
					$user_exists = true;
					$user = get_user_by_email($username);
			}
			else{
			echo	$error[] = '<strong>'.ucwords(__("error :","piereg")).'</strong> '.__('Username or Email was not found, try again!','piereg');
			}
			if ($user_exists){
				
				$user_login = $user->user_login;
				$user_email = $user->user_email;
		
				$allow = apply_filters( 'allow_password_reset', true, $user->ID );
				if($allow){
					//Generate something random for key...
					$key = wp_generate_password( 20, false );
					
					//let other plugins perform action on this hook
					do_action( 'retrieve_password_key', $user_login, $key );
					
					//Generate something random for a hash...
					if ( empty( $wp_hasher ) ) {
						require_once ABSPATH . 'wp-includes/class-phpass.php';
						$wp_hasher = new PasswordHash( 8, true );
					}
					
					//$hashed = $wp_hasher->HashPassword( $key );
					$hashed = time() . ':' . $wp_hasher->HashPassword( $key );
					
					// Now insert the new md5 key into the db
					$wpdb->update($wpdb->users, array('user_activation_key' => $hashed), array('user_login' => $user_login));
		
					
					$message_temp = "";
					if($option['user_formate_email_forgot_password_notification'] == "0"){
						$message_temp	= nl2br(strip_tags($option['user_message_email_forgot_password_notification']));
					}else{
						$message_temp	= $option['user_message_email_forgot_password_notification'];
					}
					
					$message		= $pie_register_base->filterEmail($message_temp,$user->user_login, '',$key );
					$from_name		= $option['user_from_name_forgot_password_notification'];
					$from_email		= $option['user_from_email_forgot_password_notification'];					
					$reply_email 	= $option['user_to_email_forgot_password_notification'];
					$subject 		= html_entity_decode($option['user_subject_email_forgot_password_notification'],ENT_COMPAT,"UTF-8");
					
					//Headers
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				
					if(!empty($from_email) && filter_var($from_email,FILTER_VALIDATE_EMAIL))//Validating From
					$headers .= "From: ".$from_name." <".$from_email."> \r\n";
					if($reply_email){
						$headers .= "Reply-To: {$reply_email}\r\n";
						$headers .= "Return-Path: {$from_name}\r\n";
					}else{
						$headers .= "Reply-To: {$from_email}\r\n";
						$headers .= "Return-Path: {$from_email}\r\n";
					}
			
			 $subject='Forgot Password Notification';
			
			
				$message .= "<html>
				          <body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'>
				          <div style='color: #444444;font-weight: normal;'>
				            <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div>
				           <div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Dear,','piereg')." %s ", $user_login) . 
				           "</div>
                       
				     </div> 
                     <div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>
				     ";
				$message .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;"> We’re told you forgot your password to your RaiseIT account. Dont worry, it happens to the best of us!<br>Please click this link to reset your password.','piereg</div>') . "</br></br>";
			   $message .= "<a  href=".network_site_url("login/?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "&redirect_to=".urlencode(get_option('siteurl')).">Click </a></br></br> </div>";
			
					$message .='</div>
                         <div style=color: #999;padding: 50px 30px">
                           <br>
						<div style="">Regards,</div>
						<div style="">RaiseIT Team</div>
						
						
					</div>
					</body></html>';

					//send email meassage
					if (FALSE == wp_mail($user_email, $subject, $message,$headers)){
					echo	$error[] =  '<strong>'.ucwords(__("error :","piereg")).'</strong> '.__('The e-mail could not be sent.','piereg') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...','piereg') ;
					}
					
					unset($key);
					unset($hashed);
					unset($_POST['user_login']);
				}else{
				echo 	$error[] = apply_filters('piereg_password_reset_not_allowed_text',__("Password reset is not allowed for this user","piereg"));
				}
			 
				if (count($error) == 0 )
				{
					echo $success =  '<b>'.ucwords(__("success :","piereg")).'</b> '.apply_filters("piereg_message_will_be_sent_to_your_email",__('A message will be sent to your email address.','piereg'));
				}	
			}
		}

	die();
}

/**************** FORGET PASSWORD END **************************/
?>