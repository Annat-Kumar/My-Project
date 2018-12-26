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

<div class="inner_signup">
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
     
require 'wepay.php';

// application settings
$client_id = get_option('client_id');
$client_secret = get_option('client_secret');
 $email=$_POST['email'];
 $fname=$_POST['fname'];
 $lname=$_POST['lname'];
// change to useProduction for live environments
Wepay::useProduction($client_id, $client_secret);

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
update_user_meta($user_id,'wepay_access_token',$access_token);
//wp_redirect(get_bloginfo('url').'/profile-picture');
header( "refresh:5;url=".get_bloginfo('url')."/profile-picture" );

            echo '<div class="msg">';
            echo 'You have succefully registered in our website.</div>';
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
<h1><img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2017/08/logo-new.png" alt=""  /></h1>
 <?php do_action( 'wordpress_social_login' ); ?>
 <h2 class="or">Sign Up with Email</h2>
    
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
