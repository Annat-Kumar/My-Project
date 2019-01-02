<?Php
/*
Template Name: Edit Events
*/
if ( is_user_logged_in() ) {

 $user = wp_get_current_user();
 $user_ids =  $user->ID;

 $post_id = $_GET['edit_id'];

 /*echo $post_id;

 echo "<br>";*/
get_header();

 $author_id = get_post_field ('post_author', $post_id);

 if($user_ids == $author_id)
 {

 ?>
 <?php 
 if(isset($_GET['edit_id']))
 {
  $post_id = $_GET['edit_id'];

  if(isset($_POST['edit_submit']))
  {

/*echo "<pre>";
print_r($_POST);
die();*/



    $auth_name = $_POST['auth_name'];
    $auth_email= $_POST['auth_email'];

    if($_POST['edit_description90'])
    {
      $send_mag = $_POST['edit_description90'];
    }
    else
    {
      $send_mag = 'n/a';
    }

    $fund_image  = $_POST['edit_image_event'];

    $fund_logo  = $_POST['edit_logo_event'];

    $tax_deductible = $_post['tax_deductible'];


    $f_cat= $_POST['cat'];
    $cat_ids[] = $f_cat;
    $cat_ids = array_map( 'intval', $cat_ids );
    $cat_ids = array_unique( $cat_ids );
    $taxonomy = 'fund_cate';

        //Add selected category to this current post
    wp_set_object_terms($post_id, $cat_ids, $taxonomy , $append );

    global $wpdb;
    $get_result = $wpdb->get_results("SELECT * FROM wp_posts where ID = $post_id");
    foreach ($get_result as $key => $status) {
      $post_status = $status->post_status;
    }

    $e_fund_city = $_POST['e_fund_city']; 
    $e_fund_zip  = $_POST['e_findzip']; 
    /*	 $edit_s_date = $_POST['edit_event_date'];*/
    $edit_s_time = $_POST['edit_fund_s_time'];
    $edit_e_date = $_POST['edit_event_e__date'];
    $edit_e_time = $_POST['edit_fund_e_time'];
    $edit_amount = $_POST['edit_fund_amt'];
    $edit_img1   = $_FILES['feature_image_1'];
    /* $edit_img2   = $_FILES['feature_image_2'];*/

    $edit_s_date = date_create($_POST['edit_event_date']);
    $f_dated = date_format($edit_s_date,"Y/m/d");

    $edit_e_date = date_create($_POST['edit_event_e__date']);
    $f_e_dated = date_format($edit_e_date,"Y/m/d");




    $admin_email = get_option( 'admin_email' );

    $error1 = $edit_img1['error'];
    $error2 = $edit_img2['error'];

    $f_fund_names     = stripslashes(stripslashes(stripslashes($_POST['edit_title'])));
    $f_fund_name = str_replace('\"', '', $f_fund_names);

    $f_fune_discs = stripslashes(stripslashes(stripslashes($_POST['edit_description'])));
    $f_fune_disc = str_replace('\"', '', $f_fune_discs); 



    $update_event = wp_update_post( array(
      'post_status' => $post_status,
      'post_type' => 'fundraiser',
      'post_title' => $f_fund_name,
      'post_content' => $f_fune_disc,
      'ID'            =>$post_id,
      'author'  =>  $user_ids 
    ) ); 

       //image upload
    if($fund_image != '' )
    {
      $image_parts = explode(";base64,", $fund_image);

      $image_base64 = base64_decode($image_parts[1]);

      $directory = "/".date(Y)."/".date(m)."/";

      $wp_upload_dir = wp_upload_dir( null, false );

      $upload =  $wp_upload_dir['basedir'];

      $filename = "IMG_".time().".png";

      $fileurl = $upload.$directory.$filename;

      $filetype = wp_check_filetype( basename( $fileurl), null );

      file_put_contents($fileurl, $image_base64);

      $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename( $fileurl ),
        'post_mime_type' => $filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($fileurl)),
        'post_content' => '',
        'post_status' => 'inherit'
      );

      $attach_id = wp_insert_attachment( $attachment, $fileurl ,$post_ids);

      require_once ABSPATH . 'wp-admin/includes/image.php';

      $attach_data = wp_generate_attachment_metadata( $attach_id, $fileurl );
      wp_update_attachment_metadata( $attach_id, $attach_data );

      set_post_thumbnail( $post_id, $attach_id );
    }

    //logo upload

if($fund_logo != '' )
{
$image_parts2 = explode(";base64,", $fund_logo);

$image_base642 = base64_decode($image_parts2[1]);

$directory2 = "/".date(Y)."/".date(m)."/";

$wp_upload_dir2 = wp_upload_dir( null, false );

$upload2 =  $wp_upload_dir2['basedir'];

//print_r($wp_upload_dir);


$filename2 = "IMG_".time().".png";

//$fileurl = $upload.'/'.$filename;

 $fileurl2 = $upload2.$directory2.$filename2;

 $filetype2 = wp_check_filetype( basename( $fileurl2), null );
 //print_r($filetype);

 file_put_contents($fileurl2, $image_base642);

 $attachment2 = array(
        'guid' => $wp_upload_dir2['url'] . '/' . basename( $fileurl2 ),
        'post_mime_type' => $filetype2['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($fileurl2)),
        'post_content' => '',
        'post_status' => 'inherit'
    );
  
   //print_r($attachment);
  
  //echo "<br>file name :  $fileurl";

  $attach_id2 = wp_insert_attachment( $attachment2, $fileurl2 ,$post_id);
  
  require_once ABSPATH . 'wp-admin/includes/image.php';

  $attach_data2 = wp_generate_attachment_metadata( $attach_id2, $fileurl2 );
  wp_update_attachment_metadata( $attach_id2, $attach_data2 );

    update_post_meta($post_id,'fundraiser_logo', $attach_id2);
    update_post_meta($post_id,'_fundraiser_logo', 'field_59dc69cde495f');

}

if($tax_deductible != '')
{
  update_post_meta( $post_id, 'tax_deductible', $tax_deductible );
}



    update_post_meta( $post_id, 'fund_title', $_POST['edit_title'] );
    update_post_meta( $post_id, 'fund_city', $e_fund_city );
    update_post_meta( $post_id, 'fund_zip', $e_fund_zip );
    update_post_meta( $post_id, 'select_date', $f_dated  );
    update_post_meta( $post_id, 'start_time', $edit_s_time );
    update_post_meta( $post_id, 'event_expire_date', $f_e_dated  );
    update_post_meta( $post_id, 'end_time', $edit_e_time );
    update_post_meta( $post_id, 'amount', $edit_amount);

    global $wpdb;



    /*    $post_title = $_POST['edit_title'];*/
    $post_titles = stripslashes(stripslashes(stripslashes($_POST['edit_title'])));
    $post_title = str_replace('\"', '', $post_titles);

/*    $edit_e_date=date_create($_POST['edit_event_e__date']);
$f_e_dated=date_format($edit_e_date,"Y/m/d");  */


$Update = $wpdb->query("UPDATE wp_post_relationships SET f_name = '$post_title', f_date = '$f_dated',f_end_date = '$f_e_dated', f_start_time = '$edit_s_time', f_end_time = '$edit_e_time' WHERE f_id = '$post_id' ");

if($post_title)
{
  $Update_wp_donttion = $wpdb->query("UPDATE wp_donation SET fund_name = '$post_title' WHERE fund_ent_id = '$post_id' ");
}

if($edit_s_date)
{
  $Update_wp_donttion1 = $wpdb->query("UPDATE wp_donation SET fund_event_s_date = '$f_dated' WHERE fund_ent_id = '$post_id' ");
}

if($edit_e_date)
{
  $Update_wp_donttion2 = $wpdb->query("UPDATE wp_donation SET fund_event_e_date = '$f_e_dated' WHERE fund_ent_id = '$post_id' ");
}

if($Update && !empty($Update))
{

  // write the email content for fundraiser
  @$header1 .= "MIME-Version: 1.0\n";
  $header1 .= "Content-Type: text/html; charset=utf-8\n";
  @$header1s .= "From:" . $admin_email;

  $message11 .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
  <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ",$auth_name) . 
  "</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
  $message11 .= __('<div style="padding: 0px 0;font-size: 18px;line-height: 25px;">The fundraiser event "'.$post_title.'" has been updated for new availability with date and time for approvel.','piereg</div>') . "</div>";


  $message11 .= __('<div style="padding: 10px 0;font-size: 18px;line-height: 30px;">Message:-'.$send_mag,'piereg</div>') . "</div>"; 


  $message11 .='</div><div style=color: #999;padding: 50px 30px">
  <div style="">Regards,</div>
  <div style="">RaiseIT Team</div>            
  </div></body></html>';

  $subject1 = "Raise It Notification";


  $subject1 = "=?utf-8?B?" . base64_encode($subject1) . "?=";

          // send the email to fundraiser
  $email11 = wp_mail($auth_email, $subject1, $message11, $header1);

}


echo '<button type="button" class="btn btn-info btn-lg edit_info" data-toggle="modal" data-target="#myModaedit" style="display: none;">Edit</button>';

}
}
?>
<div class="grey_back">
  <!--   <div class="grey_back"> -->
    <div class="container">
     <div class="row">
      <div class="padding_row">
        <form id="edit_event" action="" method="post" enctype="multipart/form-data">
         <?php
         if ( is_user_logged_in() ) {
           while ( have_posts() ) : the_post(); ?>
           <div class="col-sm-6 col-md-6 text_form">
             <div class="form-group">
               <label>Event Name</label>
               <input type="text" class="form-control" name="edit_title" value="<?php echo get_the_title($post_id ); ?>">
             </div>
             <div class="form-group">
               <label>Tell us About Your Fundraiser</label>
               <textarea type="textarea" class="form-control" name="edit_description" rows="3" placeholder="Your Fundraiser Event Description" id="f_fund_description"><?php echo get_post_field('post_content',$post_id); ?></textarea>

             </div>
             <div class="col-sm-6 e_fund_city">
              <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" name="e_fund_city" rows="3" placeholder="City" value="<?php echo get_field('fund_city',$post_id);?>" id="e_fund_city">
              </div>
            </div>
            <div class="col-sm-6 e_fund_zip">

              <div class="form-group">
                <label>Zipcode</label>
                <input  type="text" class="form-control" name="e_findzip" rows="3" placeholder="Zipcode" id="e_findzip" value="<?php echo get_field('fund_zip',$post_id);?>" onkeypress="return isNumber(event)">
              </div>
            </div>
            <div class="form-group">
             <label>Your Event Category</label>
             <?php

             $taxonomy = 'fund_cate';
             $terms_cat = wp_get_post_terms( $post_id, $taxonomy);

             foreach($terms_cat as $cat_name){
               $tt = $cat_name->name;
               $ti = $cat_name->term_id;

             }
             ?>
             <select id="cat" class="postform" name="cat" value="<?php echo $tt;?>">
              <?php 

              $terms = get_terms( array(
               'taxonomy' => 'fund_cate',
               'hide_empty' => false
             ) );

              foreach($terms as $termName)
              {
               $selected = ( $ti == $termName->term_id  ) ? 'selected' : '';
               echo '<option class="level-0" value="' . $termName->term_id . '" ' . $selected . '>'.$termName->name.'</option>';
             }
             ?> 
           </select>

         </div>

         <div class="form-group">
           <label><label>Please Select Date And Time to Start Your Event</label></label>
           <ul class="list-unstyled list-inline s_datetime">
            <li>
              <input type="text" name="edit_event_date" class="form-control" id="edit_event_date" placeholder="Select Event Start Date" value="<?php echo get_field('select_date',$post_id);?>"><i class="fa fa-calendar cal" aria-hidden="true"></i>
            </li>
            <li>
              <input type="text" id='edit_fund_s_time' placeholder="Event Start Time" class="timepicker form-control" name="edit_fund_s_time" value="<?php echo get_field('start_time',$post_id);?>" />
              <i class="fa fa-clock-o cal" aria-hidden="true"></i>
            </li>
          </ul>
        </div>
        <div class="form-group">
          <label>Please Select Date And Time to Expire Your Event</label>
          <ul class="list-unstyled list-inline e_datetime">
            <li>
              <input type="text" name="edit_event_e__date" class="form-control" id="edit_event_e__date" placeholder="Select Event Expire Date" value="<?Php echo get_field('event_expire_date',$post_id  );?>"><i class="fa fa-calendar cal" aria-hidden="true"></i>
            </li>
            <li>
              <input type="text" id='edit_fund_e_time' placeholder="Event Expire Time" class="timepicker form-control" name="edit_fund_e_time" value="<?php echo get_field('end_time',$post_id);?>" />
              <i class="fa fa-clock-o cal" aria-hidden="true"></i>
            </li>
          </ul>
        </div>

        <div class="form-group">
          <label>Amount of Money You Would Like to Raise</label>
          <input id="edit_fund_amt" name="edit_fund_amt" type="text" class="form-control active" placeholder="Fundraising Goal" value="<?php echo get_field('amount',$post_id);?>" maxlength="6" onkeypress="return isNumber(event)">
          <span class="dollor_goal "><i class="fa fa-usd" aria-hidden="true"></i></span>
        </div>
        <div class="form-group">
          <label>501 (c) (3)?</label>
          <input type="checkbox" name="tax_deductible" value="tax_deductible" <?php $tex = get_post_meta( $post_id, 'tax_deductible', true ); if($tex){ echo "checked" ; }?> >
        </div>


        <?php 
        $get_post_query = $wpdb->get_results("SELECT * FROM wp_post_relationships where f_id = $post_id");
        foreach ($get_post_query as $key => $getvalue) {
          $fud_arry_id = $getvalue->f_id;
          $sasa = $getvalue->status;
          $ret_auth_id = $getvalue->rr_author_id;
        }
          //echo $sasa;
        $ret_auth_id;
        $auth_name = get_the_author_meta( 'user_login', $ret_auth_id  );
        $aurh_email= get_the_author_meta( 'user_email', $ret_auth_id  );
        
        ?>

        <input type="hidden" name="auth_name" value="<?php echo get_the_author_meta( 'user_login', $ret_auth_id  );?>">
        <input type="hidden" name="auth_email" value="<?php echo get_the_author_meta( 'user_email', $ret_auth_id  );?>">

        <?php if($sasa == '0'){?>
        <div class="form-group">
          <label>Your Message to Retailer </label>
          <textarea type="textarea" class="form-control" name="edit_description90" rows="3" placeholder="Your message to retailer" id="f_fund_description90" required></textarea>
        </div>   
        <?php }?>  

      </div>
      <div class="col-sm-6 col-md-6">
        <div class="col-md-12 col-sm-12 bounceInRight wow animate slide_imges">
          <div class="iimag_chk lls">
            <div>
             <?php 

             $featured_img_url = get_the_post_thumbnail_url($post_id); 

             if ($featured_img_url) 
             { 
               ?>
               <img class="img-responsive" src="<?php echo $featured_img_url; ?>">
               <?php

             }else{ ?>

             <img class="img-responsive" src="<?php echo site_url();?>/wp-content/uploads/2017/09/not_avail.jpg">

             <?php } ?>


           </div>
         </div>
       </div>
       <div class="col-sm-12 col-md-12 iimg1">

        <div id="show_div" style="display: none;">
        </div>

        <div class="col-sm-12 col-md-6 fund_img1">
         <div class="form-group">
          <button type="button" class="btn btn-info btn-lg zzz">Edit Fundraiser Image</button>
          <input type="hidden" name="edit_image_event" id="edit_image_events" value="">
          <h4 id="preview_img" style="display: none">Preview image</h4>
          <img id="show_edit_target_img_events" class="img-responsive">

        </div>
      </div>
    </div>

<?php
$fundraiser_logo = get_field('fundraiser_logo',$post_id);
$fundraiser_logo_url =  $fundraiser_logo['url'];   
?>    
<div class="col-sm-12 col-md-12 logo_business">
  <h1>Fundraiser Logo</h1>
  <?php
  if($fundraiser_logo){
    ?>
<div class="bus_logo">

    <img class="img-responsive" src="<?php echo $fundraiser_logo_url ; ?>">
</div>
    <?php
  }
  else {
    ?>
<!--     <div class="bus_logo">
    <img class="img-responsive" src="<?php echo site_url();?>/wp-content/uploads/2017/09/not_avail.jpg"> -->
    <?Php } ?>
<!--   </div> -->



       <div class="col-sm-12 col-md-12 iimg1">

        <div id="show_div_logo" style="display: none;">
        </div>

        <div class="col-sm-12 col-md-6 fund_img_logo">
         <div class="form-group">
          <button type="button" class="btn btn-info btn-lg fund_logo">Edit Fundraiser Logo</button>
          <input type="hidden" name="edit_logo_event" id="edit_logo_events" value="">
          <h4 id="preview_logo" style="display: none">Preview Logo</h4>
          <img id="show_edit_target_logo_events" class="img-responsive">

        </div>
      </div>
    </div>

</div>
  </div>
  <?php

endwhile;
}
?>
<div class="col-sm-12 col-md-12 chk_btn">
 <input type="submit" name="edit_submit" value="Update" class="action-button sbut">
</div>

</form>
</div>

</div>
</div>
</div>

<!--<div id="edit_fundraiser_image" class="modal fade" role="dialog">-->
  <div id="edit_fundraiser_image" class="modal fade" style="display:none;">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close refresh" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Event Image</h4>
        </div>
        <div class="modal-body">

          <div class="col-sm-12 col-md-12 f_image2">
           <div class="form-group">
            <span><i class="fa fa-picture-o" aria-hidden="true"></i></span><label for="edit_image_11" class="file-upload__label">Fundraiser Image</label>
            <input type="file" name="feature_image_1" id="edit_image_11" style="display: none;">
          </div>
        </div>  
        <p id="edit-event-img" style="display: none;"><i class="fa fa-times" aria-hidden="true"></i></p>
        <section class="copy">
          <div class="figure-wrapper">
            <figure id="edit_add_target_imgs" class="image-container target">
              <img id="target_edit_event_imgs" class="img-responsive">
            </figure>
            <img id="new_edit_target_img_events" class="img-responsive">
          </div>
        </section>
        <!-- <input type="hidden" name="edit_image_event" id="edit_image_event" value="">  -->   
      </div>
    </div>

  </div>
</div>


<!--<div id="edit_fundraiser_logo" class="modal fade" role="dialog">-->
  <div id="edit_fundraiser_logo" class="modal fade" style="display:none;">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close refresh" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Event Logo</h4>
        </div>
        <div class="modal-body">

          <div class="col-sm-12 col-md-12 f_logo">
           <div class="form-group">
            <span><i class="fa fa-picture-o" aria-hidden="true"></i></span><label for="edit_logo_11" class="file-upload__label">Fundraiser Logo</label>
            <input type="file" name="feature_logo_1" id="edit_logo_11" style="display: none;">
          </div>
        </div>  
        <p id="edit-event-logo" style="display: none;"><i class="fa fa-times" aria-hidden="true"></i></p>
        <section class="copy">
          <div class="figure-wrapper">
            <figure id="edit_add_target_logo" class="image-container target">
              <img id="target_edit_event_logo" class="img-responsive">
            </figure>
            <img id="new_edit_target_logo_events" class="img-responsive">
          </div>
        </section>
        <!-- <input type="hidden" name="edit_image_event" id="edit_image_event" value="">  -->   
      </div>
    </div>

  </div>
</div>


<script>
  jQuery(".zzz").click(function(){

   jQuery('#edit_fundraiser_image').modal({
     backdrop: 'static'
   });

 })
</script>


<script>
  jQuery(".fund_logo").click(function(){

   jQuery('#edit_fundraiser_logo').modal({
     backdrop: 'static'
   });

 })
</script>

<script>

  $(".sbut").click(function(){
    var myImg = document.querySelector(".thumb_load1");
    var realWidth = myImg.naturalWidth;
    var realHeight = myImg.naturalHeight;

    if(realWidth < 630 || realHeight < 490)
    {
      alert("Event image is too small , please upload image with size more than 650px(width) x 430px(Height) and size upto 5MB");
      return false;
    }
  });

</script>
<script>
  $(document).ready(function(){
    $(".edit_info").trigger('click');
    $( ".redirect_pges" ).click(function() {
      window.location.href = "<?php echo home_url();?>/user";
    });

    $(document).on('keyup', '#edit_fund_amt', function() {
      var x = $(this).val();
      $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });

  });
</script>


<style type="text/css">
#edit_event .form-group select{width: 100%;}
#edit_event .form-group #sample dt a{width: 100%;}
#edit_event .form-group #sample{width: 100%; height: auto;margin-bottom: 0;}
/*#overlay-act-change-acc-typess{z-index: 999999;}*/
#edit_event .attachment-full {height: 20px;width: 20px; margin-right: 10px;}

#edit_event .form-group #sample dd ul{width:100%;z-index: 9;}
#edit_event .form-group #sample dd ul li{width: 49%;display: inline-block;vertical-align: top;}
#edit_event .dropdown{margin-top: 0px;}

#edit_event .dropdown dd, .dropdown dt, .dropdown ul { margin:0px; padding:0px; }
#edit_event .dropdown dd { position:relative; }
#edit_event .dropdown a, #edit_event .dropdown a:visited { color:#816c5b; text-decoration:none; outline:none;}
#edit_event .dropdown a:hover { color:#5d4617;}
/*.dropdown dt a:hover { color:#5d4617; border: 1px solid #d0c9af;}*/
#edit_event .dropdown dt a { display:block; padding-right:20px;
  border: 1px solid #BABDC3;border-radius: 4px;}
  #edit_event .dropdown dt a i {
    position: absolute;
    color: #a5a0a0;
    top: 14px;
    right: 10px;
  }
  .logged-in #edit_event .dropdown {
    float: none;
  }
  #edit_event .dropdown dt a span {
    cursor: pointer;
    display: block;
    padding: 9px;
    color: #a5a0a0;
    font-size: 14px;
    font-weight: normal;
  }
