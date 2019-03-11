<?php

// WePay PHP SDK - http://git.io/mY7iQQ
require 'wepay.php';

//wepay fundraiser account access detail
$client_id2 = $_POST['post_client_id'];
$client_secret2 = $_POST['post_client_secret'];
$access_token2 = $_POST['post_access_token'];
$account_id2 = $_POST['post_account_id'];


//*** for live site ***
/*$client_id = "75541";
$client_secret = "e31ab6ea4a";
$access_token = "STAGE_5ad7346559d4eb22eda797d7c466cdbb64cb44504c37649e1f042f8d470ea872";
$account_id    = "484430754";*/

//*** for dev site ***
$client_id     = get_option('wepay_client_id');
$client_secret = get_option('wepay_client_secret');
$access_token  = get_option('wepay_access_token');
$account_id    = get_option('wepay_account_id');


// change to useProduction for live environments
Wepay::useStaging($client_id, $client_secret);

$wepay = new WePay(NULL); // Don't pass an access_token for this call

// create the pre-approval
$response = $wepay->request('credit_card/create', array(
	'client_id'         => $client_id,
	"user_name" => $_POST['donor_name'].' '.$_POST['donor_lname'],
	"email" => $_POST['donor_email'],
	"cc_number" => $_POST['cc_number'],
	"cvv" => $_POST['cc_cvv'],
	"expiration_month" => $_POST['cc_month'],
	"expiration_year" => $_POST['cc_year'],
	"address" => array("country" => $_POST['country'],
		"postal_code" => $_POST['postal_code'])));

$response_ex = explode(',' ,$response);
if($response_ex[0] =="505")
{
	print_r($response_ex[1]);
	exit;
}
// credit card id to charge
$credit_card_id = $response->credit_card_id;

// change to useProduction for live environments
$wepay1 = new WePay($access_token);

// charge the credit card
$response1 = $wepay1->request('checkout/create', array(
	'account_id'		=> $account_id,
	'amount'		=> $raiseit_budget,
	'currency'      =>  'USD',
	'short_description'	=> 'raiseit accept donation',
	'type'            => 'goods',
	'fee' => array (
  'app_fee' => 0,
  'fee_payer' => 'payee'
),
	'payment_method'    =>  array(
		'type'         =>  'credit_card',
		'credit_card'  => array(
			'id'    =>  $credit_card_id
		)
	)
));

/* if($response1=="500")
{
//echo "Your share was unsucessfull <br> We apologize for the inconvenience <br><br> Please double check your payment credientials <br> and try again.";
?>
<div class="share-unsuccess" style="margin: 10% 5% 5% 25%;">
<img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2018/01/donation-unsuccess.png" alt="share-unsuccessfull" class="aligncenter size-full wp-image-313" />

</div>

<?php
exit;
} */
//Wepay::useStaging($client_id2, $client_secret2);

$wepay2 = new WePay(NULL); // Don't pass an access_token for this call*/

 // create the pre-approval

$response2 = $wepay1->request('credit_card/create', array(
	'client_id'         => $client_id2,
	"user_name" => $_POST['donor_name'].' '.$_POST['donor_lname'],
	"email" => $_POST['donor_email'],
	"cc_number" => $_POST['cc_number'],
	"cvv" => $_POST['cc_cvv'],
	"expiration_month" => $_POST['cc_month'],
	"expiration_year" => $_POST['cc_year'],
	"address" => array("country" => $_POST['country'],
		"postal_code" => $_POST['postal_code'])));



// credit card id to charge
$credit_card_id2 = $response2->credit_card_id;

$wepay2 = new WePay($access_token2);

// charge the credit card
$response3 = $wepay2->request('checkout/create', array(
	'account_id'		=> $account_id2,
	'amount'		=> $fundraiser_budget,
	'currency'      =>  'USD',
	'short_description'	=> 'raiseit accept donation',
	'type'            => 'goods',
	'payment_method'    =>  array(
		'type'         =>  'credit_card',
		'credit_card'  => array(
			'id'    =>  $credit_card_id2
		)
	)
));

