<?php 
/**
 * Template Name: RaiseIt Donate Page
 *
 * Login Page Template.
 *
 * @author Ahmad Awais
 * @since 1.0.0
 */

if(is_user_logged_in())
{
	get_header(); 

/*echo "<pre>";
print_r($_POST);*/


global $current_user;
//get_currentuserinfo();
wp_get_current_user();

$id = $current_user->ID;
$name = $current_user->user_firstname.' '.$current_user->user_lastname;
$email = $current_user->user_email ;
$username =  $current_user->user_nicename; 

$donr_phone = get_user_meta($id, 'user_phone', true);

if(isset($_POST['raiseit_submit']))
{   


/*	echo "<pre>";
	print_r($_POST);
	echo "<br>";

	echo $rent_id = $_POST['retailer_post_id'];
	echo "<br>";
	echo $author_id = get_post_field ('post_author', $rent_id);

	$rent_user_info = get_userdata($author_id);

    echo "<br>";

	echo $rent_email = $rent_user_info->user_email;

    echo "<br>";

	echo $rent_phone = get_user_meta($author_id, 'user_phone', true);




	echo "</pre>";

	die('*********************************************');*/

	if ($_POST['get_vale'] == 'on')
	{

		$donor_name = $_POST['donor_name'];
		$donor_lname = $_POST['donor_lname'];
		$donor_email = $_POST['donor_email'];
		$fullname_new = $donor_name.' '.$donor_lname;
		$user_pass =  wp_generate_password( 10, true, true );

		$user_info   = get_userdata(1);

		$admin_name  = $user_info->user_login;

		$admin_email = get_option( 'admin_email' );



		$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789'); 
		shuffle($seed);
		$rand = '';
		foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];

		$donor_name_new = $donor_name.'_'.$rand;

		$info = array();
		$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['user_login'] = sanitize_user($donor_name_new) ;
		$info['user_pass']     = sanitize_text_field($user_pass);
		$info['user_email']    = sanitize_email( $donor_email );

			// Register the user
		$user_register = wp_insert_user( $info );

		update_user_meta( $user_register, 'first_name', $donor_name );
		update_user_meta( $user_register, 'last_name', $donor_lname );


		add_user_meta( $user_register, 'acc_activate', 1, true );

		    // write the email content for fundraiser
		@$header_new .= "MIME-Version: 1.0\n";
		$header_new .= "Content-Type: text/html; charset=utf-8\n";
		@$headers_new .= "From:" . $admin_email;

		$message1_new .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
		<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$donor_name) . 
		"</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
		$message1_new .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">You  are successfuly create the account.','piereg</div>') . "</div>";

		$message1_new .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">Your Password is '.$user_pass,'piereg</div>') . "</div>";

		/*$message1_new .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;">Your coupan code is valid upto this date.'.$coupan_e_date,'piereg</div>') . "</div>";*/

		$message1_new .='</div><div style=color: #999;padding: 50px 30px">
		<div style="">Regards,</div>
		<div style="">RaiseIT Team</div>            
		</div></body></html>';

		$subject_new = "Raise It Notification";
		$subject_new = "=?utf-8?B?" . base64_encode($subject_new) . "?=";

		$to_new = $donor_email;

		            // send the email to fundraiser
		$email_new = wp_mail($to_new, $subject_new, $message1_new, $header_new);


	}
	
	//echo $user_pass;
	
	
	//die('==========');

 	// Amount calculation
	//$budget = $_POST['budget'];
	$budget = $_POST['donation'];
	$new_per_budget = 10;
	$value = 100;
	$raiseit_budget = ($new_per_budget/$value) * $budget;
	$fundraiser_budget = $budget - $raiseit_budget;


 	//get fundraiser post it

	$fund_id = $_POST['fundraiser_post_id'];

	$fundraiser_auth_id = $_POST['fundraiser_author'];


	$fff_titles = stripslashes(stripslashes(stripslashes($_POST['ff_title'])));
	$fff_title = str_replace('\"', '', $fff_titles );

	$fff_auth_name = $_POST['ff_auth_name'];

	$post_slug = get_post_field( 'post_name', $fund_id );
	
	$fund_event_s_date = $_POST['ff_start_date'];
	
	$fund_event_e_date = $_POST['ff_end_date'];
	
	$ff_auth_email = $_POST['ff_auth_email'];

	$ff_auth_phone = $_POST['funt_auth_phone'];

	$donor_email_n = $_POST['donor_email_n'];

	$date=date_create($_POST['e_time']);
	$coupan_e_date=date_format($date,"Y/m/d");


	$rent_id = $_POST['retailer_post_id'];

	$author_id = get_post_field ('post_author', $rent_id);

	$rent_user_info = get_userdata($author_id);

	$rent_email = $rent_user_info->user_email;

	$rent_phone = get_user_meta($author_id, 'user_phone', true);

	$coupan_value = get_post_meta( $rent_id, 'coupen_code', true);

	?>

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

    if($response->credit_card_id=='')
    {
    	
    	?>
    	<div class="raiseit-donate">
    		<div class="container">
    			<h1>
    				<?php  print_r($response);?>
    			</h1>
    			<div class="share-unsuccess">
    				<img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2018/01/donation-unsuccess.png" alt="share-unsuccessfull" class="aligncenter size-full wp-image-313" />
    				
    			</div>
    		</div>
    	</div>
    	<?php 
    	exit;
    }	
    
	// credit card id to charge
    $credit_card_id = $response->credit_card_id;
	//echo  $credit_card_id;die;
	//echo  $credit_card_id;die;
	// change to useProduction for live environments

    $wepay1 = new WePay($access_token);

	// charge the credit card
    $response1 = $wepay1->request('checkout/create', array(
    	'account_id'    => $account_id,
    	'amount'		=> $budget,
    	'currency'      =>  'USD',
    	'short_description'	=> 'raiseit accept donation',
    	'type'          => 'goods',
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
//echo "<pre>";print_r($response1);die;
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
	// when we implement this code for live we will use below code
$response2 = $wepay1->request('credit_card/create', array(
	'client_id' =>  $client_id,
	"user_name" => get_option('credit_card_name'),
	"email" => get_option('credit_card_email'),
	"cc_number" => get_option('credit_card_number'),
	"cvv" => get_option('credit_card_cvv'),
	"expiration_month" => get_option('credit_card_month'),
	"expiration_year" => get_option('credit_card_year'),
	"address" => array("country" => 'US',
		"postal_code" => get_option('postal_code'))));

/*$response2 = $wepay1->request('credit_card/create', array(
	'client_id'         => $client_id2,
	"user_name" => 'RaiseIt app',
	"email" =>'yaswant@bytecodetechnologies.in',
	"cc_number" => $_POST['cc_number'],
	"cvv" => $_POST['cc_cvv'],
	"expiration_month" => $_POST['cc_month'],
	"expiration_year" => $_POST['cc_year'],
	"address" => array("country" => $_POST['country'],
	"postal_code" => $_POST['postal_code'])));*/



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
		'fee' => array (
			'app_fee' => 0,
			'fee_payer' => 'payer'
		),
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

<!-- code for popup noticification -->


<div class="modal fade" id="myModal986" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content model-cont modelcont-2">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
				<h4 class="modal-title">Congratulation!</h4>
			</div>
			<div class="modal-body">
				<p class="save-succes">You have successfully donated $ <?php echo $budget;?> amount to a Raise It Fast campaign for <a href='<?php echo $post_slug;?>'><?php echo $fff_title;?></a>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default redirect_pge">Close</button>
			</div>
		</div>
	</div>
</div>

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

			if(donor_name == '')
			{
				document.getElementById("donor_name").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation').html('<span style="color:red;"> First name is required !</span>');
				jQuery('.bus-fs-error-donation').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("donor_name").style.borderColor = "#006600";  
				jQuery('.bus-fs-error-donation').hide();
			}

			if(donor_lname == '')
			{
				document.getElementById("donor_lname").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation').html('<span style="color:red;"> Last name is required !</span>');
				jQuery('.bus-fs-error-donation').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("donor_lname").style.borderColor = "#006600"; 
				jQuery('.bus-fs-error-donation').hide(); 
			}

			if(email == '')
			{
				document.getElementById("email").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation').html('<span style="color:red;"> Email is required !</span>');
				jQuery('.bus-fs-error-donation').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("email").style.borderColor = "#006600";  
				jQuery('.bus-fs-error-donation').hide();

				$("#donor_namen").val(donor_name);
				$("#donor_lnamen").val(donor_lname);
				$("#donor_email").val(email);
				$("#donate_amount").val(donation);
				$('.donate_1').hide();
				$('.donate_2').show();

			}
		});	

		$(".back").click(function()
		{

			$('.donate_1').show();
			$('.donate_2').hide();

		});

		$("#raiseit_submit").click(function()
		{

			var cc_number    = $("#cc_number").val();
			var cc_month     = $("#cc_month").val();
			var cc_year      = $("#cc_year").val();
			var cc_cvv       = $("#cc_cvv").val();	
			var country      = $("#country").val();
			var postal_code  = $("#postal_code").val();	

			if(cc_number == '')
			{
				document.getElementById("cc_number").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation_card').html('<span style="color:red;"> Credit Card Number is required !</span>');
				jQuery('.bus-fs-error-donation_card').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("cc_number").style.borderColor = "#006600";
				jQuery('.bus-fs-error-donation_card').hide();  
			}

			if(cc_month == '')
			{
				document.getElementById("cc_month").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation_card').html('<span style="color:red;"> Expiration Month is required !</span>');
				jQuery('.bus-fs-error-donation_card').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("cc_month").style.borderColor = "#006600";  
				jQuery('.bus-fs-error-donation_card').hide();
			}

			if(cc_year == '')
			{
				document.getElementById("cc_year").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation_card').html('<span style="color:red;"> Expiration Year is required !</span>');
				jQuery('.bus-fs-error-donation_card').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("cc_year").style.borderColor = "#006600"; 
				jQuery('.bus-fs-error-donation_card').hide(); 
			}

			if(cc_cvv == '')
			{
				document.getElementById("cc_cvv").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation_card').html('<span style="color:red;"> CVV is required !</span>');
				jQuery('.bus-fs-error-donation_card').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("cc_cvv").style.borderColor = "#006600";  
				jQuery('.bus-fs-error-donation_card').hide();
			}

			if(country == '')
			{
				document.getElementById("country").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation_card').html('<span style="color:red;"> Country is required !</span>');
				jQuery('.bus-fs-error-donation_card').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("country").style.borderColor = "#006600";  
				jQuery('.bus-fs-error-donation_card').hide();
			}
			if(postal_code == '')
			{
				document.getElementById("postal_code").style.borderColor = "#E34234"; 
				jQuery('.bus-fs-error-donation_card').html('<span style="color:red;"> Postal Code is required !</span>');
				jQuery('.bus-fs-error-donation_card').show();  
				return false;   
			}
			else
			{ 
				document.getElementById("postal_code").style.borderColor = "#006600";  
				jQuery('.bus-fs-error-donation_card').hide();
			}

		});
	});

