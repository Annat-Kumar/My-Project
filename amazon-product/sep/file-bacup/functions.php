<?php
// Add custom Theme Functions here


add_action('wp_ajax_nopriv_insert_product', 'insert_product'); 
add_action('wp_ajax_insert_product', 'insert_product');

function insert_product(){
	
	//echo "product being inserted here"; die;
	$title = $_POST['product_title'];
	$price = $_POST['product_price'];
	$category = $_POST['product_cat'];
	
	$price = str_replace("$"," " ,"$price");
	
	$post_id = wp_insert_post( array(
	'post_title' => $title,
	'post_content' => 'Here is content of the post, so this is our great new products description',
	'post_status' => 'draft',
	'post_name' => sanitize_title($title), //name/slug
	'post_type' => "product",
	) );
	
	//echo $post_id;
	
	$metas = array(
	  '_visibility' => 'visible',
	  '_stock_status' => 'instock',
	  '_downloadable' => 'no',	  
	  '_virtual' => '',
	  '_regular_price' => $price,
	  '_sale_price' => $price,
	  '_purchase_note' => '',
	  '_featured' => 'no',
	  '_weight' => '',
	  '_length' => '',
	  '_width' => '',
	  '_height' => '',
	  '_sku' => mt_rand(),
	  '_product_attributes' => array(),
	  '_price' => $price,
	  '_stock' => 2
	);
	//wp_set_object_terms(1669, $category, 'product_cat');
	//wp_set_object_terms($post_id, 'simple', 'product_type');
	
	foreach ($metas as $key => $value) {
	  update_post_meta($post_id, $key, $value);
	}

	// Add product to cart 
	WC()->cart->add_to_cart($post_id);
//	WC()->cart->add_to_cart(1669);

	
	
	die();
}

/* fetch product details vai ajax*/
add_action('wp_ajax_nopriv_product_details', 'product_details'); 
add_action('wp_ajax_product_details', 'product_details');

function product_details(){
	
	require_once('ProductScraper.php');
	
	$scraped_Values	= $_POST['scraped_Values'] ;
	//echo "<pre>";print_r($scraped_Values);die;
	$scrapedValues = Array();
	
	$scrapedValues = ProductScraper::getInfo("$scraped_Values"); 
	
	//echo "<pre>";print_r($scrapedValues);die;

	if (strpos($scraped_Values,'amazon') !== false) {	

	$url = "http://www.amazon.co.uk/dp/B003YGQP6A";
	preg_match('/\/([a-zA-Z0-9]{10})/',$scraped_Values,$parsed);
	$asin = $parsed[1];
	//echo $ASIN;

	$baseUrl =  'https://www.amazon.com/gp/product/' ;
	$html = file_get_contents($baseUrl. $asin);
	$isMatched = preg_match('|"priceblock_ourprice".*\$(.*)<|', $html, $match);
	$price = 0;
	if($isMatched && isset($match[1]))
	{
		$price = $match[1];

	} 
	else{
		
		$price = $scrapedValues[1];
	}
	
	} 
	else {
		$price = $scrapedValues[1];
	}
	
	$price = str_replace("$"," ",$price);
	
$title = $scrapedValues[0];
$return_val = array('title'=>$title , 'price'=>$price);
echo json_encode($return_val);
	
	die();
}