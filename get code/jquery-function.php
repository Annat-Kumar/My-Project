
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