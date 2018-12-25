<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

get_header('shop');


?>
<?php global $wp_query; //print_r($wp_query); 
$parent_menu_title = "";


?>
<?php

$menu_arr = my_get_menu_item_name('header_location');


if (is_array($menu_arr)) {


    $sub_menu_ar = wp_get_nav_menu_items($menu_arr['term_id']);


    // $submenulist='<ul class="hover-list" style="display: none;">';
    $submenulist = '<ul class="hover-list">';
    foreach ($sub_menu_ar as $k => $v) {
        // Check if this menu item links to the current page

        if ($sub_menu_ar[$k]->ID == $menu_arr['current_parent_menu']) {
            $parent_menu_title = $sub_menu_ar[$k]->title;
        }

        if ($sub_menu_ar[$k]->menu_item_parent == $menu_arr['current_parent_menu']) {

            $submenulist .= '<li><a href="' . $sub_menu_ar[$k]->url . '">' . $sub_menu_ar[$k]->title . '</a> </li>';
        }
    }
    $submenulist .= '</ul>';
}


?>
    <a class="lbp-inline-link-1" href="#" style="display:none;">Inline HTML Link Name</a>
    <div style="display:none">
        <div id="lbp-inline-href-1" style="padding: 10px;background: #fff;height:100%;">


        </div>
    </div>
<?php //query_posts(array('post_type'	=> 'product')); ?>
<?php
/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

//do_action('woocommerce_before_main_content');
?>
    <div class="wrp_inner">
<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
    <?php $term = get_queried_object();//print_r($term); ?>
    <?php if (is_product_category()) $display_type = get_woocommerce_term_meta($term->term_id, 'display_type', true); ?>
<?php endif; ?></div>

    <!-- <section id="content" class="container"> -->
<?php
global $wp_query;
?>

