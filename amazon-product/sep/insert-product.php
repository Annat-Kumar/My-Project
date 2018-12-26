<?php 
//Hi, i created a function for adding variable products based on your code. I share it here in case anyone needs it:

//The first parameter is the title of the product, $cats is the products category id which has to be an array and must be created previously, $variations is an array which contains the variations with prices, descriptions, discount, and $variations_key is the key of the parent attribute which has to be created previously on teh attributes page.

//I´m creating a ticket´s selling store and I´m using 2 globals: $logger and $vgh from my framework, please ignore them.

<?
function create_variable_woo_product($title, $cats = array(), $variations, $variations_key) {
global $wpdb, $logger, $vgh;
$post = array(
'post_title' => $title,
'post_status' => "publish",
'post_name' => sanitize_title($title), //name/slug
'post_type' => "product"
);
//Create product/post:
$new_prod_id = wp_insert_post($post, $wp_error);
$logger->info('Crear producto WooCommerce: ID:' . $new_prod_id);
//make product type be variable:
wp_set_object_terms($new_prod_id, 'variable', 'product_type');
//add category to product:
wp_set_object_terms($new_prod_id, $cats, 'product_cat');
//################### Add size attributes to main product: ####################
//Array for setting attributes
$var_keys = array();
$total_tickets = 0;
foreach ($variations as $variation) {
$total_tickets += (int) $variation["entradas"];
$var_keys[] = sanitize_title($variation['desc']);
wp_insert_term(
$variation['desc'], // the term
$variations_key, // the taxonomy
array(
'slug' => sanitize_title($variation['desc'])
)
);
}
wp_set_object_terms($new_prod_id, $var_keys, $variations_key );
$thedata = Array($variations_key => Array(
'name' => $variations_key,
'value' => implode( ' | ', $var_keys),
'is_visible' => '1',
'is_variation' => '1',
'is_taxonomy' => '1'
));
update_post_meta($new_prod_id, '_product_attributes', $thedata);
//########################## Done adding attributes to product #################
//set product values:
update_post_meta($new_prod_id, '_stock_status', ( (int) $total_tickets > 0) ? 'instock' : 'outofstock');
update_post_meta($new_prod_id, '_sku', mt_rand() );
update_post_meta($new_prod_id, '_stock', $total_tickets);
update_post_meta($new_prod_id, '_visibility', 'visible');
update_post_meta($new_prod_id, '_default_attributes', array());
//###################### Add Variation post types for sizes #############################
$i = 1;
$var_prices = array();
//set IDs for product_variation posts:
foreach ($variations as $variation) {
$my_post = array(
'post_title' => 'Variation #' . $i . ' of ' . count($variations) . ' for product#' . $new_prod_id,
'post_name' => 'product-' . $new_prod_id . '-variation-' . $i,
'post_status' => 'publish',
'post_parent' => $new_prod_id, //post is a child post of product post
'post_type' => 'product_variation', //set post type to product_variation
'guid' => home_url() . '/?product_variation=product-' . $new_prod_id . '-variation-' . $i
);
//Insert ea. post/variation into database:
$attID = wp_insert_post($my_post);
//Create 2xl variation for ea product_variation:
update_post_meta($attID, 'attribute_' . $variations_key, sanitize_title($variation['desc']));
update_post_meta($attID, '_sale_price', pyo_get_price($variation));
update_post_meta($attID, '_regular_price', (int) $variation["cantidad"]);
$var_prices[ $i - 1]['id'] = $attID;
$var_prices[$i - 1 ]['regular_price'] = sanitize_title($variation['cantidad']);
$var_prices[$i - 1 ]['sale_price'] = pyo_get_price($variation);
//add size attributes to this variation:
wp_set_object_terms($attID, $var_keys, 'pa_' . sanitize_title($variation['desc']));
$thedata = Array( $variations_key => Array(
'name' => $variations_key,
'value' => sanitize_title($variation['desc']),
'is_visible' => '1',
'is_variation' => '1',
'is_taxonomy' => '1'
));
update_post_meta($attID, '_product_attributes', $thedata);
update_post_meta($attID, '_sku', mt_rand());
update_post_meta($attID, '_stock_status', ( (int) $variation["entradas"] > 0) ? 'instock' : 'outofstock');
update_post_meta($attID, '_manage_stock', 'yes');
update_post_meta($attID, '_stock', $variation["entradas"]);
$i++;
}
$i = 0;
foreach ($var_prices as $var_price) {
$regular_prices[] = $var_price['regular_price'];
$sale_prices[] = $var_price['sale_price'];
}
update_post_meta($new_prod_id, '_min_variation_price', min($sale_prices));
update_post_meta($new_prod_id, '_max_variation_price', max($sale_prices));
update_post_meta($new_prod_id, '_min_variation_regular_price', min($regular_prices));
update_post_meta($new_prod_id, '_max_variation_regular_price', max($regular_prices));
update_post_meta($new_prod_id, '_min_price_variation_id', $var_prices[array_search(min($sale_prices), $sale_prices)]['id']);
update_post_meta($new_prod_id, '_max_price_variation_id', $var_prices[array_search(max($sale_prices), $sale_prices)]['id']);
update_post_meta($new_prod_id, '_min_regular_price_variation_id', $var_prices[array_search(min($regular_prices), $regular_prices)]['id']);
update_post_meta($new_prod_id, '_max_regular_price_variation_id', $var_prices[array_search(max($regular_prices), $regular_prices)]['id']);
}

?>