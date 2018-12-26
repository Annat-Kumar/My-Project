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
					<input type="text" placeholder="please enter item title" value="" id="product_title" name="product_title" disabled />
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
						<option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
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
					<input type="text" placeholder="Color" id="color" value="" />
				</div>
				<div class="col-grid-4">
					<input type="text" placeholder="Size" id="size" value="" />
				</div>
				<div class="col-grid-12 right-padding">	
					<p class="not-number"style="display:none;color:red;"><span  >Price is not a number. Please enter correct price number.</span></p>
					<p class="not-blank"style="display:none;color:red;"><span  >Price should not be blank. Please enter correct price.</span></p>
					<span>* If you think price is not correct or showing blank, please enter manualy.</span>
				</div>
				<div class="col-grid-12 check-price-btn" style="margin-top:2%">
					<button class="button wc-forward" type="button" id="price_detail" name="price_detail">Check total price</button>
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

<div class="secondary-div" style="display:none;">
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
				<tr class="custome_fee"style="display:none">
					<td>Customs fee</td>
					<td id="custome_fee" name="custome_fee"></td>
				</tr>
				<tr class="vat_customs" style="display:none">
					<td>Vat on customs</td>
					<td id="vat_customs" name="vat_customs"></td>
				</tr>
				<tr class="clearance" style="display:none">
					<td>Clearance fee</td>
					<td id="clearance" name="clearance"></td>
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
			
			//$('.price-loader').show();
			var price ;
			str	= $("#product_price").val();
			price = str.replace("$","");
			if(price =='')
			{				
				$('.not-blank').show();
				$('.not-number').hide();
				//alert('please enter price');
			}
			else if(isNaN(price)){
				alert('price is not a number');										
				$('.not-blank').hide();
				$('.not-number').show();			
			}
			else {		
			
				$("#product_price").val("$" + price);
				$('.not-blank').hide();
				$('.not-number').hide();
				$("#product_price").removeClass('bordered');						
			}
			
		});
		
		$("#price_detail").click(function(){
			
			category_value = $("#product_cat").val();
			str	= $("#product_price").val();
			product_price = str.replace("$","");
			
			if(category_value ==''){
				alert('please select category');
				 $("#product_cat").focus();
				 $('#product_cat').addClass('bordered');  
				event.preventDefault(false);				
			}else if(product_price ==''){
				$('#product_price').addClass('bordered');  
				//$("#product_price").focus();
				alert('Please enter correct price');
				event.preventDefault(false);				
			}
			else if(isNaN(product_price)){
				//alert(product_price);
				alert('price is not a number');
				event.preventDefault(false);	
			}
			else {
				$('#product_price').removeClass('bordered');
				$(".secondary-div").show();
				$("#price_detail").prop('disabled', true);
				
				$("#product_title").prop('disabled', true);
				$("#product_cat").prop('disabled', true);
				$("#product_price").prop('disabled', true);
				$("#color").val('').prop('disabled', true);
				$("#size").val('').prop('disabled', true);
				
				$(".cart-added").hide();
				
				/* calculate customs fee and other charges */
				
				website_fee = product_price*30/100 ;
				clearance_fee = 0;
				if(category_value=="345"){
					
					custome_fee = 0 ;
					clearance_fee = 10;
					vat_customes = product_price*14/100 ;					
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(vat_customes) +  Number(clearance_fee) ;
					
					$(".custome_fee").hide(); 
					$(".vat_customs").show();  
					$(".clearance").show(); 
 
				}
				else if(category_value=="351"){
					
					custome_fee = product_price*5/100 ;
					vat_customes = 0;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) ;
					
					$(".custome_fee").show(); 
					$(".vat_customs").hide();  
					$(".clearance").hide(); 
				}
				else if(category_value=="357"){
					
					custome_fee = product_price*10/100 ;
					vat_customes = product_price*14/100 ;					
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes);
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").hide(); 
				}
				else if(category_value=="346"){
					custome_fee = product_price*40/100 ;
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes);
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").hide(); 
				}
				else if(category_value=="352"){
					custome_fee = 0; 
					vat_customes = product_price*14/100 ;					
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(vat_customes);
					
					$(".custome_fee").hide(); 
					$(".vat_customs").show();  
					$(".clearance").hide();
				}
				else if(category_value=="358"){
					custome_fee = product_price*10/100 ;
					vat_customes = product_price*14/100 ;					
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes);
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").hide();
				}
				else if(category_value=="347"){
					custome_fee = product_price*40/100 ;
					clearance_fee = 50;
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes) +  Number(clearance_fee) ;
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").show();
				}
				else if(category_value=="354"){
					custome_fee = product_price*20/100 ;
					vat_customes = product_price*14/100;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes);
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").hide();
				}
				else if(category_value=="359"){
					custome_fee = product_price*40/100 ;	
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes);
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").hide();
				}
				else if(category_value=="348"){
					custome_fee = product_price*45/100 ;
					clearance_fee = 5;
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes) +  Number(clearance_fee) ;
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").show();
				}
				else if(category_value=="360"){
					custome_fee = 0 ;
					clearance_fee = 20;
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(vat_customes) +  Number(clearance_fee) ;
					
					$(".custome_fee").hide(); 
					$(".vat_customs").show();  
					$(".clearance").show();
				}
				else if(category_value=="353"){
					custome_fee = 0 ;					
					vat_customes = product_price*14/100 ;					
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(vat_customes) ;
					
					$(".custome_fee").hide(); 
					$(".vat_customs").show();  
					$(".clearance").hide();
				}
				else if(category_value=="349"){
					custome_fee = 0 ;					
					vat_customes = 0 ;
					total_fee =  Number(product_price) +  Number(website_fee) ;
					
					$(".custome_fee").hide(); 
					$(".vat_customs").hide();  
					$(".clearance").hide();
				}
				else if(category_value=="355"){
					custome_fee = product_price*5/100 ;
					clearance_fee = 20;
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes) +  Number(clearance_fee) ;
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").show();
				}
				else if(category_value=="361"){
					custome_fee = product_price*10/100 ;	
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes);
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").hide();
				}
				else if(category_value=="350"){
					custome_fee = product_price*45/100 ;	
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes);
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").hide();
				}
				else if(category_value=="356"){
					custome_fee = product_price*30/100 ;	
					vat_customes = product_price*14/100 ;
					total_fee =  Number(product_price) +  Number(website_fee) +  Number(custome_fee) +  Number(vat_customes);
					
					$(".custome_fee").show(); 
					$(".vat_customs").show();  
					$(".clearance").hide();
				}
				/** end calculation **/
				
			
				online_price =  Number(product_price);
				product_price_val = online_price.toFixed(2);
				website_fee = website_fee.toFixed(2);
				custome_fee = custome_fee.toFixed(2);
				vat_customes = vat_customes.toFixed(2);
				total_fee   = total_fee.toFixed(2); 

				$("#online_price").text(product_price_val);
				$("#website_fee").text(website_fee);
				$("#custome_fee").text(custome_fee);
				$("#vat_customs").text(vat_customes);
				if(clearance_fee != 0){
					$("#clearance").text(clearance_fee);
				}
					
				$("#total_fee").text("$" + total_fee);
								
			}
		});
		
		var url = window.location.origin;
		var admin_url ="/wp-admin/admin-ajax.php";
		var ajaxUrl = url+admin_url;
		
		
		/**** fetch product details on submit Item url *****/
		
		$('#product_url').bind('keyup', function() { 
		
			// $("#submit_url").trigger('click');
			product_url = $("#product_url").val();
			
			 regexp =  /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;
				
				
			if(product_url ==''){
				event.preventDefault(false);				
			} 
			else if (!regexp.test(product_url))
				{
					alert("Product url is not correct!");
					event.preventDefault(false);	
				}
			else {				
			
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
					$(".secondary-div").hide();					
					$("#price_detail").prop('disabled', false);
					$("#product_title").prop('disabled', false);
					$("#product_cat").prop('disabled', false);
					$("#product_price").prop('disabled', false);
					$("#color").val('').prop('disabled', false);
					$("#size").val('').prop('disabled', false);
					
					$("#add_to_cart").prop('disabled', false);
				
					var obj = jQuery.parseJSON(responseq);
					title = obj.title ;
					price = obj.price ;
					
					if(title =="Access Denied" || title ==null){
						$("#product_title").val('');
						$("#product_title").prop('disabled', false);  //Enable input 
					}
					else{
						$("#product_title").val(title);
					}
					if(price ==''){
						$("#product_price").val('');
						
					}
					else {	
					
					$("#product_price").val("$" + price);										
					 
					}
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
			product_price = $("#total_fee").text();
			product_cat = category_value ;
			var url=ajaxUrl;
			
				$.ajax({

				url :url,
				type : 'post',
				data : {
					action : 'insert_product',
					product_title: product_title,
					product_price: product_price,
					product_cat : product_cat,
				},         
				beforeSend: function() 
				{
					   $(".loader").show();                      
				},
				success: function(responseq) 
				{					
					 $(".loader").hide();
					 $("#add_to_cart").prop('disabled', true);
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