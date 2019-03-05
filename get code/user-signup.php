<?php


/****************************************Code for ajax user login************************************/

add_action('wp_ajax_nopriv_check_user_login', 'check_user_login');
add_action('wp_ajax_check_user_login', 'check_user_login');


function check_user_login()
{
  
	$credentials=array();
	$user_login = $_POST['user_login'];
	$user_pass  = $_POST['user_pass'];
	
	$credentials['user_login'] = $user_login;
	$credentials['user_password'] = $user_pass;
	$credentials['remember'] = true;

	$userdata = get_user_by('email', $credentials['user_login']);
    $result   = wp_check_password($credentials['user_password'], $userdata->data->user_pass, $userdata->data->ID);

	$user_id = $userdata->data->ID;
	
	$code = get_user_meta( $user_id, 'acc_activate', true );
	
	if(!$result)
	{
		   
		echo '1';
		  
	}elseif(isset($code) && $code == '0' )
	{	
		echo '3';
		
	}elseif(isset($code) && $code == '1')
	{	
		if ( $result ) 
		{
			auto_login( $userdata );
			
			//echo "<pre>";
			//print_r($userdata);
			
			echo $userdata->data->display_name;
			echo '-';
			echo '2';

		} 
	}

    die();
			
}

function auto_login( $user ) 
{
    if ( !is_user_logged_in() ) 
	{
        $user_id = $user->data->ID;
        $user_login = $user->data->user_login;

        wp_set_current_user( $user_id, $user_login );
        wp_set_auth_cookie( $user_id );

    } 
}

/******************** Login Process code ends here ************************/


/************** /////////////////////Sing up Ajax Process///////////////// ************/
function my_email_content_type() 
{
	return "text/html";
}
add_filter ("wp_mail_content_type", "my_email_content_type");

add_action('wp_ajax_nopriv_check_user_signup', 'check_user_signup');
add_action('wp_ajax_check_user_signup', 'check_user_signup');

function check_user_signup()
{
    //Getting personal details 
    $user_login = $_POST['user_login'];
    $user_pass  = $_POST['user_pass'];
	$user_email = $_POST['user_email'];
	$user_type  = $_POST['user_type'];
	$user_zip   = $_POST['user_zip'];
	$user_phone = $_POST['user_phone'];
	$user_adres = $_POST['user_adres'];
	
	//Getting Retailer form post data
	$buis_name          = $_POST['buis_name'];
	$buis_address       = $_POST['buis_address'];
	$buis_address_other = $_POST['buis_address_other'];
	$buis_description   = $_POST['buis_description'];
	$buis_img           = $_POST['buis_img'];
	
	//Getting Fundraiser form post data
	$fund_name          = $_POST['fund_name'];
	$fund_address       = $_POST['fund_address'];
	$fund_address_other = $_POST['fund_address_other'];
	$fund_description   = $_POST['fund_description'];
	$fund_cat_name      = $_POST['fund_cat_name'];
	$fund_s_date        = $_POST['fund_s_date'];
	$fund_s_time        = $_POST['fund_s_time'];
	$fund_e_time        = $_POST['fund_e_time'];
	
    $info = array();
  	$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($user_login) ;
    $info['user_pass']     = sanitize_text_field($user_pass);
	$info['user_email']    = sanitize_email( $user_email );
	
	// Register the user
    $user_register = wp_insert_user( $info );
	
	//Check if any error while signing up
	if ( is_wp_error($user_register) )
	{	
		$error  = $user_register->get_error_codes()	;
		
		if(in_array('empty_user_login', $error))
		{
			//***********Empty_user_login**************
			
			echo '0';
		}
		elseif(in_array('existing_user_login',$error))
		{
			//**********Username is already registered**********
			echo '1';
		}
		elseif(in_array('existing_user_email',$error))
		{
           //***********Email address is already registered***************
		   
		   echo '2';
		   
		}else{
			
			echo '4';
		}
		
    }else{
		    //************* If sign up is successful then add usermeta and posts as retailer/fundraiser****************
		
			$user_id_role = new WP_User($user_register);
			
			// Check User Type to set Role
			if($user_type == 'fundraiser')
			{
			 $user_id_role->set_role('fundraiser');
			 
			}elseif($user_type == 'retailer')
			{
				$user_id_role->set_role('retailer');
			}
			
			//Add user profile information
			update_user_meta( $user_register, 'user_type', $user_type );
			update_user_meta( $user_register, 'user_zip', $user_zip );
			update_user_meta( $user_register, 'user_phone', $user_phone );
			update_user_meta( $user_register, 'user_adres', $user_adres );
			
			//Sign Up Notifications For admin and User
			if($user_register && !is_wp_error( $user_register ))
			{
				$user = new WP_User($user_register);
				
				$user_login = stripslashes($user->user_login);
				$user_email = stripslashes($user->user_email);
				
				// Email Notification For Admin
				
				$message .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
					<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ", "ADMIN") . 
					"</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
				$message .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;"> New user registration on RaiseIt','piereg</div>') . "</br>";
				$message .= sprintf(__('Username: %s'), $user_login) . "<br/>";
				$message .= sprintf(__('E-mail: %s'), $user_email) . "<br/></div>";
				$message .='</div></body></html>';

		/*		$message  = sprintf(__('New user registration on RaiseIt %s:'), get_option('blogname')) . "<br/>";
				$message .= sprintf(__('Username: %s'), $user_login) . "<br/>";
				$message .= sprintf(__('E-mail: %s'), $user_email) . "<br/>";*/
		  
				wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

				// Email Notification For Users
				
				$code = sha1( $user_register . time() );
				//Activation Link Page
				$activation_link = add_query_arg( array( 'key' => $code, 'user' => $user_register ), get_permalink(337));
				add_user_meta( $user_register, 'has_to_be_activated', $code, true );
				add_user_meta( $user_register, 'acc_activate', 0, true );
				
				$message1= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
					<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ", $user_login) . 
					"</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
				$message1 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;"> Welcome to Raise It! Here your log in details:','piereg</div>') . "</br>";
				$message1 .= sprintf(__('Username: %s'), $user_login) . "<br/>";
				$message1 .= sprintf(__('Password: %s'), $user_pass) . "<br/>";
				$message1 .= "<p>Click on below link to activate your account with RaiseIt</p>" . "<br/>";
				$message1 .= "<a href=".$activation_link."> Activate </a>" . "<br/>";
				$message1 .= sprintf(__('If you have any problems, please contact us at %s.'), get_option('admin_email')) . "<br/></div>";
				$message1.='</div>
								<div style=color: #999;padding: 50px 30px">
								<br>
								<div style="">Regards,</div>
								<div style="">RaiseIT Team</div>						
								</div>
								</body></html>';
				wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message1);	
			}
			
			
?>