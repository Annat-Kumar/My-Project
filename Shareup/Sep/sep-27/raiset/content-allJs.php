<script>
  function validationLogin(e)
  {
	   var user_login = $("#user_login").val();
	   var user_pass =  $("#user_pass").val();
	   
	   if (user_login == "")
	   {
	   $("#user_login").css({"border":"1px solid red","color":"red","margin-top":"8%"});
	   }
	   if (user_pass == ""){
		$("#user_pass").css({"border":"1px solid red","color":"red","margin-top":"8%"});
	  }
	  if (user_login != "" && user_pass == "") {
		$("#user_pass").css({"border":"1px solid red","color":"red","margin-top":"20px"});
	  }
	  if (user_login == "" || user_pass == "") {
	  $(".error-login").show();
	  $(".error-login1").hide();
	  return false;
	  }else{
		  
		  return true;
	  } 
  }
</script>
   <!---/********** Date Picker / ************-->
   <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#event_date').datepicker({
					 autoclose: true,
					 startDate: new Date(),
                    format: "dd-mm-yyyy"
                });  
            
            });
     </script>
	  <!---/********** Time Picker / ************-->
	 <script>
	  $(document).ready(function () {
		 $( '.flatpickr' ).flatpickr({
		noCalendar: true,
		enableTime: true,
		dateFormat: 'h:i K'
	  });
	 });
  </script>
  <script>
	  $(document).ready(function () {
		 $( '.flatpickr-2' ).flatpickr({
		noCalendar: true,
		enableTime: true,
		dateFormat: 'h:i K'
	  });
	 });
  </script>
<!-- </div> --><!-- .site -->


<!----------/******************************** Sign up process Ajax Script ****************************/-->
<script>
	$("#msform").submit(function(event)
	{

		var fname =   jQuery('#fname').val();
		var email =   jQuery('#uemail').val();
		var pass =    jQuery('#pass').val();
		var cpass =   jQuery('#cpass').val();
		var zipcode = jQuery('#zipcode').val();
		var phone =   jQuery('#phone').val();
		var address = jQuery('#address').val();
		
		//var actypea = jQuery('input[name=acc_type]:checked').val(); 
		//alert(actypea);
		
		if ($.trim(fname).length == 0) 
		{
			document.getElementById("fname").style.borderColor = "#E34234";
			jQuery('.fs-error').html('<span style="color:red;"> Please Enter Your Name !</span>');
			jQuery('.fs-error').show();
			return false;
		}else{ 
		
		  document.getElementById("fname").style.borderColor = "#006600";		
		}
			/*********** Validating Username *************/
			
			var numbers = /[^A-Za-z_\s]/;
			
			if (numbers.test(fname)) 
			{
				document.getElementById("fname").style.borderColor = "#E34234";		
				jQuery('.fs-error').html('<span style="color:red;"> Please enter only letters for your name !</span>');
				jQuery('.fs-error').show();	
				return false;
				
			}else{
				
				document.getElementById("fname").style.borderColor = "#006600";
				jQuery('.fs-success').html('<span style="color:green;">  Name is  is valid, please continue !</span>');
				jQuery('.fs-error').hide();
				jQuery('.fs-success').show();
			}
		
		if ($.trim(email).length == 0) 
		{
			document.getElementById("uemail").style.borderColor = "#E34234";
			jQuery('.fs-error').html('<span style="color:red;"> Please Enter Your Email !</span>');
			jQuery('.fs-error').show();
			jQuery('.fs-success').hide();
			return false;	
		}else{ 
		
		  document.getElementById("uemail").style.borderColor = "#006600";
		  jQuery('.fs-success').hide();	  
		}
		
		/*********** Validating Email *************/
		
		var emailval = jQuery('#uemail').val();
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
		// Checking Empty Fields
		var vemail = mailformat.test(emailval)
		if ($.trim(emailval).length == 0 || vemail==false) 
		{
		jQuery('.fs-error').html('<span style="color:red;"> Email is invalid !</span>');
		document.getElementById("uemail").style.borderColor = "#E34234";
		jQuery('.fs-error').show();
		return false;
		}
		else{
		document.getElementById("uemail").style.borderColor = "#006600";	
		jQuery('.fs-error').hide();
		jQuery('.fs-success').hide();
		//return true;
		}
		
		
		if ($.trim(pass).length == 0) 
		{
			document.getElementById("pass").style.borderColor = "#E34234";
			jQuery('.fs-error').html('<span style="color:red;"> Please Enter Your Password !</span>');
			jQuery('.fs-error').show();
			return false;	
		}else{ 
		
		  document.getElementById("pass").style.borderColor = "#006600";		
		}
		
		if ($.trim(cpass).length == 0) 
		{
			document.getElementById("cpass").style.borderColor = "#E34234";
			jQuery('.fs-error').html('<span style="color:red;"> Please Confirm Your Password !</span>');
			jQuery('.fs-error').show();
			return false;	
		}else{ 
		
		  document.getElementById("cpass").style.borderColor = "#006600";		
		}
		
		if (pass != cpass || pass == '') 
		{
			//alert("Passwords Do not match");
			document.getElementById("pass").style.borderColor = "#E34234";
			document.getElementById("cpass").style.borderColor = "#E34234";
			jQuery('.fs-error').html('<span style="color:red;"> Passords do not match !</span>');
			jQuery('.fs-error').show();
			return false;    	
		}
		
		if ($.trim(zipcode).length == 0) 
		{
			document.getElementById("zipcode").style.borderColor = "#E34234";
			jQuery('.fs-error').html('<span style="color:red;"> Please Enter Your Zipcode !</span>');
			jQuery('.fs-error').show();
			return false;
		}else{ 
		
		  document.getElementById("zipcode").style.borderColor = "#006600";		
		}
		
		
		/*********** Validating Zipcode *************/
			var zipCheck = /[^0-9\.]/;
			
			if (zipCheck.test(zipcode)) 
			{
				document.getElementById("zipcode").style.borderColor = "#E34234";		
				jQuery('.fs-error').html('<span style="color:red;"> Please enter only valid zipcode !</span>');
				jQuery('.fs-error').show();	
				return false;
				
			}else{
				
				document.getElementById("zipcode").style.borderColor = "#006600";
				jQuery('.fs-error').hide();		    
			}
		
		
		if ($.trim(phone).length == 0) 
		{
			document.getElementById("phone").style.borderColor = "#E34234";
			jQuery('.fs-error').html('<span style="color:red;"> Please Enter Phone Number !</span>');
			jQuery('.fs-error').show();
			return false;
		}else{ 
		
		  document.getElementById("phone").style.borderColor = "#006600";		
		}
		
		/*********** Validating Phone Number *************/
		
			var phoneCheck = /[^0-9\.]/;
			
			if (phoneCheck.test(phone)) 
			{
				document.getElementById("phone").style.borderColor = "#E34234";		
				jQuery('.fs-error').html('<span style="color:red;"> Please enter valid phone number !</span>');
				jQuery('.fs-error').show();	
				return false;
				
			}else{
				
				document.getElementById("phone").style.borderColor = "#006600";
				jQuery('.fs-error').hide();		    
			}
		
		if ($.trim(address).length == 0) 
		{
			document.getElementById("address").style.borderColor = "#E34234";
			jQuery('.fs-error').html('<span style="color:red;"> Please Enter Your Address !</span>');
			jQuery('.fs-error').show();
			return false;
			
		}else{
		
		  document.getElementById("address").style.borderColor = "#006600";
		  
		  event.preventDefault();
		   
		  jQuery('.fs-error').hide();
		  
		  var utype = jQuery('input[name=acc_type]:checked').val();
		  //alert(utype);
		  var fname   = jQuery('#fname').val();
		  var email   = jQuery('#uemail').val();
		  var pass    = jQuery('#pass').val();
		  var uzip    = jQuery('#zipcode').val();
		  var uphone  = jQuery('#phone').val();
		  var address = jQuery('#address').val();
		  
		  //Getting Retailer/Fundraiser Form Data
		  
		  // Get Retailer form data
		  var buis_name             = jQuery('#buis_name').val();
		  var buis_address          = jQuery('#buis_address').val();
		  var buis_address_other    = jQuery('#buis_address_other').val();
		  var buis_description      = jQuery('#buis_description').val();
		  //var buis_s_date           = jQuery('#datepicker').val();
		  //var buis_e_date           = jQuery('#datepicker1').val();
		  //var buis_img              = jQuery('#buis_img').val();
		   //var buis_img              = jQuery('#buis_img').val().split('.').pop().toLowerCase();
		   
		   //var fd = new FormData();
           //fd.append( "buis_img", $('#buis_img')[0].files[0]);
           //fd.append( "action", 'check_user_signup');      
		  
          //alert(buis_img);
		  
		  // Get Fundraiser Form data
		  
		  var fund_name             = jQuery('#fund_name').val();
		  var fund_address          = jQuery('#fund_address').val();
		  var fund_address_other    = jQuery('#fund_other_addres').val();
		  var fund_description      = jQuery('#fund_description').val();
		  
		  var fund_s_date           = jQuery('#event_date').val();
		  var fund_s_time           = jQuery('#fund_s_time').val();
		  var fund_e_time           = jQuery('#fund_e_time').val();
		  var fund_cat_name         = jQuery('#cat :selected').val();
				
		  var url='<?php echo admin_url('admin-ajax.php'); ?>';
		  
		  jQuery.ajax({
					url :url ,
					type : 'post',
					dataType: 'json',
					//processData: false,
                    //contentType: false,
					data : {
						action : 'check_user_signup',
						user_login: fname,
						user_email: email,
						user_pass:  pass,
						user_zip :  uzip,
						user_phone: uphone,
						user_adres: address,
						user_type : utype,
						buis_name : buis_name,
						buis_address : buis_address,
						buis_address_other : buis_address_other,
						buis_description : buis_description,
						//buis_s_date    : buis_s_date,
						//buis_e_date    : buis_e_date,
						//buis_img         : fd,
						fund_name        : fund_name,
                        fund_address     : fund_address,
						fund_address_other : fund_address_other,
						fund_description   : fund_description,
						fund_cat_name    : fund_cat_name,
						fund_s_date      : fund_s_date,
						fund_s_time      : fund_s_time,
						fund_e_time      : fund_e_time
					},

					success : function( response ) 
					{

						if (response == 1) 
						{
							
							document.getElementById("fname").style.borderColor = "#E34234";
							jQuery('.fs-error').html('<span style="color:red;"> Username is already registered !</span>');
							jQuery('.fs-error').show();
							
						}else if (response == 2) 
						{		
							document.getElementById("uemail").style.borderColor = "#E34234";
							jQuery('.fs-error').html('<span style="color:red;"> Email address is already registered !</span>');
							jQuery('.fs-error').show();
							 							
						}else{
							
							jQuery('.fs-error').hide();
							jQuery('.fs-success').html('<span style="color:green;"> You are successfully registered, now redirecting.... !</span>');	
							jQuery('.fs-success').show();

							// Hide it after 5 seconds
							setTimeout(function()
							{
								$.LoadingOverlay("show", {
								image       : "",
								fontawesome : "fa fa-spinner fa-spin"
							  });
							  
							    $('#myModal2').modal('hide');
								window.location.href = "<?php echo home_url();?>";
								$.LoadingOverlay("hide");
							}, 5000);
															
							}
					}
			});
		
		}
	});
