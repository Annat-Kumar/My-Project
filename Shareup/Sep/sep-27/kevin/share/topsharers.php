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
	$id=$user_id;
   
  ?>
<div class="panel-group first_pan" id="accordion">

   <div class="panel panel-default sec_pan">
   <div class="panel-heading third_pan">
      <div class="col-md-12 collapse_head" data-toggle="collapse" data-parent="#accordion" data-target="#collapse<?php echo $i; ?>">
     
<div class="col-md-3 col-sm-3 col-xs-3"> <span class="heading"><?php echo $i;?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3"><span class="round"></span><span class="heading"><?php echo get_author_name($id) ?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3" ><span class="heading"><?php   echo $loop->post_count ?> </span></div>

<div class="col-md-3 col-sm-3 col-xs-3"><span class="heading prize">

<?php   

$sum = 0;
if ( $loop->have_posts() ) :
    while ( $loop->have_posts() ) : $loop->the_post();
 
     $sum = $sum + get_post_meta( $id,'budget',true );    

	 endwhile;
	 
    endif;
    
	echo "$".esc_html( $sum );


?>
</span></div>

</div>
</div>


</div>
 
</div>
<?php $i++ ;} ;?>


</div>

<?php get_footer();?>