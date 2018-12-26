<?php 
/**
 * Template Name: Job Posting Page
 *
 * Login Page Template.
 *
 * @author Ahmad Awais
 * @since 1.0.0
 */
get_header(); 
if(!is_user_logged_in())
{
  wp_redirect(get_bloginfo('url').'/log-in');
exit;
}

//get_template_part('breadcrums'); ?>
<?php 
global $message,$post_id,$budget;

if(isset($_POST['submit']))
{
 $budget= $_POST['budget'];
//$title=$_POST['job_title'];
 $author_id=get_current_user_id();
$your_content= $_POST['description'];
  $cat=$_POST['job_cat'];

 
 require 'wepay.php';
 $id=get_current_user_id();
    // application settings
   $client_id = get_option('client_id');
$client_secret = get_option('client_secret');
   // $access_token = get_user_meta($id,'wepay_access_token',true);
 $access_token = get_option('access_token');

    // change to useProduction for live environments
    Wepay::useProduction($client_id, $client_secret);

    $wepay = new WePay($access_token);

    // create an account for a user
    $response = $wepay->request('credit_card/create', array(
   'client_id' =>  $client_id,
   "user_name" => $_POST['fullname'],
   "email" => $_POST['email'],
   "cc_number" => $_POST['cc_number'],
   "cvv" => $_POST['cc_cvv'],
   "expiration_month" => $_POST['cc_month'],
   "expiration_year" => $_POST['cc_year'],
   "address" => array("country" => $_POST['country'],
      "postal_code" => $_POST['postal_code'])));

    // display the response
   // print_r($response);

 //$account_id    = get_user_meta($id,'wepay_account_id',true);
    $account_id    = get_option('account_id');

// credit card id to charge
$credit_card_id = $response->credit_card_id;


$wepay1 = new WePay($access_token);

/* charge admin fee, weepay fee and extra charges */
 $admin_fees = (5 / 100 ) * $_POST['budget'];
$add_admin_fee= $_POST['budget'] + $admin_fees;

$wepay_fee = (2.9 / 100 ) * $add_admin_fee;
$add_wepay_fee = $add_admin_fee + $wepay_fee;

$final_fee= $add_wepay_fee +(0.30);

//$total_budget = $budget + 2.33;
$total_budget = $final_fee;
// charge the credit card
$response1 = $wepay1->request('checkout/create', array(
    'account_id'          => $account_id,
    'amount'              => $total_budget,
    'currency'            => 'USD',
    'short_description'   => 'Donations',
    'type'                => 'donation',
    'payment_method'      => array(
        'type'            => 'credit_card',
        'credit_card'     => array(
            'id'          => $credit_card_id
        )
    )
));

// display the response
//print_r($response1);
if($response1->state=="authorized")
{
$post_id = wp_insert_post(array('comment_status'  => 'open','ping_status'   => 'closed','post_author'   => $author_id,'post_content' => $your_content,'post_title'    => 'job','post_status'   => 'publish','post_type'   => 'task')

        ); 


 $term = get_term_by('name', $cat, 'types');
  $term_id=$term->term_id;
wp_set_object_terms( $post_id,array($term_id),'types' );
//update_post_meta($post_id,'job_state',$_POST['job_state']);
update_post_meta($post_id,'job_city',$_POST['job_city']);
update_post_meta($post_id,'budget',$_POST['budget']);
update_post_meta($post_id,'payment_amount',$total_budget);
update_post_meta($post_id,'final_release','no');
update_post_meta($post_id,'checkout_id',$response1->checkout_id);

echo '<div class="container">';
  echo '<div class="msg">You have successfullly share your job';

            echo  '</div></div>';
}

 } 
    ?>

<?php $user_info = get_userdata(get_current_user_id());
$name= $user_info->user_firstname.' '.$user_info->user_lastname;
$email= $user_info->user_email;
     
