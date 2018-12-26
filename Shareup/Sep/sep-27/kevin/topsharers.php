<?php
/**
 * Template Name: Top Sharers
 *
 *
 * @author Ahmad Awais
 * @since 1.0.0
 */
get_header(); 
?>



<div  class="container">
<div class="col-md-12 withdrawal_lists top-sharers">
<div class="head_table">
<div class="col-md-3 col-sm-3 col-xs-3"> <span class="heading">No</span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading">Name</span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading">Number of shares</span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading">Total amount shared</span></div>

</div>
</div>

<?php
if(is_user_logged_in()){
$blogusers11 = wp_get_current_user();

$args = array(
   'post_type'  => 'task',
    'meta_key'    => 'budget',
    'post_status'    => 'publish',
    'author'        =>  $current_user->ID,  
    'posts_per_page' => -1
    );
$loops = new WP_Query( $args );
  ?>

   <div class="panel panel-default sec_pan">
  
      <div class="col-md-12 collapse_head current-user">
     
<div class="col-md-3 col-sm-3 col-xs-3"> <span class="heading top-head">  </span></div>

<div class="col-md-3 col-sm-3 col-xs-3 top-sha"><span class="round"></span><span class="heading"><?php echo $blogusers11->display_name  ?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3" ><span class="heading"><?php   echo $loops->post_count ?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading prize1">$ 
<?php   

$sum = 0;
if ( $loops->have_posts() ) :
    while ( $loops->have_posts() ) : $loops->the_post(); 
     //$budget = get_post_meta($id,'budget',true);
     $sum = $sum + get_post_meta( $id,'budget',true );      
    endwhile;    
    endif;
    $res = esc_html( $sum );
    echo $res;


?>



</span></div></div></div>
<?php } ?>

<!-- ===========all data=========== -->

<div id="mail">
<?php
$blogusers = get_users();
//echo "<pre>"; print_r($blogusers);die();
// Array of WP_User objects.
foreach ( $blogusers as $user ) {
  $all_user[] = $user->ID ;
}
$i=1;
foreach ($all_user as $key => $user_id) {
  $args = array(

    'post_type'  => 'task',
    'meta_key'    => 'budget',
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'author' => $user_id,
    'meta_query' => array(
       array(
           'key' => 'final_release',
           'value' => 'yes',
           'compare' => 'LIKE',
       )
   )
    
);  


  $loop = new WP_Query( $args );
      //echo $user_id.'=>'.$loop->post_count;
      //echo "<br>";
  
     $sum = 0;
if ( $loop->have_posts() ) :
    while ( $loop->have_posts() ) : $loop->the_post(); 
     //echo $budget = get_post_meta($id,'budget',true);
     //echo "</br>";
     $sum = $sum + get_post_meta( $id,'budget',true );      
    endwhile;    
    endif;
    $res = esc_html( $sum );

//}
//die();
  // while ( $loop->have_posts() ) : $loop->the_post(); 
   $id=$user_id;
      get_currentuserinfo(); 
      if($current_user->ID == $id){ ?>
           <script type="text/javascript">
            jQuery(document).ready(function(e) {              
             jQuery('#userid<?php echo $id ?>').hide();
                var aa = jQuery('#userid<?php echo $id ?> .numbers').text();
                    //alert(aa);
                jQuery('.top-head').text(aa);
                

             });
           </script>
     <?php }


   //$budget =get_post_meta($id,'budget',true); 


  ?>

   <div id="de_<?php  echo $res;  ?>" class="panel panel-default sec_pan">
  
      <div class="col-md-12 collapse_head  uuuu" id="userid<?php echo $id ?>">
     
<div class="col-md-3 col-sm-3 col-xs-3  numbers"> <span class="heading">  </span></div>

<div  class="col-md-3 col-sm-3 col-xs-3 top-sha"><span class="round"></span><span class="heading"><?php echo get_author_name($id) ?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3" ><span class="heading"><?php   echo $loop->post_count ?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading prize1">$ <?php   


    echo $res;


?></span></div>

</div>



</div>
 

<?php $i++ ;} ;?>


</div>
</div>

<script>
var main = document.getElementById( 'mail' );

[].map.call( main.children, Object ).sort( function ( a, b ) {
    return +b.id.match( /\d+/ ) - +a.id.match( /\d+/ );
}).forEach( function ( elem ) {
    main.appendChild( elem );
});

var addSerialNumber = function () {
    var i = 1
    jQuery('.sec_pan .uuuu').each(function(index) {
        jQuery(this).find('.numbers:nth-child(1)').html(index+1);
    });
};

addSerialNumber();

</script>
<style>
.panel.panel-default.sec_pan {border: 1px solid transparent;}
.prize1{color:#8cc53e ;}
.collapse_head{text-align: center;}
..head_table {text-align: center;}
.col-md-12.collapse_head.current-user { background-color: #e2ebd7; }
.top-sharers{ text-align: center; }
.top-sha {  left: 91px; text-align: left; }
.round { margin: 0 15px 0 0 !important ; }
</style>
<?php get_footer();?>