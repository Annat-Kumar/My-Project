<?php
?>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.main.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider.js"></script>
	
	<script src="<?php bloginfo('template_directory');?>/js/bootstrap.min.js"></script>
	<script src="<?php bloginfo('template_directory');?>/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?php bloginfo('template_directory');?>/js/jquery.bxslider.js"></script> 
	<script src="<?php bloginfo('template_directory');?>/js/wow.min.js"></script>


			<?php get_template_part('header', 'desktop'); ?>
            <?php get_template_part('header', 'mobile'); ?>
            <?php get_template_part('template', 'banner'); ?>
<?php
			include(get_template_directory() . '/constants.php');
			include(get_template_directory() . '/classes.php');
			include(get_template_directory() . '/media-importer.php');
			include(get_template_directory() . '/functions-woo.php');
?>
<img class="img-loader" src="<?php bloginfo('template_directory');?>/images/ajax-loader.gif">	

<link href="<?php echo bloginfo("stylesheet_directory"); ?>/admin/css/style.css" rel="stylesheet">
<link href="<?php echo bloginfo("stylesheet_directory"); ?>/admin/css/responsive.css" rel="stylesheet"> 

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
</script>  