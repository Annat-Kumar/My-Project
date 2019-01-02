
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<?php 

$current_user = wp_get_current_user();

?>
</div>
</div>
<div class="container-fluid footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6 footer_search footer_view">
        <div class="fotter-sec">
          <a class="footer_recent_fund" href="<?php echo site_url();?>/all-fundraisers/"><h1>Recent Fundraisers</h1></a>
          <ul class="list-unstyled extr">
            <?php
            $fund_ids = get_users( array('role' => 'subscriber' ,'fields' => 'ID') );
            $args = array( 'post_type' => 'fundraiser','numberposts' => 3,'post_status' =>'publish','author' => implode(',', $fund_ids));
            $recent_posts = wp_get_recent_posts($args);
            foreach( $recent_posts as $recent ){
              echo '<li><a href="' . get_permalink($recent["ID"]) . '"">';echo '<i class="fa fa-chevron-right" aria-hidden="true"></i>'.   $recent["post_title"].'</li></a>';
            }
            wp_reset_query();
            ?>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 footer_search footer_view">
        <div class="fotter-sec">
          <h1>Recent Locations</h1>
          <ul class="list-unstyled extr">
            <?php
            $ids = get_users( array('role' => 'subscriber' ,'fields' => 'ID') );
            $args = array( 'post_type' => 'retailer','numberposts' => 3,'post_status' =>'publish','author' => implode(',', $ids));
            $recent_posts = wp_get_recent_posts($args);
            foreach( $recent_posts as $recent ){
              echo '<li><a href="' . get_permalink($recent["ID"]) . '"">';echo '<i class="fa fa-chevron-right" aria-hidden="true"></i>'.   $recent["post_title"].'</li></a>';
            }
            wp_reset_query();
            ?>
          </ul>

        </div>

      </div>
      <div class="col-md-4 col-sm-6 footer_search footer_view">
       <div class="fotter-sec fotter_sec_icon">
        <h1> <?php 
          $frontpage_id = get_option( 'page_on_front' );
          echo get_field("footer_contact_title", $frontpage_id);        
          ?>  
        </h1>
        <ul class="list-unstyled address1">
          <a><li><i class="fa fa-map-marker" aria-hidden="true"></i>
            <span><?php echo get_field("footer_address_deatl", $frontpage_id); ?></span>
            </li>
          </a>
          <a><li><i class="fa fa-phone" aria-hidden="true"></i>
            <span><?php echo get_field("phone_and_fax_no", $frontpage_id); ?></span>
            </li>
          </a>
          <!-- <a><li><i class="fa fa-fax" aria-hidden="true"></i>
            <span>(512) 593-5109</span>
            </li>
          </a> -->
          <a><li><i class="fa fa-envelope-o" aria-hidden="true"></i>
          <span><?php echo get_field("footer_email", $frontpage_id); ?></span>
        </li>
        </a>
    </ul>

<!--
*        <?Php $user_info   = get_userdata(1); $admin_name  = $user_info->user_login; $admin_email = get_option( 'admin_email' );?>
*        <span><?php echo $admin_email; ?> </span> 
-->

  </div>
  <?php //dynamic_sidebar( 'fourth-footer-widget-area' ); ?>

</div>

<div class="col-md-12 col-sm-12">
  <a href="javascript:" id="return-to-top"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
</div>
</div>
</div>
</div>
<div class="container-fluid copy_ryt">
  <div class="container">
    <div class="row">

      <div class="text-center copyright">
       <?php //dynamic_sidebar( 'fifth-footer-widget-area' ); ?>


       <div class="col-md-6 col-sm-6">

        <ul class="list-unstyled list-inline copy-right-list">
          <li>Copyright © Raise It <?php echo date("Y"); ?>. All Rights Reserved.</li>
          <!--   <li><span id="siteseal" style="float: right; /! width: 30%; //! display: inline-block;"><script async="" type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=hkk8Fc4MgVsxaea2tt6xWDvhfrsJCQtEgPbFOZpdktsh15Sy7ED2vPwb2oBh"></script></span><script type="text/javascript" src="https://raiseitfast.com/wp-content/uploads/2017/12/siteseal_gd_3_h_l_m.gif" async></script></li> -->
        </ul>
      </div>
      <div class="col-md-6 col-sm-6 localsocial_media">
        <ul class="list-unstyled social_icons_footr list-inline">
          <li><a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="https://twitter.com/login"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="https://www.instagram.com/?hl=en"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

        </ul>
      </div>

    </div>
  </div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/jquery.bxslider.js"></script> 
<script src="<?php bloginfo('template_directory');?>/js/wow.min.js"></script>

<!-- resize crop rotate image js start -->

<script src="<?php bloginfo('template_directory');?>/js/fabric.js"></script> 
<script src="<?php bloginfo('template_directory');?>/js/darkroom.js"></script>

<!-- resize crop rotate image js end -->


