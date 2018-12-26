jQuery(document).ready(function()
{

  $("#create_fundraiser_host_page .next").click(function()
  {

    var buis_name_new     = $("#r_buis_name_new").val();
    var buis_description_new = $("#r_buis_description_new").val();
    var r_buis_image_1    = $("#r_buis_image_1_new_1").val();
    var r_buis_logo_image = $("#ret_logo").val();

    if(buis_name_new == '')
    {
      document.getElementById("r_buis_name_new").style.borderColor = "#E34234"; 
      jQuery('.fs-error').html('<span style="color:red;"> A Business name is required </span>');
      jQuery('.fs-error').show();  
      return false;   
    }
    else
    { 
      document.getElementById("r_buis_name_new").style.borderColor = "#006600";  
    } 

    if(buis_description_new == '')
    {
      document.getElementById("r_buis_description_new").style.borderColor = "#E34234"; 
      jQuery('.fs-error').html('<span style="color:red;"> A Business description is required </span>');
      jQuery('.fs-error').show();  

      return false;   
    }
    else{ 
      document.getElementById("r_buis_description_new").style.borderColor = "#006600";
    }

    if(r_buis_image_1 == '')
    {
      document.getElementById("busi_img_1").style.color = "#E34234"; 
      jQuery('.fs-error').html('<span style="color:red;"> A business Image is required </span>');
      jQuery('.fs-error').show();  
      jQuery('#btn-example-file-reset1').hide();
      return false;   
    }
    else
    { 
      document.getElementById("busi_img_1").style.color = "#006600";  
      $('.fs-error').hide();
    } 

    if(r_buis_logo_image == '')
    {
      document.getElementById("busi_img_logo").style.color = "#E34234"; 
      jQuery('.fs-error').html('<span style="color:red;"> A business Logo is required </span>');
      jQuery('.fs-error').show(); 
      jQuery('#btn-example-file-reset2').hide(); 
      return false;   
    }
    else
    { 
      document.getElementById("busi_img_logo").style.color = "#006600";  
      $('.fs-error').hide();

      var dd = $('.selected-dial-code').html();
      $("#country_code_buis").val(dd);

    }
    if(animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
      step: function(now, mx) {
        //as the opacity of current_fs reduces to 0 - stored in "now"
        //1. scale current_fs down to 80%
        scale = 1 - (1 - now) * 0.2;
        //2. bring next_fs from the right(50%)
        left = (now * 50)+"%";
        //3. increase opacity of next_fs to 1 as it moves in
        opacity = 1 - now;
        /*current_fs.css({'transform': 'scale('+scale+')'});*/
        next_fs.css({'left': left, 'opacity': opacity});
      }, 
      duration: 800, 
      complete: function(){
        current_fs.hide();
        animating = false;
      }, 
      //this comes from the custom easing plugin
      easing: 'easeInOutBack'
    });

  });

// Next Form 2

$("#create_fundraiser_host_page .previous").click(function(){
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();
  
  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
  
  //show the previous fieldset
  previous_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$("#create_fundraiser_host_page .submit").click(function(){

  var r_buis_addr     = $("#r_buis_addr_new").val();
  var buis_country    = $("#buis_country").val();
  var buis_city       = $("#buis_city_newn").val();
  var buis_state      = $("#buis_state_new").val();
  var r_zip_code      = $("#r_zip_code_new").val();
  var buis_phone      = $("#buis_phone_new").val();
  var sic_code        = $("#sic_code").val();
  var buis_w_address  = $("#buis_w_address_new").val();
  var hidden_post_id  = $("#hidden_post_id").val();
  
  //var c_code2  = $(".flag-container .selected-dial-code").text();
  
  //$("#country_code_buis").val(c_code2);

  //alert(c_code2);
  
  if(r_buis_addr == '')
  {
    document.getElementById("r_buis_addr_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Business address is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else 
  { 
    document.getElementById("r_buis_addr_new").style.borderColor = "#006600";  
  } 

  if(buis_country == '')
  {
    document.getElementById("buis_country").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Business country is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else{ 
    document.getElementById("buis_country").style.borderColor = "#006600";

  }
  
  if(buis_state == '')
  {
    document.getElementById("buis_state_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Business State is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("buis_state_new").style.borderColor = "#006600";  
  } 
  
  
  if(buis_city == '')
  {
    document.getElementById("buis_city_newn").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Business city is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else{ 
    document.getElementById("buis_city_newn").style.borderColor = "#006600";

  }


  if(r_zip_code == '')
  {
    document.getElementById("r_zip_code_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Business zipcode is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("r_zip_code_new").style.borderColor = "#006600";  
  }

  if(buis_phone == '')
  {
    document.getElementById("buis_phone_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Business phone number is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("buis_phone_new").style.borderColor = "#006600";  
    $('.fs-error').hide();
  }

  if(sic_code == '')
  {
    document.getElementById("sic_code").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Sic code is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("sic_code").style.borderColor = "#006600";  
    $('.fs-error').hide();
  }


});

// =================== image upload ===================

$(document).ready(function(){
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
$("#create_image_upload_page .business-post-info").click(function()
{

  var buis_name_new          = $("#r_buis_name_new").val();
  var buis_description_new   = $("#r_buis_description_new").val();
  var user_id                = $("#current_user_id").val();
  var hidden_post_id         = $("#hidden_post_id").val();

  if(buis_name_new == '')
  {
    document.getElementById("r_buis_name_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Business name is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("r_buis_name_new").style.borderColor = "#006600";  
  } 

  if(buis_description_new == '')
  {
    document.getElementById("r_buis_description_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Business description is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("r_buis_description_new").style.borderColor = "#006600"; 
    jQuery('.fs-error').hide();
    var url = window.location.origin;
    var admin_url ="/rif-admin/admin-ajax.php";
    var ajaxUrl = url+admin_url;


    $.ajax({
      type: 'POST',
      url: ajaxUrl,
      data : {
        buis_name_new : buis_name_new,
        buis_description_new : buis_description_new,
        user_id : user_id,
        hidden_post_id : hidden_post_id,
        action : 'image_upload_files',
      },
      beforeSend: function() 
      {
        setTimeout(function()
        {
          $('.business-create-loding').show();
        }, 500);
      },


      success : function(response) 
      {

        if(response)
        {
          $("#hidden_post_id").val(response);
          $('.business-create-loding').hide();
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

if(animating) return false;
animating = true;

current_fs = $("#create_image_upload_page .business-post-info").parent();
next_fs = $("#create_image_upload_page .business-post-info").parent().next();

  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
  //show the next fieldset
  next_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        /*  'position': 'absolute'*/
      });
      next_fs.css({'left': left, 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
}
}
});
  }
});

$("#create_image_upload_page .upload-image-next").click(function()
{
  var if_have_image = $("#if_have_image").val();

  if(if_have_image == '')
  {
    jQuery('.img-error').html('<span style="color:red;"> A Business image is required </span>');
    jQuery('.img-error').show();  
  }
  else
  {
    jQuery('.img-error').hide(); 
    if(animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
  //show the next fieldset
  next_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        /* 'position': 'absolute'*/
      });
      next_fs.css({'left': left, 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
}
});


$(".previous").click(function(){
  if(animating) return false;
  animating = true;
  
  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();
  
  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
  
  //show the previous fieldset
  previous_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});

$("#create_image_upload_page .submit").click(function(){
  var r_buis_addr   = $("#r_buis_addr_new").val();
  var buis_country  = $("#buis_country").val();
  var buis_city     = $("#buis_city_newn").val();
  var buis_state    = $("#buis_state_new").val();
  var r_zip_code    = $("#r_zip_code_new").val();
  var buis_phone    = $("#buis_phone_new").val();
  var buis_w_address  = $("#buis_w_address_new").val();
  
  if(r_buis_addr == '')
  {
    document.getElementById("r_buis_addr_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error-pp').html('<span style="color:red;"> A Business address is required </span>');
    jQuery('.fs-error-pp').show();  
    return false;   
  }
  else 
  { 
    document.getElementById("r_buis_addr_new").style.borderColor = "#006600";  
  } 

  if(buis_country == '')
  {
    document.getElementById("buis_country").style.borderColor = "#E34234"; 
    jQuery('.fs-error-pp').html('<span style="color:red;"> A Business country is required </span>');
    jQuery('.fs-error-pp').show();  
    return false;   
  }
  else{ 
    document.getElementById("buis_country").style.borderColor = "#006600";

  }
  
  if(buis_state == '')
  {
    document.getElementById("buis_state_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error-pp').html('<span style="color:red;"> A Business State is required </span>');
    jQuery('.fs-error-pp').show();  
    return false;   
  }
  else
  { 
    document.getElementById("buis_state_new").style.borderColor = "#006600";  
  } 
  
  
  if(buis_city == '')
  {
    document.getElementById("buis_city_newn").style.borderColor = "#E34234"; 
    jQuery('.fs-error-pp').html('<span style="color:red;"> A Business City is required </span>');
    jQuery('.fs-error-pp').show();  
    return false;   
  }
  else
  { 
    document.getElementById("buis_city_newn").style.borderColor = "#006600";

  }
  if(r_zip_code == '')
  {
    document.getElementById("r_zip_code_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error-pp').html('<span style="color:red;"> A Business Zipcode is required! </span>');
    jQuery('.fs-error-pp').show();  
    return false;   
  }
  else
  { 
    document.getElementById("r_zip_code_new").style.borderColor = "#006600";  
  }

  if(buis_phone == '')
  {
    document.getElementById("buis_phone_new").style.borderColor = "#E34234"; 
    jQuery('.fs-error-pp').html('<span style="color:red;"> A Business phone number is required </span>');
    jQuery('.fs-error-pp').show();  
    return false;   
  }
  else
  { 
    document.getElementById("buis_phone_new").style.borderColor = "#006600"; 
    $('.fs-error-pp').hide();
  setTimeout(function() 
  {
    $.LoadingOverlay("show", {
      image       : "",
      fontawesome : "fas fa-spinner fa-spin"
    });               
  }, 100);
  }
}); 

});


// script for create fundraiser

$(document).ready(function()
{
  $('#create_fundraiser_event_page .next').click(function()
  {
    var fund_name = $("#fund_name").val();
    var fund_description = $("#fund_description").val();
    var fund_city = $("#fund_city").val();
    var findzip = $("#findzip").val();
    var user_id = $("#current_user_id").val();
    var post_id = $("#hidden_post_ids").val();
    var post_org = $("input[name='post_org']:checked").val();


    if($('#tax_deductible').is(':checked'))
    {
      var tax_deductible = "true";
    }
    else
    {
      var tax_deductible = "false";
    }

    if(fund_name == '')
    {   
      document.getElementById("fund_name").style.borderColor = "#E34234"; 
      $('.fs-error').html('<span style="color:red;"> A Campaign name is required </span>');
      $('.fs-error').show();  
      return false; 
    }
    else
    { 
      document.getElementById("fund_name").style.borderColor = "#006600";  
    }

    if(fund_description == '')
    {
      document.getElementById("fund_description").style.borderColor = "#E34234"; 
      $('.fs-error').html('<span style="color:red;"> A Campagin description is required </span>');
      $('.fs-error').show();  
      return false;
    }
    else
    { 
      document.getElementById("fund_description").style.borderColor = "#006600";  
    } 

    if(fund_city == '')
    {
      document.getElementById("fund_city").style.borderColor = "#E34234"; 
      $('.fs-error').html('<span style="color:red;"> A City is required </span>');
      $('.fs-error').show();  
      return false;
    }
    else
    { 
      document.getElementById("fund_city").style.borderColor = "#006600";  
    }

    if(findzip == '')
    {
      document.getElementById("findzip").style.borderColor = "#E34234"; 
      $('.fs-error').html('<span style="color:red;"> A Zipcode is required </span>');
      $('.fs-error').show();  
      return false;
    }
    else
    { 
      $('.fs-error').hide();
      document.getElementById("findzip").style.borderColor = "#006600"; 

      var url = window.location.origin;
      var admin_url ="/rif-admin/admin-ajax.php";
      var ajaxUrl = url+admin_url;
      $.ajax({
        type: 'POST',
        url: ajaxUrl,
        dataType: 'text',
        data : {
          fund_name : fund_name,
          fund_description : fund_description,
          fund_city : fund_city,
          findzip : findzip,
          tax_deductible : tax_deductible,
          post_org : post_org,
          user_id : user_id,
          post_id : post_id,
          action : 'ajax_create_fundraiser_page',
        },

        beforeSend: function() 
        {
          setTimeout(function()
          {
            $('.business-create-loding').show();
          }, 500);
        },

        success : function(response) 
        {
          if(response)
          {
            var poost_id = $.trim(response)
            $("#hidden_post_ids").val(poost_id);
            $('.business-create-loding').hide();

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

if(animating) return false;
animating = true;

current_fs = $("#create_fundraiser_event_page #find_next_imfo").parent();
next_fs = $("#create_fundraiser_event_page #find_next_imfo").parent().next();

  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        /*  'position': 'absolute'*/
      });
      next_fs.css({'left': left, 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
}
} 
});
    }

  });

});

$("#create_fundraiser_event_page #find_next_img").click(function()
{

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

var if_have_image = $("#if_have_image").val();
if(if_have_image == '')
{
  jQuery('.img-error').html('<span style="color:red;">  At least one Campaign image is required </span>');
  jQuery('.img-error').show();  
}
else
{
  jQuery('.img-error').hide(); 
  if(animating) return false;
  animating = true;

  current_fs = $("#create_fundraiser_event_page #find_next_img").parent();
  next_fs = $("#create_fundraiser_event_page #find_next_img").parent().next();

  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  
  //show the next fieldset
  next_fs.show(); 
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        /* 'position': 'absolute'*/
      });
      next_fs.css({'left': left, 'opacity': opacity});
    }, 
    duration: 800, 
    complete: function(){
      current_fs.hide();
      animating = false;
    }, 
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
}
});


$("#create_fundraiser_event_page #find_next2").click(function(){

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

var result          = $('#select_done :selected').text();
var f_event_date    = $("#f_event_date_new").val();
var f_fund_s_time   = $("#f_fund_s_time_new").val();
var f_event_e__date = $("#f_event_e__date_new").val();
var f_fund_e_time   = $("#f_fund_e_time_new").val();
var f_fund_amte     = $("#f_fund_amte_new").val();

if(result == '')
{   
  $('.fs-erro-pd').html('<span style="color:red;"> At least one Campaign Category is required  </span>');
  $('.fs-erro-pd').show(); 
  $('.categroy-select .show-tick .bs-placeholder').css('border-color','#E34234');
  return false; 
}
else
{ 
    //document.getElementById("c_select_new").style.borderColor = "#006600";  
    $('.categroy-select .show-tick .bs-placeholder').css('border-color','#006600');
    //return true; 
  } 
/*  if(f_event_date == ''){

    document.getElementById("f_event_date_new").style.borderColor = "#E34234"; 
    $('.fs-erro-pd').html('<span style="color:red;"> A Campagin start date is required </span>');
    $('.fs-erro-pd').show();  
    return false;

  }
  else
  { 
    document.getElementById("f_event_date_new").style.borderColor = "#006600";  
  } */

  if(f_fund_s_time == '')
  {   
    document.getElementById("f_fund_s_time_new").style.borderColor = "#E34234"; 
    $('.fs-erro-pd').html('<span style="color:red;"> A Campaign start time is required </span>');
    $('.fs-erro-pd').show();  
    return false; 

  }
  else
  { 
    document.getElementById("f_fund_s_time_new").style.borderColor = "#006600";  
  } 


  if(f_event_e__date == '')
  {   
    document.getElementById("f_event_e__date_new").style.borderColor = "#E34234"; 
    $('.fs-erro-pd').html('<span style="color:red;"> A Campaign Business Giveaway ending date is required </span>');
    $('.fs-erro-pd').show();  
    return false; 

  }
  else
  { 
    document.getElementById("f_event_e__date_new").style.borderColor = "#006600";  
  } 

  if(f_fund_e_time == '')
  {   
    document.getElementById("f_fund_e_time_new").style.borderColor = "#E34234"; 
    $('.fs-erro-pd').html('<span style="color:red;"> A Campaign Business Giveaway ending time is required </span>');
    $('.fs-erro-pd').show();  
    return false; 

  }
  else
  { 
    document.getElementById("f_fund_e_time_new").style.borderColor = "#006600";  
  } 


  if(f_fund_amte == ''){

    document.getElementById("f_fund_amte_new").style.borderColor = "#E34234"; 
    $('.fs-erro-pd').html('<span style="color:red;"> A Fundraiser goal is required </span>');
    $('.fs-erro-pd').show();  
    return false;

  }
  else
  {
    document.getElementById("f_fund_amte_new").style.borderColor = "#006600";
    $('.fs-erro-pd').hide();

    if(animating) return false;
    animating = true;

    current_fs = $("#create_fundraiser_event_page #find_next2").parent();
    next_fs = $("#create_fundraiser_event_page #find_next2").parent().next();

//activate next step on progressbar using the index of next_fs
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show(); 
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
  step: function(now, mx) {
//as the opacity of current_fs reduces to 0 - stored in "now"
//1. scale current_fs down to 80%
scale = 1 - (1 - now) * 0.2;
//2. bring next_fs from the right(50%)
left = (now * 50)+"%";
//3. increase opacity of next_fs to 1 as it moves in
opacity = 1 - now;
/*current_fs.css({'transform': 'scale('+scale+')'});*/
next_fs.css({'left': left, 'opacity': opacity});
}, 
duration: 800, 
complete: function(){
  current_fs.hide();
  animating = false;
}, 
//this comes from the custom easing plugin
easing: 'easeInOutBack'
});
}

});




$("#create_fundraiser_event_page #find_next_search").click(function()
{

//jQuery time
var hidden_true = $(".hidden_true").val();
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

var search_businesss_new = $("#search_inputs_new").val();
if(search_businesss_new == '')
{
  document.getElementById("search_inputs_new").style.borderColor = "#E34234"; 
  $('.fs-erro-se').html('<span style="color:red;"> A Business Partner is required </span>');
  $('.fs-erro-se').show();  
  return false; 
}
else if(hidden_true == '')
{

  document.getElementById("hidden_true_id").style.borderColor = "#E34234"; 
  $('.fs-erro-se').html('<span style="color:red;"> Please select a Business Partner </span>');
  $('.fs-erro-se').show();  
  return false; 

}
else
{
  $('.fs-erro-se').hide();
  $(".evnt_lst_btn").show(); 
  $('.evnt_lst_btn').attr('id', 'evnts_lst_btn');
  document.getElementById("evnts_lst_btn").style.opacity = "1"
  if(animating) return false;
  animating = true;

  current_fs = $("#create_fundraiser_event_page #find_next_search").parent();
  next_fs = $("#create_fundraiser_event_page #find_next_search").parent().next();

//activate next step on progressbar using the index of next_fs
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset
next_fs.show(); 
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
  step: function(now, mx) {
//as the opacity of current_fs reduces to 0 - stored in "now"
//1. scale current_fs down to 80%
scale = 1 - (1 - now) * 0.2;
//2. bring next_fs from the right(50%)
left = (now * 50)+"%";
//3. increase opacity of next_fs to 1 as it moves in
opacity = 1 - now;
/*current_fs.css({'transform': 'scale('+scale+')'});*/
next_fs.css({'left': left, 'opacity': opacity});
}, 
duration: 800, 
complete: function(){
  current_fs.hide();
  animating = false;
}, 
//this comes from the custom easing plugin
easing: 'easeInOutBack'
});
}
});


$("#find_sub1").click(function()
{

  var hidden_true = $("#hidden_true_id").val();
  var search_businesss_test = $("#search_inputs_new").val();
  if(search_businesss_test == '')
  {

    document.getElementById("search_inputs_new").style.borderColor = "#E34234"; 
    $('.fs-erro-se').html('<span style="color:red;"> A business Partner is required </span>');
    $('.fs-erro-se').show();  
    return false; 

  }
  else
  {
    $('.fs-erro-se').hide(); 
    document.getElementById("search_inputs_new").style.borderColor = "#006600"; 
  }

  if(hidden_true == '')
  {

    document.getElementById("hidden_true_id").style.borderColor = "#E34234"; 
    $('.fs-erro-se').html('<span style="color:red;"> Please select a Business Partner </span>');
    $('.fs-erro-se').show();  
    return false; 

  }
  else
  {
    $('.fs-erro-se').hide(); 
    document.getElementById("hidden_true_id").style.borderColor = "#006600"; 

  }


});

$('#search_inputs_new').keyup(function () 
{  
  var minlength = 5; 
  var url = window.location.origin;
  var admin_url ="/rif-admin/admin-ajax.php";
  var ajaxUrl = url+admin_url;
  var zip_code = $('#search_inputs_new').val();

  if (zip_code.length >= minlength ) 
  {
    $('#searched_new .show-spin').show();
    $.ajax({
     url :ajaxUrl,
     type : 'post',
     data : {
      action : 'zip_search_create_fund',
      zip_codes : zip_code  
    },
    success : function(posts) 
    {
      $("#show_result_new").html(posts);
      $(".fieldset_4").addClass("fieldset_44");
      $('#searched_new .show-spin').hide();
      //$('.hidden_true').val("");

      $(".chk_radio").click(function(){          
       if($(this).is(':checked') && $(this).val() !== '') 
       {
        var ret_e_id           = $(this).val();
        var ret_e_title        = $(this).attr("data-title");
        var ret_e_auther_id    = $(this).attr("data-ret-auth-id");
        var ret_e_authe_name   = $(this).attr("data-ret-name");

        $('#ret_e_id_news').val(ret_e_id);
        $('#ret_e_title_news').val(ret_e_title);
        $('#ret_e_authe_name_news').val(ret_e_authe_name);
        $('#ret_e_auther_id_news').val(ret_e_auther_id);
        $('.hidden_true').val(true);

      }
    });
    }
  });
  }
});

$("#find_pre3").click(function(){

 $(".third_fieldset").show();
 $('.third_fieldset').attr('id', 'third_field');
 document.getElementById("third_field").style.opacity = "1"; 
 $("#third_field").css("transform","");
 $(".fieldset_4").hide();
});

// ================= image upload ends here ==============


$(".country-list li").click(function() {

 var c_code4  = $(this).attr('data-dial-code');
 var addplus = "+";
 var combine_code = addplus+c_code4;

  //alert(c_code4);
  $("#country_code_buis").val(combine_code);

});

});

jQuery(".wepay_submit").click(function()
{
  var new_wepay_f_name = $("#wepay_f_name").val();
  var new_wepay_l_name = $("#wepay_l_name").val();
  var new_wepay_email  = $("#wepay_email").val();
  var accept_wepay_trnm = $("#accept_wepay_trnm").val();
  
  if(new_wepay_f_name == '')
  {
    document.getElementById("wepay_f_name").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A First Name is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("wepay_f_name").style.borderColor = "#006600";  
  } 

  if(new_wepay_l_name == '')
  {
    document.getElementById("wepay_l_name").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Last Name is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("wepay_l_name").style.borderColor = "#006600";  
  }  

  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var vemail = mailformat.test(new_wepay_email)
  if ($.trim(new_wepay_email).length == 0 || new_wepay_email==false) 
  {

    document.getElementById("wepay_email").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> An Email Address is Required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  {
    document.getElementById("wepay_email").style.borderColor = "#006600";  
  }

  if(accept_wepay_trnm == '')
  {
    jQuery('.fs-error').html('<span style="color:red;"> Please accept the WePay terms & conditions </span>');
    jQuery('.fs-error').show();  
    return false;   

  }
  else
  {
    jQuery('.fs-error').hide();


    setTimeout(function() 
      {
        $.LoadingOverlay("show", {
          image       : "",
          fontawesome : "fas fa-spinner fa-spin"
        });               
      }, 100);

    return true;   
  }

});


jQuery(".wepay_new_submit").click(function()
{
  var new_wepay_f_name = $("#new_wepay_f_name").val();
  var new_wepay_l_name = $("#new_wepay_l_name").val();
  var new_wepay_email  = $("#new_wepay_email").val();
  var accept_wepay_trnm = $("#accept_wepay_trnm").val();

  if(new_wepay_f_name == '')
  {
    document.getElementById("new_wepay_f_name").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A First Name is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("new_wepay_f_name").style.borderColor = "#006600";  
  } 

  if(new_wepay_l_name == '')
  {
    document.getElementById("new_wepay_l_name").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> A Last Name is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  { 
    document.getElementById("new_wepay_l_name").style.borderColor = "#006600";  
  }  

  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var vemail = mailformat.test(new_wepay_email)
  if ($.trim(new_wepay_email).length == 0 || new_wepay_email==false) 
  {

    document.getElementById("new_wepay_email").style.borderColor = "#E34234"; 
    jQuery('.fs-error').html('<span style="color:red;"> An Email address is required </span>');
    jQuery('.fs-error').show();  
    return false;   
  }
  else
  {
    document.getElementById("new_wepay_email").style.borderColor = "#006600";  
  }

  if(accept_wepay_trnm == '')
  {
    jQuery('.fs-error').html('<span style="color:red;"> Please accept the WePay terms & conditions </span>');
    jQuery('.fs-error').show();  
    return false;   

  }
  else
  {
    jQuery('.fs-error').hide();


    // $("#create_fundraiser_event_page").submit(function() {
      setTimeout(function() 
      {
        $.LoadingOverlay("show", {
          image       : "",
          fontawesome : "fas fa-spinner fa-spin"
        });               
      }, 100);
     // });
    return true;   
  }

});


/*jQuery(".submit_buis_final").click(function(){

  setTimeout(function() 
  {
    $.LoadingOverlay("show", {
      image       : "",
      fontawesome : "fas fa-spinner fa-spin"
    });               
  }, 100);
  
});*/
