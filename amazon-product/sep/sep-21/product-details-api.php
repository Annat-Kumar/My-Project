<?php

/*
Template name:product-details
*/

get_header();

require_once('ProductScraper.php');


?>

<form method="post" name="product-form" action="#">
<input type="text" name="product_url" placeholder="https://www.amazon.com/gp/product/B00I8BICB2..">
<input type="submit" name="submit_url" value="Submit Url">
</form>
<?php


if(isset($_POST['submit_url']))
{
		
	$scraped_Values	= $_POST['product_url'] ;
	$scrapedValues = Array();
	$scrapedValues147 = ProductScraper::getInfo('https://www.amazon.com/gp/product/B00I8BICB2/ref=s9_acsd_top_hd_bw_b3OSvIh_c_x_w?pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-3&pf_rd_r=HSWNNJH1NEGBWKW7SDG5&pf_rd_r=HSWNNJH1NEGBWKW7SDG5&pf_rd_t=101&pf_rd_p=86cb3aa2-2cf4-5158-a14d-80184ff240a1&pf_rd_p=86cb3aa2-2cf4-5158-a14d-80184ff240a1&pf_rd_i=3109924011'); 
 	
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
	//insert_product();
?>	
<div class="main-div">
	<div class="product -details">
		<span class="">Product Title</span>
		<input type="text" value='<?php echo $scrapedValues[0] ;?>' id="product_title" name="product_title" disabled >
		<span class="">Price</span>
		<?php if (strpos($scraped_Values,'amazon') !== false) {
		?>
		<input type="text" value="<?php echo "$". $price ;?>" id="product_price" name="product_price" disabled >
		<?php }else {?>		
		<input type="text" value="<?php echo $price ;?>" id="product_price" name="product_price" disabled >
		<?php } ?>
		<span class="">Category</span>
		 <?php 
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
		<select name="product_cat" id="product_cat">
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
		<span class="">Website fee</span>
		<input type="text" value="$25" name="website_fee" disabled >
		<span class="">Tax fee</span>
		<input type="text" value="$10" name="tax_fee" disabled >
		<span class="">Shipping fee</span>
		<input type="text" value="$15" name="shipping_fee" disabled >
		<span class="">Total</span>
		<?php 
			$total = $price+10+15+25 ;
		?>
		<input type="text" value="<?php echo "$". $total ;?>" name="total" disabled>
	</div>
	<button type="button" id="add_to_cart" name="add_to_cart" style="background-color:#dd3333;color:#fff;">ADD TO CART</button>
</div>
	
<?php 	
}
 ?>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script>
 jQuery(document).ready(function()
{
	
		var url = window.location.origin;
		var admin_url ="/wp-admin/admin-ajax.php";
		var ajaxUrl = url+admin_url;
		
		$("#add_to_cart").click(function(){
			
			category_value = $("#product_cat").val();
			
			if(category_value ==''){
				alert('please select category');
				event.preventDefault();				
			}
			
			alert('your product is being added to cart. Plz wait!');
			
			product_title = $("#product_title").val();
			product_price = $("#product_price").val();
			
			var url=ajaxUrl;
			
			/* $.post(ajaxUrl,{
				type: 'POST',
				product_title: product_title,
				product_price:product_price
				action: "insert_product",				
				}).success(function(posts){
					
					alert('your product added sucessfully');
				}); */
				
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'insert_product',
					product_title: product_title,
					product_price: product_price
				},         
				beforeSend: function() 
				{
					                         
				},
				success: function(responseq) 
				{
					alert('Item added to cart sucessfully');
					window.location.href = "https://hersandfamily.com/cart/";
				}
				
				});
				
		});
		
});
 </script>
 
 <?php 
//get_footer();
?>

