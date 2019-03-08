<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif;

				get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->

<script type="text/javascript">
jQuery(document).ready(function($)
{
		
	 $('tbody').on('click', 'tr', function(event) {
				
		var table_id = $(this).parent().parent().attr('id');
		var table_t = "#"+table_id ;
		
		table  = $(table_t).DataTable();
		row  = $(this).closest('tr');
		row_id = table.row( row ).data() ;
		
		$("#myBtn").val(row_id[0]);
		console.log(row_id[0]);			
				
				
		});
	
});

</script>
<style>
tbody tr::after {
    content: "\f0a4";  
    position: absolute;
    left: -34px;
    display: inline-block;
    object-fit: cover;
    font-family: 'Font Awesome 5 Free';
    font-size: 22px;
}
</style>




<?php wp_footer(); ?>

</body>
</html>
