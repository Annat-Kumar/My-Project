<?php 

/**

 * Template Name: All jobs Page

 *

 */
get_header(); 
require 'wepay.php';
// application settings
$user = wp_get_current_user();
get_current_user_id();
if ( in_array( 'administrator', (array) $user->roles ) )
 {
   $account_id = get_option('account_id');
   $access_token = get_option('access_token');
  }
  else
  {
     $account_id = get_user_meta(get_current_user_id(),'wepay_account_id',true);
     $access_token = get_user_meta(get_current_user_id(),'wepay_access_token',true);
  }
    $client_id = get_option('client_id');
    $client_secret = get_option('client_secret');
if($account_id !="" AND $access_token!="")
{  
// change to useProduction for live environments
Wepay::useProduction($client_id, $client_secret);
$wepay = new WePay($access_token);
//check the state of account
$response = $wepay->request('account', array(
'account_id'    => $account_id
));
$state= $response->state;
}
if(isset($_POST['submit_situation'])){
  $date = date('F d, Y', time());
    $us_id=get_current_user_id();
  $old_app=get_post_meta($_POST['request_for_post'],'applicants',true);
  $des=$_POST['request_desc'];
  $media=$_FILES['request_media']['name'];
  $upload_overrides = array( 'test_form' => false );
  $uploadedfile = array(
            'name'     => $_FILES['request_media']['name'],
            'type'     => $_FILES['request_media']['type'],
            'tmp_name' => $_FILES['request_media']['tmp_name'],
            'error'    => $_FILES['request_media']['error'],
            'size'     => $_FILES['request_media']['size']

        );

        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

    if($old_app!="")

     {

      $old_app_array=$old_app.','.$us_id;

     

      update_post_meta($_POST['request_for_post'],'applicants',$old_app_array);

      update_post_meta($_POST['request_for_post'],'applicants_request_date_'.$us_id,$date);

       update_post_meta($_POST['request_for_post'],'applicants_message_'.$us_id,$des);

       update_post_meta($_POST['request_for_post'],'applicants_media_'.$us_id,$movefile['url']);

      }

      else

      {

      update_post_meta($_POST['request_for_post'],'applicants',$us_id);

      update_post_meta($_POST['request_for_post'],'applicants_message_'.$us_id,$des);

      update_post_meta($_POST['request_for_post'],'applicants_media_'.$us_id,$movefile['url']);

      update_post_meta($_POST['request_for_post'],'applicants_request_date_'.$us_id,$date);

      }

  $user = get_user_by( 'id',$_POST['author_of_post'] );
  $name= $user->first_name . ' ' . $user->last_name;
  $email= $user->user_email;
  $headers  = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
  $headers .= "From: Kevin Bendict <".get_option('admin_email').">" . "\r\n";
  $message="Hello ".$name.",<br> <br>A new applicant has request you for your task description<br> <br>Please check it in your profile page.<br><br> Thanks";

      wp_mail($email, 'New Request On your Job', $message, $headers); 

    } 



 ?>

  <div id="black_overlay" style="width: 100%; visibility:hidden;"> 
    <div class="added pop-up">

      <a class="close">&times;</a>

      <h3 class="request_amount">$21</h3>
      <h2 class="request_author">kevin</h2>

      <form name="situation" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="request_for_post" name="request_for_post">
        <input type="hidden" class="author_of_post" name="author_of_post"/>
        <input type="hidden" id="request_by_user" name="request_by_user" value="<?php echo get_current_user_id();?>">

        <span class="request_form request_explain">Explain your situation</span>
        <textarea name="request_desc" placeholder="It's your life. Be Detailed, Descriptive and Honest."></textarea>
        
        <span class="request_form request_explain">Media</span>
        <input type="file" name="request_media">  
        
        <input type="submit" class="send_request" name="submit_situation" value="Send Request"/>

      </form>      

    </div>
  </div>

    <div class="container">
    <div class="row enigma_blog_wrapper">

      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#all">All</a></li>
          
          <?php $wcatTerms = get_terms('types', array('hide_empty' => 0, 'parent' =>0)); 
   
            foreach($wcatTerms as $wcatTerm) : ?>

        <li><a data-toggle="tab" href="#<?php echo $wcatTerm->slug; ?>"><?php echo $wcatTerm->name; ?></a></li>

          <?php endforeach; ?>

      </ul>
      
      <div class="form-wrap">
          <form class="all_jobs" name="search_form" action="" method="post">

          <label>Location: </label>

           <input name="search_loc" id="search_loc" type="text" value="<?php echo $_POST['search_loc'] ; ?>" placeholder="i.e. Anchorage, AK" />

           <input type="submit" name="search_job" style="visibility: hidden;" />

        </form>

        <form class="all_jobs" name="search_form" action="" method="post">

          <label>Author: </label>

           <input name="search_auth" id="search_auth" type="text"  placeholder="i.e. Sapna Rana" value="<?php echo $_POST['search_auth'] ; ?>" />

           <input type="submit" name="search_post" style="visibility: hidden;" />

          </form>
      </div>