?>
<div class="row enigma_blog_wrapper">
<div class="container inner_page">
<div class="inner-job">
<h1><img src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2017/08/logo-new.png" alt=""  /></h1>
  <div class="text-side8">
    <form name="job_posting" action="" method="post" id="job_posting">
     <div id="sf1" class="frm">
          <fieldset>
           <!--  <legend>Job Information</legend> -->
        <!-- <div class="form-group">
            <label for="inputEmail">Job Title</label>
            <input type="text" name="job_title" id="job_title" class="form-control" placeholder="Job Title" required>
        </div> -->
        <div class="form-group" >
            <label for="inputPassword" style="font-size:14px;font-weight:normal;"> 
        
        How much would you like to donate ?</label>
            <input type="text" name="budget"  id="budget" class="form-control" placeholder="Enter Your Budget" required>
        </div>
         
        

        <div class="form-group">
        <label style="font-size:14px;font-weight:normal;">Where do you want to give ?(i.e. your city of residence)</label>
    
       <input type="text" name="job_city" id="job_city" class="form-control" placeholder="Location" required> 
         <!--   <select name="job_city" class="form-control" id="job_state" required ><option>Select City</option></select>-->
        </div>
       
        

 
<div class="clearfix" style="clear: both;"></div>
     <div class="form-group">
       <label>Category</label>
            <!--<select name="job_cat" id="job_cat" class="form-control">
               <option value="All">All</option>
               <option value="Unemployment">Unemployment</option>
               <option value="Home and Rent">Home & Rent</option>
               <option value="Family and Youth">Family & Youth</option>
               <option value="Food and Basics">Food & Basics</option>
               <option value="Small Buisness">Small Buisness</option>
               <option value="Medical">Medical</option>
            </select>-->
               
			   <select name="job_cat" id="job_cat" class="form-control">               
			   <?php $wcatTerms = get_terms('types', array('hide_empty' => 0, 'parent' =>0)); 
					foreach($wcatTerms as $wcatTerm) :
			   ?>
               <option value="<?php echo $wcatTerm->name ;?>"><?php echo $wcatTerm->name ;?></option>
			   <?php endforeach ; ?>
            </select>
        </div>
       
        
       <div class="form-group" style="font-size:14px;">
        <label style="font-size:14px;font-weight:normal;">Who would you like to give your monetory sid to?<br>(You can choose to leave this blank, but your inbox requests may be larger than normal) </label>
         <textarea maxlength="160" id="textarea_job" name="description" class="form-control" placeholder="Description"></textarea> 
         <span id="textarea_limit"></span>
        
        </div>
        <hr class="line--sec">
         
        <div class="form-group">
              <div class="col-lg-10 col-lg-offset-3">
                <button class="btn  open1" id="submit" type="button" style="font-size:14px;font-weight:normal;">Post to Share</span></button> 
              </div>
            </div>
          </fieldset>
        </div>

        <div id="sf2" class="frm" style="display: none;">
          <fieldset>
            <!-- <legend>Do Payment</legend> -->