if($response1->state=="authorized" && $response3->state=="authorized")
{

	update_post_meta($fund_id,'donate','yes');
	update_post_meta($fund_id,'payment_amount',$fundraiser_budget);
	update_post_meta($fund_id,'final_release','yes');
	update_post_meta($fund_id,'checkout_id',$response1->checkout_id);
	update_post_meta($fund_id,'total_amount',$budget);
	update_post_meta($fund_id,'donor_id',$id);

	update_post_meta($fundraiser_auth_id,'donor_id',$id);

	global $wpdb;
	$tablename=$wpdb->prefix.'donation';

	if(is_user_logged_in())
	{
		$data = array(
			'donars_id' => $id, 
			'fund_ent_id' => $fund_id,
			'fund_name' => $fff_title,          
			'fund_auth_name' => $fff_auth_name, 
			'donation_amt' => $budget,
			'fund_event_s_date' => $fund_event_s_date,
			'fund_event_e_date' => $fund_event_e_date,
			'ff_auth_email'     => $ff_auth_email,
			'donor_email_n'     => $donor_email_n,
			'fund_auth_phone'   => $ff_auth_phone,
			'rent_email'        => $rent_email,
			'rent_phone'        => $rent_phone,
			'donar_phone'       => $donr_phone,
			'3day'              => '0',
			'1day'              => '0'

		);
	}
	else{
		$data = array(
			'donars_id' => $user_register, 
			'fund_ent_id' => $fund_id,
			'fund_name' => $fff_title,          
			'fund_auth_name' => $fff_auth_name, 
			'donation_amt' => $budget,
		);
	}

	$insert = $wpdb->insert( $tablename, $data);

	update_post_meta($rent_id,'budget',$_POST['budget']);
	update_post_meta($rent_id,'payment_amount',$raiseit_budget);
	update_post_meta($fund_id,'final_release','yes');
	update_post_meta($fund_id,'checkout_id',$response1->checkout_id);

    // write the email content for fundraiser
	@$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: text/html; charset=utf-8\n";
	@$headers .= "From:" . $cc_user_email;

	$message1 .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
	<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$name) . 
	"</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
	$message1 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">You  are successfuly donate the amount.','piereg</div>') . "</div>";

	$message1 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">Your coupan code is.'.$coupan_value,'piereg</div>') . "</div>";


	$message1 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">You have donated $ '.$budget.' amount for <a href="'.site_url('/fundraiser/').$post_slug.'/">'.$fff_title.'</a>','piereg</div>') . "</div>";

	/*$message1 .= '<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">You have donated $ '.$budget.'amount for <a href ="'.$post_slug.'">'.$fff_titles.'</a></div>';*/

	$message1 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">Your coupan code is valid upto this date.'.$coupan_e_date,'piereg</div>') . "</div>";

	$message1 .='</div><div style=color: #999;padding: 50px 30px">
	<div style="">Regards,</div>
	<div style="">RaiseIT Team</div>            
	</div></body></html>';

	$subject = "Raise It Notification";
	$subject = "=?utf-8?B?" . base64_encode($subject) . "?=";

	$to = $email;

            // send the email to fundraiser
	$email1=wp_mail($to, $subject, $message1, $header);

	//header("location:".site_url()."/raiseit-donate/");

}

/*echo '<button type="button" class="btn btn-info btn-lg Select_popup" data-toggle="modal" data-target="#myModal986" style="display: none;">dsfsdfdssdf</button>';*/

}



?>

<script>
	$(document).ready(function(){
		$(".Select_popup").trigger('click');
		//$('.save-succes').html('You have successfully donated the amount.');
		$( ".redirect_pge" ).click(function() {
			window.location.href = "<?php echo $post_slug; ?>";
		});
	});
</script>

<script>
	$(document).ready(function(){
		$("#donate_continue").click(function(){
			var donation    = $("#donation").val();
			var donor_name  = $("#donor_name").val();
			var donor_lname = $("#donor_lname").val();
			var email       = $("#email").val();

			if(donation == '')
			{
				document.getElementById("donation").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation').html('<span style="color:red;"> Please input donation amount!</span>');
				jQuery('.bus-fs-error-donation').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("donation").style.borderColor = "#006600";
				jQuery('.bus-fs-error-donation').hide();  
			}
		}
	});
</script>