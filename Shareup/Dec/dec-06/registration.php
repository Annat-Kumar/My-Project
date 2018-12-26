<?php 
/**
 * Template Name: Registration Page
 *
 * Registration Page Template.
 *
 * @author Ahmad Awais
 * @since 1.0.0
 */
get_header(); 
?>
<div class="row enigma_blog_wrapper">
<div class="container inner_page">


<?php 
global $username, $password, $email, $first_name, $last_name,$reg_errors;
if (isset($_POST['submit'])) 
{

        $username =   sanitize_user($_POST['username']);
        $password   =   esc_attr($_POST['password']);
        $email    =   sanitize_email($_POST['email']);
        
        $first_name =   sanitize_text_field($_POST['fname']);
        $last_name  =   sanitize_text_field($_POST['lname']);
      
         $pic        =   $_POST['profile_pic'];

    
    $reg_errors = new WP_Error;

    if ( empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Required form field is missing');
    }

    elseif ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'Password length must be greater than 5');
    }

    elseif ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email is not valid');
    }

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
     
/* require 'wepay.php';

// application settings
$client_id = get_option('client_id');
$client_secret = get_option('client_secret');
 $email=$_POST['email'];
 $fname=$_POST['fname'];
 $lname=$_POST['lname'];
// change to useProduction for live environments
Wepay::useStaging($client_id, $client_secret);

$wepay = new WePay(NULL);

// register new merchant
$response = $wepay->request('user/register/', array(
    'client_id'        => $client_id,
    'client_secret'    => $client_secret,
    'email'            => $_POST['email'],
    'scope'            => 'manage_accounts,collect_payments,view_user,preapprove_payments,send_money',
    'first_name'       => $_POST['fname'],
    'last_name'        => $_POST['lname'],
    'original_ip'      => '74.125.224.84',
    'original_device'  => 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_6;
                             en-US) AppleWebKit/534.13 (KHTML, like Gecko)
                             Chrome/9.0.597.102 Safari/534.13',
    'tos_acceptance_time' => 1209600
));

$access_token=$response->access_token;
$wepay1 = new WePay($access_token);

    // create an account for a user
    $response1 = $wepay1->request('user/send_confirmation/', array());
 
 $wepay2 = new WePay($access_token);

// create an account for a user
$response2 = $wepay2->request('account/create/', array(
    'name'         => $_POST['fname'].' '.$_POST['lname'],
    'description'  => $_POST['fname'].' '.$_POST['lname'].' description'
));

// display the response
//print_r($response2);
$account_id=$response2->account_id;
 $user_id;
update_user_meta($user_id,'wepay_account_id',$account_id);
update_user_meta($user_id,'wepay_access_token',$access_token);  */
//wp_redirect(get_bloginfo('url').'/profile-picture');


/*--------------paypal-------------------------------*/

$email=$_POST['email'];
 $fname=$_POST['fname'];
 $lname=$_POST['lname'];

require_once('config.php');
require_once('PayPal.php');
 require_once('Adaptive.php'); 
/* require_once('Financing.php'); */
/* require_once('autoload.php'); */ 
 
 
/* 'IPAddress' => $_SERVER['REMOTE_ADDR'], */
// Create PayPal object.
$PayPalConfig = array(
      'Sandbox' => $sandbox,
  'DeveloperAccountEmail' => $developer_account_email,
  'ApplicationID' => $application_id,
  'DeviceID' => $device_id,
  
  'APIUsername' => $api_username,
  'APIPassword' => $api_password,
  'APISignature' => $api_signature,
  'APISubject' => $api_subject,
  'PrintHeaders' => $print_headers,
  'LogResults' => $log_results,
  'LogPath' => $log_path,
);

 
$PayPal = new Adaptive($PayPalConfig);
 
