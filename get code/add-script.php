<?php
/*Template Name: Home Page*/
get_header('childtheme');
?>
<?php 
wp_head() ;
// under <head> tag in header.php 
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.main.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider.js"></script>
	
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/raqam-style.css" rel="stylesheet">
	
	<?php 
	/* use get_template_directory_uri() for parent theme 
	   get_stylesheet_directory_uri() for child theme 
	*/
	?>
	
	<!-- bloginfo('template_directory');is deprecated in latest wordpress -->
	<script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>
	<script src="<?php bloginfo('template_directory');?>/owl-carousel/owl.carousel.min.js"></script>
	
	<link href="<?php echo bloginfo("stylesheet_directory"); ?>/admin/css/style.css" rel="stylesheet">
	<link href="<?php echo bloginfo("stylesheet_directory"); ?>/admin/css/responsive.css" rel="stylesheet"> 
	


	<?php get_template_part('header', 'desktop'); // template header-desktop.php included  ?>
	<?php get_template_part('header', 'mobile'); // template header-mobile.php included  ?>
	<?php get_template_part('template', 'banner'); // template header-banner.php included  ?>
	
	<?php get_template_part( 'nav' );           // Navigation bar (nav.php) ?>
	<?php get_template_part( 'nav', '2' );      // Navigation bar #2 (nav-2.php) ?>
	<?php get_template_part( 'nav', 'single' ); // Navigation bar to use in single pages (nav-single.php) ?>
	
	<?php get_template_part('template-parts/layout'); 
		//will include layout.php from template-parts subdirectory placed in the root of your theme folder.
	?>
	
	
	<?php
	/*  use get_template_directory() to get templte directory path 
		output is /home/a572016d/public_html/raqam-investment/wp-content/themes/twentynineteen
		use get_template_directory_uri to get template url path
		output is http://bytecodetechnologies.co.in/raqam-investment/wp-content/themes/twentynineteen
	*/
	include(get_template_directory() . '/constants.php');
	include(get_template_directory() . '/classes.php');
	include(get_template_directory() . '/media-importer.php');
	include(get_template_directory() . '/functions-woo.php');
	
		
	echo get_template_directory();
	
	//Returns an absolute server path (eg: /home/user/public_html/wp-content/themes/my_theme), not a URI.

	//In the case a child theme is being used, the absolute path to the parent theme directory will be returned. Use get_stylesheet_directory() to get the absolute path to the child theme directory.
	
	?>
	<?php 
	/* Using loop.php in child themes
	Assuming the theme folder is wp-content/themes, that the parent theme is twentyten, and the child theme is twentytenchild, then the following code —
	*/ 
		get_template_part( 'loop', 'index' ); 
		
	/*
	will do a PHP require() for the first file that exists among these, in this priority:
	wp-content/themes/twentytenchild/loop-index.php
	wp-content/themes/twentyten/loop-index.php
	wp-content/themes/twentytenchild/loop.php
	wp-content/themes/twentyten/loop.php
	*/
	
	To use this function with subfolders in your theme directory, simply prepend the folder name before the slug. For example, if you have a folder called “partials” in your theme directory and a template part called “content-page.php” in that sub-folder, you would use get_template_part() like this:
	?>

<?php get_template_part( 'partials/content', 'page' ); ?>
	
<?php echo "<script>window.location='".get_option('home')."/home-page/'</script>"; ?>

<?php dynamic_sidebar('bottom-right-foot'); ?>	


<script>
	var uploadField = document.getElementById("f_fund_images");
	uploadField.onchange = function() {
		if(this.files[0].size > 5242880){
			alert("Event image is too Big , please upload image with size upto 5MB");
			this.value = "";
		};
	};
</script>  

<script type="text/javascript">
	$('#create_fundraiser_event_page').submit(function() {
		setTimeout(function() 
		{
			$("#addevent_dvLoading").show();

		}, 3000);
	});
</script>

