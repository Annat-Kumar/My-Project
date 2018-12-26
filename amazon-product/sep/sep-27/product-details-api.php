<?php

/*
Template name:product-details
*/

get_header();

?>
<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/product-style.min.css">
<!-- Cart Banner start here  -->
<div class="cart-banner">
  <div class="cart-container">
    <div class="cart-form">
    <h4>Add Item(s)</h4>
    <form class="" action="" method="post">
		<div class="row">
			<div class="col-grid-12">
				<input type="text" id="product_url" name="product_url" placeholder="* Item URL" value="" />
			</div>
			<div class="col-grid-12 product-loader" style="display:none;text-align:center">		
				<div style="width:50%;margin:0 auto;color:blue;">
					<span style="text-align:center;">Product details is being fetched. Please Wait !</span>
				</div>
				<img class="img-loader" src="<?php bloginfo('template_directory');?>/images/ajax-loader.gif">
			</div>

			<div class="main-div" style="display:none;">
				<div class="col-grid-6 right-padding">
					<input type="text" placeholder="* Item Name" value="" id="product_title" name="product_title" disabled />
				</div>
				<?php 
						/* show all product categoryproduct category */
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
					
				<div class="col-grid-6">
					<!--<input class="select-arrow" type="text" name="product_cat" id="product_cat" placeholder="Select Category" value="" />-->
					<select class="select-arrow" name="product_cat" id="product_cat">
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
				</div>		 
				<div class="col-grid-4 right-padding">
					<input type="text" class="" value=""  id="product_price" name="product_price" placeholder="* Unit price ($)" />
				</div>
				<div class="col-grid-4 right-padding">
					<input type="text" placeholder="Color" value="" />
				</div>
				<div class="col-grid-4">
					<input type="text" placeholder="Size" value="" />
				</div>
				<div class="col-grid-12 right-padding">	
					<p class="not-number"style="display:none;color:red;"><span  >Price is not a number. Please enter correct price number.</span></p>
					<span>* If you think price is not correct or showing blank, please enter manualy.</span>
				</div>

			</div>
		</div>
    </form>
				<div class="price-loader" style="display:none;text-align:center">		
					<div style="width:50%;margin:0 auto;color:blue;"><span style="text-align:center;">Price  is being updated. Please Wait !</span></div>
					<img class="img-loader" src="<?php bloginfo('template_directory');?>/images/ajax-loader.gif">
				</div>
    </div>
  </div>

</div>

