      <?php

      $get_current_user = wp_get_current_user();

      $user_ids = $get_current_user->ID;
      $username = $get_current_user->user_nicename;


      if(isset($_POST['chng_submit']))
      {
        $user_chngfirstname = $_POST['chn_firstname'];
       $user_chnglastname  = $_POST['chn_lastname'];
        //$user_chngemail     = $_POST['user_email'];
        $user_chngphn       = $_POST['chn_contact'];

    
      update_user_meta( $user_ids, 'first_name', $user_chngfirstname );
      update_user_meta( $user_ids, 'last_name', $user_chnglastname );
      update_user_meta( $user_ids, 'user_phone', $user_chngphn );

     header("location:".site_url()."/user/".$username);
      }



      ?>


<div id="edit_info_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Info</h4>
      </div>
      <div class="modal-body">

        <div class="alert alert-warning info-error" style="display: none"></div>
        <div class="alert alert-success info-success" style="display: none;"></div>
        
        <form id="change_info" method="post" action="#">

        <div class="form-group">
          <label>First Name</label>
          <input type="text" class="form-control" name="chn_firstname" rows="3" placeholder="First Name" id="chn_firstname" value="<?php echo ucfirst(get_the_author_meta('first_name', $user_ids ));?>">
        </div>

        <div class="form-group">
          <label>Last Name</label>
          <input type="text" class="form-control" name="chn_lastname" rows="3" placeholder="Last Name" id="chn_lastname" value="<?php echo ucfirst(get_the_author_meta('last_name', $user_ids ));?>">
        </div>          

        <div class="form-group">
          <label>Email</label>
          <input disabled class="form-control" name="chn_email" rows="3" placeholder="Email" id="chn_email" value="<?php echo get_the_author_meta('email', $user_ids); ?>">
        </div>

        <div class="form-group">
          <label>Contact No</label>
          <input type="text" class="form-control" name="chn_contact" rows="3" placeholder="Contact" id="chn_contact" value="<?php echo get_usermeta($user_ids , $meta_key = 'user_phone' );?>">
        </div>

        <div class="div_btn">
        <ul class="list-unstyled list-inline info-butt"> 
          <li>
        <input type="submit" id="sub_chnge_info" name="chng_submit" class="submit btn btn-success action-button" value="Submit" />
          </li>
          <li class="btn_down">
            <?php echo do_shortcode( '[plugin_delete_me /]' ); ?>
          </li>
        </ul>
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- script for change information -->
  <script>
  $( document ).ready(function() {

  $("#sub_chnge_info").click(function(event)
  {

    var chn_firstname = jQuery('#chn_firstname').val();
    var chn_lastname  =   jQuery('#chn_lastname').val();
    var chn_email     =   jQuery('#chn_email').val();
    var chn_contact   =    jQuery('#chn_contact').val();


    if ($.trim(chn_firstname).length == 0) 
    {
      document.getElementById("chn_firstname").style.borderColor = "#E34234";
      jQuery('.info-error').html('<span style="color:red;"> Please Enter Your First Name !</span>');
      jQuery('.info-error').show();
      return false;
    }
    else
    { 
      document.getElementById("chn_firstname").style.borderColor = "#006600";    
    }

    var numbers = /[^A-Za-z_\s]/;
      
    if (numbers.test(chn_firstname)) 
      {
        document.getElementById("chn_firstname").style.borderColor = "#E34234";    
        jQuery('.info-error').html('<span style="color:red;"> Please Enter Only Letters For Your First Name !</span>');
        jQuery('.info-error').show(); 
        return false;
        
    }
    else
    {
        document.getElementById("chn_firstname").style.borderColor = "#006600";
        jQuery('.info-error').hide();
    }


    if ($.trim(chn_lastname).length == 0) 
    {
      document.getElementById("chn_lastname").style.borderColor = "#E34234";
      jQuery('.info-error').html('<span style="color:red;"> Please Enter Your Last Name !</span>');
      jQuery('.info-error').show();
      return false;
    }
    else
    { 
      document.getElementById("chn_lastname").style.borderColor = "#006600";    
    }
      
    if (numbers.test(chn_lastname)) 
      {
        document.getElementById("chn_lastname").style.borderColor = "#E34234";    
        jQuery('.info-error').html('<span style="color:red;"> Please Enter Only Letters For Your Last Name !</span>');
        jQuery('.info-error').show(); 
        return false;
        
    }
    else
    {
        document.getElementById("chn_lastname").style.borderColor = "#006600";
        jQuery('.info-error').hide();
    }


    if ($.trim(chn_email).length == 0) 
    {
      document.getElementById("chn_email").style.borderColor = "#E34234";
      jQuery('.info-error').html('<span style="color:red;"> Please Enter Your Email !</span>');
      jQuery('.info-error').show();
      jQuery('.info-success').hide();
      return false; 
    }else{ 
    
      document.getElementById("chn_email").style.borderColor = "#006600";
      jQuery('.info-success').hide();   
    }
    
    /*********** Validating Email *************/
    
    var emailval = jQuery('#chn_email').val();
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
    // Checking Empty Fields
    var vemail = mailformat.test(emailval)
    if ($.trim(emailval).length == 0 || vemail==false) 
    {
    jQuery('.info-error').html('<span style="color:red;"> Email is invalid !</span>');
    document.getElementById("chn_email").style.borderColor = "#E34234";
    jQuery('.info-error').show();
    return false;
    }
    else{
    document.getElementById("chn_email").style.borderColor = "#006600";  
    jQuery('.info-error').hide();
    //return true;
    }   

   if ($.trim(chn_contact).length == 0) 
    {
      document.getElementById("chn_contact").style.borderColor = "#E34234";
      jQuery('.info-error').html('<span style="color:red;"> Please Enter Phone Number !</span>');
      jQuery('.info-error').show();
      return false;
    }else{ 
    
      document.getElementById("chn_contact").style.borderColor = "#006600";   
    }
    
    /*********** Validating Phone Number *************/
    
      var phoneCheck = /[^0-9\.]/;
      
      if (phoneCheck.test(chn_contact)) 
      {
        document.getElementById("chn_contact").style.borderColor = "#E34234";   
        jQuery('.info-error').html('<span style="color:red;"> Please Enter Valid Phone Number !</span>');
        jQuery('.info-error').show(); 
        return false;
        
      }
      else
      {
        document.getElementById("chn_contact").style.borderColor = "#006600";
        jQuery('.info-error').hide(); 
        jQuery('.info-success').show();
        jQuery('.info-success').html('<span style="color:green;">Congratulations, you are successfully updated your info.</span>');  
        return true;


      }


/*        event.preventDefault();

    var chn_firstname = jQuery('#chn_firstname').val();
    var chn_lastname  =   jQuery('#chn_lastname').val();
    var chn_email     =   jQuery('#chn_email').val();
    var chn_contact   =    jQuery('#chn_contact').val();


        var url='<?php echo admin_url('admin-ajax.php'); ?>';

            jQuery.ajax({
            url :url ,
            type : 'post',
            dataType: 'json',
            data : {
            action : 'edit_profile',
            first_name: chn_firstname,
            last_name: chn_lastname,
            user_email: chn_email,
            user_phone: chn_contact,
          },
          success : function( response ) 
          {
              jQuery('.info-error').hide(); 
              jQuery('.info-success').show();
              jQuery('.info-success').html('<span style="color:green;">Congratulations, you are successfully updated your info.</span>');  
                           
              setTimeout(function()
              {
                $.LoadingOverlay("show", {
                image       : "",
                fontawesome : "fa fa-spinner fa-spin"
                });
                $.LoadingOverlay("hide");
                window.location.href = "<?php echo home_url();?>/user";

              }, 2000);                                                            
          }


      });*/
            }



  });
 });
  </script>



<style type="text/css">
  #edit_info_popup .modal-header {
      background:#19bf7e none repeat scroll 0 0;
      border-bottom: 1px solid #e5e5e5;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      padding: 20px 31px;
    }

      #edit_info_popup .modal-dialog {
          width: 450px;
          margin-top: 5%;
      }   
    #edit_info_popup .action-button{
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
        #edit_info_popup .btn_down{
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

    #edit_info_popup .btn_down:hover, #edit_info_popup .btn_down:focus, #edit_info_popup .btn_down:active {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px#19bf7e;}
    


    #edit_info_popup .btn_down a{color: #fff !important;text-decoration: none !important;}

    #edit_info_popup .action-button:hover, #edit_info_popup .action-button:focus, #edit_info_popup .action-button:active {
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px#19bf7e;
    }
</style>