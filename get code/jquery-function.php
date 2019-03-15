
<script>

jQuery.noConflict();	
var no_confilct = $.noConflict();	
	
swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false 
    },
    function(isConfirm) {
        if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    }
);

$(document).ready(function () {                                                                      
                  var ask = window.confirm("Are you 21 years of age ?");
   					 if (ask) {
        			window.alert("You can check CBD product.");                  
                    }
                  else {
                    window.alert("Sorry! You are not authorized."); 
                    window.location.href = "https://paradisevt.com/";
                  }
                })
				
</script>
<script>

$('#product_cat').bind('focusout', function() { 
			
			category_value = $("#product_cat").val();
			if(category_value !='')
			{
				$("#product_cat").removeClass('bordered'); 		
			}
			else {
				$("#product_cat").addClass('bordered');
			}
		});
		
		
</script>

<script>
jQuery("#stripe_payment_form").validate({
      errorElement: "span",
      errorClass: "help-inline-error",
        rules: {
    phone: "required",
	dob: "required",
	address1: "required",
	address2: "required",
	city: "required",
	state: "required",
	zip: "required",
	country: "required",
	accountholder_name: "required",
	routing_number: "required",
	account_number: "required",
	confirm_account_number :{
		reuired :true,
		equalTo : "#account_number",
	},
    messages: {
                account_number: "account number should not be blank",
                confirm_account_number: " account no. and confirm account no. should be same.",
            }
    }
    });
	
	jQuery('.na').attr('readonly', true);
	$(#input').removeAttr('readonly');
	jQuery(".na").prop("disabled", true);
	( "#x" ).prop( "disabled", false );
	  

	var text_max = 140;
    jQuery('#textarea_limit').html(text_max + ' characters remaining');

    jQuery('#textarea_job').keyup(function() {
        var text_length = jQuery('#textarea_job').val().length;
        var text_remaining = text_max - text_length;

        jQuery('#textarea_limit').html(text_remaining + ' characters remaining');
    });	 

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

         });	
</script>