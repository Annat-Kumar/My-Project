  <script>
$(document).ready(function() 
{

  $('.nav > li > ul').hide();  

  $('.nav > li:has(ul)').addClass('accordion');  
  $('.nav > li:has(ul) > a').click(function() {

    $(this).toggleClass('accordionExpanded'); 

    $(this).next('ul').slideToggle('slow');

    $(this).parent().siblings('li').children('ul:visible').slideUp('slow')
    .parent('li').find('a').removeClass('accordionExpanded');

    $(".nav > li.active").removeClass("active");

    return false;
  });

  $('.nav > li > a').click(function(){

  //$(this).next('ul').slideToggle('slow');
  $(this).parent().siblings('li').children('ul:visible').hide('slow')
  .parent('li').find('a').removeClass('accordionExpanded');

});
  $(".table-condensed").addClass("calender_table");
  $('.back_table').css('background-image', 'url(<?php echo site_url();?>/wp-content/uploads/2017/11/local.jpg)');
});
</script>
<script>
$(document).ready(function(){

$(this).scrollTop(0);

});

</script> 



    <!-- author all script -->

    <script>

      $(document).ready(function(){
        var minlength = 5;
        $('#search-input_deny').keyup(function(){
          var zip_code = $('#search-input_deny').val();
          if (zip_code.length >= minlength ) 
          {
            var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";

            $.post(ajaxUrl,{
   type: 'POST',
   action:"author_search_retaile",
   zip_codes : zip_code,

   beforeSend: function() 
   {
    jQuery('#deny_dvLoading').show();    
  },

}).success(function(posts){


  jQuery('#deny_dvLoading').hide();

  setTimeout(function()
  {
$("#deny_show_results").html(posts); 
$(".fieldset_4").addClass("fieldset_44");
}, 1000); 
});
}

});
      });
    </script>

<script>
            jQuery(document).ready(function() {
              function close_accordion_section() {
                jQuery('.accordions .accordion-section-title').removeClass('active');
                jQuery('.accordions .accordion-section-content').slideUp(300).removeClass('open');
              }

              jQuery('.accordion-section-title').click(function(e) {
// Grab current anchor value
var currentAttrValue = jQuery(this).attr('href');

if(jQuery(e.target).is('.active')) 
{
  close_accordion_section();
}else {
  close_accordion_section();

  // Add active class to section title
  jQuery(this).addClass('active');
  // Open up the hidden content panel
  jQuery('.accordions ' + currentAttrValue).slideDown(300).addClass('open'); 
}

e.preventDefault();
});
});
</script>



<!-- Approve and Disapprove -->

