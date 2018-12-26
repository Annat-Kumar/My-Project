<?php

/*
Template name:product-category
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
			<input type="text" placeholder="* Item URL" value="" />
		  </div>
		  <div class="col-grid-5 right-padding">
			<input class="select-arrow" type="text" placeholder="Select Category" value="" />
		  </div>
		  <div class="col-grid-5 right-padding">
			<input type="text" placeholder="* Item Name" value="" />
		  </div>
		  <div class="col-grid-2">
		  <input type="number" placeholder="1" name="quantity" min="1" max="5">
		  </div>
		<div class="col-grid-4 right-padding">
		<input type="text" placeholder="* Unit price ($)" value="" />
		</div>
		<div class="col-grid-4 right-padding">
		<input type="text" placeholder="Color" value="" />
		</div>
		<div class="col-grid-4">
		<input type="text" placeholder="Size" value="" />
		</div>
		</div>
    </form>

    </div>
  </div>

</div>
<style>
.footer-wrapper {
    float: left;
}
</style>
 <?php 
get_footer();
?>