<!--<script src="<?php bloginfo('template_directory');?>/js/signup/script.js"></script>-->
<script src="<?php bloginfo('template_directory');?>/js/signup/jquery.easing.min.js" ></script>
<!--<script src="<?php bloginfo('template_directory');?>/js/signup/jquery-1.9.1.min.js" ></script>-->

<!-- <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.3/src/loadingoverlay.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.3/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script> -->

<script src="<?php bloginfo('template_directory');?>/js/loder/src/loading-overlay.js" ></script>

<script src="<?php bloginfo('template_directory');?>/js/loder/loadingoverlay_progress.min.js" ></script>


<!--/************* Date picker JS and CSS *********/-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<!---/************Time Picker JS and CSS/************* -->
<link href="<?php bloginfo('template_directory');?>/css/flatpickr.min.css" rel="stylesheet"> 
<script src="<?php bloginfo('template_directory');?>/js/signup/flatpickr.js"></script>

<script src='<?php bloginfo('template_directory');?>/js/timepicki.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>


<script>
  jQuery(document).ready(function(){

   jQuery("#edit_image_11").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target_edit_event_imgs").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target_edit_event_imgs', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             $("#edit_image_events").val(newImage);
             $("#new_edit_target_img_events").attr("src", newImage);
             $("#edit-event-img").show();          
             $("#show_edit_target_img_events").attr("src", newImage);
             $("#preview_img").show();
            jQuery('#edit_fundraiser_image').modal('hide');
   }
 },
},

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
         //cropPlugin.selectZone(170, 25, 300, 300);
       // cropPlugin.requireFocus();
     }

   });

   });

 $('#edit-event-img').on('click', function(e) {
  $('#new_edit_target_img_events').attr('src', '');
  $('#edit-event-img').hide();
  var $el = $('#edit_image_11');
  $el.wrap('<form>').closest('form').get(0).reset();
  $el.unwrap();
  return myFunction_edit_fund_images();
});

 function myFunction_edit_fund_images() {
  var newx = document.createElement("IMG");
  newx.setAttribute("id", "target_edit_event_imgs");
  document.body.appendChild(newx);
  document.getElementById('edit_add_target_imgs').append(newx);
} 


 }); 
</script>

<script>
  jQuery(document).ready(function(){

   jQuery("#edit_logo_11").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target_edit_event_logo").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target_edit_event_logo', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             $("#edit_logo_events").val(newImage);
             $("#new_edit_target_logo_events").attr("src", newImage);
             $("#edit-event-logo").show();          
             $("#show_edit_target_logo_events").attr("src", newImage);
             $("#preview_logo").show();
            jQuery('#edit_fundraiser_logo').modal('hide');
   }
 },
},

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
         //cropPlugin.selectZone(170, 25, 300, 300);
       // cropPlugin.requireFocus();
     }

   });

   });

 $('#edit-event-logo').on('click', function(e) {
  $('#new_edit_target_logo_events').attr('src', '');
  $('#edit-event-logo').hide();
  var $el = $('#edit_logo_11');
  $el.wrap('<form>').closest('form').get(0).reset();
  $el.unwrap();
  return myFunction_edit_fund_images();
});

 function myFunction_edit_fund_images() {
  var newx = document.createElement("IMG");
  newx.setAttribute("id", "target_edit_event_logo");
  document.body.appendChild(newx);
  document.getElementById('edit_add_target_logo').append(newx);
} 


 }); 
</script>





<!---/********* Sign up success notification Auth Code Pop up ********/-->

<div class="modal fade yashu" id="overlay-act-signup-succ" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
        <h4 class="modal-title">Welcome to Raise It</h4>
      </div>
      <div class="modal-body">

        <div class="error-left">

         <div class="alert alert-success auth-success-aftrsignupp" style="display:none;">
          Congratulations, you have successfully authenticated your account with Raise It.
        </div>

        <div class="alert alert-warning auth-error-login1" style="display:none;">
         <strong>Error:</strong> Please enter your authentication code.
       </div>

       <div class="alert alert-warning auth-error-login" style="display:none;">
         <strong>Error:</strong> Authentication code didn't match, please check your email and input a valid code.
       </div>

       <div id="dvLoading" style="display:none"></div>
     </div>

     <div class="testing">
       <p class="act-acc-p">An authentication code is send to your email and via text to your registered phone number, please check your email or phone and insert this code here below to get login to Raise It.</p>

       <p>
       </div>     
       <form name="auth_code" method="post" action="#" id="auth-code-sel-opt-in"> 
        <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
        <div class="auth-code-in">
          <input name="auth_code" value="" type="text" class="auth-code form-control" id="auth_code" placeholder="Your Authentication Code">
          <input type="hidden" value="" id="n_user_id">
        </div>

        <div class="sub-opt-in">
          <input name="submit" class="submit action-button" value="Submit" type="submit"  id="auth-code">
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<div class="modal fade yashu" id="overlay-act-aftrlogin" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title">Welcome to Raise It</h4>
      </div>
      <div class="modal-body">

        <div class="error-left">

         <div class="alert alert-success auth-success-aftrlogin" style="display:none;">
          Congratulations, you have successfully authenticated your account with Raise It.
        </div>

        <div class="alert alert-warning auth-error-aftrlogin" style="display:none;">
         <strong>Error:</strong> Please enter your authentication code.
       </div>

       <div class="alert alert-warning auth-error-afterlogin1" style="display:none;">
         <strong>Error:</strong> Authentication code didn't match, please check your email and input a valid code.
       </div>

     </div>

     <h5 class="act-acc">It seems that your account is not authenticated with Raise It.</h5>
     <p class="act-acc-p">Please check your email and insert this code here below to get authenticated with Raise It. </p>

     <p> 
      <form name="auth_code_aftr_login" method="post" action="#" id="auth-code-aftr-log-in"> 
        <?php //wp_nonce_field('ajax-login-nonce', 'security'); ?>
        <div class="auth-code-in">
          <input name="auth_code" value="" type="text" class="auth-code form-control" id="auth_code_login" placeholder="Your Authentication Code">
          <input type="hidden" value="" id="n_user_id">
        </div>

        <div class="sub-opt-in">
          <input name="submit" class="submit action-button" value="Submit" type="submit"  id="auth-code">
        </div>


      </form>
    </p>

  </div>