<?php 
if (is_search()) {

    ?>
    <h3 style="text-align:center; padding-bottom:10px;"><?php printf(__('Search Results For %s', 'woocommerce'), '<b>"' . get_search_query() . '"</b>'); ?></h3>
<?php } ?>
<?php
if (is_search() && $wp_query->post_count == 0) {
    $prdct_cat = get_terms('product_cat');
    $prdct_tag = get_terms('product_tag');
    $search_k = $_GET['s']; //search key

    foreach ($prdct_cat as $name) {
        $catpos = stripos($name->name, $search_k);
        if ($catpos !== false) {
            $cat_termslugs[] = $name->slug;
        }
    }

    foreach ($prdct_tag as $name) {
        $tagpos = stripos($name->name, $search_k);
        if ($tagpos !== false) {
            $tax_termslugs[] = $name->slug;
        }
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 20,
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

    $taxquery = new WP_Query($args);
	$total_post = $taxquery->found_posts;
if ($taxquery->have_posts()) : ?>

    <?php
    /**
     * woocommerce_before_shop_loop hook
     *
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */

    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    do_action('woocommerce_before_shop_loop');
    ?>
    <?php //woocommerce_product_loop_start(); ?>
    <?php breadcrumb_header() ?>
    <div class="row">
        <?php woocommerce_product_subcategories(); ?>
    </div>

    <?php if ((is_post_type_archive()) or (is_product_tag()) or (is_product_category() and (($display_type == 'products') or ($display_type == 'both') or ((!get_option('woocommerce_category_archive_display') or get_option('woocommerce_category_archive_display') == 'both') and !$display_type)))): ?>
    <?php
    ob_start();
    dynamic_sidebar('layer_sidebar');
    $layer_sidebar = ob_get_clean();

if (!empty($layer_sidebar)) {
    ?>
    <div class="row 1">
<?php }else { ?>
    <div class="full-width-blck ">
<?php } ?>
    <div class="catalog  scroll_parent_wrap3">
        <?php


        if (!empty($layer_sidebar)) {
            ?>

            <div class="left-side-blck">
                <div class="controls-panel">

                    <?php /* <h2><?php _e('Filters','alor'); ?></h2> */ ?>
                    <div class="menu">
                        <?php if (!empty($parent_menu_title)) { ?>
                            <div id="filter_cat_drp" class="widget">
                                <!--<h3 class="arrowdeactive"><?php // echo $parent_menu_title;?></h3>-->
                                <h3 class="arrowactive"><?php echo $parent_menu_title; ?></h3>
                                <?php echo $submenulist; ?>
                            </div>
                        <?php } ?>

                        <?php echo str_replace('<ul>', '<ul class="hover-list">', $layer_sidebar); ?>

                        <?php
                        remove_action('woocommerce_before_shop_loop', 'woocommerce_show_messages', 10);
                        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
                        //do_action( 'woocommerce_before_shop_loop' );
                        ?>
                    </div>
                    <?php
                    /**
                     * woocommerce_after_shop_loop hook
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    //do_action( 'woocommerce_after_shop_loop' );
                    ?>

                </div>
            </div>

        <?php } ?>
        <div id="product_list" class="right-side-blck">

            <ul class="products catalog-list">
                <?php
                $_GET['flag_first_item'] = 1;
                while ($taxquery->have_posts()) : $taxquery->the_post(); ?>

                    <?php woocommerce_get_template_part('content', 'product-list'); ?>

                    <?php $_GET['flag_first_item'] = $_GET['flag_first_item'] + 1; endwhile; // end of the loop. ?>
            <div  class="load-more-post div-height" style="display:none;"><?php $prdctop_cat= $wp_query->get_queried_object()->term_id;?><input type="hidden" id="cat_id" data-tax-terms="<?php echo $tax_termslugs?>" value="<?php echo $prdctop_cat ;?>"/></div>
			<div style="clear:both"></div>
			</ul>
				
				
        </div>
    </div>
</div>
<?php endif; ?>
<?php //woocommerce_product_loop_end(); ?>
    <script type="text/javascript">
        jQuery(window).trigger('initFadeList');
        jQuery(window).trigger('initTouchNav');
        jQuery(window).trigger('initRefreshHeight');
        jQuery(window).trigger('initFadeProducts');
    </script>
	

<?php
/**
 * woocommerce_after_shop_loop hook
 *
 * @hooked woocommerce_pagination - 10
 */
//    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
//	do_action( 'woocommerce_after_shop_loop' );
?>

<?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

    <?php woocommerce_get_template('loop/no-products-found.php'); ?>

<?php endif; ?>
<?php
} else {
?>
    <?php breadcrumb_header() ?>
    <div id="products">

<?php
/**
 * woocommerce_before_shop_loop hook
 *
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
 */
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
do_action('woocommerce_before_shop_loop');
?>
<?php
if (have_posts()) : ?>
    <div class="row">
        <?php woocommerce_product_subcategories(); ?>
    </div>
<?php if ((is_post_type_archive()) or (is_product_tag()) or (is_product_category() and (($display_type == 'products') or ($display_type == 'both') or ((!get_option('woocommerce_category_archive_display') or get_option('woocommerce_category_archive_display') == 'both') and !$display_type)))):
?>

<?php 
global $wp;
$cat_page_url = home_url( $wp->request ) ;
//$current_url = home_url(add_query_arg(array(),$wp->request));
$current_url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<?php

if (is_active_sidebar('layer_sidebar') == 1){
?>
    <div class="row 2">
        <?php }else{ ?>
        <div class="full-width-blck ">
            <?php } ?>
            <div class="catalog  scroll_parent_wrap7">
                <?php
                if ((is_active_sidebar('layer_sidebar') == 1)) {
                    ?>
                    <div class="left-side-blck">
                        <div class="controls-panel">
                            <?php $source_tax = $_GET['source_tax']; ?>

                            <?php if (is_product_category()) { ?>

                                <?php
                                $current_term_id = get_queried_object_id();
                                $taxonomy_name = "product_cat";

                                $this_term = get_term($current_term_id, $taxonomy_name);
                                $parent_term = $this_term->parent;
                                $parent_term_object = get_term($parent_term, $taxonomy_name);
                                $parent_term_name = $parent_term_object->name;
                                $term_children = get_term_children($parent_term, $taxonomy_name);


                                ?>
                                <div class="menu">
                                    <div id="filter_cat_drp" class="widget">
                                        <h3 class="arrowdeactive"><?php if ($parent_term_name == "Gents") {
                                                echo "Mens";
                                            } elseif ($parent_term_name == "Ladies") {
                                                echo "Womens";
                                            } else {
                                                echo $parent_term_name;
                                            } ?></h3>
                                        <ul class="hover-list">

                                            <?php
                                            foreach ($term_children as $child) {
                                                $term = get_term_by('id', $child, $taxonomy_name);
                                                if ($term->count > 0) {
                                                    echo '<li><a href="' . get_term_link($child, $taxonomy_name) . '">' . $term->name . '</a></li>';
                                                }
                                            }

                                            ?>
                                        </ul>
                                    </div>
                                </div>


                            <?php } else {
                                dynamic_sidebar('custom_sidebar');
                            } ?>
                            <?php dynamic_sidebar('layer_sidebar'); ?>
                        </div>
                    </div>

                <?php } ?>
                <div id="product_list" class=" right-side-blck">
					<div class="yit-wcan-container post-listing">
                    <ul class="catalog-list products pro-filter">
                        <?php
                        $_GET['flag_first_item'] = 1;
                        while (have_posts()) : the_post(); ?>

                            <?php woocommerce_get_template_part('content', 'product'); ?>

                            <?php $_GET['flag_first_item'] = $_GET['flag_first_item'] + 1; endwhile; // end of the loop. 
                        ?>
						<div  class="load-more-post"></div>
						
                    </ul>
						
						 <div class="div-height" style="display:none;"><?php $prdcat_id= $wp_query->get_queried_object()->term_id;$term_slug = get_term_by('id', $prdcat_id, 'product_cat', 'ARRAY_A'); $term = get_term( $prdcat_id, 'product_cat' ); ?><input type="hidden" id="cat_id"  data-tax-terms="<?php echo $term_slug['slug'];?>" data-total-product=<?php echo  $term->count;?> value="<?php echo $prdcat_id ;?>"/>						
						</div>
						
						<div style="clear:both"></div>
						<div class="loader" style="display:none;text-align:center">							
							<img src="https://alor.com/wp-content/uploads/ajax-loader.gif" height="" width="">
						</div>
						<div class="no-more-product" style="display:none" id="<?php echo $cat_page_url ; ?>">No More Products</div>
						<div class="curremt-url" style="display:none">
								<?php $explode_url = explode('&',$current_url); 
									$filter_color_price = $explode_url[0];
									$color_price_ex = explode('?',$filter_color_price);
									$color_price_str = explode('=',$color_price_ex[1]);
									$color_price_attr = $color_price_str[0];
									$filter = $explode_url[3];
									$filter_ex = explode('=' ,$filter);
									$filter_attr = $filter_ex[0];									
									
									if($filter_attr == "filter_color") {
									$color_name=  $filter_ex[1];
									$color_args = array(
										'post_type'             => array('product'),
										'post_status'           => 'publish',
										'ignore_sticky_posts'   => 1,
										'posts_per_page'        => -1,    
										'tax_query'             => array(
											array(
												'taxonomy'      => 'product_cat',
												'field' => 'term_id', //This is optional, as it defaults to 'term_id'
												'terms'         => $prdcat_id,
												'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
											),
											array(
											'taxonomy'        => 'pa_color',
											'field'           => 'slug',
											'terms'           =>  $color_name,
											'operator'        => 'IN',
										)
									 )
									);
								
									$taxquery_color = new WP_Query($color_args);
									$total_post_color = $taxquery_color->found_posts;
								?>
							<input type="hidden" id="color_name" value="<?php echo $color_name;?>">
							<input type="hidden" id="total_color_product" value="<?php echo $total_post_color ;?>">
						<?php } 
						
							else if($filter_attr == "min_price") {
									$filter_price = $explode_url[4];									
									$filter_max_pr = explode('=' ,$filter_price);
									$min_price=  $filter_ex[1];
									$max_price = $filter_max_pr[1];
									$price_args = array(
										'post_type'             => array('product'),
										'post_status'           => 'publish',
										'ignore_sticky_posts'   => 1,
										'posts_per_page'        => -1,  
										'meta_query' => array(
												array(
													'key' => '_price',
													'value' => array($min_price, $max_price),
													'compare' => 'BETWEEN', 
													'type' => 'NUMERIC'
													),
													
												),										
										'tax_query'             => array(
											array(
												'taxonomy'      => 'product_cat',
												'field' => 'term_id', //This is optional, as it defaults to 'term_id'
												'terms'         => $prdcat_id,
												'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
											),
											
									 )
									);
								
									$taxquery_price = new WP_Query($price_args);
									$total_post_price = $taxquery_price->found_posts;
								?>
							<input type="hidden" id="min_price" value="<?php echo $min_price;?>">
							<input type="hidden" id="max_price" value="<?php echo $max_price;?>">
							<input type="hidden" id="total_product_price" value="<?php echo $total_post_price ;?>">
						<?php } 
						
						if($color_price_attr == "filter_color") {
									$prc_color_name=  $color_price_str[1];
									$min_price_filter = explode('=',$explode_url[4]);
									$max_price_filter = explode('=',$explode_url[5]);
									$color_min_price = $min_price_filter[1];
									$color_max_price  = $max_price_filter[1];;
									$prc_color_args = array(
										'post_type'             => array('product'),
										'post_status'           => 'publish',
										'ignore_sticky_posts'   => 1,
										'posts_per_page'        => -1,
										'meta_query' => array(
												array(
													'key' => '_price',
													'value' => array($color_min_price, $color_max_price),
													'compare' => 'BETWEEN', 
													'type' => 'NUMERIC'
													),	
													
												),										
										'tax_query'             => array(
											array(
												'taxonomy'      => 'product_cat',
												'field' => 'term_id', //This is optional, as it defaults to 'term_id'
												'terms'         => $prdcat_id,
												'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
											),
											array(
											'taxonomy'        => 'pa_color',
											'field'           => 'slug',
											'terms'           =>  $prc_color_name,
											'operator'        => 'IN',
										)
									 )
									);
								
									$taxquery_color_price = new WP_Query($prc_color_args);
									$total_post_prc_color = $taxquery_color_price->found_posts;
								?>
							<input type="hidden" id="prc_color_name" value="<?php echo $prc_color_name;?>">
							<input type="hidden" id="color_min_price" value="<?php echo $color_min_price;?>">
							<input type="hidden" id="color_max_price" value="<?php echo $color_max_price;?>">
							<input type="hidden" id="total_post_prc_color" value="<?php echo $total_post_prc_color ;?>">
						<?php } /*END*/?>
							<input type="hidden" id="filter_attr" value="<?php echo $filter_attr ;?>">
							<input type="hidden" id="color_price_attr" value="<?php echo $color_price_attr ;?>">
						</div>
						
						
					</div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <script type="text/javascript">
        jQuery(window).trigger('initFadeList');
        jQuery(window).trigger('initTouchNav');
        jQuery(window).trigger('initRefreshHeight');
        jQuery(window).trigger('initFadeProducts');


        jQuery(document).ready(function ($) {
            $('.controls-panel .widget h3').toggle(
                function () {
                    $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    $(this).parent().find('div').slideUp();
                    $(this).parent().find('form').slideUp();
                    $(this).parent().find('ul').slideUp();
                }, function () {
                    $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                    $(this).parent().find('div').slideDown();
                    $(this).parent().find('form').slideDown();
                    $(this).parent().find('ul').slideDown();
                }
            );
            $(".various").fancybox({
                maxWidth: 800,
                maxHeight: 600,
                fitToView: false,
                width: '70%',
                height: '70%',
                autoSize: false,
                closeClick: false,
                openEffect: 'none',
                closeEffect: 'none'
            });

            var value = $('.yith-wcan-list-price-filter > li:last-child > a > span:first-child').text();
            value = value.replace("-", "+");
            // can then use it as
            $(".yith-wcan-list-price-filter > li:last-child > a").text(value + ' +');

            if ($(window).width() <= 768) {
                $('.inner_cls #products .catalog li .caption').remove();
                $('.inner_cls #products .catalog li .hide-cls').remove();

                $('.inner_cls #products .catalog li a').on('click touchend', function (e) {
                    var el = $(this);
                    var link = el.attr('href');
                    //window.location = link;
                });
            }
            if ($(window).width() >= 768 && $(window).width() <= 1024) {
                $('.inner_cls #products .catalog li .caption').remove();
                $('.inner_cls #products .catalog li .hide-cls').remove();

                $('.inner_cls #products .catalog li a').on('click touchend', function (e) {
                    var el = $(this);
                    var link = el.attr('href');
                    //window.location = link;
                });
            }
        });
    </script>
    <?php
    /**
     * woocommerce_after_shop_loop hook
     *
     * @hooked woocommerce_pagination - 10
     */
    do_action('woocommerce_after_shop_loop');
    ?>

<?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

    <?php woocommerce_get_template('loop/no-products-found.php'); ?>

<?php endif;
}

?>

<?php
/**
 * woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php
/**
 * woocommerce_sidebar hook
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');


?>
<?php if ($cat_page_url == "https://alor.com/shop") {
	
?>	
<script>
jQuery(function($){
		
	var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";	
	var cat_id = $("#cat_id").val();		
	var	total_color_product	= $("#total_color_product").val();
	var	color_name	= $("#color_name").val();
	var	filter_attr	= $("#filter_attr").val();
	var	min_price	= $("#min_price").val();
	var	max_price	= $("#max_price").val();
	var total_product_price = $("#total_product_price").val();

	if(filter_attr == "filter_color") {	
		$(document).ready(function() {
			
			$.post(ajaxUrl,{			
			type: 'POST',
			action:"lazy_load_color_filter",
			offset:0,
			ppp:9,
			cat_id:cat_id,
			color_name:color_name
			}).success(function(posts){	
				$(" .pro-filter li").remove();				
				$(".load-more-post").before(posts);					
			
			})

			
	});
	
	var page=1;var ppp=9;	
	var set_offset = 9;
	$('.post-listing').append( '<span class="load-more"></span>' );
	var button = $('.post-listing .load-more');
	var loading = false;	
	var scrollHandling = {
	    allow: true,
	    reallow: function() {
		scrollHandling.allow = true;
	    },
	    delay: 400 //(milliseconds) adjust to the highest acceptable value
	};
	
	

	$(window).scroll(function(){
		if(set_offset < total_color_product) {
		if( ! loading && scrollHandling.allow ) {
			
			scrollHandling.allow = false;
			setTimeout(scrollHandling.reallow, scrollHandling.delay);
			var offset = $(button).offset().top - $(window).scrollTop();
			if( 2000 > offset ) {
				
				loading = true;
				$(".loader").show();
				$.post(ajaxUrl,{
				type: 'POST',
				action:"lazy_load_color_filter",
				offset:(page*ppp) ,
				ppp:ppp,
				cat_id:cat_id,
				color_name:color_name
				}).success(function(posts){
					
					page++;	
					set_offset = page*ppp ;						
						
					$(".load-more-post").before(posts);					
					
					loading = false;
				})

			}
		}
	}
	else
	{
		//$(".loader").fadeOut("slow");
		$(".loader").hide();
		$(".no-more-product").show();
		
	}
	});	
 
 }
 else if(filter_attr == "min_price") {
	 
		//if(total_product_price > 9) {
		$(document).ready(function() {
			
			$.post(ajaxUrl,{			
			type: 'POST',
			action:"lazy_load_price_filter",
			offset:0,
			ppp:9,
			cat_id:cat_id,
			min_price:min_price,
			max_price:max_price
			}).success(function(posts){	
				$(" .pro-filter li").remove();			
				$(".load-more-post").before(posts);					
			
			})			
	});
//}
	
	var page=1;var ppp=9;	
	var set_offset = 9;
	$('.post-listing').append( '<span class="load-more"></span>' );
	var button = $('.post-listing .load-more');
	var loading = false;	
	var scrollHandling = {
	    allow: true,
	    reallow: function() {
		scrollHandling.allow = true;
	    },
	    delay: 400 //(milliseconds) adjust to the highest acceptable value
	};
	
	

	$(window).scroll(function(){
		if(set_offset < total_product_price) {
		if( ! loading && scrollHandling.allow ) {
			
			scrollHandling.allow = false;
			setTimeout(scrollHandling.reallow, scrollHandling.delay);
			var offset = $(button).offset().top - $(window).scrollTop();
			if( 2000 > offset ) {
				
				loading = true;
				$(".loader").show();
				$.post(ajaxUrl,{
				type: 'POST',
				action:"lazy_load_price_filter",
				offset:(page*ppp) ,
				ppp:ppp,
				cat_id:cat_id,
				min_price:min_price,
				max_price:max_price
				}).success(function(posts){
					
					page++;	
					set_offset = page*ppp ;						
						
					$(".load-more-post").before(posts);					
					
					loading = false;
				})

			}
		}
	}
	else
	{
		$(".loader").fadeOut("slow");
		$(".loader").hide();
		$(".no-more-product").show();
		
	}
	});	
 
 }
});
</script>
<?php	
	} 
	else {?>
<script>
jQuery(function($){
	
	var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";	
	var cat_id = $("#cat_id").val();
	var cat_slug = $("#cat_id").attr("data-tax-terms");
	var cat_total_product = $("#cat_id").attr("data-total-product");
	//var ppp=cat_total_product -13;
	

			
			
			$(document).ready(function() {
				
				$.post(ajaxUrl,{
				//alert("welcome to Alor");
				type: 'POST',
				action:"lazy_load_ajax",
				offset:9,
				ppp:9,
				cat_id:cat_id
				}).success(function(posts){
					
					//page++;						
					$(".load-more-post").before(posts);					
				
				})

			
	});
	
	var page=2;var ppp=9;	
	var set_offset = 18;
	$('.post-listing').append( '<span class="load-more"></span>' );
	var button = $('.post-listing .load-more');
	//var page = 2;
	var loading = false;	
	var scrollHandling = {
	    allow: true,
	    reallow: function() {
	        scrollHandling.allow = true;
	    },
	    delay: 400 //(milliseconds) adjust to the highest acceptable value
	};
	
	

	$(window).scroll(function(){
		if(set_offset < cat_total_product) {
		if( ! loading && scrollHandling.allow ) {
			
			scrollHandling.allow = false;
			setTimeout(scrollHandling.reallow, scrollHandling.delay);
			var offset = $(button).offset().top - $(window).scrollTop();
			if( 2000 > offset ) {
				
				loading = true;
				$(".loader").show();
				$.post(ajaxUrl,{
				type: 'POST',
				action:"lazy_load_ajax",
				offset:(page*ppp) ,
				ppp:ppp,
				cat_id:cat_id
				}).success(function(posts){
					
					page++;	
					set_offset = page*ppp ;						
						
					$(".load-more-post").before(posts);					
					//$(".loader").fadeOut("slow");
					
					loading = false;
				})

			}
		}
	}
	else
	{
		//$(".loader").fadeOut("slow");
		$(".loader").hide();
		$(".no-more-product").show();
		
	}
	});	
});
</script>
<?php }?>
<script>
jQuery(function($){
				
				$('.price-item a').click(function() {			
					//alert("working fine");			
					$(".no-more-product").hide();
					$(".loader").hide();	
					
					var price_path  = $(this).attr('href');			
				   window.location.href = price_path;
				});
				
				/* *****price filter with color**** */
				
	/* var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";	
	var cat_id = $("#cat_id").val();		
	var	total_post_prc_color	= $("#total_post_prc_color").val();
	var	color_name	= $("#color_name").val();
	var	color_price_attr	= $("#color_price_attr").val();
	var	min_price	= $("#min_price").val();
	var	max_price	= $("#max_price").val();
	var total_product_price = $("#total_product_price").val();

	if(filter_attr == "filter_color") {	
		$(document).ready(function() {
			
			$.post(ajaxUrl,{			
			type: 'POST',
			action:"lazy_load_color_filter",
			offset:0,
			ppp:9,
			cat_id:cat_id,
			color_name:color_name
			}).success(function(posts){	
				$(" .pro-filter li").remove();				
				$(".load-more-post").before(posts);					
			
			})

			
	});
	
	var page=1;var ppp=9;	
	var set_offset = 9;
	$('.post-listing').append( '<span class="load-more"></span>' );
	var button = $('.post-listing .load-more');
	var loading = false;	
	var scrollHandling = {
	    allow: true,
	    reallow: function() {
		scrollHandling.allow = true;
	    },
	    delay: 400 //(milliseconds) adjust to the highest acceptable value
	};
	
	

	$(window).scroll(function(){
		if(set_offset < total_color_product) {
		if( ! loading && scrollHandling.allow ) {
			
			scrollHandling.allow = false;
			setTimeout(scrollHandling.reallow, scrollHandling.delay);
			var offset = $(button).offset().top - $(window).scrollTop();
			if( 2000 > offset ) {
				
				loading = true;
				$(".loader").show();
				$.post(ajaxUrl,{
				type: 'POST',
				action:"lazy_load_color_filter",
				offset:(page*ppp) ,
				ppp:ppp,
				cat_id:cat_id,
				color_name:color_name
				}).success(function(posts){
					
					page++;	
					set_offset = page*ppp ;						
						
					$(".load-more-post").before(posts);					
					
					loading = false;
				})

			}
		}
	}
	else
	{
		//$(".loader").fadeOut("slow");
		$(".loader").hide();
		$(".no-more-product").show();
		
	}
	});	
 
 }
 else if(filter_attr == "min_price") {
	 
		$(document).ready(function() {
			
			$.post(ajaxUrl,{			
			type: 'POST',
			action:"lazy_load_price_filter",
			offset:0,
			ppp:9,
			cat_id:cat_id,
			min_price:min_price,
			max_price:max_price
			}).success(function(posts){	
				$(" .pro-filter li").remove();			
				$(".load-more-post").before(posts);					
			
			})

			
	});
	
	var page=1;var ppp=9;	
	var set_offset = 9;
	$('.post-listing').append( '<span class="load-more"></span>' );
	var button = $('.post-listing .load-more');
	var loading = false;	
	var scrollHandling = {
	    allow: true,
	    reallow: function() {
		scrollHandling.allow = true;
	    },
	    delay: 400 //(milliseconds) adjust to the highest acceptable value
	};
	
	

	$(window).scroll(function(){
		if(set_offset < total_product_price) {
		if( ! loading && scrollHandling.allow ) {
			
			scrollHandling.allow = false;
			setTimeout(scrollHandling.reallow, scrollHandling.delay);
			var offset = $(button).offset().top - $(window).scrollTop();
			if( 2000 > offset ) {
				
				loading = true;
				$(".loader").show();
				$.post(ajaxUrl,{
				type: 'POST',
				action:"lazy_load_price_filter",
				offset:(page*ppp) ,
				ppp:ppp,
				cat_id:cat_id,
				min_price:min_price,
				max_price:max_price
				}).success(function(posts){
					
					page++;	
					set_offset = page*ppp ;						
						
					$(".load-more-post").before(posts);					
					
					loading = false;
				})

			}
		}
	}
	else
	{
		$(".loader").fadeOut("slow");
		$(".loader").hide();
		$(".no-more-product").show();
		
	}
	});	
 
 } */
				/***********END********/
});
</script>
<style>
#content .woocommerce-pagination{display:none !important;}

#product_list .catalog-list > li:first-child {
	width: 33.33%!important;
	height: 197px  !important;
	text-align: center;
	overflow: hidden;
}
#product_list .catalog-list > li {width: 33.33% !important;}
.slideset .caption-left{display:none;}

.no-more-product {
    text-align: center;
    font-size: 14px;
    font-weight: 800;
    margin-top: 2%;
}
#product_list .catalog-list li {   
	height: 197px !important;
	text-align:center;
}
<!--.inner_cls #products .catalog li{height:auto;}-->
.left-side-blck .hover-list li{height:auto;}


@media(max-width:767px){
	#product_list .catalog-list li { height: 86px;}
	#product_list .catalog-list > li:first-child{ height:86px !important;}
}
</style>
<?php get_footer('shop'); ?>