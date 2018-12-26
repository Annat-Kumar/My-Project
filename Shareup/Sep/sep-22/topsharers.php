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



<div class="container">
<?php echo $msg;?>

<div class="col-md-12 withdrawal_lists">
<div class="head_table">
<div class="col-md-3 col-sm-3 col-xs-3"> <span class="heading">No</span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading">Name</span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading">Number of shares</span></div>
<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading">Total amount shared</span></div>

</div>
</div>
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
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'author' => $user_id,
    
);  

  $loop = new WP_Query( $args );
      //echo $user_id.'=>'.$loop->post_count;
      //echo "<br>";
     

//}
//die();
  // while ( $loop->have_posts() ) : $loop->the_post(); 
   $id=$user_id;
   
   $budget =get_post_meta($id,'budget',true); 
 
  ?>
<div class="panel-group first_pan" id="accordion">

   <div class="panel panel-default sec_pan">
   <div class="panel-heading third_pan">
      <div class="col-md-12 collapse_head" data-toggle="collapse" data-parent="#accordion" data-target="#collapse<?php echo $i; ?>">
     
<div class="col-md-3 col-sm-3 col-xs-3"> <span class="heading"><?php echo $i;?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3"><span class="round"></span><span class="heading"><?php echo get_author_name($id) ?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3" ><span class="heading"><?php   echo $loop->post_count ?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading prize">$0 <?php   echo $budget ?></span></div>

</div>
</div>


</div>
 
</div>
<?php $i++ ;} ;?>


</div>

<?php get_footer();?>