<script>
$(document).ready(function()
{
$("#dissaproved_event .approve_disapprove").click(function(event)
{ 
event.preventDefault();

var r_id_new        = $('#rid_new').val();
var f_id_new        = $('#f_id_new').val();
var f_email_new     = $('#f_email_new').val();
var f_title_new     = $('#f_title_new').val();
var f_auth_name_new = $('#f_auth_name_new').val();


var divid = $('#divid').val();
var app_disapp_val = $('#app_disapp_val').val();

var url='<?php echo admin_url('admin-ajax.php'); ?>';     
$.ajax({
  url :url ,
  type : 'post',
      //dataType: 'json',
      data : {
        action      : 'approve_disapprove_event',
        //Approve Data
        r_id_new    : r_id_new,
        f_id_new    : f_id_new,
        f_email_new : f_email_new,
        f_title_new : f_title_new,
        f_auth_name_new : f_auth_name_new,
        
        //Get Div id and select button values
        divid : divid,
        app_disapp_val :app_disapp_val  
      },
      
      beforeSend: function() 
      {
                   //jQuery('#msform #dvLoading').show(); 

                   setTimeout(function()
                   {
                    jQuery.LoadingOverlay("show", {
                      image       : "",
                      fontawesome : "fa fa-spinner fa-spin"
                    });
                    
                    
                    jQuery.LoadingOverlay("hide");
                    
                    
                  }, 1000);  

                   
                   
                 },

                 success : function(response) 
                 {

                  var str = response;
                  var arr = str.split("-");
                  
                  var rid = arr[0];
                  
                  var fid = arr[1];
                  
                  jQuery(".myvalue").load("<?php  echo "https://" . $_SERVER['SERVER_NAME'];?>/return-data/",{r_id: rid, f_id: fid});
                  jQuery('#dissaproved_event').modal('hide');
                  
                }
              });
});
});
</script>
<script>
// Coupon Code Functionality 
$(document).ready(function()
{
$("#discount_text_coupen_10").keyup(function(){

  var text1 = $("#discount_text_coupen_10").val();
  document.getElementById('discount_selct_text_new').value = text1;
});
$("#discount_text_coupen_20").keyup(function(Text){
  var text2 = $("#discount_text_coupen_20").val();
  document.getElementById('discount_selct_text_new').value = text2;
});
$("#discount_text_coupen_30").keyup(function(Text){
  var text3 = $("#discount_text_coupen_30").val();
  document.getElementById('discount_selct_text_new').value = text3;
});
$("#discount_text_coupen_40").keyup(function(Text){
  var text4 = $("#discount_text_coupen_40").val();
  document.getElementById('discount_selct_text_new').value = text4;
});
$("#discount_text_coupen_50").keyup(function(Text){
  var text5 = $("#discount_text_coupen_50").val();
  document.getElementById('discount_selct_text_new').value = text5;
});
$("#free_coupen").keyup(function(Text){
  var text6 = $("#free_coupen").val();
  document.getElementById('discount_selct_text_new').value = text6;
});
$("#custom_coupen").keyup(function(Text){
  var text7 = $("#custom_coupen").val();
  document.getElementById('discount_selct_text_new').value = text7;
});

function makeid() {

  var text = "";

  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

  for (var i = 0; i < 8; i++)

    text += possible.charAt(Math.floor(Math.random() * possible.length));
  return text;
}

//alert(makeid());

/*    $(document).ready(function(){*/

  var cc_10 =  $('#discount_text_coupen_10').val();

  var cc_20 =  $('#discount_text_coupen_20').val();

  var cc_30 =  $('#discount_text_coupen_30').val();

  var cc_40 =  $('#discount_text_coupen_40').val();

  var cc_50 =  $('#discount_text_coupen_50').val();

  var free_coupon  =  $('#free_coupen').val();

  var custom_coupen = $('#custom_coupen').val();

  if(cc_10=='')
  {
    $('#discount_text_coupen_10').prop('disabled',true);
  }else {

    $('#discount_text_coupen_10').prop('disabled',false);
  }

  if(cc_20=='')
  {
    $('#discount_text_coupen_20').prop('disabled',true);
  }else { 

    $('#discount_text_coupen_20').prop('disabled',false);
  }

  if(cc_30=='')
  {
    $('#discount_text_coupen_30').prop('disabled',true);

  }else{

    $('#discount_text_coupen_30').prop('disabled',false);
  } 

  if(cc_40=='')
  {
    $('#discount_text_coupen_40').prop('disabled',true);

  }else{

    $('#discount_text_coupen_40').prop('disabled',false);
  }

  if(cc_50=='')
  {
    $('#discount_text_coupen_50').prop('disabled',true);

  }else{

    $('#discount_text_coupen_50').prop('disabled',false);
  }


  if(free_coupon=='')
  {
    $('#free_coupen').prop('disabled',true);

  }
  else{

    $('#free_coupen').prop('disabled',false);
  }

  if(custom_coupen=='')
  {
    $('#custom_coupen').prop('disabled',true);

  }
  else{

    $('#custom_coupen').prop('disabled',false);
  }

  $("input[name='discount']").on('change', function() {

    var codeVal = $('input[name=discount]:checked').val();

    if(codeVal) 
    {
    //alert(codeVal); 

    var cc = makeid();

    $('#coupen_code').val(cc);

    $('#coupen_code_new').val(cc);

    $('#discount_selct').val(codeVal);

    if(codeVal == 'coupen_10')
    {

      //alert("1");
      $('#discount_text_coupen_10').prop('disabled',false);

      $('#discount_text_coupen_20').prop('disabled',true);

      $('#discount_text_coupen_30').prop('disabled',true);

      $('#discount_text_coupen_40').prop('disabled',true);

      $('#discount_text_coupen_50').prop('disabled',true);
      
      $('#free_coupen').prop('disabled',true);

      $('#custom_coupen').prop('disabled',true);

      $('#extra_benefit').prop('disabled',true);

      document.getElementById('discount_text_coupen_20').value = "";
      document.getElementById('discount_text_coupen_30').value = "";
      document.getElementById('discount_text_coupen_40').value = "";
      document.getElementById('discount_text_coupen_50').value = "";
      document.getElementById('free_coupen').value = "";
      document.getElementById('custom_coupen').value = "";
      $("#discount_text_coupen_10").focus();




    }
    else if(codeVal == 'coupen_20'){

      $('#discount_text_coupen_20').prop('disabled',false);

      $('#discount_text_coupen_10').prop('disabled',true);

      $('#discount_text_coupen_30').prop('disabled',true);

      $('#discount_text_coupen_40').prop('disabled',true);

      $('#discount_text_coupen_50').prop('disabled',true);
      
      $('#free_coupen').prop('disabled',true);

      $('#custom_coupen').prop('disabled',true);

      $('#extra_benefit').prop('disabled',true);

      document.getElementById('discount_text_coupen_10').value = "";
      document.getElementById('discount_text_coupen_30').value = "";
      document.getElementById('discount_text_coupen_40').value = "";
      document.getElementById('discount_text_coupen_50').value = "";
      document.getElementById('free_coupen').value = "";
      document.getElementById('custom_coupen').value = "";
      document.getElementById('extra_benefit').value = "";
      $("#discount_text_coupen_20").focus();


    }
    else if(codeVal == 'coupen_30'){

      $('#discount_text_coupen_30').prop('disabled',false);

      $('#discount_text_coupen_10').prop('disabled',true);

      $('#discount_text_coupen_20').prop('disabled',true);

      $('#discount_text_coupen_40').prop('disabled',true);

      $('#discount_text_coupen_50').prop('disabled',true);
      
      $('#free_coupen').prop('disabled',true);

      $('#custom_coupen').prop('disabled',true);

      $('#extra_benefit').prop('disabled',true);

      document.getElementById('discount_text_coupen_20').value = "";
      document.getElementById('discount_text_coupen_10').value = "";
      document.getElementById('discount_text_coupen_40').value = "";
      document.getElementById('discount_text_coupen_50').value = "";
      document.getElementById('free_coupen').value = "";
      document.getElementById('custom_coupen').value = "";
      document.getElementById('extra_benefit').value = "";
      $("#discount_text_coupen_30").focus();



    }
    else if(codeVal == 'coupen_40'){

      $('#discount_text_coupen_40').prop('disabled',false);

      $('#discount_text_coupen_10').prop('disabled',true);

      $('#discount_text_coupen_20').prop('disabled',true);

      $('#discount_text_coupen_30').prop('disabled',true);

      $('#discount_text_coupen_50').prop('disabled',true);
      
      $('#free_coupen').prop('disabled',true);

      $('#custom_coupen').prop('disabled',true);

      $('#extra_benefit').prop('disabled',true);

      document.getElementById('discount_text_coupen_20').value = "";
      document.getElementById('discount_text_coupen_30').value = "";
      document.getElementById('discount_text_coupen_10').value = "";
      document.getElementById('discount_text_coupen_50').value = "";
      document.getElementById('free_coupen').value = "";
      document.getElementById('custom_coupen').value = "";
      document.getElementById('extra_benefit').value = "";
      
      $("#discount_text_coupen_40").focus();


    }
    else if(codeVal == 'coupen_50'){

      $('#discount_text_coupen_50').prop('disabled',false);

      $('#discount_text_coupen_10').prop('disabled',true);

      $('#discount_text_coupen_20').prop('disabled',true);

      $('#discount_text_coupen_30').prop('disabled',true);

      $('#discount_text_coupen_40').prop('disabled',true);
      
      $('#free_coupen').prop('disabled',true);

      $('#custom_coupen').prop('disabled',true);

      $('#extra_benefit').prop('disabled',true);


      document.getElementById('discount_text_coupen_20').value = "";
      document.getElementById('discount_text_coupen_30').value = "";
      document.getElementById('discount_text_coupen_40').value = "";
      document.getElementById('discount_text_coupen_10').value = "";
      document.getElementById('free_coupen').value = "";
      document.getElementById('custom_coupen').value = "";
      document.getElementById('extra_benefit').value = "";
      $("#discount_text_coupen_50").focus();


    }
    else if(codeVal == 'free_coupon'){

      $('#free_coupen').prop('disabled',false);

      $('#discount_text_coupen_50').prop('disabled',true);

      $('#discount_text_coupen_10').prop('disabled',true);

      $('#discount_text_coupen_20').prop('disabled',true);

      $('#discount_text_coupen_30').prop('disabled',true);

      $('#discount_text_coupen_40').prop('disabled',true);

      $('#custom_coupen').prop('disabled',true);

      $('#extra_benefit').prop('disabled',true);
      
      


      document.getElementById('discount_text_coupen_20').value = "";
      document.getElementById('discount_text_coupen_30').value = "";
      document.getElementById('discount_text_coupen_40').value = "";
      document.getElementById('discount_text_coupen_50').value = "";
      document.getElementById('discount_text_coupen_10').value = "";
      document.getElementById('custom_coupen').value = "";
      document.getElementById('extra_benefit').value = "";
      $("#free_coupen").focus();


    }

    else if(codeVal == 'custom_coupon'){

      //alert(codeVal);

      $('#custom_coupen').prop('disabled',false);

      $('#discount_text_coupen_50').prop('disabled',true);

      $('#discount_text_coupen_10').prop('disabled',true);

      $('#discount_text_coupen_20').prop('disabled',true);

      $('#discount_text_coupen_30').prop('disabled',true);

      $('#discount_text_coupen_40').prop('disabled',true);

      $('#free_coupen').prop('disabled',true);

      $('#extra_benefit').prop('disabled',false);
      
      

      document.getElementById('discount_text_coupen_20').value = "";
      document.getElementById('discount_text_coupen_30').value = "";
      document.getElementById('discount_text_coupen_40').value = "";
      document.getElementById('discount_text_coupen_50').value = "";
      document.getElementById('discount_text_coupen_10').value = "";
      document.getElementById('free_coupen').value = "";
      $("#extra_benefit").focus();


    }


  }
});

$(".btn-act").click(function(event){

var coupen_code  = $("#coupen_code").val();

var discount_selct_text_new  = $("#discount_selct_text_new").val();

var discount_disable = $("#discount_selct_text_new").is(":disabled");

var extra_benefit = $("#extra_benefit").val();

var disabled = $("#extra_benefit").is(":disabled");

var rr_id_new = $("#get_reat_id").val();

var ff_id_new = $("#get_fund_id").val();

if(coupen_code == '')
{
document.getElementById("coupen_code").style.borderColor = "#E34234"; 
jQuery('.fs-error').html('<span style="color:red;"> Select Coupons For Donors !</span>');
jQuery('.fs-error').show();  
return false;   
}
else
{ 
document.getElementById("coupen_code").style.borderColor = "#006600";  
} 

if(disabled)
{

}

else
{

if(extra_benefit == '')
{
  document.getElementById("extra_benefit").style.borderColor = "#E34234"; 
  jQuery('.fs-error').html('<span style="color:red;"> Please input  the extra benefit discount, for e.g $5 OFF.</span>');
  jQuery('.fs-error').show();  
  return false;   
}
else
{ 
  document.getElementById("extra_benefit").style.borderColor = "#006600";  
} 
}


if(discount_disable)
{
}
else{

if(discount_selct_text_new == '')
{
  document.getElementById("discount_selct_text_new").style.borderColor = "#E34234"; 
  jQuery('.fs-error').html('<span style="color:red;"> Please input  the retailer items for which you want to provide discount, for e.g Apparels ,food etc.</span>');
  jQuery('.fs-error').show();  
  return false;   
}
else
{ 
  document.getElementById("discount_selct_text_new").style.borderColor = "#006600";  

  event.preventDefault();
  
var coupen_code  = $("#coupen_code").val();

var discount_selct_text_new  = $("#discount_selct_text_new").val();

var extra_benefit = $("#extra_benefit").val();

var rr_id_new = $("#get_reat_id").val();

var ff_id_new = $("#get_fund_id").val();

var discount_selct = $("#discount_selct").val();




  
  var url='<?php echo admin_url('admin-ajax.php'); ?>';     
  $.ajax({
    url :url ,
    type : 'post',
      //dataType: 'json',
      data : {
        action      : 'accept_fundraiser_request',
        //Approve Data

        coupen_code : coupen_code, 

        discount_selct_text_new : discount_selct_text_new,

        extra_benefit : extra_benefit,

        discount_selct : discount_selct,

        rr_id_new : rr_id_new,

        ff_id_new : ff_id_new
        
      },
      
      beforeSend: function() 
      {
                   //jQuery('#msform #dvLoading').show(); 

                   setTimeout(function()
                   {
                    jQuery.LoadingOverlay("show", {
                      image       : "",
                      fontawesome : "fa fa-spinner fa-spin"
                    });
                    
                    
                    jQuery.LoadingOverlay("hide");
                    
                    
                  }, 1000);  

                 },

                 success : function(response) 
                 {

        //alert(response);  
        
        var str = response;
        var arr = str.split("-");
        
        var rid = arr[0];
        
        var fid = arr[1];
        
        jQuery(".myvalue").load("<?php  echo "https://" . $_SERVER['SERVER_NAME'];?>/return-data/",{r_id: rid, f_id: fid});
        
        jQuery('#accept_deny').modal('hide');
        
      }
    });



} 
}
//return false;
});




});

</script>

<!-- script for show deny popup -->

<script>
$('input[name="new_status"]').change(function() 
{
if($(this).is(':checked') && $(this).val() == 'deny') 
{
$('#deny_request').modal('show');
}
});
</script>


<script>

$('input[name="status"]').change(function() 
{
if($(this).is(':checked') && $(this).val() == 'disapprove') 
{
$('#edit').modal('show');
var chnage_time_req    = $(this).val();
var email = $(this).attr("data-email");
var e_id = $(this).attr("data-id");
var r_id = $(this).attr("data-rid");
var e_title = $(this).attr("data-title");
var f_auth_name = $(this).attr("data-fauthname");

$('#email').val(email);
$('#e_id').val(e_id);
$('#r_id').val(r_id);
$('#e_title').val(e_title);
$('#f_auth_name').val(f_auth_name);
$('#chnage_time_req').val(chnage_time_req);

$("td span").removeClass('myvalue');

$(this).closest('td').next('td').find('span').addClass('myvalue');

}
else if($(this).is(':checked') && $(this).val() == 'approve') 
{
$('#accept_deny').modal('show');
/*$(".approve_disapprove").attr("disabled", true);*/
var appr_val    = $(this).val();
var rid_new     = $(this).attr("data-rid_new");
var f_id_new    = $(this).attr("data-f_id_new");
var f_email_new = $(this).attr("data-f_email_new");
var f_title_new = $(this).attr("data-f_title_new");
var f_auth_name_new = $(this).attr("f_auth_name_new");

$('#accept_deny #get_reat_id').val(rid_new);
$('#accept_deny #get_fund_id').val(f_id_new);


$('#rid_new').val(rid_new);
$('#f_id_new').val(f_id_new);
$('#f_email_new').val(f_email_new);
$('#f_title_new').val(f_title_new);
$('#f_auth_name_new').val(f_auth_name_new);
$('#app_disapp_val').val(appr_val);

$("td span").removeClass('myvalue');

$(this).closest('td').next('td').find('span').addClass('myvalue');
$(this).closest('td').next('td').next('td').find('input.approve_disapprove').addClass('diiss');

}

else if($(this).is(':checked') && $(this).val() == 'disapp') 
{

$('#dissaproved_event').modal('show');

var disapp_val   = $(this).val();
var rid_new2     = $(this).attr("data-rid_new2");
var f_id_new2    = $(this).attr("data-f_id_new");
var f_email_new2 = $(this).attr("data-f_email_new");
var f_title_new2 = $(this).attr("data-f_title_new");
var f_auth_name_new2 = $(this).attr("f_auth_name_new");

$('#rid_new').val(rid_new2);
$('#f_id_new').val(f_id_new2);
$('#f_email_new').val(f_email_new2);
$('#f_title_new').val(f_title_new2);
$('#f_auth_name_new').val(f_auth_name_new2);
$('#app_disapp_val').val(disapp_val);

$("td span").removeClass('myvalue');

$(this).closest('td').next('td').find('span').addClass('myvalue');

}

//$(this).closest("div").css({"color": "red", "border": "2px solid red"});

var divid = $(this).closest("div").attr('id');
//alert(divid);

$('#divid').val(divid);

});


$("#dis_app_form").submit(function(event)
{
var x = document.getElementsByClassName("e_s_time");
var xx = document.getElementsByClassName("e_e_time");

var e_s_date = jQuery('#e_s_date').val();
var e_s_time = jQuery('.e_s_time').val();
var e_e_date = jQuery('#e_e_date').val();
var e_e_time = jQuery('.e_e_time').val();

//alert(e_s_time);

if ($.trim(e_s_date).length == 0) 
{
  document.getElementById("e_s_date").style.borderColor = "#E34234";
  jQuery('.alert-danger').html('<span style="color:red;"><strong>Error:</strong> Please select Start date !</span>');
  jQuery('.alert-danger').show();
  return false;
}else{    
  document.getElementById("e_s_date").style.borderColor = "#006600";    
}

if ($.trim(e_s_time).length == 0) 
{

  x[0].style.borderColor = "#E34234";
  jQuery('.alert-danger').html('<span style="color:red;"><strong>Error:</strong> Please select start time !</span>');
  jQuery('.alert-danger').show();
  return false;
}else{    
  x[0].style.borderColor = "#006600";
  document.getElementById('e_s_time2').value = e_s_time;     
}

if ($.trim(e_e_date).length == 0) 
{
  document.getElementById("e_e_date").style.borderColor = "#E34234";
  jQuery('.alert-danger').html('<span style="color:red;"><strong>Error:</strong> Please select Expire date !</span>');
  jQuery('.alert-danger').show();
  return false;
}else{    
  document.getElementById("e_e_date").style.borderColor = "#006600";    
}


if ($.trim(e_e_time).length == 0) 
{


  xx[0].style.borderColor = "#E34234";
  jQuery('.alert-danger').html('<span style="color:red;"><strong>Error:</strong> Please select end time !</span>');
  jQuery('.alert-danger').show();
  return false;
  
}else{    
  xx[0].style.borderColor = "#006600";
  document.getElementById('e_e_time2').value = e_e_time;
  //return true;  

  event.preventDefault();
  
  var email    = $('#email').val();
  var e_id     = $('#e_id').val();
  var r_id     = $('#r_id').val();
  var e_title  = $('#e_title').val();
  var f_auth_name = $('#f_auth_name').val();
  
  var e_s_date    = $('#e_s_date').val();
  var e_s_time    = $('#e_s_time').val();
  var e_e_date    = $('#e_e_date').val();
  var e_e_time    = $('#e_e_time').val();
  var comment     = $('#comment').val();
  
  
  
  var url='<?php echo admin_url('admin-ajax.php'); ?>';     
  $.ajax({
    url :url ,
    type : 'post',
      //dataType: 'json',
      data : {
        action      : 'change_time_req_event',
        //Approve Data
        email : email,
        e_id  : e_id,
        r_id  : r_id,
        e_title : e_title,
        f_auth_name : f_auth_name,
        
        e_s_date : e_s_date,
        e_s_time : e_s_time,
        e_e_date : e_e_date,
        e_e_time : e_e_time,
        comment  : comment
        
        
      },
      
      beforeSend: function() 
      {
                   //jQuery('#msform #dvLoading').show(); 

                   setTimeout(function()
                   {
                    jQuery.LoadingOverlay("show", {
                      image       : "",
                      fontawesome : "fa fa-spinner fa-spin"
                    });
                    
                    
                    jQuery.LoadingOverlay("hide");
                    
                    
                  }, 1000);  

                   
                   
                 },

                 success : function(response) 
                 {

        //alert(response);  
        
        var str = response;
        var arr = str.split("-");
        
        var rid = arr[0];
        
        var fid = arr[1];
        
        jQuery(".myvalue").load("<?php  echo "https://" . $_SERVER['SERVER_NAME'];?>/return-data/",{r_id: rid, f_id: fid});
        
        jQuery('#edit').modal('hide');
        
      }
    });

  
}

});

</script>    

<script>

	$(document).ready(function(){

		var minlength = 5;

		$('#search-input_1').keyup(function(){

			var zip_code = $('#search-input_1').val();


			if (zip_code.length >= minlength ) 
			{


				var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";

				$.post(ajaxUrl,{
   //alert("welcome to Alor");
   type: 'POST',
   action:"author_search_retaile",
   zip_codes : zip_code,

   beforeSend: function() 
   {
   	jQuery('.loader_serach #dvLoading').show();    
   },

}).success(function(posts){

	jQuery('.loader_serach #dvLoading').hide();

	setTimeout(function()
	{
/*      $.LoadingOverlay("show", {
  image       : "",
  fontawesome : "fa fa-spinner fa-spin"
}); */ 
$("#show_results").html(posts); 
$(".fieldset_4").addClass("fieldset_44");
/*$.LoadingOverlay("hide");*/
}, 1000); 
});
}

});
	});
</script>


<script>

	$(document).ready(function(){

		var minlength11 = 1;
		$('#search_ret_names').keyup(function(){

			var zip_code11 = $('#search_ret_names').val();

			var myInput = document.getElementById("search_ret_names");
			if (myInput && myInput.value)
			{
				$("#tab_default_7 .nnew_post").hide();
				$(".fs-error-fund").show();
				$("#show_posts").show();


			}
			else
			{
				$("#tab_default_7 .nnew_post").show();
				$(".fs-error-fund").hide();
				$("#show_posts").hide();
			}


			if (zip_code11.length >= minlength11 ) 
			{



				var retailer_names = $('#search_ret_names').val();

				var newajaxUrls="<?php echo admin_url('admin-ajax.php')?>";

				$.post(newajaxUrls,{

					type: 'POST',
					action:"search_reat_post",
					search_ret_namess : retailer_names,

					beforeSend: function() 
					{
						jQuery('.loader_serach1 #dvLoading1').show();    
					},

				}).success(function(posts){

					jQuery('.loader_serach1 #dvLoading1').hide();


					setTimeout(function()
					{
						$("#show_posts").html(posts);
						$("#tab_default_7 .nnew_post").hide();
						$.LoadingOverlay("hide");
					}, 1000);

				});
			}

		});


	});
</script>



<!-- =====================Events========================= -->

<script>

	$(document).ready(function(){


		var minlength1123 = 5;
		$('#search_event_names').keyup(function(){

			var zip_code1123 = $('#search_event_names').val();


			if (zip_code1123.length >= minlength1123 ) 
			{



				var retailer_names12 = $('#search_event_names').val();

				var newajaxUrls="<?php echo admin_url('admin-ajax.php')?>";

				$.post(newajaxUrls,{

					type: 'POST',
					action:"search_reat_post",
					search_event_namess : retailer_names12,

					beforeSend: function() 
					{
						jQuery('.loader_serach1 #dvLoading1').show();    
					},

				}).success(function(posts){

					jQuery('.loader_serach1 #dvLoading1').hide();


					setTimeout(function()
					{
						$("#show_posts").html(posts);
						$("#tab_default_7 .nnew_post").hide();
						$.LoadingOverlay("hide");
					}, 1000);

				});
			}

		});


	});
</script>

<!-- ======================================== -->
<script>
	$(".nested_events > li ").click(function() {
		$(".nested_events > li").removeClass('active');
	});


</script>
 <!-- ========================================== -->