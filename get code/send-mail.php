

<?php

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
?>
<?php

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
?>
<?php

  $user = get_user_by( 'id',$_POST['author_of_post'] );
  $name= $user->first_name . ' ' . $user->last_name;
  $email= $user->user_email;
  $headers  = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
  $headers .= "From: Kevin Bendict <".get_option('admin_email').">" . "\r\n";
  $message="Hello ".$name.",<br> <br>A new applicant has request you for your task description<br> <br>Please check it in your profile page.<br><br> Thanks";

      wp_mail($email, 'New Request On your Job', $message, $headers); 

    
?>