</script>

<!------------------------******************* Sign up ends here *******************------------------------->



<!------------------ Login Form Email Check ----------------------->
<script type="text/javascript">

$('#user_login').on('keyup', function(){

var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
   
   if( !emailReg)
     {
        document.getElementById("user_login").style.borderColor = "#E34234";
		document.getElementById("red-check").style.backgroundColor = "#E34234";
		document.getElementById("red-check").style.color = "#fff";

     } 

   else
    {
     	document.getElementById("user_login").style.borderColor = "#006600";
		document.getElementById("red-check").style.backgroundColor = "#27AE60";
		document.getElementById("red-check").style.color = "#fff";  
    }

});



$('#user_pass').on('keyup', function(){

var upass  =   jQuery('#user_pass').val();
   
   if($.trim(upass).length == 0)
     {
        document.getElementById("user_pass").style.borderColor = "#E34234";
		document.getElementById("error-red").style.backgroundColor = "#E34234";
		document.getElementById("error-red").style.color = "#fff";

     } 

   else
    {
     	document.getElementById("user_pass").style.borderColor = "#006600";
		document.getElementById("error-red").style.backgroundColor = "#27AE60";
		document.getElementById("error-red").style.color = "#fff";  
    }


});

$("#user_login").focusout(function() {

var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
   
   if( !emailReg)
     {
        document.getElementById("user_login").style.borderColor = "#E34234";
		document.getElementById("red-check").style.backgroundColor = "#E34234";
		document.getElementById("red-check").style.color = "#fff";

} 
else
    {
     	document.getElementById("user_login").style.borderColor = "#006600";
		document.getElementById("red-check").style.backgroundColor = "#27AE60";
		document.getElementById("red-check").style.color = "#fff";  
    }
});

</script>

<!------------------ Login Form Code Ends Here ----------------------->


<!------------------   Forget password Start code here ------------------>

<script type="text/javascript">
     $('.forgetsend').click( function(event) 
 { 
     var email1 = $(".foergetinput > #user_login").val();
     if (email1 == "")
      {
     	$(".error-login-sin1").show();
     	$("#user_login").addClass("input_color");
        $(".hidde").hide();
        return false;
       } 
      else
      {
       $(".hidde").show();
       $(".error-login-sin1").hide();
       }

   event.preventDefault();


  var email1 = $(".foergetinput > #user_login").val();

  var url='<?php echo admin_url('admin-ajax.php'); ?>';

  var uri= <?php home_url();?>$.ajax({
      url :url ,type : 'post',
	  data : {action : 'forget_password',user_login: email1,},
      success : function( response ) 
	  {
	  $(".piereg_warning").html(response);
	  }
	  });
	  });
</script>

<!------------------   Forget password End code here ------------------>