</div>
</div>
</div> 

<?php get_template_part( 'content', 'allJs' ); ?>






<script>
  jQuery(document).ready(function(){

   $("#edit_profile_image").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
      backgroundColor: '#fff',

      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             //varThatStoresYourImageData = newImage;



             var profile = jQuery('#get_p_image').val(); 
             var fund_name = jQuery('#fund_name').val();
             var fund_description = jQuery('#fund_description').val();
             var fund_city = jQuery('#fund_city').val();
             var findzip = jQuery('#findzip').val();

       //alert(profile);

       if(profile == "profile") 
       {   

        var url ='<?php echo admin_url('admin-ajax.php'); ?>';
        jQuery.ajax({
         url : url,
         type : 'post',

         data : {
          action : 'upload_profile_media',
          imagedata: newImage

        },
        beforeSend: function() 
        {
         jQuery('#dvLoading_profile').show();    
       },


       success : function(response) 
       {
        jQuery('#dvLoading_profile').hide();
        window.location.href = "<?php echo home_url();?>/user/";
      }	

    });
      }

    }
  },
},

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
         //cropPlugin.selectZone(170, 25, 300, 300);
       // cropPlugin.requireFocus();
     }
   });




   });

   $(".refresh_pro").click(function(){
    window.location.href = "<?php echo home_url();?>/user/";
  });

 }); 
</script>

<script>

  jQuery(document).ready(function(){

   $("#r_buis_image_1_new_1").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target_bus_img").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target_bus_img', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
      backgroundColor: '#fff',

      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             //varThatStoresYourImageData = newImage;

       //var profile_img = jQuery('#get_p_image_bus').val(); 
       
       //alert(profile1);

       $("#ret_image").val(newImage);
       $("#new_target_bus_img").attr("src", newImage);
       $("#btn-example-file-reset1").show();
       jQuery("#add_event_bus_image").attr("src", newImage);
       jQuery("#add_business_image").modal('hide');
       jQuery("#add_bus_preview_image").show();

     }
   },
 },

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
         //cropPlugin.selectZone(170, 25, 300, 300);
       // cropPlugin.requireFocus();
     }
   });
   });

   $('#btn-example-file-reset1').on('click', function(e) {
    $('#new_target_bus_img').attr('src', '');
    $('#btn-example-file-reset1').hide();
    var $el = $('#r_buis_image_1_new_1');
    $el.wrap('<form>').closest('form').get(0).reset();
    $el.unwrap();
    return myFunction_new();


  });

   function myFunction_new() {
    var xx = document.createElement("IMG");
    xx.setAttribute("id", "target_bus_img");
    document.body.appendChild(xx);
    document.getElementById('add_target1').append(xx);
  } 
}); 

</script>

<script>
  
  $(document).ready(function() {

 
    // NEED TO BE UPDATED if new versions are affected
    var ua = navigator.userAgent,scrollTopPosition,
    iOS = /iPad|iPhone|iPod/.test(ua),
    iOS11 = /OS 11_0_1|OS 11_0_2|OS 11_0_3|OS 11_1|OS 11_1_1|OS 11_1_2|OS 11_2|OS 11_2_1/.test(ua);

    // ios 11 bug caret position
    if ( iOS ) {
      scrollTopPosition = $(document).scrollTop();
      document.getElementById("user_login").style.border = "1px solid #ccc"; 
      document.getElementById("user_pass").style.border = "1px solid #ccc"; 
      document.getElementById("clientname").style.border = "1px solid #ccc"; 
      document.getElementById("lastname").style.border = "1px solid #ccc";
      document.getElementById("fname").style.border = "1px solid #ccc"; 
      document.getElementById("uemail").style.border = "1px solid #ccc"; 
      document.getElementById("uphone").style.border = "1px solid #ccc"; 
      document.getElementById("pass").style.border = "1px solid #ccc";
      document.getElementById("cpass").style.border = "1px solid #ccc"; 
      document.getElementById("user_login1").style.border = "1px solid #ccc"; 
      document.getElementById("search-input_deny").style.border = "1px solid #ccc"; 
    }  
});


