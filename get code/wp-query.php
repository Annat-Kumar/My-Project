
<?php

$args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'operator' => 'IN',
                'terms' => $cat_termslugs
            ),
            array(
                'taxonomy' => 'product_tag',
                'field' => 'slug',
                'operator' => 'IN',
                'terms' => $tax_termslugs
            )
        ),
    );
	
	$query = new WP_Query($args);
	$total_post = $query->found_posts;
	
	if($query-> have_posts()){
	while ($query->have_posts()) : $query->the_post(); 
	
	// all post is here
	endwhile;  
		wp_reset_query();
	}
?>
<?php 
/* code on function file*/ 

function load_morepost(){
 //echo "action is clear";die;
global $wpdb;
global $paged; global $args;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args= null;
$offset = $_POST["set_offset"];
$ppp = $_POST["ppp"];
header("Content-Type: text/html");
$args = array(
    'post_type'  => 'post',
	'posts_per_page'=>$ppp,
	'offset' => $offset,
	'paged' => $paged,
    'post_status'    => 'publish',
	);

	$query = new WP_Query( $args );
	$i=1;
	if($query-> have_posts()){
	while ($query->have_posts()) : $query->the_post(); 
?>

		<div class="single-post">
			<div class="post-title">
			 <a href="<?php  the_permalink() ;?>"><h1><?php   the_title();?></h1></a>
			</div>
			<div class="featured-image">
				<?php  the_post_thumbnail();?>
				<div class="read-more"><a href="<?php  the_permalink() ;?>">Read More</a></div>
			</div>
			<div class="post-excerpt">
				<p><?php  the_excerpt(); ?></p>
			</div>			
			<div class="post-author-meta">
				<a href="#"><?php echo get_post_meta(get_the_id() ,'my_magzine' ,true) ;?></a>
				<span class="post-date"> / <?php  the_date();?> / </span>
			</div>
		</div>
		<?php 
		$i++;
		endwhile;  
		wp_reset_query();
	}
	else {
	echo '<div class=".no-more-post"><p>No more post available</p></div>';
	}
 die(0);
}
add_action('wp_ajax_nopriv_load_morepost', 'load_morepost'); 
add_action('wp_ajax_load_morepost', 'load_morepost');	

?>