<div class="form-group col-md-6">
        <label for="inputPassword"> Name: </label>
        <input id="fullname" class="form-control" name="fullname" value="<?php echo $name; ?>" type="text" placeholder="John Smith" required/>
    </div>
     
     <div class="form-group col-md-6">
        <label for="inputPassword">Email: </label>
        <input id="email" class="form-control"  name="email" type="email" value="<?php echo $email; ?>" placeholder="johnsmith@examplea.com" required/>
    </div> 
     
     <div class="form-group col-md-6">
    <label for="inputPassword"> Credit Card Number: </label>
        <input id="cc_number" class="form-control"  name="cc_number" type="text" placeholder="4003830171874018" required/>
    </div>
     
     <div class="form-group col-md-6">
     <label for="inputPassword"> Expiration Month: </label>
      <input id="cc_month" class="form-control"  name="cc_month" type="text" placeholder="01" required/>
   </div>
    
    <div class="form-group col-md-6">
     <label for="inputPassword">   Expiration Year: </label>
      <input id="cc_year" class="form-control"  name="cc_year" type="text" placeholder="21" required/>
  </div>
   
    <div class="form-group col-md-6">
        <label for="inputPassword">CVV: </label>
       <input id="cc_cvv"  class="form-control"  name="cc_cvv" type="text" placeholder="123" required="required"/>
       <span id="cc_cvv_invalid">Invalid CVV</span>
    </div>
     
    <div class="form-group col-md-6">
     <label for="inputPassword"> Country: </label>
        <input id="country" class="form-control"  name="country" type="text" placeholder="US" required="required"/>
    </div>
     
     <div class="form-group col-md-6">
     <label for="inputPassword"> Postal Code: </label>
        <input id="postal_code" class="form-control"  name="postal_code" type="text" placeholder="94085" required="required"/>
    </div>
    

     <div class="form-group col-md-12">
              <div class="col-md-12 text-center">
                <button class="btn back3" type="button">Back</button> 
                </div>
                 <div class="col-md-12 text-center">
                <button class="btn" type="job_submit" id="submit1" name="submit">Submit </button> 
               
              </div>
            </div>

    

 </fieldset>
        </div>
         <p class="agree" style="border:0;">We charge a 12% fee on any and all refunds</p>
         <p class="agree" style="border:0;">By posting you agree to our <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></p>
      </form>
    </div>
    
  


</div>
</div>
</div>
<style>
  ul#stepForm, ul#stepForm li {
    margin: 0;
    padding: 0;
  }
  ul#stepForm li {
    list-style: none outside none;
  } 
  label{margin-top: 10px;}
  .help-inline-error{color:red;}
</style>
<script type="text/javascript">
  jQuery(document).ready(function()
  {
 var v = jQuery("#job_posting").validate({
      errorElement: "span",
      errorClass: "help-inline-error",
        rules: {
    cc_number: {
      required: true,
      creditcard: true
    }
    }
    });

    jQuery(".open1").click(function() {
     if (v.form()) {
        jQuery("#sf1").hide("fast");
        jQuery("#sf2").show("slow");
    }
    });

   jQuery(".back3").click(function() {
      jQuery("#sf2").hide("fast");
      jQuery("#sf1").show("slow");
    });



jQuery("#submit").click(function() {
  if (/\w+\s+\w+/.test(jQuery("#fullname").val())) {
            
        } else {
            alert("Name should be like this 'John Smith'");
            return false;
        }
   
   jQuery('#cc_cvv').keyup(function () {
         var myRe = /^[0-9]{3,4}$/;
         var cvv= jQuery("#cc_cvv").val();
         var myArray = myRe.exec(cvv);
         
         if(cvv != myArray)
          {
            //invalid cvv number
            
               jQuery("#cc_cvv_invalid").css('display','block');
            return false;
         }
         else
         {
          
           jQuery("#cc_cvv_invalid").css('display','none');
             return true;  //valid cvv number
            }

         }); });


    var text_max = 140;
    jQuery('#textarea_limit').html(text_max + ' characters remaining');

    jQuery('#textarea_job').keyup(function() {
        var text_length = jQuery('#textarea_job').val().length;
        var text_remaining = text_max - text_length;

        jQuery('#textarea_limit').html(text_remaining + ' characters remaining');
    });

  
  
     jQuery("#job_city").autocomplete({
        source: function( request, response ) {
          
             jQuery.ajax({
                url : '<?php echo get_bloginfo('template_url');?>/search_city.php',
                dataType: "json",
                type:'post',
            data: {
               //name_startsWith: request.term,
               term: request.term
            },
             success: function( data ) {
              // response( data );
              
              response( jQuery.map( data, function( item ) {
               
                return {
                  
                  value: item.state
                 
                }
              }));
            }
              });
            },
            autoFocus: true,
            minLength: 0        
    });



   
});


 

</script>
<style type="text/css">
  #cc_cvv_invalid
  {
    display: none;
    color: red;
  }
</style>
 
<?php get_footer();?>