<script>

	jQuery(document).ready(function(){

		$('#f_event_date_new').datepicker({
			Format: 'mm-dd-yyyy',
			autoclose:true,
			orientation: 'auto',
			startDate: new Date(),
		}).on('changeDate',function(e){
			$('#f_event_e__date_new').datepicker('setStartDate',e.date)
		});

		$('#f_event_e__date_new').datepicker({
			Format: 'mm-dd-yyyy',
			autoclose:true,
			orientation: 'auto',
		}).on('changeDate',function(e){
			$('#f_event_date_new').datepicker('setEndDate',e.date)
		});



		$(document).on('keyup', '#f_fund_amte_new', function() {
			var x = $(this).val();
			$(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
		});


		var minlength = 5;  

	//$('#searchsubmit').click(function(e){

	$('#search_inputs_new').keyup(function () 
	{  

		var zip_code = $('#search_inputs_new').val();

		if (zip_code.length >= minlength ) 
		{

			var ajaxUrl="<?php echo admin_url('admin-ajax.php')?>";

			jQuery.ajax({
				url :ajaxUrl ,
				type : 'post',
				data : {
					action : 'zip_serach',
					zip_codes : zip_code	
				},

				beforeSend: function() 
				{
					jQuery('#dvLoading_new').show();    
				},

				success : function(posts) 
				{
					$("#show_result_new").html(posts);
					$(".fieldset_4").addClass("fieldset_44");
					jQuery('#dvLoading_new').hide();

					$(".chk_radio").click(function(){          
						if($(this).is(':checked') && $(this).val() !== '') 
						{

							var ret_e_id           = $(this).val();
							var ret_e_title        = $(this).attr("data-title");
							var ret_e_auther_id    = $(this).attr("data-ret-auth-id");
							var ret_e_authe_name   = $(this).attr("data-ret-name");

							$('#ret_e_id_news').val(ret_e_id);
							$('#ret_e_title_news').val(ret_e_title);
							$('#ret_e_authe_name_news').val(ret_e_authe_name);
							$('#ret_e_auther_id_news').val(ret_e_auther_id);

						}
					});
				}
			});
		}
	});
	});
</script>	

<script>
$(document).ready(function() 
{

  $('.nav > li > ul').hide();  

  $('.nav > li:has(ul)').addClass('accordion');  
  $('.nav > li:has(ul) > a').click(function() {

    $(this).toggleClass('accordionExpanded'); 

    $(this).next('ul').slideToggle('slow');

    $(this).parent().siblings('li').children('ul:visible').slideUp('slow')
    .parent('li').find('a').removeClass('accordionExpanded');

    $(".nav > li.active").removeClass("active");

    return false;
  });
  
}

			if(isNaN(product_price)){
				//alert(product_price);
				alert('price is not a number');
				event.preventDefault(false);	
			}
			
			$("#product_title").prop('disabled', true);
			$("#product_cat").prop('disabled', true);
			$("#product_price").prop('disabled', true);
			
			website_fee = product_price*30/100 ;								
			if(category_value=="345"){
				
				custome_fee = 0 ;
				clearance_fee = 10;
				vat_customes = product_price*14/100 ;
				total_fee = parseInt(product_price) + parseInt(website_fee) + parseInt(custome_fee) + parseInt(vat_customes) + parseInt(clearance_fee) ;
				
				$(".custome_fee").hide(); 
				$(".vat_customs").show();  
				$(".clearance").show(); 
				
				website_fee = product_price*30/100 ;								
				if(category_value=="345"){
					
					custome_fee = 0 ;
					clearance_fee = 10;
					vat_customes = product_price*14/100 ;
					total_fee = parseInt(product_price) + parseInt(website_fee) + parseInt(custome_fee) + parseInt(vat_customes) + parseInt(clearance_fee) ;
					
					$(".custome_fee").hide(); 
					$(".vat_customs").show();  
					$(".clearance").show(); 
 
				}

			}
			
		var url = window.location.origin;
		var admin_url ="/wp-admin/admin-ajax.php";
		var ajaxUrl = url+admin_url;
		
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
					var obj = jQuery.parseJSON(responseq);
					title = obj.title ;
					price = obj.price ;
					
					if(title =="Access Denied" || title ==null){
						$("#product_title").val('');
						$("#product_title").prop('disabled', false);  //Enable input 
					}
				}
			$('#table_1').on('click', 'tbody tr', function(event) {
				
		var table;
		table  = $('#table_1').DataTable();
		row  = $(this).closest('tr');
		row_id = table.row( row ).data() ;
		
		$("#myBtn").val(row_id[0]);
		console.log(row_id[0]);


 var v = jQuery("#job_posting").validate({
      errorElement: "span",
      errorClass: "help-inline-error",
        rules: {
    cc_number: {
      required: true,
      creditcard: true
    },
  budget : {
    number: true,
    min: 1
  },
  
  
    }
    });

  jQuery('#cc_cvv').keyup(function () {
         var myRe = /^[0-9]{3,4}$/;
         var cvv= jQuery("#cc_cvv").val();
         var myArray = myRe.exec(cvv);	
</script>  