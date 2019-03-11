<?php
/**
 * Template Name: Home page
 * The template for displaying Home page.
 * 
**/
get_header(); ?>


<div class="all-post">
<?php 
global $wpdb;
$ppp = 9;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args_total_post = array(
    'post_type'  => 'post',
	'posts_per_page'=>-1,
	'paged' => $paged,
    'post_status'    => 'publish',
	);
	
	$query_totalpost = new WP_Query( $args_total_post );
	
	$total_post = $query_totalpost->post_count;
	//echo "total post => ".$total_post;die;
	
	$args = array(
    'post_type'  => 'post',
	'posts_per_page'=>$ppp,
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
?>	
	<div class="load-more-post"></div>
	<div class="loader" style="text-align: center; display: none;">								
		<img class="img-loader" src="<?php home_url();?>/wp-content/uploads/2019/02/ajax-loader.gif">
	</div>		
	<input type="hidden" id="post_count" value="<?php echo $total_post; ?>">
</div>
<div class="no-more-post" style="display:none"><p>No more post available</p></div>
		
<?php
//http://www.simonjaeggi.ch/wp-content/uploads/2019/02/ajax-loader.gif
get_footer(); 

?>


<script type="text/javascript">
jQuery(document).ready(function($)
{
	
		var url = window.location.origin;
		var admin_url ="/admin-ajax.php";
		//var ajaxUrl = url+admin_url;
		var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";		
		var total_post = $("#post_count").val();
		page=1; ppp=9;
		set_offset = 9;
		//alert(total_post);
		$('.all-post').append( '<span class="load-more"></span>' );
		var button = $('.all-post .load-more');
		var loading = false;	
		var scrollHandling = {
			allow: true,
			reallow: function() {
			scrollHandling.allow = true;
			},
			delay: 400 //(milliseconds) adjust to the highest acceptable value
		};
		$(window).scroll(function(){
			console.log(set_offset);
			if(set_offset < total_post) {			
			if( ! loading && scrollHandling.allow ) {						
				scrollHandling.allow = false;
				setTimeout(scrollHandling.reallow, scrollHandling.delay);
				var offset = $(button).offset().top - $(window).scrollTop();
				if( 2000 > offset ) {
					//alert('working');
					loading = true;
					$(".loader").show();
					$.post(ajaxUrl,{
					type: 'POST',
					action: "load_morepost",
					set_offset:(page*ppp) ,
					ppp:ppp,				
					}).success(function(posts){					
						page++;	
						set_offset = page*ppp ;						
						$(".load-more-post").before(posts);;
						$(".loader").hide();
						loading = false;
					});

				}
			}
			}
			else {
				//alert('no-more-post available');
				$(".loader").hide();
				$(".no-more-post").show();
			}
		
		});
							
});


</script>
<script>

$("#myBtn").on("click", function(){
		
		table_id = $("#get_id").val();
		row_id = $("#myBtn").val();
		if(row_id =='')
		{
			alert('please select row');
			event.preventDefault(false);
		}
		$("#update").removeClass('add-row ');
		$("#update").addClass('update-row');
		$("#update").html('Update');

		var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'edit_data',
					table_id : table_id,
					row_id : row_id,
				},         
				beforeSend: function() 
				{
					   //$(".loader").show();                      
				},
				success: function(responseq) 
				{					
					// alert('success');
					
					/* var obj = jQuery.parseJSON(responseq);
					col_len = obj.column.length;
					console.log(col_len); */									
					
					$('.append-html').append(responseq);
					$('.edit-table').show();
				}
				
				});
		});
		
</script>