</script>


<script>

  jQuery(document).ready(function(){

   $("#r_buis_logo_image_new_1").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target_bus_logo").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target_bus_logo', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
      backgroundColor: '#fff',

      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             $("#btn-example-file-reset2").show();
             $("#ret_logo").val(newImage);
             $("#new_target_logo").attr("src", newImage);
             jQuery("#add_event_bus_logo").attr("src", newImage);
             jQuery("#add_bus_preview_logo").show();
             jQuery("#add_business_logo").modal('hide');

           }
         },
       },
      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
      }
    });
   });
   $('#btn-example-file-reset2').on('click', function(e) {
    $('#new_target_logo').attr('src', '');
    $('#btn-example-file-reset2').hide();
    var $el = $('#r_buis_logo_image_new_1');
    $el.wrap('<form>').closest('form').get(0).reset();
    $el.unwrap();
    return myFunction_new1();

  });

   function myFunction_new1() {
    var x = document.createElement("IMG");
    x.setAttribute("id", "target_bus_logo");
    document.body.appendChild(x);
    document.getElementById('add_target2').append(x);
  } 

}); 
</script>

<script>

  jQuery(document).ready(function(){

   $("#f_fund_images").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target_fund_img_new").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target_fund_img_new', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
     // backgroundColor: '#fff',

      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
          
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             $("#fund_image_new").val(newImage);
             $("#new_target_fund_img").attr("src", newImage);
             $("#btn-example-file-reset").show();
             jQuery("#add_event_fund_image").attr("src", newImage);
             jQuery("#add_preview_image").show();
             jQuery("#add_fundraiser_image").modal('hide');
           }
         },
       },

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
         //cropPlugin.selectZone(170, 25, 300, 300);
       // cropPlugin.requireFocus();
     }
   });
   });

 }); 
</script>

<script>

 $('#btn-example-file-reset').on('click', function(e) {
  $('#new_target_fund_img').attr('src', '');
  $('#btn-example-file-reset').hide();
  var $el = $('#f_fund_images');
  $el.wrap('<form>').closest('form').get(0).reset();
  $el.unwrap();
  return myFunction();
});

 function myFunction() {
  var x = document.createElement("IMG");
  x.setAttribute("id", "target_fund_img_new");
  document.body.appendChild(x);
  document.getElementById('add_target').append(x);
}  

</script>



<!-- for fundraiser logo start -->

<script>

  jQuery(document).ready(function(){

   $("#f_fund_logo").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target_fund_logo_new").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target_fund_logo_new', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
     // backgroundColor: '#fff',

      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
          
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             $("#fund_logo_new").val(newImage);
             $("#new_target_fund_logo").attr("src", newImage);
             $("#btn-example-file-logo").show();
             jQuery("#add_event_fund_logo").attr("src", newImage);
             jQuery("#add_preview_logo").show();
             jQuery("#add_fundraiser_logo").modal('hide');
           }
         },
       },

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
         //cropPlugin.selectZone(170, 25, 300, 300);
       // cropPlugin.requireFocus();
     }
   });
   });

 }); 
</script>

<script>

 $('#btn-example-file-logo').on('click', function(e) {
  $('#new_target_fund_logo').attr('src', '');
  $('#btn-example-file-logo').hide();
  var $el = $('#f_fund_logo');
  $el.wrap('<form>').closest('form').get(0).reset();
  $el.unwrap();
  return myFunction();
});

 function myFunction() {
  var x = document.createElement("IMG");
  x.setAttribute("id", "target_fund_logo_new");
  document.body.appendChild(x);
  document.getElementById('add_target_logo').append(x);
}  

</script>

<!-- for fundraiser logo end -->




<!-- for edit retialer business or fundraiser event -->

<script>

  jQuery(document).ready(function(){

   $("#edit_images_1").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target_edit_bus_img").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target_edit_bus_img', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
      //backgroundColor: '#fff',

      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67, //key "c"
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             //varThatStoresYourImageData = newImage;

       //var profile_img = jQuery('#get_p_image_bus').val(); 
       
       //alert(profile1);

       $("#edit_image_val").val(newImage);
       $("#new_edit_target_img").attr("src", newImage);
       $("#edit-btn-example-file-reset").show();
       jQuery('#edit_event_bus_image').attr("src", newImage);
       jQuery('#edit_bus_preview_image').show();
       jQuery('#edit_business_image').modal('hide');
     }
   },
 },

      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
         //cropPlugin.selectZone(170, 25, 300, 300);
       // cropPlugin.requireFocus();
     }
   });
   });
   $('#edit-btn-example-file-reset').on('click', function(e) {
    $('#new_edit_target_img').attr('src', '');
    $('#edit-btn-example-file-reset').hide();
    var $el = $('#edit_images_1');
    $el.wrap('<form>').closest('form').get(0).reset();
    $el.unwrap();
    return myFunction_edit_bus_1();
  });
   function myFunction_edit_bus_1() {
    var xx = document.createElement("IMG");
    xx.setAttribute("id", "target_edit_bus_img");
    document.body.appendChild(xx);
    document.getElementById('edit_add_target').append(xx);
  } 

}); 
</script>