// Prepare request arrays
$CreateAccountFields = array(
    'AccountType' => 'Personal', // Required. The type of account to be created. Personal or Premier
    'CitizenshipCountryCode' => 'US', // Required. The code of the country to be associated with the business account. This field does not apply to personal or premier accounts.
    'ContactPhoneNumber' => '783-770-6467', // Required. The phone number associated with the new account.
    'HomePhoneNumber' => '555-555-5555', // Home phone number associated with the account.
    'MobilePhoneNumber' => '783-770-6467', // Mobile phone number associated with the account.
    'ReturnURL' => $domain.'return.php', // Required. URL to redirect the user to after leaving PayPal pages.
    'ShowAddCreditCard' => 'true', // Whether or not to show the Add Credit Card option. Values: true/false
    'ShowMobileConfirm' => '', // Whether or not to show the mobile confirmation option. Values: true/false 
    'ReturnURLDescription' => 'Home Page', // A description of the Return URL.
    'UseMiniBrowser' => 'false', // Whether or not to use the minibrowser flow. Values: true/false Note: If you specify true here, do not specify values for ReturnURL or ReturnURLDescription
    'CurrencyCode' => 'USD', // Required. Currency code associated with the new account. 
    'DateOfBirth' => '1982-04-09Z', // Date of birth of the account holder. YYYY-MM-DDZ format. For example, 1970-01-01Z
    'EmailAddress' => $email, // Required. Email address.
    'Saluation' => '', // A saluation for the account holder.
    'FirstName' => $fname, // Required. First name of the account holder.
    'MiddleName' => '', // Middle name of the account holder.
    'LastName' => $lname, // Required. Last name of the account holder.
    'Suffix' => '', // Suffix name for the account holder.
    'NotificationURL' => $domain.'paypal/ipn/ipn-listener.php', // URL for IPN
    'PreferredLanguageCode' => 'en_US', // Required. The code indicating the language to be associated with the new account.
    'RegistrationType' => 'Web', // Required. Whether the PayPal user will use a mobile device or the web to complete registration. This determins whether a key or a URL is returned for the redirect URL. Allowable values are: Web
    'SuppressWelcomeEmail' => 'TRUE', // Whether or not to suppress the PayPal welcome email. Values: true/false
    'confirmEmail'    => 'TRUE',
  'reminderEmailFrequency'=>'NONE',
  'PerformExtraVettingOnThisAccount' => '', // Whether to subject the account to extra vetting by PayPal before the account can be used. Values: true/false
    'TaxID' => ''    // Tax ID equivalent to US SSN number. Note: Currently only supported in Brazil, which uses tax ID numbers such as CPF and CNPJ.
);
 
$Address = array(
    'Line1' => '1503 Main St.', // Required. Street address.
    'Line2' => '376', // Street address 2.
    'City' => 'Kansas City', // Required. City
    'State' => 'MO', // State or Province
    'PostalCode' => '64111', // Postal code
    'CountryCode' => 'US'    // Required. The country code.
);
 


 
$PayPalRequestData = array(
    'CreateAccountFields' => $CreateAccountFields, 
    'Address' => $Address 
    
);
 
// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->CreateAccount($PayPalRequestData);


  //exit('Direct Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
if($PayPalResult['Ack']=='Success'){

$account_id=$PayPalResult['AccountID'];
$access_token=$PayPalResult['CreateAccountKey'];
 $user_id;
update_user_meta($user_id,'paypal_account_id',$account_id);
update_user_meta($user_id,'paypal_account_key',$access_token);  
//wp_redirect(get_bloginfo('url').'/profile-picture');



  $id=$PayPalResult['RedirectURL'];
$email=$_POST['email'];
$to      = $email;
$subject = 'PayPal Account';
$message = 'Please Click here to confirm your account:<a href="#">'.$id.'</a>';
$headers = 'From: admin@example.com' . "\r\n" .
    'Reply-To: admin@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

   }
    
   /* $post_id = wp_insert_post(array('comment_status'  => 'open','ping_status'   => 'closed','post_author'   => $author_id,'post_content' => $your_content,'post_title'    => 'job','post_status'   => 'publish','post_type'   => 'task') */
?>
  <div class="share-text">
      <a href="https://www.sandbox.paypal.com/us/verified/pal=ruby%2dfacilitator%40bytecodetechnologies%2ein" ></a>
    <h4> Your paypal status : <?php echo $PayPalResult['Ack']; ?>.</h4>
  <?php echo "Your Pyapal Account ID is : ".$PayPalResult['AccountID']; ?>
  
        
      
  </div>







  <?php

  



/*--------------------end Paypal-------------------------------*/









 header( "refresh:5;url=".get_bloginfo('url')."/profile-picture" ); 

           // echo '<div class="msg">';
           // echo 'You have succefully registered in our website.</div>';
			
		
      ?>
<?php 
exit;
  }
  else
  {
    foreach ( $reg_errors->get_error_messages() as $error ) {
           
            echo '<div class="error">';
            echo $error . '</div>';
        }
  }
  

}

?>
<div class="inner1">
<h1><img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2017/03/shareup.png" alt="" width="280" height="50" class="aligncenter size-full wp-image-313" /></h1>
 <?php do_action( 'wordpress_social_login' ); ?>
 <h2 class="or">Or Sign Up with Email</h2>
    
    <form name="register" action="" method="post" id="register">
   
    
        
         <div class="form-group">
     
          <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $first_name; ?>" placeholder="First Name" >
        </div>

        <div class="form-group">
        
          <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $last_name; ?>" placeholder="Last Name" >
        </div>

        <div class="form-group">
       
          <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email" >
        </div>
     <div class="form-group">
      
          <input type="password" name="password" id="password" value="<?php echo $username; ?>" class="form-control" placeholder="Password" >
        </div>
        
    
         <div class="form-group">
           
            
                <input type="submit" id="submit"  value="Sign Up" name="submit" class="form-control">
               
               
            
        </div>
      
    </form>
    <p class="agree">By signing up you agree to our<br> <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></p>

    <div class="already_acc"><p>Already have an account?</p>
		<a href="<?php echo bloginfo('url');?>/log-in">Login</a>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function()
  {
jQuery("#register").validate({
 
}); 

  });
</script>







<?php get_footer();?>