</style>
<script>
 jQuery(document).ready(function(){

   var aa = $.noConflict();

   aa(".dropdown img.flag").addClass("flagvisibility");

   aa(".dropdown dt a").click(function() {
    aa(".dropdown dd ul").toggle();
  });

   aa(".dropdown dd ul li a").click(function() {
    var text = aa(this).html();
    aa(".dropdown dt a span").html(text);
    aa(".dropdown dd ul").hide();
    aa("#resultd").html("" + getSelectedValue("sampled"));
    document.getElementById('resultd').value = getSelectedValue("sampled");
  });

   function getSelectedValue(id) {
     return aa("#" + id).find("dt a span.value").html();
   }

   aa(document).bind('click', function(e) {
    var $clicked = aa(e.target);
    if (! $clicked.parents().hasClass("dropdown"))
      aa(".dropdown dd ul").hide();
  });
   aa(".dropdown img.flag").toggleClass("flagvisibility");

 });
</script>

<script>
 $(document).ready(function(){
  $(this).scrollTop(0);

});

</script>
<style>
.image-container.target > img {
  display: none;
}
</style>


<?php 
}
else
{
  echo '<div class="grey_back"><div class="container"><div class="row"><div class="padding_row">';
  echo "<div class='alert alert-warning'>";

  echo '<h1>Warning !</h1>';
  echo "<p>You dont have any permission to edit this event.</p>";
  echo '</div></div></div></div>';
}

}
else
{
  header("location:".site_url()."");
}
get_footer();
?>
