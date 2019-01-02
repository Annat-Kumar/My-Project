<?php 
/**
* Template Name: Total Donation
*
* Login Page Template.
*
* @author Ahmad Awais
* @since 1.0.0
*/
get_header(); 

$user = wp_get_current_user();
$user_id =  $user->ID;
?>

<div class="container">
	<div class="row">
		<div class="div_box">
			<div class="second_divbox">
<?php include('author-sidebar.php'); ?>
<div class="col-md-10 col-sm-9 col-xs-12">
	<div class="info_about">
      <h2>Total Coupons Issued</h2>
    </div>
<div class="tab-pane" id="tab_coupon_code">


<div class="row">
<div class="col-sm-12 col-md-12">

 <h3 class="count_posts">Total Donation</h3>
 <table class="table table-bordered first_business_event">
   <thead>                   

     <tr>
      <th>S.No.</th>
      <th>Business Name</th>
      <th>Total Coupon</th>
      <th>Coupon Code</th>
    </tr>
  </thead>
  
  <?php

  global $paged4; global $args4;
  $paged4 = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $args4 = null;
  $args4 = array( 'post_type' => 'retailer', 'posts_per_page' => 10,'post_status' =>'publish','paged' => $paged,'author' =>  $user_id);
  $loop4 = new WP_Query( $args4 );
  if( $loop4->have_posts()){
   $i=1;
   while ( $loop4->have_posts() ) : $loop4->the_post();

    $trimtitle = get_the_title(); 
    $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = '… ' );
    
    $coupon_values = get_post_meta( get_the_ID(), 'coupen_code' );
    
    $coupon_code = $coupon_values[0];
    
    $retailer_id = get_the_ID();
    $total_coupon_query = $wpdb->get_results("SELECT * FROM wp_donation WHERE retailer_id =$retailer_id");
								  //print_r($total_coupon_query);
    $count = $total_coupon_query->post_count; 
								  //echo $count;
    
    $get_donate_post = $wpdb->get_results("SELECT * FROM wp_donation WHERE retailer_id =$retailer_id");

    $post_count = count($get_donate_post); 
    
    ?>	
    <tr>
      <td><?php echo $i ?></td>
      <td><a class="post_titles" href="<?php echo get_permalink(); ?>" ><?php  echo ucfirst($shorttitle);?></a></td>
      <td><?php echo $post_count ;?></td>
      <td><?php echo $coupon_code ?></td>
    </tr>
    <?php
    $i++;
  endwhile ;
  
}
?>
</table>
</div>
</div>
</div>
<!-- End Coupon Code List -->