<div class="main-div" style="display:none;">
	<div class="cart-detail">
		<div class="detail-container">

			<p><img class="info-icon" src="<?php bloginfo('template_directory');?>/images/info-icon.png" /><strong>International shipping fees</strong> Charged after arrival to our office
			Minimum weight value of any order is first 0.25kg then multiplications of 0.5kg, The calculated weight is approximated to the next whole figure. e.g. 2Kg 300g = 2.5kg, 1kg 700g = 2kg
			</p>
			<p><img class="info-icon" src="<?php bloginfo('template_directory');?>/images/info-icon.png" /><strong>Domestic shipping </strong>is the cost of shipping from the merchant to our office in the US. Will be calculated for you at the review stage.
			You can enter it `Notes and additional info` section in cart if you know othwerwise we will add it if there is any at the review stage
			</p>
			<div class="checkout">
				<table width="100%">
				<tr>
					<td>Online Price</td>
					<td><span id="online_price"></span></td>
				</tr>
				<tr>
					<td>Customs fee</td>
					<td id="custome_fee" name="custome_fee"></td>
				</tr>
				<tr>
					<td>website fee</td>
					<td><span id="website_fee" name="website_fee" ></span></td>
				</tr>
				<tr>
					<td>International shipping fees ($10 per 1/2kg, min. 1/4kg) </td>
					<td>To be determined</td>
				</tr>
				</table>
				<h2>Your Total  <span name="total" id="total_fee"></span></h2>
				<p>
				  Conversion Rate ≈ 18.79 EGP
				</p>
				<!--<a class="checkout-btn" href="#">Add to cart</a>-->
				<button class="button wc-forward" type="button" id="add_to_cart" name="add_to_cart">ADD TO CART</button>
				<div class="loader" style="display:none;">		
					
					<img class="img-loader" src="<?php bloginfo('template_directory');?>/images/ajax-loader.gif">
					<div style="color:blue;"><span style="text-align:center;">Product is being added to cart. Please Wait !</span></div>
				</div>
				<div class="cart-added" style="display:none;">
					<span style="color:green;">Product added to cart sucessfully</span>
					<div style="margin-top: 2%;">
						<a href="https://hersandfamily.com/cart/" class="button wc-forward" style="background-color: #dd3333;color: #fff;">View cart</a>
					</div>
				</div>
			</div>
			
			<div class="checout-right">
				<p>
				  <img class="info-icon" src="<?php bloginfo('template_directory');?>/images/info-icon.png" /> Minimum weight value of any order is first 0.25kg then multiplications of 0.5kg, The calculated weight is approximated to the next whole figure. e.g. 2Kg 300g = 2.5kg, 1kg 700g = 2kg
				</p>
				<p>
				  <img class="info-icon" src="<?php bloginfo('template_directory');?>/images/info-icon.png" /> <strong>Domestic shipping</strong> is the cost of shipping from the merchant to our office in the US. Will be calculated for you at the review stage.
				</p>
				<p>
				  <strong>Kindly note if you place an order with more than one item and one of them is unavailable , the only available options are:</strong>
				- Your order will be on hold.
				- Your order will be cancelled.
				- The unavailable item will be cancelled.
				</p>
				<p>
				  - The notes field is for you to add any important information regarding your order.
				</p>
				<p>
				  - After your order arrives to our our Office, delivery fees will be charged.
				</p>
			</div>
		</div>
	</div>
</div>
<style>
.footer-wrapper {
    float: left;
}
.bordered{border-color:#fe0226 !important;}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script>
 jQuery(document).ready(function()
{
				$('#product_cat').bind('focusout', function() { 
					
					category_value = $("#product_cat").val();
					if(category_value !='')
					{
						$("#product_cat").removeClass('bordered'); 		
					}
					else {
						$("#product_cat").addClass('bordered');
					}
				});
		$('#product_price').bind('focusout', function() { 
			
			$('.price-loader').show();
			var price ;
			str	= $("#product_price").val();
			price = str.replace("$","");
			if(isNaN(price)){
				alert('price is not a number');
				
			//$("#product_price").val("");
			$("#website_fee").text("");
			$("#online_price").text("");
			$("#custome_fee").text("");
			$("#total_fee").text("");
			$('.price-loader').hide();
			$('.not-number').show();			
			}
			else {
			website_fee = price*30/100 ;
			custome_fee = price*14/100 ;
			total_fee = parseInt(price) + parseInt(website_fee) + parseInt(custome_fee) ;
			
			$("#product_price").val("$" + price);
			$("#online_price").text("$" + price);
			$("#website_fee").text("$" + website_fee);
			$("#custome_fee").text("$" + custome_fee);
			$("#total_fee").text("$" + total_fee);
			$('.price-loader').hide();
			$('.not-number').hide();
			$("#product_price").removeClass('bordered'); 
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
					$("#online_price").text("$" + price);
					$("#website_fee").text("$" + website_fee);
					$("#custome_fee").text("$" + custome_fee);
					$("#total_fee").text("$" + total_fee);
					 
					
				}
				
				});
			}
			
		});
		
		
		
		$("#add_to_cart").click(function(){
			
			category_value = $("#product_cat").val();
			online_price = $("#online_price").text();
			
			if(category_value ==''){
				alert('please select category');
				 $("#product_cat").focus();
				 $('#product_cat').addClass('bordered');  
				event.preventDefault(false);				
			}else if(online_price ==''){
				$('#product_price').addClass('bordered');  
				//$("#product_price").focus();
				alert('Please enter correct price');
				event.preventDefault(false);				
			}
			else {
			
			//alert('your product is being added to cart. Plz wait!');
			$('#product_cat').removeClass('bordered');  
			$("#product_price").removeClass('bordered'); 
			$(".cart-added").hide();
			
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