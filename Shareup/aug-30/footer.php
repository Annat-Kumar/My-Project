<!-- enigma Callout Section -->
<?php $wl_theme_options = weblizar_get_options(); ?>
</div>

<footer>
<div class="container-fluid footer_fllow_us">

	<div class="top-footer">
		<div class="top-footer-container container">
			<div class="row">
				<div class="top-footer-content">
					

								<?php dynamic_sidebar('top-foot'); ?>
				</div>
			</div>
		</div>
	
	</div>
	
	<div class="container">
		<div class="row">
			<div class="center-footer-content">
	
								<?php dynamic_sidebar('center-foot'); ?>		
			</div>
			<div class="clear"></div>
			<div class="bottom-footer-content">
				<div class="col-md-4">
					<?php dynamic_sidebar('bottom-left-foot'); ?>	
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar('bottom-center-foot'); ?>	
				</div>
				<div class="col-md-3">
					<?php dynamic_sidebar('bottom-right-foot'); ?>	
				</div>
			</div>
		</div>
	</div>
</div>
</footer>
<!-- Footer Widget Secton -->
<!--<div class="enigma_footer_widget_area">	
	<div class="container">
		<div class="row">
			<?php 
			/* if ( is_active_sidebar( 'footer-widget-area' ) ){ 
				dynamic_sidebar( 'footer-widget-area' );
			} else 
			{ 
			$args = array(
			'before_widget' => '<div class="col-md-3 col-sm-6 enigma_footer_widget_column">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="enigma_footer_widget_title">',
			'after_title'   => '<div class="enigma-footer-separator"></div></div>' );
			the_widget('WP_Widget_Pages', null, $args);			
			} */?>
		</div>		
	</div>	
</div>-->
	
<!-- /Footer Widget Secton -->

<?php if($wl_theme_options['custom_css']) ?>
<style type="text/css">
<?php { echo esc_attr($wl_theme_options['custom_css']); } ?>
</style>

<?php get_template_part('google', 'font'); ?>
<?php wp_footer(); ?>

</body>
</html>