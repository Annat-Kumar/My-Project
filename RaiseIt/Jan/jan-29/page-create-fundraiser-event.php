	<?php 
	/**
	* Template Name: Create Fundraiser event Page
	*
	* Login Page Template.
	*
	* @author Ahmad Awais
	* @since 1.0.0
	*/



	$current_users = wp_get_current_user();

	$user_roless = $current_users->roles;

	$id = $current_users->ID;
	$name = $current_users->user_firstname;
	$fundra_email = $current_users->user_email ;
	$username =  $current_users->user_nicename;
	$fundraiser_phone = get_user_meta( $id, 'user_phone', true);

	if(is_user_logged_in())
	{
	get_header(); 


	if(isset($_POST['submit_fun']) && !empty($_POST['submit_fun']))

	{

	/*		echo "<pre>";
	print_r($_POST);
	die("*****************************************");*/

	//get all data from post

	$f_fund_names     = stripslashes(stripslashes(stripslashes($_POST['fund_name'])));
	$f_fund_name = str_replace('\"', '', $f_fund_names);

	$f_descriptions     = stripslashes(stripslashes(stripslashes($_POST['description'])));
	$f_description = str_replace('\"', '', $f_descriptions);


	//$f_description = $_POST['description'];


	$fund_city       = $_POST['fund_city'];
	$findzip         = $_POST['findzip'];
	$f_event_date    = $_POST['f_event_date'];
	$f_fund_s_time   = $_POST['f_fund_s_time'];
	$f_event_e__date = $_POST['f_event_e__date'];
	$f_fund_e_time   = $_POST['f_fund_e_time'];
	$event_amt       = $_POST['f_fund_amt'];
	$f_cat           = $_POST['f_cat_chk'];
	$check_value     = $_POST['get_value'];
	$feature_image_1 = $_FILES['feature_image_1'];
	$tax_deductible  = $_POST['tax_deductible'];

	$fund_image      = $_POST['fund_image'];

	$fund_logo       = $_POST['fund_logo'];

	if($_POST['new_wepay_f_name'] != '')
	{
		$w_f_name = $_POST['new_wepay_f_name'];
	}
	else 
	{
		$w_f_name = "none";
	}
	if($_POST['new_wepay_l_name'] != '')
	{
		$w_l_name = $_POST['new_wepay_l_name'];
	}
	else 
	{
		$w_l_name = "none";
	}

	if($_POST['new_wepay_email'] != '')
	{
		$w_email = $_POST['new_wepay_email'];
	}
	else 
	{
		$w_email = "none";
	}


	$ret_e_id_new             = $_POST['ret_e_id_news'];
	$ret_e_title_new          = $_POST['ret_e_title_news'];
	$ret_e_authe_name_new     = $_POST['ret_e_authe_name_news'];
	$ret_e_auther_id_new      = $_POST['ret_e_auther_id_news'];

	$show_post            = $_POST['show_post'];

	$retailer_phone = get_user_meta( $ret_e_auther_id_new, 'user_phone', true);


	$f_date  = date_create($_POST['f_event_date']);

	$f_dated = date_format($f_date,"Y/m/d");


	$f_e_date  = date_create($_POST['f_event_e__date']);

	$f_e_dated = date_format($f_e_date,"Y/m/d");	

	$user_infos_new = get_userdata($ret_e_auther_id_new);

	$retailer_user_emails = $user_infos_new->user_email;
	$retailer_user_names = $user_infos_new->user_nicename;

	// send mail to admin  for zipcode alert

	$send_zip = $_POST['send_zip'];
	if($_POST['msg_to_raisit'])
	{
		$send_message = $_POST['msg_to_raisit'];
	}
	else
	{
		$send_message = "N/A";
	}

	if(isset($send_zip) && !empty($send_zip))
	{
		global $wpdb;
		$zip_tablename = $wpdb->prefix.'zip_notification';
		$zip_datas = array(
			'zipcode' => $send_zip, 
			'fund_email' => $fundra_email,
			'fund_author_name' => $name,
		);

		$zip_inserts = $wpdb->insert( $zip_tablename, $zip_datas);

		if($zip_inserts)
		{
			$user_info   = get_userdata(1);
			$admin_name  = $user_info->user_login;
			$admin_email = get_option( 'admin_email' );

	         	// write the email content for admin

			@$header4 .= "MIME-Version: 1.0\n";
			$header4 .= "Content-Type: text/html; charset=utf-8\n";
			@$headers4 .= "From:" . $admin_email;  

			$sends_message .= "<html>

			<body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'>

			<div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'>

			<div style='color: #444444;font-weight: normal;'>

			<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT </div>

			<div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$admin_name) . 
			"</div>



			</div>

			<div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";

			$sends_message .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">A fundraiser have send a message to you, when they do not finds a retailer after searching for <b>"'.$send_zip.'"</b>.','piereg</div>');

			$sends_message .=  '<div style="padding: 30px 0;font-size: 18px;line-height: 20px;><b style="margin-bottom:20px;">Message:-</b>'.$send_message.'</div>';


			$sends_message .='</div><div style=color: #999;padding: 50px 30px">
			<div style="">Regards,</div>
			<div style="">Raise It Team</div>            
			</div></body></html>';

			$subject31 = "Raise It Notification";
			$subject31 = "=?utf-8?B?" . base64_encode($subject31) . "?=";



			$to_admin = $admin_email;

		          // send the email to reatiler
			$email3 = wp_mail($to_admin, $subject31, $sends_message, $header4);


		}

	}

	$user_post_meta_fund = array(
		'post_title'   => $f_fund_name,
		'post_content' => $f_description,
		'post_status'  => 'draft',
		'post_type'    => 'fundraiser',
		'post_author'  => $id,
	); 

	$f_post_id = wp_insert_post( $user_post_meta_fund );
	$cat_ids[] = $f_cat;
	$cat_ids = array_map( 'intval', $cat_ids );
	$cat_ids = array_unique( $cat_ids );
	$taxonomy = 'fund_cate';

	//Add selected category to this current post
	wp_set_object_terms($f_post_id, $cat_ids, $taxonomy , true );

	//$post_slug1 = get_post_field( 'post_name', $f_post_id );


	global $wpdb;
	$tablenames = $wpdb->prefix.'post_relationships';

	if(isset($check_value))
	{
		$datas = array(
			'r_id' => $ret_e_id_new, 
			'r_name' => $ret_e_title_new,
			'rr_author_id' =>$ret_e_auther_id_new,          
			'f_id' => $f_post_id, 
			'f_name' => $f_fund_name,
			'f_date' => $f_dated, 
			'f_end_date' => $f_e_dated,
			'f_start_time' => $f_fund_s_time, 
			'f_end_time' => $f_fund_e_time,
			'status' => none,
			'f_auth_name' => $name,
			'f_auth_email' => $fundra_email,
			'f_auth_id' => $id,
			'child_frst_name' => $w_f_name,
			'child_lst_name' => $w_l_name,
			'child_email' => $w_email,
			'donor_id' =>0,
		);

		$fund_inserts = $wpdb->insert( $tablenames, $datas);

		if(isset($fund_inserts) && !empty($fund_inserts))
		{
		// write the email content for Retailer
			@$header .= "MIME-Version: 1.0\n";
			$header .= "Content-Type: text/html; charset=utf-8\n";
			@$headers .= "From:" . $admin_email;

			$message .= "<html><body style='padding:3px; background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
			<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$retailer_user_names) . 
			"</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
			$message .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">A fundraiser have requested to you for hosting their event. Plesae check this requested event in your event listings to approve or disapprove the event. ','piereg</div>') . "</br></div>";

			$message .='</div></br></br><div style=color: #999;padding: 50px 30px">
			<div style="">Regards,</div>
			<div style="">Raise It Team</div>            
			</div></body></html>';

			$subject = "Raise It Notification";
			$subject = "=?utf-8?B?" . base64_encode($subject) . "?=";

			$to_reta = $retailer_user_emails;

	        // send the email to reatiler
			$email = wp_mail($to_reta, $subject, $message, $header);


	       //text msg to retailer by phone number  retailer_phone

			$account_sid = get_option('twilio_account_sid'); 
			$auth_token  = get_option('twilio_auth_token');       
			require('lib/twilio-php-latest/Services/Twilio.php');        
			$client = new Services_Twilio($account_sid, $auth_token);
	              //$from = '+18566198165';           
	              //$from = '+12182068385 ';            
			$from        = get_option('twilio_phone_no');                
			$client->account->messages->sendMessage( $from, $retailer_phone, "Hi ".$retailer_user_names." A fundraiser have requested to you for hosting their event. Plesae check this requested event in your event listings to approve or disapprove the event. Plesae login to your account to check this event. ".site_url()."");


		// write the email content for fundraiser

			@$header2 .= "MIME-Version: 1.0\n";
			$header2 .= "Content-Type: text/html; charset=utf-8\n";
			@$headers2 .= "From:" . $admin_email;

			$message1 .= "<html><body style=' padding:3px; background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
			<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$name) . 
			"</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
			$message1 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">Your event request have been sent to retailer for approval.','piereg</div>') . "</br</div>";

			$message1 .='</div><div style=color: #999;padding: 50px 30px">
			<div style="">Regards,</div>
			<div style="">Raise It Team</div>            
			</div></body></html>';

			$subject2 = "Raise It Notification";
			$subject2 = "=?utf-8?B?" . base64_encode($subject2) . "?=";

			$to_fund = $fundra_email;

	    // send the email to fundraiser
			$email1 = wp_mail($to_fund, $subject2, $message1, $header2);	


	         //text msg to retailer by phone number  fundraiser_phone           
			$client->account->messages->sendMessage( $from, $fundraiser_phone, "Hi ".$name." Your event request have been sent to retailer for approval. Plesae login to your account to check this event.".site_url()."");


		}

	}

	  //update_post_meta( $post_id, 'fund_name', $user_info->group );
	update_post_meta( $f_post_id, 'fund_title', $f_fund_name );
	update_post_meta( $f_post_id, 'fund_city', $fund_city );
	update_post_meta( $f_post_id, 'fund_zip', $findzip );   
	update_post_meta( $f_post_id, 'select_date', $f_dated );
	update_post_meta( $f_post_id, 'start_time', $f_fund_s_time );
	update_post_meta( $f_post_id, 'event_expire_date', $f_e_dated );
	update_post_meta( $f_post_id, 'end_time', $f_fund_e_time );
	update_post_meta( $f_post_id, 'amount', $event_amt); 
	update_post_meta( $f_post_id, 'amount', $event_amt); 
	update_post_meta( $f_post_id, 'show_post', $show_post);
	if($tax_deductible != '')
	{
		update_post_meta($f_post_id, 'tax_deductible', $tax_deductible); 
	}

	$image_parts = explode(";base64,", $fund_image);

	$image_base64 = base64_decode($image_parts[1]);

	$directory = "/".date(Y)."/".date(m)."/";

	$wp_upload_dir = wp_upload_dir( null, false );

	$upload =  $wp_upload_dir['basedir'];

	//print_r($wp_upload_dir);


	$filename = "IMG_".time().".png";

	//$fileurl = $upload.'/'.$filename;

	$fileurl = $upload.$directory.$filename;

	$filetype = wp_check_filetype( basename( $fileurl), null );
	//print_r($filetype);

	file_put_contents($fileurl, $image_base64);

	$attachment = array(
		'guid' => $wp_upload_dir['url'] . '/' . basename( $fileurl ),
		'post_mime_type' => $filetype['type'],
		'post_title' => preg_replace('/\.[^.]+$/', '', basename($fileurl)),
		'post_content' => '',
		'post_status' => 'inherit'
	);

	//print_r($attachment);

	//echo "<br>file name :  $fileurl";

	$attach_id = wp_insert_attachment( $attachment, $fileurl ,$f_post_id);

	require_once ABSPATH . 'wp-admin/includes/image.php';

	$attach_data = wp_generate_attachment_metadata( $attach_id, $fileurl );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	set_post_thumbnail( $f_post_id, $attach_id );

	//update_post_meta($f_post_id,'feature_image_1', $attach_id );
	//update_post_meta($f_post_id,'_feature_image_1','field_59dc69cde495f' );

	//logo upload

	if($fund_logo != '' )
	{
		$image_parts2 = explode(";base64,", $fund_logo);

		$image_base642 = base64_decode($image_parts2[1]);

		$directory2 = "/".date(Y)."/".date(m)."/";

		$wp_upload_dir2 = wp_upload_dir( null, false );

		$upload2 =  $wp_upload_dir2['basedir'];

	//print_r($wp_upload_dir);


		$filename2 = "IMG_".time().".png";

	//$fileurl = $upload.'/'.$filename;

		$fileurl2 = $upload2.$directory2.$filename2;

		$filetype2 = wp_check_filetype( basename( $fileurl2), null );
	//print_r($filetype);

		file_put_contents($fileurl2, $image_base642);

		$attachment2 = array(
			'guid' => $wp_upload_dir2['url'] . '/' . basename( $fileurl2 ),
			'post_mime_type' => $filetype2['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($fileurl2)),
			'post_content' => '',
			'post_status' => 'inherit'
		);

	//print_r($attachment);

	//echo "<br>file name :  $fileurl";

		$attach_id2 = wp_insert_attachment( $attachment2, $fileurl2 ,$f_post_id);

		require_once ABSPATH . 'wp-admin/includes/image.php';

		$attach_data2 = wp_generate_attachment_metadata( $attach_id2, $fileurl2 );
		wp_update_attachment_metadata( $attach_id2, $attach_data2 );

		update_post_meta($f_post_id,'fundraiser_logo', $attach_id2);
		update_post_meta($f_post_id,'_fundraiser_logo', 'field_59dc69cde495f');

	}



	if($_POST['wepay_f_name'] != '')
	{	    
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
		}

		if($_POST['new_wepay_f_name'] != '')
		{	    

			require 'wepay.php';
			$client_id         = get_option('wepay_client_id');
			$client_secret     = get_option('wepay_client_secret');
			$access_token_live = get_option('wepay_access_token');
	// change to useStaging for live environments
			if(site_url() == "https://dev.raiseitfast.com")
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
					'email'            => $_POST['new_wepay_email'],
					'scope'            => 'manage_accounts,collect_payments,view_user,preapprove_payments,send_money',
					'first_name'       => $_POST['new_wepay_f_name'],
					'last_name'        => $_POST['new_wepay_l_name'],
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
						'name'         => $_POST['new_wepay_f_name'].' '.$_POST['new_wepay_l_name'],
						'description'  => $_POST['new_wepay_f_name'].' '.$_POST['new_wepay_l_name'].' description'
					));
					$account_id = $response2->account_id;
					update_post_meta($f_post_id,'account_id', $account_id );
					update_post_meta($f_post_id,'access_token',$access_token);
					update_post_meta($f_post_id,'client_id',$client_id);
					update_post_meta($f_post_id,'client_secret',$client_secret);
				}
			}

	    // successfully notification start ==================================
			$headerfund = "MIME-Version: 1.0\n";
			$headerfund .= "Content-Type: text/html; charset=utf-8\n";
			$headersfund .= "From:" . $admin_email;

			$messagefund =  "<html><body style=' padding:3px; background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'>
			<div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'>
			<div style='color: #444444;font-weight: normal;'>
			<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> Raise It</div>
			<div style='clear:both'></div>
			<div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>
			Hi ,".$name." 
			</div>
			</div>
			<div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>
			<div style='padding: 0px 0;font-size: 18px;line-height: 40px;'>
			<p>You've successfully created a Fundraising event page.</p>
			</div>
			<div style='padding: 0px 0;font-size: 18px;line-height: 10px;'>
			<p>Please click this below link to the retailer event</p>
			</div>
			<div style='padding: 30px 0;font-size: 18px;line-height: 10px;'>
			<a style='background: #555555;color: #fff;padding: 12px 30px;text-decoration: none;border-radius: 3px;letter-spacing: 0.3px;' href='".site_url()."/fundraiser/?p=".$f_post_id."'>".$f_fund_name."</a> 
			</div>
			</div>
			<div style='color: #999;padding: 20px 20px'>
			<div>Regards,</div>
			<div>Raise It Team</div> 
			</div>

			</div>

			</body>
			</html>";

			$subjectfund = "Raise It Notification";
			$subjectfund = "=?utf-8?B?" . base64_encode($subjectfund) . "?=";      
			$tofund = $fundra_email;

				// send the email to reatiler
			$emailbusi = wp_mail($tofund, $subjectfund, $messagefund, $headerfund);

	            // successfully notification end ==================================

	             // successfully notification mail For admin start ==================================
			$headerfundadmin = "MIME-Version: 1.0\n";
			$headerfundadmin .= "Content-Type: text/html; charset=utf-8\n";
			$headersfundadmin .= "From:" . $admin_email;

			$messagefundadmin =  "<html><body style=' padding:3px; background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'>
			<div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'>
			<div style='color: #444444;font-weight: normal;'>
			<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> Raise It</div>
			<div style='clear:both'></div>
			<div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>
			Hi Admin, 
			</div>
			</div>
			<div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>
			<div style='padding: 0px 0;font-size: 18px;line-height: 40px;'>
			<p> A new fundraising event page is created by <b> ".$name." </b> .</p>
			</div>
			<div style='padding: 0px 0;font-size: 18px;line-height: 10px;'>
			<p>Please click this below link to the retailer event</p>
			</div>
			<div style='padding: 30px 0;font-size: 18px;line-height: 10px;'>
			<a style='background: #555555;color: #fff;padding: 12px 30px;text-decoration: none;border-radius: 3px;letter-spacing: 0.3px;' href='".site_url()."/fundraiser/?p=".$f_post_id."'>".$f_fund_name."</a> 
			</div>
			</div>
			<div style='color: #999;padding: 20px 20px'>
			<div>Regards,</div>
			<div>Raise It Team</div> 
			</div>

			</div>

			</body>
			</html>";

			$subjectfundadmin = "Raise It Notification";
			$subjectfund = "=?utf-8?B?" . base64_encode($subjectfundadmin) . "?=";      
			/*$tofundadmin = $fundra_email;*/
			$tofundadmin = get_option('rec_email_notification');

				// send the email to reatiler
			$emailbusi = wp_mail($tofundadmin, $subjectfundadmin, $messagefundadmin, $headerfundadmin);

	            // successfully notification end ==================================



	//header("location:".site_url()."/?post_type=fundraiser&p=".$f_post_id."&preview=true");
			header("location:".site_url()."/fundraiser/?p=".$f_post_id." ");
		}

		?>

		<div class="container-fluid donate_background">
			<div class="container">
				<div class="row">
					<div class="donate_border2">
						<div class="col-md-12 col-sm-12 create-fundraiser-event-page">

							<div id="addevent_dvLoading" style="display:none"></div>

							<form id="create_fundraiser_event_page" method="post" action="#" enctype="multipart/form-data">
								<?php 

								$user = wp_get_current_user();

								$first_name = $user->first_name;
								$last_name  = $user->last_name;
								$user_email = $user->user_email;

								$client_id = get_user_meta( get_current_user_id(), 'client_id', true );

								if($client_id == "")
								{
									?>
									<!-- progressbar -->
									<ul id="progressbar">
										<li class="active status_bar">Page Setup</li>
										<li class="status_bar">Personal Details</li>
										<li class="status_bar">Search Retalier</li>
										<li class="status_bar">Submit</li>
									</ul>
									<?php } else { ?>
									<ul id="progressbar" class="three_bar">
										<li class="active">Page Setup</li>
										<li>Personal Details</li>
										<li>Submit</li>
									</ul>	
									<?php } ?>	 
									<ul id="progressbar" class="four_bar" style="display: none">
										<li class="active active status_bars">Page Setup</li>
										<li class="active status_bars">Personal Details</li>
										<li class="active status_bars">Search Retalier</li>
										<li class="status_bars">Submit</li>
									</ul>

									<!-- fieldsets -->
									<fieldset>
										<h2 class="fs-title">Create Fundraising Event Page</h2>

										<div class="alert alert-warning fs-error" style="display:none;"></div>

										<input type="hidden" name="u_type" value="fundraiser">

										<div class="form-group">
											<label>Event Name</label>
											<input type="text" class="form-control" required="" name="fund_name" placeholder="Event Name" id="fund_name" />
										</div>
										<div class="form-group">
											<label>Tell us About Your Fundraiser</label>
											<textarea type="textarea" class="form-control" name="description" rows="3" placeholder="Your Fundraiser Event Description" id="fund_description"></textarea>
										</div>

										<div class="col-sm-6 fund_citys">
											<div class="form-group">
												<label>City</label>
												<input type="text" class="form-control" name="fund_city" rows="3" placeholder="City" id="fund_city">
											</div>
										</div>
										<div class="col-sm-6 fund_city">

											<div class="form-group">
												<label>Zipcode</label>
												<input  type="text" class="form-control" name="findzip" rows="3" placeholder="Zipcode" id="findzip">
											</div>
										</div>

										<div class="col-md-6 col-sm-6 add_fund_img">
											<div class="form-group add_funds_img">
												<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_fundraiser_image">Add Fundraiser Image</button>

											</div>

											<h4 id="add_preview_image" style="display: none;">Preview Image</h4>
											<img id="add_event_fund_image" class="img-responsive">
											<input type="hidden" name="fund_image" id="fund_image_new" value="">

											<div id="add_fundraiser_image" class="modal fade" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close refresh" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Change Event Image</h4>
														</div>
														<div class="modal-body">

															<div class="col-sm-12 col-md-12 f_image2">
																<div class="form-group">
																	<!-- <label>Business Image 1</label> -->
																	<span><i class="fa fa-picture-o" id="fund_img_icon" aria-hidden="true"></i></span><label for="f_fund_images" class="file-upload__label">Upload Fundraiser Image</label>
																	<input style="display: none;" id="f_fund_images" name="feature_image_1" accept="image/*" type="file">
																</div>
															</div>  
															<p id="btn-example-file-reset" style="display: none;"><i class="fa fa-times" aria-hidden="true"></i></p>

															<section class="copy">
																<div class="figure-wrapper">
																	<figure class="image-container target" id="add_target">
																		<img id="target_fund_img_new" class="img-responsive">
																	</figure>
																	<img id="new_target_fund_img" class="img-responsive">
																</div>
															</section>

															<!-- <input type="hidden" name="edit_image_event" id="edit_image_event" value="">  -->   
														</div>
													</div>

												</div>
											</div>
										</div>

										<div class="col-md-6 col-sm-6 add_fund_logo">

											<div class="form-group add_funds_img">
												<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_fundraiser_logo">Add Fundraiser logo</button>

											</div>

											<h4 id="add_preview_logo" style="display: none;">Preview Image</h4>
											<img id="add_event_fund_logo" class="img-responsive">
											<input type="hidden" name="fund_logo" id="fund_logo_new" value="">

											<div id="add_fundraiser_logo" class="modal fade" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close refresh" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Change Event Logo</h4>
														</div>
														<div class="modal-body">

															<div class="col-sm-12 col-md-12 f_image_logo">
																<div class="form-group">
																	<!-- <label>Business Image 1</label> -->
																	<span><i class="fa fa-picture-o" id="fund_logo_icon" aria-hidden="true"></i></span><label for="f_fund_logo" class="file-upload__label">Upload Fundraiser Logo</label>
																	<input style="display: none;" id="f_fund_logo" name="feature_logo" accept="image/*" type="file">
																</div>
															</div>  
															<p id="btn-example-file-logo" style="display: none;"><i class="fa fa-times" aria-hidden="true"></i></p>

															<section class="copy">
																<div class="figure-wrapper">
																	<figure class="image-container target" id="add_target_logo">
																		<img id="target_fund_logo_new" class="img-responsive">
																	</figure>
																	<img id="new_target_fund_logo" class="img-responsive">
																</div>
															</section>

															<!-- <input type="hidden" name="edit_image_event" id="edit_image_event" value="">  -->   
														</div>
													</div>

												</div>
											</div>
										</div>
										<div class="col-md-12 col-sm-12 photo_text">

											<h5 style="font-size: 13px;">(Your photo may be distorted on your fundraiser page if your image size is too small.)</h5>	
										</div>

										<div class="form-group deduct">
											<label>501 (c) (3)?</label>
											<input type="checkbox" name="tax_deductible" value="tax_deductible">
										</div>


										<input type="button" name="next" class="next action-button" value="Next" id="find_next1" />


									</fieldset>

									<fieldset>
										<h2 class="fs-title">Personal Details</h2>
										<div class="alert alert-warning fs-error" style="display:none;"></div>
										<h3 class="fs-subtitle"></h3>

										<div class="form-group">
											<label>Your Event Category</label>

											<dl id="sample_new" class="dropdown">
												<dt><a href=""  id="c_select_new"><span>Please select Your Event Category</span><i class="fa fa-caret-down" aria-hidden="true"></i>
												</a></dt>
												<dd>
													<ul>
														<?php 


														$terms = get_terms( array(
															'taxonomy' => 'fund_cate',
															'hide_empty' => false
														) );
														foreach($terms as $termName)
														{
															$cat_id= $termName->term_id;

															$data_dropdown= "SELECT * FROM 'wp_terms' WHERE term_id=$cat_id";

															foreach ($data_dropdown as $key => $drop) {

																$cat_slug= $drop->slug;
															}
															?>



															<li><a href="" class="prevent-link" id="c_select"><?php echo do_shortcode(sprintf('[wp_custom_image_category term_id="%s"]',$termName->term_id)); ?><?php echo $termName->name ;?>
																<span class="value"><?php echo $termName->term_id ;?></span>

															</a></li>
															<?php } ?>

														</ul>

													</dd>
												</dl>
												<input type="hidden" id="result_new" name="f_cat_chk" value="">

											</div>

											<div class="form-group">
												<label>Please Select Date And Time to Start Your Event</label>
												<ul class="list-unstyled list-inline s_datetime">
													<li>
														<input type="text" name="f_event_date" class="form-control" id="f_event_date_new" placeholder="Select Event Start Date"><i class="fa fa-calendar cal" aria-hidden="true"></i>
													</li>
													<li>
														<input type="text" id='f_fund_s_time_new' placeholder="Event Start Time" class="timepicker form-control" name="f_fund_s_time" value="8:00am" />
														<i class="fa fa-clock-o cal" aria-hidden="true"></i>
													</li>
												</ul>
											</div>
											<div class="form-group">
												<label>Please Select Date And Time to Expire Your Event</label>
												<ul class="list-unstyled list-inline e_datetime">
													<li>
														<input type="text" name="f_event_e__date" class="form-control" id="f_event_e__date_new" placeholder="Select Event Expire Date"><i class="fa fa-calendar cal" aria-hidden="true"></i>
													</li>
													<li>
														<input type="text" id='f_fund_e_time_new' placeholder="Event Expire Time" class="timepicker form-control" name="f_fund_e_time" value="12:00pm" />
														<i class="fa fa-clock-o cal" aria-hidden="true"></i>
													</li>
												</ul>
											</div>

											<div class="form-group" id="amt_fund">
												<label>Amount of Money You Would Like to Raise</label>
												<input id="f_fund_amte_new" name="f_fund_amt" type="text" maxlength="6" class="form-control active" placeholder="" value="" onkeypress="return isNumber(event)"/>
											</div>   											


											<input type="button" name="previous" class="previous action-button" value="Previous" id="find_pre1" />
											<input type="button" name="next" class="next2 action-button" value="Next" id="find_next2" />
										</fieldset>

										<fieldset>

											<div class="form-group">
												<?php if($client_id == "")
												{
													?>
													<h2 class="fs-title">Serach Retailer</h2>
													<div class="alert alert-warning fs-error" style="display:none;"></div>
													<h3 class="fs-subtitle"></h3>	

													<?php } else { ?>

													<div id="loder_new">
														<div class="dvloding" id="dvLoading_new" style="display:none;margin:auto;"></div>
													</div>
													<?php } ?>

													<div id="searched_new">




														<label>Search retailers to host your event by zipcode or city</label>
														<!-- <p>Please input upto 5 numbers or characters for search.</p> -->
														<p>Please input a City or a 5 digit zip code</p>
														<input id="search_inputs_new" name="zip_codes" class="form-control input-lg" placeholder="Please enter valid zip code or city only" >

													</div>
												</div>
												<div id="show_result_new">
												</div> 

												<div class="form-group exist_wepay">

													<?php if($client_id != "")
													{
														?>
														<label>You only need to check this box if you your existing wepay account is not to be used for this event <span class="chkbox_fund_event"><input type="checkbox" name="check_acc" id="check_acc"></span></label>
														
														<?php } ?>

													</div>


													<input class="form-control" name="ret_e_id_news" value="" type="hidden" id="ret_e_id_news">
													<input class="form-control" name="ret_e_title_news" value="" type="hidden" id="ret_e_title_news">
													<input class="form-control" name="ret_e_authe_name_news" value="" type="hidden" id="ret_e_authe_name_news">
													<input class="form-control" name="ret_e_auther_id_news" value="" type="hidden" id="ret_e_auther_id_news">

													<input type="button" name="previous" class="previous action-button" value="Previous" id="find_pre2" />
													<?php if($client_id == "")
													{
														?>
														<input type="button" name="next" class="next3 action-button" value="Next" id="find_next2" />
														<?php } else { 

															if((in_array("administrator", $user_roless)) || (in_array("editor", $user_roless)))
															{
																?>

																<div class="form-group">
																	<input type="checkbox" name="show_post" value="true">Please check this if you want to show this event to admin staff only.<br>
																</div>
																<?php } ?>
																<input type="button" name="next" class="next3 action-button" value="Next" id="find_next2" style="display: none;" />
																<input type="submit" name="submit_fun" class="submit action-button sub_check" value="Submit" id="find_sub1" />
																<?php } ?>
															</fieldset>

															<?php 
															if(!in_array("administrator", $user_roless))
															{
																if($client_id == "")
																{
																	?>
								<fieldset  class="fieldset_4">

									<h2 class="fs-title">Create Wepay Account</h2>

									<div id="loder_new">
										<div class="dvloding" id="dvLoading_new" style="display:none;margin:auto;"></div>
									</div>
									<p>(For receiving donation from your donars you will have to create your account.)</p>
									<div class="form-group">
										<label>First Name</label>
										<input id="wepay_f_name" name="wepay_f_name" type="text" class="form-control active" placeholder="" value="<?php echo $first_name; ?>"/>
									</div>  
									<div class="form-group">
										<label>Last Name</label>
										<input id="wepay_l_name" name="wepay_l_name" type="text" class="form-control active" placeholder="" value="<?php echo $last_name; ?>" />
									</div>

									<div class="form-group">
										<label>Email</label>
										<input id="wepay_email" name="wepay_email" type="text" class="form-control active" placeholder="" value="<?php echo $user_email; ?>" />
									</div>
									<?php

									if(in_array("editor", $user_roless))
									{
										?>
										<div class="form-group">
											<input type="checkbox" name="show_post" value="true">Please check this if you want to show this event to admin staff only.<br>
										</div>
										<?php } ?>

							

										<input type="button" name="previous" class="previous action-button" value="Previous" id="find_pre3" />
										<input type="submit" name="submit_fun" class="submit action-button" value="Submit" id="find_sub1" />
									</fieldset>
									<?php } } ?>

																		<fieldset  class="fieldset_4" style="display: none">

																			<h2 class="fs-title">Create Wepay Account</h2>

																			<div id="loder_new">
																				<div class="dvloding" id="dvLoading_new" style="display:none;margin:auto;"></div>
																			</div>
																			<p>(For receiving donation from your donars you will have to create your account.)</p>
																			<div class="form-group">
																				<label>First Name</label>
																				<input id="new_wepay_f_name" name="new_wepay_f_name" type="text" class="form-control active" placeholder="" value=""/>
																			</div>  
																			<div class="form-group">
																				<label>Last Name</label>
																				<input id="new_wepay_l_name" name="new_wepay_l_name" type="text" class="form-control active" placeholder="" value="" />
								</div>

								<div class="form-group">
									<label>Email</label>
									<input id="new_wepay_email" name="new_wepay_email" type="text" class="form-control active" placeholder="" value="" />
								</div>
								<?php

								if(in_array("editor", $user_roless))
								{
									?>
									<div class="form-group">
										<input type="checkbox" name="show_post" value="true">Please check this if you want to show this event to admin staff only.<br>
									</div>
									<?php } ?>

									<div class="evnt_lst_btn">

									<input type="button" name="previous" class="previous action-button" value="Previous" id="find_pre3" />
									<input type="submit" name="submit_fun" class="submit action-button" value="Submit" id="find_sub1" />
								</div>
								</fieldset>





																		</form>

																	</div>		
																</div>
															</div>
														</div>
													</div>

													<script>

														var uploadField = document.getElementById("f_fund_images");
														uploadField.onchange = function() {
															if(this.files[0].size > 5242880){
																alert("Event image is too Big , please upload image with size upto 5MB");
																this.value = "";
															};
														};
													</script>  

													<script type="text/javascript">
														$('#create_fundraiser_event_page').submit(function() {
															setTimeout(function() 
															{
																$("#addevent_dvLoading").show();

															}, 3000);
														});
													</script>

													<script>

														jQuery(document).ready(function(){

															$('#f_event_date_new').datepicker({
																Format: 'mm-dd-yyyy',
																autoclose:true,
																orientation: 'auto',
																startDate: new Date(),
															}).on('changeDate',function(e){
																$('#f_event_e__date_new').datepicker('setStartDate',e.date)
															});

															$('#f_event_e__date_new').datepicker({
																Format: 'mm-dd-yyyy',
																autoclose:true,
																orientation: 'auto',
															}).on('changeDate',function(e){
																$('#f_event_date_new').datepicker('setEndDate',e.date)
															});



															$(document).on('keyup', '#f_fund_amte_new', function() {
																var x = $(this).val();
																$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
															});


															var minlength = 5;  

	//$('#searchsubmit').click(function(e){

	$('#search_inputs_new').keyup(function () 
	{  

		var zip_code = $('#search_inputs_new').val();

		if (zip_code.length >= minlength ) 
		{

			var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";

			jQuery.ajax({
				url :ajaxUrl ,
				type : 'post',
				data : {
					action : 'zip_serach',
					zip_codes : zip_code	
				},

				beforeSend: function() 
				{
					jQuery('#dvLoading_new').show();    
				},

				success : function(posts) 
				{
					$("#show_result_new").html(posts);
					$(".fieldset_4").addClass("fieldset_44");
					jQuery('#dvLoading_new').hide();

					$(".chk_radio").click(function(){          
						if($(this).is(':checked') && $(this).val() !== '') 
						{

							var ret_e_id           = $(this).val();
							var ret_e_title        = $(this).attr("data-title");
							var ret_e_auther_id    = $(this).attr("data-ret-auth-id");
							var ret_e_authe_name   = $(this).attr("data-ret-name");

							$('#ret_e_id_news').val(ret_e_id);
							$('#ret_e_title_news').val(ret_e_title);
							$('#ret_e_authe_name_news').val(ret_e_authe_name);
							$('#ret_e_auther_id_news').val(ret_e_auther_id);

						}
					});
				}
			});
		}
	});

	jQuery('#f_fund_images').on('change', function(){ //on file input change
	if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
	{
	    jQuery('#thumb-output_fund').html(''); //clear html of output element
	    var data = jQuery(this)[0].files; //this file data

	    $.each(data, function(index, file){ //loop though each file
	        if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
	            var fRead = new FileReader(); //new filereader
	            fRead.onload = (function(file){ //trigger function on successful read
	            	return function(e) {
	                var img = $('<img/>').addClass('thumb-load_fund img-responsive').attr('src', e.target.result); //create image element
	                $('#thumb-output_fund').append(img);
	                $(".thumb-load_fund").attr('id', 'img_id');
	                 //append image to output element
	             };
	         })(file);
	            fRead.readAsDataURL(file); //URL representing the file's data.
	        }
	    });

	}else{
	    alert("Your browser doesn't support File API!"); //if File API is absent
	}
	});
	});


	</script>
	<script>

	jQuery(document).ready(function(){
	//jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches


	$(".next").click(function(e){

	// alert("Width of image: " + $("#img_id").width());
	// alert("Height of image: " + $("#img_id").height());
	var fund_name = $("#fund_name").val();
	var fund_description = $("#fund_description").val();
	var fund_city = $("#fund_city").val();
	var findzip = $("#findzip").val();
	var f_fund_images = $("#f_fund_images").val();


	if(fund_name == '')
	{		
		document.getElementById("fund_name").style.borderColor = "#E34234"; 
		jQuery('.fs-error').html('<span style="color:red;"> Event name is required !</span>');
		jQuery('.fs-error').show();  
		return false; 

	}
	else
	{ 
		document.getElementById("fund_name").style.borderColor = "#006600";  
	} 


	if(fund_description == ''){

		document.getElementById("fund_description").style.borderColor = "#E34234"; 
		jQuery('.fs-error').html('<span style="color:red;"> Event description is required !</span>');
		jQuery('.fs-error').show();  
		return false;

	}
	else
	{ 
		document.getElementById("fund_description").style.borderColor = "#006600";  
	} 

	if(fund_city == ''){

		document.getElementById("fund_city").style.borderColor = "#E34234"; 
		jQuery('.fs-error').html('<span style="color:red;"> City is required !</span>');
		jQuery('.fs-error').show();  
		return false;

	}
	else
	{ 
		document.getElementById("fund_city").style.borderColor = "#006600";  
	} 

	if(findzip == ''){

		document.getElementById("findzip").style.borderColor = "#E34234"; 
		jQuery('.fs-error').html('<span style="color:red;"> Zipcode is required !</span>');
		jQuery('.fs-error').show();  
		return false;

	}
	else
	{ 
		document.getElementById("findzip").style.borderColor = "#006600";  
	} 

	if(f_fund_images == ''){

		document.getElementById("fund_img_icon").style.color = "#E34234"; 
		jQuery('.fs-error').html('<span style="color:red;"> Event image is required !</span>');
		jQuery('.fs-error').show();


		return false;	
	}

	else
	{

		document.getElementById("fund_img_icon").style.color = "#006600";
		$('.fs-error').hide();
	}

	/*	var myImg = document.querySelector("#img_id");
	var realWidth = myImg.naturalWidth;
	var realHeight = myImg.naturalHeight;

	if(realWidth < 630 || realHeight < 490)
	{
	alert("Event image is too small , please upload image with size more than 650px(width) x 430px(Height) and size upto 5MB");
	return false;
	}*/
	/*    else
	{
	*/if(animating) return false;
	animating = true;

	current_fs = $(this).parent();
	next_fs = $(this).parent().next();

	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	/*    }*/


	});


	$(".next2").click(function(){

	var result          = $("#result_new").val();
	var f_event_date    = $("#f_event_date_new").val();
	var f_fund_s_time   = $("#f_fund_s_time_new").val();
	var f_event_e__date = $("#f_event_e__date_new").val();
	var f_fund_e_time   = $("#f_fund_e_time_new").val();
	var f_fund_amte     = $("#f_fund_amte_new").val();

	if(result == '')
	{		
	document.getElementById("c_select_new").style.borderColor = "#E34234"; 
	jQuery('.fs-error').html('<span style="color:red;"> Event category is required  !</span>');
	jQuery('.fs-error').show();  
	return false; 

	}
	else
	{ 
	document.getElementById("c_select_new").style.borderColor = "#006600";  
	} 


	if(f_event_date == ''){

	document.getElementById("f_event_date_new").style.borderColor = "#E34234"; 
	jQuery('.fs-error').html('<span style="color:red;"> Event start date is required !</span>');
	jQuery('.fs-error').show();  
	return false;

	}
	else
	{ 
	document.getElementById("f_event_date_new").style.borderColor = "#006600";  
	} 

	if(f_fund_s_time == '')
	{		
	document.getElementById("f_fund_s_time_new").style.borderColor = "#E34234"; 
	jQuery('.fs-error').html('<span style="color:red;"> Event start time is required !</span>');
	jQuery('.fs-error').show();  
	return false; 

	}
	else
	{ 
	document.getElementById("f_fund_s_time_new").style.borderColor = "#006600";  
	} 


	if(f_event_e__date == '')
	{		
	document.getElementById("f_event_e__date_new").style.borderColor = "#E34234"; 
	jQuery('.fs-error').html('<span style="color:red;"> Event expire date is required !</span>');
	jQuery('.fs-error').show();  
	return false; 

	}
	else
	{ 
	document.getElementById("f_event_e__date_new").style.borderColor = "#006600";  
	} 

	if(f_fund_e_time == '')
	{		
	document.getElementById("f_fund_e_time_new").style.borderColor = "#E34234"; 
	jQuery('.fs-error').html('<span style="color:red;"> Event end time is required !</span>');
	jQuery('.fs-error').show();  
	return false; 

	}
	else
	{ 
	document.getElementById("f_fund_e_time_new").style.borderColor = "#006600";  
	} 


	if(f_fund_amte == ''){

	document.getElementById("f_fund_amte_new").style.borderColor = "#E34234"; 
	jQuery('.fs-error').html('<span style="color:red;"> Fundraising goal is required !</span>');
	jQuery('.fs-error').show();  
	return false;

	}
	else
	{
	document.getElementById("f_fund_amte_new").style.borderColor = "#006600";
	$('.fs-error').hide();


	if(animating) return false;
	animating = true;

	current_fs = $(this).parent();
	next_fs = $(this).parent().next();

	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	}



	});

	$(".next3").click(function(){
	if(animating) return false;
	animating = true;

	current_fs = $(this).parent();
	next_fs = $(this).parent().next();

	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	});

	$(".previous").click(function(){
	if(animating) return false;
	animating = true;

	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();

	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
	step: function(now, mx) {
		//as the opacity of current_fs reduces to 0 - stored in "now"
		//1. scale previous_fs from 80% to 100%
		scale = 0.8 + (1 - now) * 0.2;
		//2. take current_fs to the right(50%) - from 0%
		left = ((1-now) * 50)+"%";
		//3. increase opacity of previous_fs to 1 as it moves in
		opacity = 1 - now;
		current_fs.css({'left': left});
		previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
	}, 
	duration: 800, 
	complete: function(){
		current_fs.hide();
		animating = false;
	}, 
	//this comes from the custom easing plugin
	easing: 'easeInOutBack'
	});
	});

	});
	</script>


	<script>




	$(".dropdown img.flag").addClass("flagvisibility");

	$(".dropdown dt a").click(function(e) {

	e.preventDefault();
	$(".dropdown dd ul").show();
	});

	$(".dropdown dd ul li a").click(function(e) {

	e.preventDefault();
	var text = $(this).html();
	$(".dropdown dt a span").html(text);
	$(".dropdown dd ul").hide();
	$("#result_new").html("" + getSelectedValue("sample_new"));
	document.getElementById('result_new').value = getSelectedValue("sample_new");
	});

	function getSelectedValue(id) {
	return $("#" + id).find("dt a span.value").html();
	}

	$(document).bind('click', function(e) {
			//e.preventDefault();
			var $clicked = $(e.target);
			if (! $clicked.parents().hasClass("dropdown"))
				$(".dropdown dd ul").hide();
		});
	$(".dropdown img.flag").toggleClass("flagvisibility");
	</script>

	<style>
	#create_fundraiser_event_page #progressbar .status_bar {
	list-style-type: none;
	color: #3b5262;
	text-transform: uppercase;
	font-size: 9px;
	width: 25%;
	float: left;
	position: relative;
	}

	#create_fundraiser_event_page #progressbar .status_bars {
	list-style-type: none;
	color: #3b5262;
	text-transform: uppercase;
	font-size: 9px;
	width: 25%;
	float: left;
	position: relative;
	}

	.image-container.target > img {
	display: none;
	}

	#addevent_dvLoading {
	background: #e1e1e1 url("<?php echo home_url();?>/wp-content/themes/twentyfifteen/images/image-loader.gif") no-repeat scroll center center;
	height: 34px;
	margin-top: 10px !important;
	z-index: 1000;
	width: 50%;
	margin-left: 23%;
	} 
	</style>


	<script>



	$( document ).ready(function() {
	var radios = document.getElementsByName("check_acc");
	if (!$("input[name='check_acc']:checked").val()) {
		$(".fieldset_4").hide();
	}else{
		$(".four_bar").show();
		$(".three_bar").hide();
		$(".next3").show();
		$(".sub_check").hide();
		/*$(".fieldset_4").show();*/
	}
	});

	function validate() {
	if (document.getElementById('check_acc').checked) {
		$(".four_bar").show();
		$(".three_bar").hide();
		$(".next3").show();
		$(".sub_check").hide();
		/*$(".fieldset_4").show();*/
	} else {

		/*$(".fieldset_4").hide();*/
		$(".next3").hide();
		$("#find_sub1").show();
		$(".four_bar").hide();
		$(".three_bar").show();

	}
	}

	document.getElementById('check_acc').addEventListener('change', validate);


	</script>


	<?php  get_footer();?>

	<?php 
	} 

	else
	{
	header("location:".site_url()." ");
	}
	?>