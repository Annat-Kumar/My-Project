<?php


  $get_current_user = wp_get_current_user();

  print_r($get_current_user);

  $user_id = $get_current_user->ID;
 

if(isset($_POST['submit_wepay']))
   {
    print_r($_POST);
 echo $user_id;
 die('*******************************************');


   	     $client_ids     = $_POST['client_id'];
    		 $client_secrets = $_POST['client_secret'];
    		 $access_tokens  = $_POST['access_token'];
    		 $account_ids    = $_POST['account_id'];
		
			update_user_meta( $user_id, 'client_id', $client_ids );
			update_user_meta( $user_id, 'client_secret', $client_secrets );
			update_user_meta( $user_id, 'access_token', $access_tokens );
			update_user_meta( $user_id, 'account_id', $account_ids );
   }
   header("loction:".site_url()."/user")
?>

 <script>
  $( document ).ready(function() {

  	$("#wepay_submit").click(function(event)
		  {

		  	  var client_id      =   jQuery('#client_id').val();
			    var client_secret  =   jQuery('#client_secret').val();
			    var access_token   =   jQuery('#access_token').val();
			    var account_id     =   jQuery('#account_id').val();

    if ($.trim(client_id).length == 0) 
    {
      document.getElementById("client_id").style.borderColor = "#E34234";
      jQuery('.wepay-error').html('<span style="color:red;"> Please Enter Your Client Id !</span>');
      jQuery('.wepay-error').show();
      return false;
    }
    else
    { 
      document.getElementById("client_id").style.borderColor = "#006600";    
    }
    if ($.trim(client_secret).length == 0) 
    {
      document.getElementById("client_secret").style.borderColor = "#E34234";
      jQuery('.wepay-error').html('<span style="color:red;"> Please Enter Your Client Secret !</span>');
      jQuery('.wepay-error').show();
      return false;
    }
    else
    { 
      document.getElementById("client_secret").style.borderColor = "#006600";    
    }
    if ($.trim(access_token).length == 0) 
    {
      document.getElementById("access_token").style.borderColor = "#E34234";
      jQuery('.wepay-error').html('<span style="color:red;"> Please Enter Your Access Token !</span>');
      jQuery('.wepay-error').show();
      jQuery('.wepay-success').hide();
      return false; 
    }
    else{ 
    
      document.getElementById("access_token").style.borderColor = "#006600";
      jQuery('.wepay-success').hide();   
    }

   if ($.trim(account_id).length == 0) 
    {
      document.getElementById("account_id").style.borderColor = "#E34234";
      jQuery('.wepay-error').html('<span style="color:red;"> Please Enter Account Id !</span>');
      jQuery('.wepay-error').show();
      return false;
    }

     else
    { 
    
     document.getElementById("account_id").style.borderColor = "#006600";
     return true;  

     }


		  });


  });
  </script>


<div id="add_wepay_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Wepay Info</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-warning wepay-error" style="display: none"></div>
        <div class="alert alert-success wepay-success" style="display: none;"></div>
        <p class="alert alert-success" style="">You need to create your account at <a href="https://go.wepay.com/">Wepay</a> to accept payments from donors.</p>
        <?php  echo $user_id; ?>
        
        <form id="wepay_info" method="post" action="">

        <div class="form-group">
          <label>Client Id</label>
          <input type="text" class="form-control" name="client_id" rows="3" placeholder="client Id" id="client_id" value="<?php echo get_the_author_meta('client_id', $user_id );?>">
        </div>

        <div class="form-group">
          <label>Client Secret</label>
          <input type="text" class="form-control" name="client_secret" rows="3" placeholder="Client Secret" id="client_secret" value="<?php echo get_the_author_meta('client_secret', $user_id );?>">
        </div>          

        <div class="form-group">
          <label>Access Token</label>
          <input type="text" class="form-control" name="access_token" rows="3" placeholder="Access Token" id="access_token" value="<?php echo get_the_author_meta('access_token' , $user_id);?>">
        </div>


       <div class="form-group">
          <label>Account Id</label>
          <input type="text" class="form-control" name="account_id" rows="3" placeholder="Email" id="account_id" value="<?php echo get_the_author_meta('account_id', $user_id); ?>">
        </div>

        <input type="submit" name="submit_wepay" id="wepay_submit" class="submit btn btn-success action-button" value="Submit" />


        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- script for change information -->


<style type="text/css">
  #add_wepay_popup .modal-header {
      background:#19bf7e none repeat scroll 0 0;
      border-bottom: 1px solid #e5e5e5;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      padding: 20px 31px;
    }

      #add_wepay_popup .modal-dialog {
          width: 450px;
          margin-top: 5%;
      }   
     #add_wepay_popup .action-button{
          width: 100px;
          background:#19bf7e;
          font-weight: bold;
          color: #fff;
          border: 2px solid transparent;
          border-radius: 1px;
          cursor: pointer;
         /* margin: 10px 5px 4px 0px;*/
          font-family: Roboto;
          letter-spacing: 0.5px;
          padding: 7px 5px;
          font-size: 15px;
    }
        #add_wepay_popup .btn_down{
          width: 156px;
          background:#19bf7e;
          font-weight: bold;
          border: 2px solid transparent;
          border-radius: 1px;
          cursor: pointer;
          /*margin: 10px 5px 4px 0px;*/
          font-family: Roboto;
          letter-spacing: 0.5px;
          padding: 7px 21px;
          font-size: 15px;
    }

    #add_wepay_popup .btn_down:hover, #add_wepay_popup .btn_down:focus, #add_wepay_popup .btn_down:active {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px#19bf7e;}
    


    #add_wepay_popup .btn_down a{color: #fff !important;text-decoration: none !important;}

    #add_wepay_popup .action-button:hover, #add_wepay_popup .action-button:focus, #add_wepay_popup .action-button:active {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px#19bf7e;
    }
</style>