<div class="tab-content">
<div id="all" class="tab-pane fade in active">
<?php if(isset($_POST['search_job']))
{
$args1 = array('post_type'=>'task','posts_per_page'=>-9,'paged' => $paged,'meta_query'=>
array(array(
        'key'       => 'job_city',
        'value'     =>$_POST['search_loc'],
        'compare'   => 'LIKE'
    )));
}
else if(isset($_POST['search_post']))
{
function get_user_id_by_display_name( $display_name) {
global $wpdb;
if ( ! $user = $wpdb->get_row( $wpdb->prepare(
"SELECT `ID` FROM $wpdb->users WHERE `display_name` = %s", $display_name
)))
return false;
return $user->ID;
}
$author_name = $_POST['search_auth'];
$author_id = get_user_id_by_display_name($author_name);
if($author_id ==''){$args1 = array('post_type'=>'task','posts_per_page'=>9,'paged' => $paged,'author'=>9.3);}
else{ $args1 = array('post_type'=>'task','posts_per_page'=>-1,'paged' => $paged,'author'=>$author_id);}}
else{$args11 = array('post_type'=>'task','posts_per_page'=>9,'paged' => $paged,'post_status'=>'publish');  
$args1 = array('post_type'=>'task','posts_per_page'=>9,'paged' => $paged ,'meta_query'=>
 array(array(
        'key'       =>'approved_applicants',
        'value'     => false,
        'compare'   => 'LIKE'
    ))); 
}
$query1 = new WP_Query( $args11 ); 
if($query1->have_posts()){
while ($query1->have_posts()) : $query1->the_post(
 ); 
$id1=get_the_ID();
$approved_applicants1 =get_post_meta($id1,'approved_applicants',true);
$applicants1=get_post_meta($id1,'applicants',true);
$app_arr1= explode(',', $applicants1);
//if($approved_applicants1=='')
//{
?>
<div class="col-md-4 col-sm-4 text-center list_all">
<div class="jobimage">
<div class="col-md-12 author_image">
<?php 
$author1=get_the_author_meta('ID'); 
echo get_avatar( $author1, 120);
?>
</div>
<div class="col-md-12 budget_task">
$<?php echo get_post_meta(get_the_ID(),'budget',true); ?>
<input type="hidden" name="req_amount" id="" value="$<?php echo get_post_meta(get_the_ID(),'budget',true); ?>">
</div>
<div class="col-md-12 author_name">
<?php echo get_the_author();?>
<input type="hidden" name="req_author" value="<?php echo get_the_author(); ?>">
</div>
<div class="col-md-12 location_task">
<?php echo get_post_meta(get_the_ID(),'job_city',true); ?>
</div>
<div class="col-md-12 desc_task">
<?php echo get_the_content(); ?>
</div>
<div class="col-md-12 request_task">
<?php 
if(is_user_logged_in())
{
if($author1!=get_current_user_id()) 
{
if(!in_array(get_current_user_id(), $app_arr1)) 
{
if($state=="active")
{
$count=count($app_arr1);
echo '<a class="request_click model" data-authid="'.get_the_author_meta('ID').'" data-jobid="'.get_the_ID().'" data-amt="'.get_post_meta(get_the_ID(),'budget',true).'" data-authname="'.get_the_author().'">Request</a>';
     echo "<br>";
  echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
else
{
  $count=count($app_arr1);
  echo '<a class="request_click1">Request</a>';
  echo "<br>";
  echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
} 
else 
{
echo '<div class="req-colors">Requested </div>' ;
 }
 } 
if($author1==get_current_user_id())
{
if($app_arr1[0]=="")
{
$count=0;
}
else
{
$count=count($app_arr1);
}
//echo '<a href="'.get_bloginfo('url').'/log-in">Requests('.$count.')</a>';
echo '<a href="'.get_bloginfo('url').'/log-in">Requests</a>';
echo "<br>";
echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
}
else
{
  $count=count($app_arr1);
  echo '<a class="aa1" href="'.get_bloginfo('url').'/log-in">Login for Request</a>';
  echo "<br>";
  echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
?>
</div>
<div class="col-md-6 time_task">
<?php echo $date= human_time_diff( get_the_time('U'), current_time( 'timestamp' ) ) . ' ago'; ?>
</div>
<div class="col-md-6 cat_task">
<?php 
$terms=get_the_terms( $id,'types' );
if(!empty($terms))
{
foreach($terms as  $v)
{
echo str_replace('and','&',$v->name);
}
}
else
{
echo 'All';
}
?>
</div>
</div>
</div>
<?php // }
endwhile;  
wp_reset_postdata();
}
else
{
echo '<div class="col-md-12"> No Posts Found </div>';
}
?>
<div style="clear:both"></div>
<div class="load-more-post"></div>
<div class="load-anchor" style="clear:both;"><a id="more_posts">Load More</a></div>
</div>
<?php
$wcatTerms1 = get_terms('types', array('hide_empty' => 0, 'parent' =>0));  
foreach($wcatTerms1 as $wcatTerm) : 
?>
<div id="<?php echo $wcatTerm->slug; ?>" class="tab-pane fade">
<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if(isset($_POST['search_job']))
{
$args = array('post_type'=>'task','posts_per_page'=>-1,'meta_query'=>
array(array(
'key'       => 'job_city',
'value'     =>$_POST['search_loc'],
'compare'   => 'LIKE'
 )),'tax_query' => array(
array(
'taxonomy' => 'types',
'field' => 'slug',
'terms' => $wcatTerm->slug
 )
 ));
}
else
{
$args = array('post_type'=>'task','posts_per_page'=>9,'tax_query' => array(
       array(
       'taxonomy' => 'types',
       'field' => 'slug',
       'terms' => $wcatTerm->slug
        )
    ));
}
$query = new WP_Query( $args ); 
if($query->have_posts()){
while ($query->have_posts()) : $query->the_post(); 
$id=get_the_ID();
$approved_applicants =get_post_meta($id,'approved_applicants',true);
$applicants=get_post_meta($id,'applicants',true);
$app_arr= explode(',', $applicants);
//if($approved_applicants=='')
//{
?>
<div class="col-md-4 col-sm-4 text-center list_all">
<div class="jobimage">
<div class="col-md-12 author_image">
<?php 
$author=get_the_author_meta('ID'); 
echo get_avatar( $author, 120);
?>
</div>
<div class="col-md-12 budget_task">
$<?php echo get_post_meta(get_the_ID(),'budget',true); ?>
<input type="hidden" id="amount" value="<?php echo get_post_meta(get_the_ID(),'budget',true); ?>" >
</div>
<div class="col-md-12 author_name">
<?php echo get_the_author();?>
</div>
<div class="col-md-12 location_task">
<?php echo get_post_meta(get_the_ID(),'job_city',true); ?>
</div>
<div class="col-md-12 desc_task">
<?php echo get_the_content(); ?>
</div>
<div class="col-md-12 request_task">
<?php 
if(is_user_logged_in())
{
if($author!=get_current_user_id()) 
{
if(!in_array(get_current_user_id(), $app_arr)) 
{
if($state=="active")
{
 $count=count($app_arr);
 echo '<a class="request_click model" data-authid="'.get_the_author_meta('ID').'" data-jobid="'.get_the_ID().'" data-amt="'.get_post_meta(get_the_ID(),'budget',true).'" data-authname="'.get_the_author().'">Request</a>';
     echo "<br>";
 echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
else
{
 $count=count($app_arr);
 echo '<a class="request_click1">Request</a>';
 echo "<br>";
 echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
}
else 
{
echo '<div class="req-colors">Requested</div>' ;
}  
} 
if($author==get_current_user_id())
{
if($app_arr[0]=="")
{
  $count=0;
}
else
{
 $count=count($app_arr);
}
$count=count($app_arr);
 //echo '<a href="'.get_bloginfo('url').'/log-in">Requests('.$count.')</a>';
 echo '<a href="'.get_bloginfo('url').'/log-in">Requests</a>';
 echo "<br>";
 echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
}
else
{
 $count=count($app_arr);
  echo '<a class="afaf" href="'.get_bloginfo('url').'/log-in">Login for Request</a>';
  echo "<br>";
  echo '<div class="req-color">Requests :'.$count .'</div>' ;
}
 ?>
</div>
<div class="col-md-6 time_task">
<?php echo $date= human_time_diff( get_the_time('U'), current_time( 'timestamp' ) ) . ' ago'; ?>
</div>
<div class="col-md-6 cat_task">
<?php 
$terms=get_the_terms( $id,'types' );
foreach($terms as  $v)
{
echo str_replace('and','&',$v->name);
}
?>
</div>
</div>
</div>
<?php //}
endwhile;  
wp_reset_postdata();
}
else
{
echo '<div class="col-md-12"> No Posts Found </div>';
}
?>
<div class="load-more-post-cate"></div>
<div style="clear:both"></div>
<div class="load-anchor-cate"><a class="load-cate cate-<?php echo $wcatTerm->slug; ?>" data-count="<?php echo $count;?>" id="<?php echo $wcatTerm->slug; ?>" >Load More</a></div>
</div>
<?php 
$st = $j;
$j++;
endforeach; 
?>
</div>
<div id="full-content-loader" class="loader" style="display: none;text-align:center;padding-top: 30px;padding-bottom: 30px">
<img src="https://www.shareupproject.com/wp-content/uploads/2017/08/giphy.gif" width="100" height="100" />
</div>
</div>
<script type="text/javascript">jQuery(document).ready(function()
{jQuery(".request_click").click(function(){var h=jQuery("body").height()+'<span id="IL_AD12" class="IL_AD">px</span>';jQuery("#black_overlay").css({"height":h,"visibility":"visible"});jQuery(".added").css('display','block');jQuery('.request_amount').text('$'+jQuery(this).attr('data-amt'));jQuery('.request_author').text(jQuery(this).attr('data-authname'));jQuery('.author_of_post').val(jQuery(this).attr('data-authid'));jQuery('.request_for_post').val(jQuery(this).attr('data-jobid'))});jQuery(".close").click(function(){jQuery(".added").css('display','none');jQuery("#black_overlay").css("visibility","hidden")});jQuery('.request_click1').click(function(){alert('Please verify your wepay account')})
jQuery("#search_loc").autocomplete({source:function(request,response){jQuery.ajax({url:'<?php echo get_bloginfo('template_url');?>/search_city.php',dataType:"json",type:'post',data:{term:request.term},success:function(data){response(jQuery.map(data,function(item){return{value:item.state}}))}})},});jQuery("#search_auth").autocomplete({source:function(request,response){jQuery.ajax({url:'<?php echo get_bloginfo('template_url');?>/search_author.php',dataType:"json",type:'post',data:{term:request.term},success:function(data){response(jQuery.map(data,function(item){return{value:item.name}}))}})},});jQuery(document).ready(function(){jQuery('#pagination a').live('click',function(e){e.preventDefault();var link=jQuery(this).attr('href');var imgUrl=jQuery('#gif').val();jQuery("html, body").animate({scrollTop:0},600);jQuery('#all').html("<img src='"+imgUrl+"' alt='description' style='margin:50px 0px 0px 400px'/>");jQuery('#all').load(link+' #all')})})});jQuery(document).ready(function($){var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";var page=1;var ppp=9;x=0;y=350;$("#more_posts").on("click",function(){$(".loader").show();$.post(ajaxUrl,{type: 'POST',action:"more_post_ajax",offset:(page*ppp),ppp:ppp}).success(function(posts){page++;y=y+1250;if(posts=='<div class="col-md-12 no-more-posts"> No More Posts Available. </div>')
{$(".load-anchor").hide();$(".load-more-post").before(posts)}
else{$(".load-more-post").before(posts)}$(".loader").fadeOut("slow");})})});jQuery(document).ready(function($){var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";var page=1;var ppp=9;var x=0;var y=0;$(".cate-family-youth").on("click",function(){$(".loader").show();var id=$(this).attr('id');$.post(ajaxUrl,{type:'POST',action:"load_more_post",data:{'data-id':id},offset:(page*ppp),ppp:ppp}).success(function(posts){page++;y=y+450;var div_id="#"+id+" .load-more-post-cate";if(posts=='<div class="col-md-12 no-more-posts"> No More Posts Available. </div>')
{$("#"+id+" .load-anchor-cate").hide();$(div_id).before(posts)}
else{$(div_id).before(posts)}$(".loader").fadeOut("slow"); })})});jQuery(document).ready(function($){var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";var page=1;var ppp=9;var x=0;var y=0;$(".cate-food-basics").on("click",function(){$(".loader").show();var id=$(this).attr('id');$.post(ajaxUrl,{type:'POST',action:"load_more_post",data:{'data-id':id},offset:(page*ppp),ppp:ppp}).success(function(posts){page++;y=y+450;var div_id="#"+id+" .load-more-post-cate";if(posts=='<div class="col-md-12 no-more-posts"> No More Posts Available. </div>')
{$("#"+id+" .load-anchor-cate").hide();$(div_id).before(posts)}
else{$(div_id).before(posts)}$(".loader").fadeOut("slow");})})});jQuery(document).ready(function($){var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";var page=1;var ppp=9;var x=0;var y=0;jQuery(".cate-home-rent").on("click",function(){$(".loader").show();var id=jQuery(this).attr('id');jQuery.post(ajaxUrl,{type:'POST',action:"load_more_post",data:{'data-id':id},offset:(page*ppp),ppp:ppp}).success(function(posts){page++;y=y+450;var div_id="#"+id+" .load-more-post-cate";if(posts=='<div class="col-md-12 no-more-posts"> No More Posts Available. </div>')
{$("#"+id+" .load-anchor-cate").hide();$(div_id).before(posts)}
else{jQuery(div_id).before(posts)}$(".loader").fadeOut("slow");})})});jQuery(document).ready(function($){var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";var page=1;var ppp=9;var x=0;var y=0;$(".cate-medical").on("click",function(){$(".loader").show();var id=$(this).attr('id');$.post(ajaxUrl,{type:'POST',action:"load_more_post",data:{'data-id':id},offset:(page*ppp),ppp:ppp}).success(function(posts){page++;y=y+450;var div_id="#"+id+" .load-more-post-cate";if(posts=='<div class="col-md-12 no-more-posts"> No More Posts Available. </div>')
{$("#"+id+" .load-anchor-cate").hide();$(div_id).before(posts)}
else{var div_id="#"+id+" .load-more-post-cate";$(div_id).before(posts)}$(".loader").fadeOut("slow");})})});jQuery(document).ready(function($){var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";var page=1;var ppp=9;var x=0;var y=0;$(".cate-small-buisness").on("click",function(){$(".loader").show();var id=$(this).attr('id');$.post(ajaxUrl,{type:'POST',action:"load_more_post",data:{'data-id':id},offset:(page*ppp),ppp:ppp}).success(function(posts){page++;y=y+450;var div_id="#"+id+" .load-more-post-cate";if(posts=='<div class="col-md-12 no-more-posts"> No More Posts Available. </div>')
{$("#"+id+" .load-anchor-cate").hide();$(div_id).before(posts)}
else{$(div_id).before(posts)}$(".loader").fadeOut("slow");})})});jQuery(document).ready(function($){var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";var page=1;var ppp=9;var x=0;var y=0;$(".cate-unemployment").on("click",function(){$(".loader").show();var id=$(this).attr('id');$.post(ajaxUrl,{type:'POST',action:"load_more_post",data:{'data-id':id},offset:(page*ppp),ppp:ppp}).success(function(posts){page++;y=y+450;var div_id="#"+id+" .load-more-post-cate";if(posts=='<div class="col-md-12 no-more-posts"> No More Posts Available. </div>')
{$("#"+id+" .load-anchor-cate").hide();$(div_id).before(posts)}
else{$(div_id).before(posts)}$(".loader").fadeOut("slow");})})});</script>
</div>
<style>.load-anchor{text-align:center}.load-anchor-cate{text-align:center}#more_posts{background:#fff none repeat scroll 0 0;border:2px solid #8cc53e;color:#8cc53e;cursor:pointer;font-size:14px;font-weight:700;padding:10px;border-radius:17px}#more_posts:hover{background:#8cc53e;color:#fff}.load-cate{background:#fff none repeat scroll 0 0;border:2px solid #8cc53e;color:#8cc53e;cursor:pointer;font-size:14px;font-weight:700;padding:10px;border-radius:17px}.load-cate:hover{background:#8cc53e;color:#fff}.no-more-posts{border:3px solid #8cc53e;text-align:center;font-size:14px;font-weight:700;color:#2a6496;padding:10px 0;border-radius:55px;width:67%;margin-left:16%}</style>
<?php get_footer(); ?>