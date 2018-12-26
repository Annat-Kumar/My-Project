<?php
// Add custom Theme Functions here


add_action('wp_ajax_nopriv_insert_product', 'insert_product'); 
add_action('wp_ajax_insert_product', 'insert_product');

function insert_product(){
	
	//echo "product being inserted here";
	$title = $_POST['product_title'];
	$price = $_POST['product_price'];
	
	$price = str_replace("$"," " ,"$price");
	
	$post_id = wp_insert_post( array(
	'post_title' => $title,
	'post_content' => 'Here is content of the post, so this is our great new products description',
	'post_status' => 'draft',
	'post_type' => "product",
	) );
	
	//echo $post_id;
	
	$metas = array(
	  '_visibility' => 'visible',
	  '_stock_status' => 'instock',	  
	  '_virtual' => 'yes',
	  '_regular_price' => '',
	  '_sale_price' => '',
	  '_purchase_note' => '',
	  '_featured' => 'no',
	  '_weight' => '',
	  '_length' => '',
	  '_width' => '',
	  '_height' => '',
	  '_sku' => '',
	  '_product_attributes' => array(),
	  '_price' => $price,
	  '_stock' => ''
	);
	
	foreach ($metas as $key => $value) {
	  update_post_meta($post_id, $key, $value);
	}

	// Add product to cart 
	WC()->cart->add_to_cart( $post_id );

	
	
	die();
}