<script>

  jQuery(document).ready(function(){

   $("#busness_logo").on("change", function() {
     $("[for=file]").html(this.files[0].name);
     $("#target_edit_bus_logo").attr("src", URL.createObjectURL(this.files[0]));
     var dkrm = new Darkroom('#target_edit_bus_logo', {
      // Size options
      minWidth: 100,
      minHeight: 100,
      maxWidth: 600,
      maxHeight: 500,
      ratio: 4/3,
      // Plugins options
      plugins: {
        //save: false,
        crop: {
          quickCropKey: 67,
          minHeight: 50,
          minWidth: 50,
          ratio: 4/3
        },
        save: {
         callback: function() {
             this.darkroom.selfDestroy(); // Turn off the bar and cleanup
             var newImage = dkrm.canvas.toDataURL();
             $("#edit_image_val_logo").val(newImage);
             $("#new_edit_target_logo").attr("src", newImage);
             $("#edit-logo-btn-example-file-reset").show();

             jQuery('#edit_bus_preview_logo').show();
             jQuery('#edit_event_bus_logo').attr("src", newImage);
             jQuery('#edit_business_logo').modal('hide');
           }
         },
       },
      // Post initialize script
      initialize: function() {
        var cropPlugin = this.plugins['crop'];
      }
    });
   });

   $('#edit-logo-btn-example-file-reset').on('click', function(e) {
    $('#new_edit_target_logo').attr('src', '');
    $('#edit-logo-btn-example-file-reset').hide();
    var $el = $('#busness_logo');
    $el.wrap('<form>').closest('form').get(0).reset();
    $el.unwrap();
    return myFunction_edit_bus_logoo();
  });
   function myFunction_edit_bus_logoo() {
    var xxslogo = document.createElement("IMG");
    xxslogo.setAttribute("id", "target_edit_bus_logo");
    document.body.appendChild(xxslogo);
    document.getElementById('edit_add_target_logo').append(xxslogo);
  } 
}); 
</script>

