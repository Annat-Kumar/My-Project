<?php

/*
Template name:product-category
*/
?>
<form method="post" name="product-form" action="#">
<input type="text" name="product_url" placeholder="https://www.amazon.com/gp/product/B00I8BICB2..">
<input type="submit" name="submit_url" value="Submit Url">
</form>
<?php

require_once('ProductScraper.php');

if(isset($_POST['submit_url']))
{
		
	$scraped_Values	= $_POST['product_url'] ;
	$scrapedValues = Array();
	
 
	// echo $scraped_Values ;echo "<br>";
	$scrapedValues = ProductScraper::getInfo("$scraped_Values"); 

	echo "<pre>";print_r($scrapedValues);die;

	//echo "<pre>";print_r($scrapedValues);


	if (strpos($scraped_Values,'amazon') !== false) {
    echo 'amazon exist';

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
		
		//echo "Price:" . $price . "<br />" ;
	} 
	else{
		//echo "Price: " . $scrapedValues[1] . "<br />";
	}
	
	//insert_product();
	} else {
		echo 'Sorry url work only for amazon product';
		//die;
	}
}

$orderby = 'name';
$order = 'asc';
$hide_empty = false ;
$cat_args = array(
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
);
 
$product_categories = get_terms( 'product_cat', $cat_args );
 
if( !empty($product_categories) ){

?>
<select name="category-list">
<option value="">Please Select Product category</option>
<?php 
    foreach ($product_categories as $key => $category) {
       

?>
	<option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
<?php 
}
?>
</select>
<?php 
}
?>