</script>

<div class="container-fluid donate_background">
	<div class="container">
		<div class="row">
			<div class="donate_border">

				<?php 
				if($_POST['ff_id'] != '')
				{ 
					?>

					<div class="col-md-7 col-sm-7 donate_form12">
						<form method="post" action="" id="dntfrm">

							<div class="donate_1">

								<div class="alert alert-warning bus-fs-error-donation" style="display: none;"></div> 

								<div class="form-group">
									<label class="enter_donation"> Enter Your Donation: </label>
									<!-- <span class="d_doll"><img src="<?php echo site_url();?>/wp-content/uploads/2017/12/dollar.png" class="img-responsive"></span> -->
									<input id="donation" class="form-control" maxlength="6" name="donation" value="" type="text"  placeholder="Enter Your Donation" onkeypress="return isNumber(event)"/>
									<!-- <span class="d_dot"><img src="<?php echo site_url();?>/wp-content/uploads/2017/12/rupee.png" class="img-responsive"></span> -->


									<div id="msg3"></div>
								</div>

								<div class="form-group">
									<label>Your Name: </label>
									<input id="donor_name" class="form-control"  name="donor_name"  value="<?php echo $current_user->user_firstname ;?>" placeholder="john" required/>
								</div> 

								<div class="form-group">
									<label> Last Name: </label>
									<input id="donor_lname" class="form-control"  name="donor_lname" type="text" placeholder="Smith" value="<?php echo $current_user->user_lastname;?>" required/>
								</div>

								<div class="form-group">
									<label>Email: </label>
									<input id="email" class="form-control"  name="email" type="email" value="<?php echo $email; ?>" placeholder="johnsmith@examplea.com" required/>
								</div> 


								<div class="form-group">
									<div class="col-md-12 col-sm-12 text-center continue_btn">
										<button class="btn raise_btn2" type="button" id="donate_continue" name="donate_continue">Continue </button> 

									</div>
								</div>


							</div>

							<div class="donate_2" vis="hide" style="display:none;">



								<?php 
								$raiseit_amt = $_POST['raiseit_amt'];  	
								$post_client_id = $_POST['post_client_id'];
								$post_client_secret = $_POST['post_client_secret'];
								$post_access_token = $_POST['post_access_token'];
								$post_account_id = $_POST['post_account_id'];
								$raiseit_percentage = $_POST['raiseit_percentage'];		

			//get retailer and fundraiser post data

								$r_post_id = $_POST['retail_post_id'];
								$r_author =  $_POST['retailer_author'];
								$f_author_id = $_POST['fund_author_id'];
								$ff_id = $_POST['ff_id'];
								$ee_date = $_POST['event_e_date'];

								$event_titles     = stripslashes(stripslashes(stripslashes($_POST['fund_name'])));
								$event_title =      str_replace('\"', '', $event_titles);

								/*$event_title = $_POST['fund_name'];*/

								$event_auth_name = $_POST['event_auth_name'];

								$date_s = get_field('select_date',$_POST['ff_id']);

								$date_e = get_field('event_expire_date',$_POST['ff_id']);

								$user_info = get_userdata($f_author_id);


								$fund_auth_email = $user_info->user_email;

								$fund_auth_phone = get_user_meta($f_author_id, 'user_phone', true);

								?>
								<input type='hidden' name='budget' value='<?php echo $raiseit_amt ; ?>'>
								<input type='hidden' name='r_persentage' value='<?php echo $raiseit_percentage ; ?>'>
								<input type='hidden' name='post_client_id' value='<?php echo $post_client_id ; ?>'>
								<input type='hidden' name='post_client_secret' value='<?php echo $post_client_secret ; ?>'>
								<input type='hidden' name='post_access_token' value='<?php echo $post_access_token ; ?>'>
								<input type='hidden' name='post_account_id' value='<?php echo $post_account_id ; ?>'>

								<!-- get post data retailer and fundraiser -->

								<input type='hidden' name='retailer_post_id' value='<?php echo $r_post_id; ?>'>
								<input type='hidden' name='retailer_author' value='<?php echo $r_author ; ?>'>
								<input type='hidden' name='fundraiser_post_id' value='<?php echo $ff_id ; ?>'>
								<input type="hidden" name="e_time" value="<?php echo $ee_date ; ?>">
								<input type='hidden' name='fundraiser_author' value='<?php echo $f_author_id ; ?>'>
								<input type="hidden" name="ff_title" value="<?php echo $event_title;?>">
								<input type="hidden" name="ff_auth_name" value="<?php echo $event_auth_name;?>">

								<input type="hidden" name="ff_start_date" value="<?php echo $date_s ;?>">
								<input type="hidden" name="ff_end_date" value="<?php echo $date_e;?>">
								<input type="hidden" name="ff_auth_email" value="<?php echo $fund_auth_email;?>">
								<input type="hidden" name="donor_email_n" value="<?php echo $email;?>">
								<input type="hidden" name="funt_auth_phone" value="<?php echo $fund_auth_phone;?>">

								<input type="hidden" name="donor_namen" value="" id="donor_namen">
								<input type="hidden" name="donor_lnamen" value="" id="donor_lnamen">
								<input type='hidden' name="donor_email" value="" id="donor_email">			
								<input type="hidden" name="donate_amount" value="" id="donate_amount">


								<div class="click_donate"> 

									<div class="alert alert-warning bus-fs-error-donation_card" style="display: none;"></div>

									<div class="form-group">
										<label for="inputPassword"> Credit Card Number: </label>
										<input id="cc_number" class="form-control" name="cc_number" type="text" placeholder="4003830171874018"  />
									</div>

									<div class="form-group">
										<label for="inputPassword"> Expiration Month: </label>
										<input id="cc_month" class="form-control" name="cc_month" type="text" placeholder="01" onkeypress="return isNumber(event)" maxlength="2" />
									</div>

									<div class="form-group">
										<label for="inputPassword">   Expiration Year: </label>
										<input id="cc_year" class="form-control" name="cc_year" type="text" placeholder="21" onkeypress="return isNumber(event)" maxlength="2" />
									</div>

									<div class="form-group">
										<label for="inputPassword">CVV: </label>
										<span class="credit_donate"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
										<input id="cc_cvv"  class="form-control" name="cc_cvv" type="text" placeholder="123" onkeypress="return isNumber(event)" maxlength="3" />


									</div>

									<div class="form-group">
										<label for="inputPassword"> Country: </label>
										<input id="country" class="form-control" name="country" type="text" placeholder="US" />
									</div>

									<div class="form-group">
										<label for="inputPassword"> Postal Code: </label>
										<input id="postal_code" class="form-control" name="postal_code" type="text" placeholder="94085" onkeypress="return isNumber(event)" />
									</div>

									<?php

									if ( !is_user_logged_in() )
									{	
										?>


										<div class="toggle_check">
											<label class="switch_toggle">
												<input type="checkbox" class="maxtickets_enable_cb" name="get_vale">
												<span class="slider_toggle round"></span>

											</label>
										</div>
										<div class="form-group">
											<label class="create">(Would you like to create your account history or create your account with Raise It)</label>
										</div>
										<div class="slider_inputshow"><input class="form-control" placeholder="Password" type="text" style="display: none;" />
										</div>
										<?php 
									}
									?>


								</div>

								<div class="form-group">
									<div class="col-md-12 text-center back_sub">
										<input type="button" name="back" class="back back_bnt btn btn-default" value="Back" />


										<button class="btn raise_btn2" type="submit" id="raiseit_submit" name="raiseit_submit">Submit </button> 

									</div>
								</div>


							</div> <!-- donate_2 -->
						</form>

					</div>



				</script>

				<div class="col-md-5 col-sm-5 donate_right">
					<div class="donate_border_img">


						<h1><?php echo $event_title;?></h1>
						<div class="right_inner_donate">

							<?php
						//$feature_image_1 = get_field('feature_image_1',$_POST['ff_id']);
							$feature_image1 =   get_the_post_thumbnail_url($_POST['ff_id']);
						//$images = array($feature_image1);
						//$result = array_filter($images,'strlen');

        //$count = count($result)
							?>
							<?php if($feature_image1) { ?>
							<img class="img-responsive" src="<?php echo $feature_image1 ;?>" >
							<?php } else { ?>
							<img class="img-responsive" src="<?php echo site_url();?>/wp-content/uploads/2017/09/not_avail.jpg">
							<?php }
							?>
						</div>
					</div>
				</div>

				<?php
			}
			if($response1->state=="authorized" && $response3->state=="authorized")

			{
				?>
				<div class="alert alert-success">

					<h4 class="modal-title">Congratulation!</h4>
					<p class="save-succes">You have successfully donated $ <?php echo $budget;?> amount to a Raise It Fast campaign for <a href='<?php echo $post_slug;?>'><?php echo $fff_title;?></a>.</p>
				</div>

				<?php
			}

			if($_POST['ff_id'] == '' && $response1->state!="authorized" && $response3->state!="authorized")
			{
				echo '<div class="alert alert-danger">';
				echo "<h5>Please select event for donation first.</h5>";
				echo '</div>';
			}
			?>
		</div>
	</div>
</div>
</div>

<style type="text/css"> 
.logged-in .top{margin-top: 100px !important;}
/*.raise_btn2{width: 25% !important;}*/
</style>
<script>
	
	$(document).ready(function(){
		$(".slider_inputshow").css("display","none");
		$('.maxtickets_enable_cb').click(function() {
			if($(this).is(':checked'))
				$(".slider_inputshow").css("display","block");
			else
				$(".slider_inputshow").css("display","none");
		});
	});
</script>
<?php  get_footer();?>

<?php
} 

else
{
	header("location:".site_url()." ");
}
?>