<script>
  $('p').each(function() {
    var $this = $(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
    $this.remove();
  });
  $(".alert_close_btn").click(function(){
    $(".alert_background").hide();
  });
  
</script>

<script>
  $(document).ready(function()
  {
     document.getElementById("myBtn").setAttribute("disabled","disabled");
  });
  </script>

<!-- Tel no Js --> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/js/intlTelInput.min.js"></script>

<script>
  $("#uphone").intlTelInput(
  {

// typing digits after a valid number will be added to the extension part of the number
allowExtensions: false,

// automatically format the number according to the selected country
autoFormat: true,

// if there is just a dial code in the input: remove it on blur, and re-add it on focus
autoHideDialCode: true,

// add or remove input placeholder with an example number for the selected country
autoPlaceholder: true,

// default country
defaultCountry: "",

// geoIp lookup function
geoIpLookup: null,

// don't insert international dial codes
nationalMode: false,

// number type to use for placeholders
numberType: "MOBILE",

// display only these countries
onlyCountries: [],

// the countries at the top of the list. defaults to united states and united kingdom
preferredCountries: [ "us", "in" ],

// specify the path to the libphonenumber script to enable validation/formatting
//utilsScript: ""

});
</script>

<script>
  $(document).ready(function() {

/*$('input[name="new_status"]').change(function() 
 {
  alert("jhhhhhhhhh");
   if($(this).is(':checked') && $(this).val() == 'deny') 
{
  alert("heloooo");
    $('#deny_request').modal('show');
}
}*/

/*    alert('jjjjjjjjjjjjj');*/
    $("#owl-demo").owlCarousel({
          autoPlay: 3000, //Set AutoPlay to 3 seconds
          items : 5,
          itemsDesktop : [900,3],
          itemsDesktopSmall : [979,3]
        });
  });

  $(document).ready(function() {
    $("#owl-demo2").owlCarousel({
          autoPlay: 3000, //Set AutoPlay to 3 seconds
          items : 1,
          itemsDesktop : [900,3],
          itemsDesktopSmall : [979,3]
        });
  }); 

  $('#f_event_date').datepicker({
    Format: 'mm-dd-yyyy',
    autoclose:true,
    startDate: new Date(),
  }).on('changeDate',function(e){
    $('#f_event_e__date').datepicker('setStartDate',e.date)
  });

  $('#f_event_e__date').datepicker({
    Format: 'mm-dd-yyyy',
    autoclose:true,
  }).on('changeDate',function(e){
    $('#f_event_date').datepicker('setEndDate',e.date)
  });

  /*date for edit event*/

  $('#edit_event_date').datepicker({
    Format: 'mm-dd-yyyy',
    autoclose:true,
    startDate: new Date(),
  }).on('changeDate',function(e){
    $('#edit_event_e__date').datepicker('setStartDate',e.date)
  });

  $('#edit_event_e__date').datepicker({
    Format: 'mm-dd-yyyy',
    autoclose:true,
  }).on('changeDate',function(e){
    $('#edit_event_date').datepicker('setEndDate',e.date)
  });

  /*======date for  Business Events======*/
  $('#e_s_date').datepicker({
    Format: 'mm-dd-yyyy',
    autoclose:true,
    startDate: new Date(),
  }).on('changeDate',function(events){
    $('#e_e_date').datepicker('setStartDate',events.date)
  });

  $('#e_e_date').datepicker({
    Format: 'mm-dd-yyyy',
    autoclose:true,
  }).on('changeDate',function(event){
    $('#e_s_date').datepicker('setEndDate',event.date)
  }); 

  jQuery('input.timepicker').timepicker();

</script>

<script>
  new WOW().init();
</script>

<script>	
	function Setlink()
	{ 
	 //alert(Text);
	 
   var link = $('input[name=acc_type]:checked').val();

   if(link == 'retailer') 
   {
     location.href='<?php echo site_url();?>/create-fundraising-host-page/';
   }
   else if(link == 'fundraiser')
   {

     location.href='<?php echo site_url();?>/create-fundraising-event-page/';
   }

 }
</script>



<script>

  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }


  $(document).ready(function()
  {

    $(document).on('keyup', '#donation', function() {
      var x = $(this).val();
      $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });
  });

  $(document).ready(function()
  {


    $(document).on('keyup', '#f_fund_amte', function() {
      var x = $(this).val();
      $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });


    $('.dropbtn').click(
      function(){
        $("#search-id").val('');
        $("#shows_result").hide();
        $(".main_ul_menu").show();

      });

    $(".single_cate > p").addClass("add_cat_text");
    $(".slider > .attachment-full").addClass("img-responsive center-block");
  });


  $(".tag_remove > .horizontal").addClass("tag_removes");
  $(".tag_removes > .mo-openid-share-link:nth-child(1)").addClass("hvr-sweep-to-right-btn");
  $('.tag_removes .mo-openid-share-link:nth-child(2)').addClass("hvr-sweep-to-left-btn");
  $(".hvr-sweep-to-left-btn .mo-custom-share-icon").removeAttr("style");
  $(".hvr-sweep-to-right-btn .mo-custom-share-icon").removeAttr("style");
  $('.tag_remove + br').remove();
  $('.tag_removes + p').remove();


  $(document).ready(function(){

    $(this).scrollTop(0);

  });

  $(document).ready(function() 
  {
    $("input.search-field").after('<button type="submit" value="Search" class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>');
  });

  $(document).ready(function() {
   $("input.search-field").prop('required',true);
 });

  $(document).ready(function() {
    $('.logout').each(function() {
     $(this).prepend('<i class="fa fa-sign-out" aria-hidden="true"></i>');
   });

    document.getElementById("find-sec").style.backgroundImage = "url('<?php echo site_url();?>/wp-content/themes/twentyfifteen/images/find-back.jpg')";
    document.getElementById("find-sec").style.backgroundRepeat = "no-repeat";

    document.getElementById("best-pac-sec").style.backgroundImage = "url('<?php echo site_url();?>/wp-content/uploads/2017/09/local-buss.jpg')";
    document.getElementById("best-pac-sec").style.backgroundRepeat = "no-repeat";

    document.getElementById("box_test").style.backgroundImage = "url('<?php echo site_url();?>/wp-content/uploads/2017/12/testi2.jpg')";
    document.getElementById("box_test").style.backgroundRepeat = "no-repeat";
  });
</script>
<script>
  $('#myAffix').affix({
    offset: {
      top: 100,
      bottom: function () {
        return (this.bottom = $('.footer').outerHeight(true))
      }
    }
  });
</script>

<script>
  $(document).ready(function(){
    $('.bxslider').bxSlider({
     auto: true,
     mode:'horizontal',
   });
  });

</script>
<script>
 $(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip(); 
  $('[data-toggle="tooltip2"]').tooltip(); 
  $('[data-toggle="modal"]').tooltip(); 
});
</script>  

<script>
 $(document).ready(function() {

  $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
    numPanelOpen = $(accordionId + ' .collapse.in').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
    } else {
      closeAllPanels(accordionId);
    }
  });

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .panel-collapse:not(".in")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .panel-collapse.in').collapse('hide');
  }

});

</script>

