
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
 </script>