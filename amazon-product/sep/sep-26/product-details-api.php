<?php

/*
Template name:product-details
*/

get_header();

error_reporting(0);
require_once('ProductScraper.php');


?>
<div class="container" style="margin-top:2%">
<span class="font-bold">Item Url</span>
<form method="post" id="product_form" name="product_form">
<input type="text" id ="product_url" name="product_url" placeholder="https://www.amazon.com/gp/product/B00I8BICB2.." value="">
<input type="submit" id="submit_url"  name="submit_url" value="Submit Url" style="display:none;">
</form>
</div>
<div class="product-loader" style="display:none;text-align:center">		
			<div style="width:50%;margin:0 auto;color:blue;"><span style="text-align:center;">Product details is being fetched. Please Wait !</span></div>
			<img class="img-loader" src="<?php bloginfo('template_directory');?>/images/ajax-loader.gif">
</div>

<div class="container main-div" style="display:none;">
	<div class="product-details">
		<span class="font-bold">Product Title</span>
		<input type="text" value='<?php echo $scrapedValues[0] ;?>' id="product_title" name="product_title" disabled >
		<span class="font-bold">Price in $</span><br/>
		<span>If you think price is not correct or showing blank, please enter manualy.</span>
		<input type="text" value="" id="product_price" name="product_price" placeholder="sorry we are unable to fetch correct price. Please enter product price.">
		
		
		<div class="price-loader" style="display:none;text-align:center">		
			<div style="width:50%;margin:0 auto;color:blue;"><span style="text-align:center;">Price  is being updated. Please Wait !</span></div>
			<img class="img-loader" src="<?php bloginfo('template_directory');?>/images/ajax-loader.gif">
		</div>
		<span class="font-bold">Category</span>
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
		
		<span class="font-bold">Website fee (30% of online fee)</span>
		<input type="text" value=" " id="website_fee" name="website_fee" disabled >
		<span class="font-bold">Custome fee </span>
		<input type="text" value=" " id="custome_fee" name="custome_fee" disabled >
		<span class="font-bold">Total fee </span>
		
		<input type="text" value=" " name="total" id="total_fee" name="total_fee" disabled>
	</div>
	<button type="button" id="add_to_cart" name="add_to_cart" style="background-color:#dd3333;color:#fff;">ADD TO CART</button>
	<div class="loader" style="display:none;text-align:center">		
		<div style="width:50%;margin:0 auto;color:blue;"><span style="text-align:center;">Product is being added to cart. Please Wait !</span></div>
		<img class="img-loader" src="<?php bloginfo('template_directory');?>/images/ajax-loader.gif">
	</div>
	<div class="cart-added" style="display:none;text-align:center;"><span style="color:green;">Product added to cart sucessfully</span><div style="margin-top: 2%;"><a href="https://hersandfamily.com/cart/" class="button wc-forward">View cart</a></div>
	</div>
</div>
	

<style>

.font-bold{font-weight:bold;}
</style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script>
 jQuery(document).ready(function()
{
				
		$('#product_price').bind('focusout', function() { 
			
			$('.price-loader').show();
			var price ;
			str	= $("#product_price").val();
			price = str.replace("$","");
			if(isNaN(price)){
				alert('price is not a number');
				$('.price-loader').hide();
				
			$("#product_price").val("");
			$("#website_fee").val("");
			$("#custome_fee").val("");
			$("#total_fee").val("");
			$('.price-loader').hide();				
			}
			else {
			website_fee = price*30/100 ;
			custome_fee = price*14/100 ;
			total_fee = parseInt(price) + parseInt(website_fee) + parseInt(custome_fee) ;
			
			$("#product_price").val("$" + price);
			$("#website_fee").val("$" + website_fee);
			$("#custome_fee").val("$" + custome_fee);
			$("#total_fee").val("$" + total_fee);
			$('.price-loader').hide();
			}
			
		});
		
		var url = window.location.origin;
		var admin_url ="/wp-admin/admin-ajax.php";
		var ajaxUrl = url+admin_url;
		
		
		/**** fetch product details on submit Item url *****/
		
		$('#product_url').bind('keyup', function() { 
		
			// $("#submit_url").trigger('click');
			product_url = $("#product_url").val();
			if(product_url ==''){
				event.preventDefault(false);				
			}else {				
			
			var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'product_details',
					scraped_Values : product_url
				},         
				beforeSend: function() 
				{
					   $(".product-loader").show();                      
				},
				success: function(responseq) 
				{					
					$(".product-loader").hide();
					$(".main-div").show();					
					var obj = jQuery.parseJSON(responseq);
					title = obj.title ;
					price = obj.price ;
					$("#product_title").val(title);
					$("#product_price").val(price);
					 
					website_fee = price*30/100 ;
					custome_fee = price*14/100 ;
					total_fee = parseInt(price) + parseInt(website_fee) + parseInt(custome_fee) ;
					
					$("#product_price").val("$" + price);
					$("#website_fee").val("$" + website_fee);
					$("#custome_fee").val("$" + custome_fee);
					$("#total_fee").val("$" + total_fee);
					 
					
				}
				
				});
			}
			
		});
		
		
		
		$("#add_to_cart").click(function(){
			
			category_value = $("#product_cat").val();
			
			if(category_value ==''){
				alert('please select category');
				event.preventDefault(false);				
			}else {
			
			//alert('your product is being added to cart. Plz wait!');
			
			product_title = $("#product_title").val();
			product_price = $("#total_fee").val();
			
			var url=ajaxUrl;
			
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
					   $(".loader").show();                      
				},
				success: function(responseq) 
				{					
					 $(".loader").hide();
					 $(".cart-added").show();
					 //window.location.href = "https://hersandfamily.com/product-details-from-url/";
					 $(document.body).trigger('wc_fragment_refresh');
				}
				
				});
				}
		});
		
});
 </script>
 
 <?php 
get_footer();
?>