<script>
  $('.dropbtn').hover(
   function(){ $('ul.file_menu li').first().addClass('active') },
       //function(){ $('.file_menu li').removeClass('active') }
       )
  $('ul.file_menu > li').hover(function () {
    $(this).toggleClass('active').siblings().removeClass('active');
  });

</script>


<!-- script for show deny popup -->



<?php 

if(is_user_logged_in())
{


  global $current_user; 

  get_currentuserinfo();

  if ( $current_user ) 
  {
   $permission = get_user_meta( $current_user->ID, 'user_type' , true );

   if ( empty( $permission ) && !current_user_can('administrator') )
   {

     ?>
     <style> 
     #overlay-act-aftr-login .modal-header {
      background: #19bf7e none repeat scroll 0 0;
      border-bottom: 1px solid #e5e5e5;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      padding: 20px 31px;
    }
    #overlay-act-aftr-login .act-acc {
      padding: 25px;
      line-height: 22px;
    }
    #overlay-act-aftr-login .modal-body > h4, #overlay-act-aftr-login .modal-body > p {
      text-align: center;
      margin-top: 18px;
    }
    #overlay-act-aftr-login	.modal-dialog {
      margin-top: 15%;
      width: 500px;
    }
    #overlay-act-aftr-login .donat {
      background: #19bf7e none repeat scroll 0 0;
      border: 2px solid transparent;
      color: #fff;
      font-size: 20px;
      font-weight: 600;
      margin: 19px 0 0 9em;
      padding: 5px 30px;
      transition: all 1s ease 0s;
    }

    #overlay-act-aftr-login .action-button {
      background: #19bf7e none repeat scroll 0 0;
      border: 2px solid transparent;
      border-radius: 1px;
      color: #fff;
      cursor: pointer;
      font-family: Roboto;
      font-size: 15px;
      font-weight: bold;
      letter-spacing: 0.5px;
      margin: 10px 5px 4px;
      padding: 7px 5px;
      width: 100px;
    }

    #overlay-act-aftr-login #sel-opt-in .action-button:hover, #overlay-act-aftr-login .action-button:focus {
      box-shadow: 0 0 0 2px #fff, 0 0 0 3px #19bf7e;
    }

    #overlay-act-aftr-login  > form {
      text-align: center;
    }				

    #overlay-act-aftr-login .radio-inline > input {
      float: left;
      left: 5em;
      position: absolute;
    }

    #overlay-act-aftr-login input {
      border: 1px solid #ccc;
      border-radius: 0;
      box-sizing: border-box;
      color: #2c3e50;
      font-size: 14px;
      margin-bottom: 15px;
      padding: 5px 10px;
      width: 100%;
    }
    .sub-opt-in {
      text-align: center;
    }

    .sel-opt-in {
      float: left;
      margin: 25px;
      position: relative;
      text-align: center;
      width: 100%;
    }
    #overlay-act-aftr-login .radio-inline {
      display: inline-block;
      float: left;
      font-size: 15px;
      font-weight: 900;
      margin-bottom: 15px;
      margin-left: 8em;
      padding: 0;
      position: relative;
      right: 3em;
      width: auto;
    }

    #wpadminbar {
      background: #23282d none repeat scroll 0 0;
      color: #ccc;
      direction: ltr;
      font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
      height: 32px;
      left: 0;
      min-width: 600px;
      position: fixed;
      top: 0;
      width: 100%;
      z-index:0 !important;
    }



    .submit.action-button:disabled {
     cursor: not-allowed;
     opacity: 0.20;
   }

 </style>
 <?php 
}
}
}
?>
<style> 
#show_result > h3 {
  text-align: center;
}
#overlay-act-signup-succ .modal-header {
  background: #19bf7e none repeat scroll 0 0;
  border-bottom: 1px solid #e5e5e5;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  padding: 20px 31px;
}
#overlay-act-signup-succ .act-acc {
  /*padding: 25px;*/
  line-height: 22px;
  text-align: center;
}
#overlay-act-signup-succ .modal-body > h4 {
  text-align: center;
}
#overlay-act-signup-succ .modal-body > p {
  text-align: center;
}

.auth-code.form-control {
  margin: 0 auto;
  position: relative;
  top: 15px;
  width: 50%;
}
#auth-code {
  background: #19bf7e none repeat scroll 0 0;
  border: 2px solid;
  color: #fff;
  margin: 20px 10px 10px 11em;
  padding: 7px 5px;
  position: relative;
  top: 20px;
  width: 110px;
}
#overlay-act-signup-succ .modal-dialog {margin-top:10%;}

#overlay-act-signup-succ .action-button:hover, #overlay-act-signup-succ .action-button:focus, #overlay-act-signup-succ .action-button:active {
  box-shadow: 0 0 0 2px #fff, 0 0 0 3px #19bf7e;
}       


#will_u_ret_or_fund .modal-header {
  background: #19BF7E none repeat scroll 0 0;
  border-bottom: 1px solid #e5e5e5;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  padding: 20px 31px;
}
#will_u_ret_or_fund .act-acc {
  /*padding: 25px;*/
  line-height: 22px;
  text-align: center;
  color: green;
}
#will_u_ret_or_fund .modal-body > h4 {
  text-align: center;
}
#will_u_ret_or_fund .modal-body > p {
  text-align: center;
}

.auth-code.form-control {
  margin: 0 auto;
  position: relative;
  top: 15px;
  width: 50%;
}
#auth-code {
  background: #19bf7e none repeat scroll 0 0;
  border: 2px solid;
  color: #fff;
  margin: 20px 10px 10px 11em;
  padding: 7px 5px;
  position: relative;
  top: 20px;
  width: 110px;
}

#ret_or_fund .action-button {
  background: #19bf7e none repeat scroll 0 0;
  border: 2px solid transparent;
  border-radius: 1px;
  color: #fff;
  cursor: pointer;
  font-family: Roboto;
  font-size: 15px;
  font-weight: bold;
  left: -10em;
  letter-spacing: 0.5px;
  margin: 20px 5px 4px;
  padding: 7px 5px;
  position: relative;
  width: 100px;
}

#will_u_ret_or_fund .modal-dialog {margin-top:10%;}

#ret_or_fund .action-button:hover, #ret_or_fund .action-button:focus, #ret_or_fund .action-button:active {
  box-shadow: 0 0 0 2px #fff, 0 0 0 3px #19bf7e;
}   


#will_u_ret_or_fund .modal-body form label {
  color: #575757;
  font-size: 14px;
  font-weight: 600;
}

#will_u_ret_or_fund .radio-inline {
  display: inline-block;
  float: left;
  margin-bottom: 15px;
  margin-left: 3em;
  margin-top: 15px;
  padding-left: 20px;
  position: relative;
  width: 30%;
}
#will_u_ret_or_fund .radio-inline > input {
  float: left;
  position: absolute;
}

#will_u_ret_or_fund .act-acc-p {
  text-align: center;
}

#ret_fund_event_create .modal-dialog {
  margin-top: 0%;
  width: 520px;
}

#ret_fund_event_create #msform {
  margin: 5px auto;
  position: relative;
  text-align: center;
  width: 490px;
  padding-bottom: 23px;
}

#ret_fund_event_create #msform .fs-title {
  color: #19bf7e;
  font-size: 15px;
  font-weight: 600;
  line-height: 23px;
  margin-bottom: 10px;
  margin-top: 0;
  text-align: left;
  text-transform: uppercase;
}

#ret_fund_event_create .modal-header {
  background: #19bf7e none repeat scroll 0 0;
  border-bottom: 1px solid #e5e5e5;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  padding: 20px 31px;
}

#ret_fund_event_create #event_create .action-button {
  background: #19bf7e none repeat scroll 0 0;
  border: 2px solid transparent;
  color: #fff;
  cursor: pointer;
  font-family: Roboto;
  font-size: 15px;
  font-weight: bold;
  letter-spacing: 0.5px;
  margin: 10px 5px 4px;
  padding: 7px 5px;
  width:100px;
  border-radius:4px;
}

#ret_fund_event_create #event_create .action-button:hover, #event_create .action-button:focus, #event_create .action-button:active {
  box-shadow: 0 0 0 2px #fff, 0 0 0 3px #19bf7e;
}

#ret_fund_event_create #event_create_fund .action-button:hover, #event_create_fund .action-button:focus, #event_create_fund .action-button:active {
  box-shadow: 0 0 0 2px #fff, 0 0 0 3px #19bf7e;
}

.addressmap{margin-left: -46px;margin-top: 10px;}

#overlay-act-aftrlogin .modal-header {
  background: #19bf7e none repeat scroll 0 0;
  border-bottom: 1px solid #e5e5e5;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  padding: 20px 31px;
}
#overlay-act-aftrlogin .act-acc {
  /*padding: 25px;*/
  line-height: 22px;
  text-align: center;
}
#overlay-act-aftrlogin .modal-body > h4 {
  text-align: center;
}
#overlay-act-aftrlogin .modal-body > p {
  text-align: center;
}

.auth-code.form-control {
  margin: 0 auto;
  position: relative;
  top: 15px;
  width: 50%;
}
#auth-code {
  background: #19bf7e none repeat scroll 0 0;
  border: 2px solid;
  color: #fff;
  margin: 20px 10px 10px 11em;
  padding: 7px 5px;
  position: relative;
  top: 20px;
  width: 110px;
}
#overlay-act-aftrlogin .modal-dialog {margin-top:10%;}

#overlay-act-aftrlogin .action-button:hover, #overlay-act-aftrlogin .action-button:focus, #overlay-act-aftrlogin .action-button:active {
  box-shadow: 0 0 0 2px #fff, 0 0 0 3px #19bf7e;
}   



</style>


<?php wp_footer(); ?>
</body>
</html>
