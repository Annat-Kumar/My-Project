<?php
/** Theme Name	: Enigma
* Theme Core Functions and Codes
*/
	/**Includes required resources here**/
	define('WL_TEMPLATE_DIR_URI', get_template_directory_uri());
	define('WL_TEMPLATE_DIR', get_template_directory());
	define('WL_TEMPLATE_DIR_CORE' , WL_TEMPLATE_DIR . '/core');
	require( WL_TEMPLATE_DIR_CORE . '/menu/default_menu_walker.php' );
	require( WL_TEMPLATE_DIR_CORE . '/menu/weblizar_nav_walker.php' );
	require( WL_TEMPLATE_DIR_CORE . '/scripts/css_js.php' ); //Enquiring Resources here	
	require( WL_TEMPLATE_DIR_CORE . '/comment-function.php' );	
	require(dirname(__FILE__).'/customizer.php');
		require( get_template_directory() . '/class-tgm-plugin-activation.php' );
	//Sane Defaults
	function weblizar_default_settings()
{
	$ImageUrl =  esc_url(get_template_directory_uri() ."/images/1.png");
	$ImageUrl2 = esc_url(get_template_directory_uri() ."/images/2.png");
	$ImageUrl3 = esc_url(get_template_directory_uri() ."/images/3.png");
	$ImageUrl4 = esc_url(get_template_directory_uri() ."/images/portfolio1.png");
	$ImageUrl5 = esc_url(get_template_directory_uri() ."/images/portfolio2.png");
	$ImageUrl6 = esc_url(get_template_directory_uri() ."/images/portfolio3.png");
	$ImageUrl7 = esc_url(get_template_directory_uri() ."/images/portfolio4.png");
	$wl_theme_options=array(
			//Logo and Fevicon header	
			'upload__header_image'=>'',
			'upload_image_logo'=>'',
			'height'=>'55',
			'width'=>'150',
			'_frontpage' => '1',
			'blog_count'=>'3',
			'upload_image_favicon'=>'',			
			'custom_css'=>'',

			'slider_image_speed' => '',
			'slide_image_1' => $ImageUrl,
			'slide_title_1' => __('Slide Title', 'enigma' ),
			'slide_desc_1' => __('Lorem Ipsum is simply dummy text of the printing', 'enigma' ),
			'slide_btn_text_1' => __('Read More', 'enigma' ),
			'slide_btn_link_1' => '#',
			'slide_image_2' => $ImageUrl2,
			'slide_title_2' => __('variations of passages', 'enigma' ),
			'slide_desc_2' => __('Contrary to popular belief, Lorem Ipsum is not simply random text', 'enigma' ),
			'slide_btn_text_2' => __('Read More', 'enigma' ),
			'slide_btn_link_2' => '#',
			'slide_image_3' => $ImageUrl3,
			'slide_title_3' => __('Contrary to popular ', 'enigma' ),
			'slide_desc_3' => __('Aldus PageMaker including versions of Lorem Ipsum, rutrum turpi', 'enigma' ),
			'slide_btn_text_3' => __('Read More', 'enigma' ),
			'slide_btn_link_3' => '#',			
			// Footer Call-Out
			'fc_home'=>'1',			
			'fc_title' => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'enigma' ),
			'fc_btn_txt' => __('More Features', 'enigma' ),
			'fc_btn_link' =>"#",
			'fc_icon' => 'fa fa-thumbs-up', 
			//Social media links
			'header_social_media_in_enabled'=>'1',
			'footer_section_social_media_enbled'=>'1',
			'twitter_link' =>"#",
			'fb_link' =>"#",
			'linkedin_link' =>"#",
			'youtube_link' =>"#",
			'instagram' =>"#",
			'gplus' =>"#",
			'vk_link' =>"#",
			'qq_link' => "#",
			'whatsapp_link' => "#",
			
			'email_id' => 'example@mymail.com',
			'phone_no' => '0159753586',
			'footer_customizations' => __(' &#169; 2016 Enigma Theme', 'enigma' ),
			'developed_by_text' => __('Theme Developed By', 'enigma' ),
			'developed_by_weblizar_text' => __('Weblizar Themes', 'enigma' ),
			'developed_by_link' => 'http://weblizar.com/',
			'service_home'=>'1',
			'home_service_heading' => __('Our Services', 'enigma' ),
			'service_1_title'=>__("Idea",'enigma' ),
			'service_1_icons'=>"fa fa-google",
			'service_1_text'=>__("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.", 'enigma' ),
			'service_1_link'=>"#",
			
			'service_2_title'=>__('Records', 'enigma' ),
			'service_2_icons'=>"fa fa-database",
			'service_2_text'=>__("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.", 'enigma' ),
			'service_2_link'=>"#",
			
			'service_3_title'=>__("WordPress", 'enigma' ),
			'service_3_icons'=>"fa fa-wordpress",
			'service_3_text'=>__("There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in.", 'enigma' ),
			'service_3_link'=>"#",			

			//Portfolio Settings:
			'portfolio_home'=>'1',
			'port_heading' => __('Recent Works', 'enigma' ),
			'port_1_img'=> $ImageUrl4,
			'port_1_title'=>__('Bonorum', 'enigma' ),
			'port_1_link'=>'#',
			'port_2_img'=> $ImageUrl5,			
			'port_2_title'=>__('Content', 'enigma' ),
			'port_2_link'=>'#',
			'port_3_img'=> $ImageUrl6,
			'port_3_title'=>__('dictionary', 'enigma' ),
			'port_3_link'=>'#',
			'port_4_img'=> $ImageUrl7,
			'port_4_title'=>__('randomised', 'enigma' ),
			'port_4_link'=>'#',
			//BLOG Settings
			'show_blog' => '1',
			'blog_title'=>__('Latest Blog', 'enigma' ),
			
			//Google font style
			'main_heading_font' => 'Open Sans',
			'menu_font' => 'Open Sans',
			'theme_title' => 'Open Sans',
			'desc_font_all' => 'Open Sans'
			
			
		);
		return apply_filters( 'enigma_options', $wl_theme_options );
}
	function weblizar_get_options() {
    // Options API
    return wp_parse_args( 
        get_option( 'enigma_options', array() ), 
        weblizar_default_settings() 
    );    
	}
	
	$args = array(
	'flex-width'    => true,
	'width'         => 2000,
	'flex-height'    => true,
	'height'        => 100,
	'default-image' => get_template_directory_uri() . '/images/header-bg.jpg',
	'wp-head-callback'   => 'enigma_header_style',
);
add_theme_support( 'custom-header', $args );

	
	/*After Theme Setup*/
	add_action( 'after_setup_theme', 'weblizar_head_setup' ); 	
	function weblizar_head_setup()
	{	
		global $content_width;
		//content width
		if ( ! isset( $content_width ) ) $content_width = 550; //px
	
	    //Blog Thumb Image Sizes
		add_image_size('home_post_thumb',340,210,true);
		//Blogs thumbs
		add_image_size('wl_page_thumb',730,350,true);	
		add_image_size('blog_2c_thumb',570,350,true);
		add_theme_support( 'title-tag' );
		
		// Load text domain for translation-ready
		load_theme_textdomain( 'enigma', WL_TEMPLATE_DIR_CORE . '/lang' );	
		
		add_theme_support( 'post-thumbnails' ); //supports featured image
		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'enigma' ) );
		// theme support 	
		$args = array('default-color' => '000000',);
		add_theme_support( 'custom-background', $args); 
		add_theme_support( 'automatic-feed-links');
		$defaults = array(
	'default-image'          => '',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
		
		
		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style('css/editor-style.css');
		require( WL_TEMPLATE_DIR . '/options-reset.php'); //Reset Theme Options Here				
	}
	

	// Read more tag to formatting in blog page 
	function weblizar_content_more($more)
	{  							
	   return '<div class="blog-post-details-item"><a class="enigma_blog_read_btn" href="'.get_permalink().'"><i class="fa fa-plus-circle"></i>"'.__('Read More', 'enigma' ).'"</a></div>';
	}   
	add_filter( 'the_content_more_link', 'weblizar_content_more' );
	
	
	// Replaces the excerpt "more" text by a link
	function weblizar_excerpt_more($more) {      
	return '';
	}
	add_filter('excerpt_more', 'weblizar_excerpt_more');
	
	
	if ( ! function_exists( 'enigma_header_style' ) ) :
	function enigma_header_style() {
		$header_text_color = get_header_textcolor();
	// If no custom options for text are set, let's bail.
	// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
	if ( get_theme_support( 'custom-header', 'default-text-color' ) == $header_text_color ) {
		return;
	}
	// If we get this far, we have custom styles. Let's do this.
	?>

	<style id="fashionair-custom-header-styles" type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.head-contact-info li a{
		color:#fff;
		}
		.hd_cover {
		color: #fff;
		}
		.logo p {
		color: #fff;
		}
		.social i {
		color: #fff;
		}
		.social li {
		border: 2px solid #ffffff;
		}
		.logo a {
			color: #fff;
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.head-contact-info li a, .hd_cover, .logo p, .social i, .logo a{
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
		.social li {
			border:2px solid #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; 
	
	
	/*
	* Weblizar widget area
	*/
	add_action( 'widgets_init', 'weblizar_widgets_init');
	function weblizar_widgets_init() {
	/*sidebar*/
	register_sidebar( array(
			'name' => __( 'Sidebar', 'enigma' ),
			'id' => 'sidebar-primary',
			'description' => __( 'The primary widget area', 'enigma' ),
			'before_widget' => '<div class="enigma_sidebar_widget">',
			'after_widget' => '</div>',
			'before_title' => '<div class="enigma_sidebar_widget_title"><h2>',
			'after_title' => '</h2></div>'
		) );

	register_sidebar( array(
			'name' => __( 'Footer Widget Area', 'enigma' ),
			'id' => 'footer-widget-area',
			'description' => __( 'footer widget area', 'enigma' ),
			'before_widget' => '<div class="col-md-3 col-sm-6 enigma_footer_widget_column">',
			'after_widget' => '</div>',
			'before_title' => '<div class="enigma_footer_widget_title">',
			'after_title' => '<div class="enigma-footer-separator"></div></div>',
		) );        

		register_sidebar( array(
			'name' => __( 'Login', 'enigma' ),
			'id' => 'login',
			'description' => __( 'Login widget area', 'enigma' ),
			'before_widget' => '<div class="col-md-3 col-sm-6 enigma_footer_widget_column">',
			'after_widget' => '</div>',
			'before_title' => '<div class="enigma_footer_widget_title">',
			'after_title' => '<div class="enigma-footer-separator"></div></div>',
		) );       
		
		register_sidebar( array(
			'name' => __( 'Top Footer', 'enigma' ),
			'id' => 'top-foot',
			'description' => __( 'Text Area top foot', 'enigma' ),
			'before_widget' => '<div class="col-md-12 top-foot-copy">',
			'after_widget' => '</div>',
			'before_title' => '<div class="enigma_footer_widget_title">',
			'after_title' => '<div class="enigma-footer-separator"></div></div>',
		) );    
		
		register_sidebar( array(
			'name' => __( 'Center Footer', 'enigma' ),
			'id' => 'center-foot',
			'description' => __( 'Text Area top foot', 'enigma' ),
			'before_widget' => '<div class="col-md-12 center-foot-copy">',
			'after_widget' => '</div>',
			'before_title' => '<div class="enigma_footer_widget_title">',
			'after_title' => '<div class="enigma-footer-separator"></div></div>',
		) );   
		
		register_sidebar( array(
			'name' => __( 'Bottom Left Foot', 'enigma' ),
			'id' => 'bottom-left-foot',
			'description' => __( 'Bottom left widget area', 'enigma' ),
			'before_widget' => '<div class=" bottom-left">',
			'after_widget' => '</div>',
			'before_title' => '<div class="enigma_footer_widget_title">',
			'after_title' => '<div class="enigma-footer-separator"></div></div>',
		) );   
		
		register_sidebar( array(
			'name' => __( 'Bottom Center Foot', 'enigma' ),
			'id' => 'bootom-center-foot',
			'description' => __( 'Bottom center footer widget area', 'enigma' ),
			'before_widget' => '<div class="bottom-center-foot">',
			'after_widget' => '</div>',
			'before_title' => '<div class="enigma_footer_widget_title">',
			'after_title' => '<div class="enigma-footer-separator"></div></div>',
		) );   
		
		register_sidebar( array(
			'name' => __( 'Bottom Right Foot', 'enigma' ),
			'id' => 'bottom-right-foot',
			'description' => __( 'Bottom right footer widget area', 'enigma' ),
			'before_widget' => '<div class=" bottom-right">',
			'after_widget' => '</div>',
			'before_title' => '<div class="enigma_footer_widget_title">',
			'after_title' => '<div class="enigma-footer-separator"></div></div>',
		) );   
		
	}
	
	
	/* Breadcrumbs  */
	function weblizar_breadcrumbs() {
    $delimiter = '';
    $home = __('Home', 'enigma' ); // text for the 'Home' link
    $before = '<li>'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb
    echo '<ul class="breadcrumb">';
    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>' . $delimiter . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . ' _e("Archive by category","enigma") "' . single_cat_title('', false) . '"' . $after;
    } elseif (is_day()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
        echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . get_the_title() . $after;
        }
		
    } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . _e("Search results for","enigma")  . get_search_query() . '"' . $after;

    } elseif (is_tag()) {        
		echo $before . _e('Tag','enigma') . single_tag_title('', false) . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . _e("Articles posted by","enigma") . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . _e("Error 404","enigma") . $after;
    }
    
    echo '</ul>';
	}
	
	
	//PAGINATION
		function weblizar_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='enigma_blog_pagination'><div class='enigma_blog_pagi'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                echo ($paged == $i)? "<a class='active'>".$i."</a>":"<a href='".get_pagenum_link($i)."'>".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div></div>";
     }
}
	/*===================================================================================
	* Add Author Links
	* =================================================================================*/
	function weblizar_author_profile( $contactmethods ) {	
	
	$contactmethods['youtube_profile'] = __('Youtube Profile URL','enigma');	
	$contactmethods['twitter_profile'] = __('Twitter Profile URL','enigma');
	$contactmethods['facebook_profile'] = __('Facebook Profile URL','enigma');
	$contactmethods['linkedin_profile'] = __('Linkedin Profile URL','enigma');
	
	return $contactmethods;
	}
	add_filter( 'user_contactmethods', 'weblizar_author_profile', 10, 1);
	/*===================================================================================
	* Add Class Gravtar
	* =================================================================================*/
	add_filter('get_avatar','weblizar_gravatar_class');

	function weblizar_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='author_detail_img", $class);
    return $class;
	}	
	/****--- Navigation for Author, Category , Tag , Archive ---***/
	function weblizar_navigation() { ?>
	<div class="enigma_blog_pagination">
	<div class="enigma_blog_pagi">
	<?php posts_nav_link(); ?>
	</div>
	</div>
	<?php }

	/****--- Navigation for Single ---***/
	function weblizar_navigation_posts() { ?>
	<div class="navigation_en">
	<nav id="wblizar_nav"> 
	<span class="nav-previous">
	<?php previous_post_link('&laquo; %link'); ?>
	</span>
	<span class="nav-next">
	<?php next_post_link('%link &raquo;'); ?>
	</span> 
	</nav>
	</div>	
<?php 
	}
if (is_admin()) {
	require_once('core/admin/admin-themes.php');
	
}
/*
global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) ) :
		add_theme_support( 'custom-header' );
	else :
		add_custom_image_header( $wp_head_callback, $admin_head_callback );
	endif;
	*/

//Plugin Recommend
add_action('tgmpa_register','enigma_plugin_recommend');
function enigma_plugin_recommend(){
	$plugins = array(
	/*array(
            'name'      => 'Responsive Coming Soon',
            'slug'      => 'responsive-coming-soon-page',
            'required'  => false,
        ),
	array(
            'name'      => 'Photo Video Link Gallery',
            'slug'      => 'photo-video-link-gallery',
            'required'  => false,
        ),
	array(
            'name'      => 'Lightbox Gallery',
            'slug'      => 'simple-lightbox-gallery',
            'required'  => false,
        ),
	array(
            'name'      => 'Instagram Gallery',
            'slug'      => 'gallery-for-instagram',
            'required'  => false,
        ),
	array(
            'name'      => 'Ultimate Responsive Image Slider',
            'slug'      => 'ultimate-responsive-image-slider',
            'required'  => false,
        ),
	array(
            'name'      => 'Flickr Album Gallery',
            'slug'      => 'flickr-album-gallery',
            'required'  => false,
        ),
	array(
            'name'      => 'Gallery Pro',
            'slug'      => 'gallery-pro',
            'required'  => false,
        ), 
	array(
            'name'      => 'Admin Custom Login',
            'slug'      => 'admin-custom-login',
            'required'  => false,
        )
		*/
	);
    tgmpa( $plugins );
}

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Type', 'text_domain' ),
		'all_items'                  => __( 'All Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Type', 'text_domain' ),
		'add_new_item'               => __( 'Add New Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Type', 'text_domain' ),
		'update_item'                => __( 'Update Type', 'text_domain' ),
		'view_item'                  => __( 'View Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Type with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Type', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Types', 'text_domain' ),
		'search_items'               => __( 'Search Types', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Types list', 'text_domain' ),
		'items_list_navigation'      => __( 'Types list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'types', array( 'task' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );

/*
* Creating a function to create our CPT
*/


function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Tasks', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Task', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Tasks', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Tasks', 'twentythirteen' ),
		'all_items'           => __( 'All Tasks', 'twentythirteen' ),
		'view_item'           => __( 'View Task', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Task', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Task', 'twentythirteen' ),
		'update_item'         => __( 'Update Task', 'twentythirteen' ),
		'search_items'        => __( 'Search Task', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'tasks', 'twentythirteen' ),
		'description'         => __( 'Tasks news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		//'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => true,
		'taxonomies'  => array( 'type' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'task', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type', 0 );


/* infinite scroll pagination all category*/
function more_post_ajax(){		
require 'wepay.php';
// application settings
$user = wp_get_current_user();
get_current_user_id();
if ( in_array( 'administrator', (array) $user->roles ) )
{
$account_id = get_option('account_id');
$access_token = get_option('access_token');
}
else
{
$account_id = get_user_meta(get_current_user_id(),'wepay_account_id',true);
$access_token = get_user_meta(get_current_user_id(),'wepay_access_token',true);
}
$client_id = get_option('client_id');
$client_secret = get_option('client_secret');
if($account_id !="" AND $access_token!="")
{  
// change to useProduction for live environments
Wepay::useProduction($client_id, $client_secret);
$wepay = new WePay($access_token);
//check the state of account
$response = $wepay->request('account', array(
'account_id'    => $account_id
));
$state= $response->state;
}
if(isset($_POST['submit_situation'])){
	$date = date('F d, Y', time());
    $us_id=get_current_user_id();
	$old_app=get_post_meta($_POST['request_for_post'],'applicants',true);
	$des=$_POST['request_desc'];
	$media=$_FILES['request_media']['name'];
	$upload_overrides = array( 'test_form' => false );
	$uploadedfile = array(
            'name'     => $_FILES['request_media']['name'],
            'type'     => $_FILES['request_media']['type'],
            'tmp_name' => $_FILES['request_media']['tmp_name'],
            'error'    => $_FILES['request_media']['error'],
            'size'     => $_FILES['request_media']['size']
        );
    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    if($old_app!="")
     {
      $old_app_array=$old_app.','.$us_id;
      update_post_meta($_POST['request_for_post'],'applicants',$old_app_array);
      update_post_meta($_POST['request_for_post'],'applicants_request_date_'.$us_id,$date);
      update_post_meta($_POST['request_for_post'],'applicants_message_'.$us_id,$des);
      update_post_meta($_POST['request_for_post'],'applicants_media_'.$us_id,$movefile['url']);
      }
      else
      {
      update_post_meta($_POST['request_for_post'],'applicants',$us_id);
      update_post_meta($_POST['request_for_post'],'applicants_message_'.$us_id,$des);
      update_post_meta($_POST['request_for_post'],'applicants_media_'.$us_id,$movefile['url']);
      update_post_meta($_POST['request_for_post'],'applicants_request_date_'.$us_id,$date);
      }
	$user = get_user_by( 'id',$_POST['author_of_post'] );
	$name= $user->first_name . ' ' . $user->last_name;
	$email= $user->user_email;
	$headers  = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
	$headers .= "From: Kevin Bendict <".get_option('admin_email').">" . "\r\n";
	$message="Hello ".$name.",<br> <br>A new applicant has request you for your task description<br> <br>Please check it in your profile page.<br><br> Thanks";
     wp_mail($email, 'New Request On your Job', $message, $headers); 
    }
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $offset = $_POST["offset"];
    $ppp = $_POST["ppp"];
    header("Content-Type: text/html");
    $args11 = array('post_type'=>'task','posts_per_page'=>$ppp,'offset' => $offset,'paged' => $paged,'post_status'=>'publish');
	$args1 = array('post_type'=>'task','posts_per_page'=>$ppp,'offset' => $offset,'paged' => $paged,'post_status'=>'publish', 'meta_query'=>
	array(array(
        'key'       =>'approved_applicants',
        'value'     => false,
        'compare'   => 'LIKE'
    ))); 
    $loop = new WP_Query($args1);
	if($loop->have_posts()){
    while ($loop->have_posts()) : $loop->the_post(); 
$id1=get_the_ID();
$approved_applicants1 =get_post_meta($id1,'approved_applicants',true);
$applicants1=get_post_meta($id1,'applicants',true);
$app_arr1= explode(',', $applicants1);
       //the_content();?>
<div class="col-md-4 col-sm-4 text-center list_all">
<div class="jobimage">
<div class="col-md-12 author_image">
<?php 
$author1=get_the_author_meta('ID'); 
echo get_avatar( $author1, 120);
?>
</div>
<div class="col-md-12 budget_task">
$<?php echo get_post_meta(get_the_ID(),'budget',true); ?>
<input type="hidden" name="req_amount" id="" value="$<?php echo get_post_meta(get_the_ID(),'budget',true); ?>">
</div>
<div class="col-md-12 author_name">
<?php echo get_the_author();?>
<input type="hidden" name="req_author" value="<?php echo get_the_author(); ?>">
</div>
<div class="col-md-12 location_task">
<?php echo get_post_meta(get_the_ID(),'job_city',true); ?>
</div>
<div class="col-md-12 desc_task">
<?php echo get_the_content(); ?>
</div>
<div class="col-md-12 request_task">
<?php 
if(is_user_logged_in())
{
if($author1!=get_current_user_id()) 
{
if(!in_array(get_current_user_id(), $app_arr1)) 
{
if($state=="active")
{
$count=count($app_arr1);
echo '<a class="request_click model" data-authid="'.get_the_author_meta('ID').'" data-jobid="'.get_the_ID().'" data-amt="'.get_post_meta(get_the_ID(),'budget',true).'" data-authname="'.get_the_author().'">Request</a>';
     echo "<br>";
  echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
else
{
  $count=count($app_arr1);
  echo '<a class="request_click1">Request</a>';
  echo "<br>";
  echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
} 
else 
{
echo '<div class="req-colors">Requested </div>' ;
 }
 } 
if($author1==get_current_user_id())
{
if($app_arr1[0]=="")
{
$count=0;
}
else
{
$count=count($app_arr1);
}
 //echo '<a href="'.get_bloginfo('url').'/log-in">Requests('.$count.')</a>';
echo '<a href="'.get_bloginfo('url').'/log-in">Requests</a>';
echo "<br>";
echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
}
else
{
  $count=count($app_arr1);
  echo '<a class="aa1" href="'.get_bloginfo('url').'/log-in">Login for Request</a>';
  echo "<br>";
  echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
?>
</div>

<div class="col-md-6 time_task">
<?php echo $date= human_time_diff( get_the_time('U'), current_time( 'timestamp' ) ) . ' ago'; ?>
</div>
<div class="col-md-6 cat_task">
<?php 
$terms=get_the_terms( $id,'types' );
if(!empty($terms))
{
foreach($terms as  $v)
{
echo str_replace('and','&',$v->name);
}
}
else
{
echo 'All';
}
?>
</div>
</div>
<script>
jQuery(document).ready(function()
{
jQuery(".request_click").click(function() {
var h = jQuery("body").height() + '<span id="IL_AD12" class="IL_AD">px</span>';
jQuery("#black_overlay").css({"height":h,"visibility":"visible"});
jQuery(".added").css('display','block');
jQuery('.request_amount').text('$'+jQuery(this).attr('data-amt'));
jQuery('.request_author').text(jQuery(this).attr('data-authname'));
jQuery('.author_of_post').val(jQuery(this).attr('data-authid'));
jQuery('.request_for_post').val(jQuery(this).attr('data-jobid'));
  });
jQuery(".close").click(function() {
jQuery(".added").css('display','none');
jQuery("#black_overlay").css("visibility","hidden");
  });	
});
</script>
</div>
<?php 
endwhile;  
wp_reset_postdata();
} 
else
{
 echo '<div class="col-md-12 no-more-posts"> No More Posts Available. </div>';
}
}
add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax'); 
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
/* load more pagination sub category*/
function load_more_post(){
$data = $_POST['data'];
$data_id = $data['data-id'];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = $_POST["offset"];
$ppp = $_POST["ppp"];
header("Content-Type: text/html");
$args = array('post_type'=>'task','posts_per_page'=>$ppp,'offset' => $offset,'post_status'=>'publish','tax_query' => array( array(
            'taxonomy' => 'types',
            'field' => 'slug',
            'terms' => $data_id
      )
    ));
$query = new WP_Query( $args ); 
if($query->have_posts()){
while ($query->have_posts()) : $query->the_post(); 
$id=get_the_ID();
$approved_applicants =get_post_meta($id,'approved_applicants',true);
$applicants=get_post_meta($id,'applicants',true);
$app_arr= explode(',', $applicants);
//if($approved_applicants=='')
//{
?>
<div class="col-md-4 col-sm-4 text-center list_all">
<div class="jobimage">
<div class="col-md-12 author_image">
<?php 
$author=get_the_author_meta('ID'); 
echo get_avatar( $author, 120);
?>
</div>
<div class="col-md-12 budget_task">
$<?php echo get_post_meta(get_the_ID(),'budget',true); ?>
<input type="hidden" id="amount" value="<?php echo get_post_meta(get_the_ID(),
'budget',true); ?>" >
</div>
<div class="col-md-12 author_name">
<?php echo get_the_author();?>
</div>
<div class="col-md-12 location_task">
<?php echo get_post_meta(get_the_ID(),'job_city',true); ?>
</div>
<div class="col-md-12 desc_task">
<?php echo get_the_content(); ?>
</div>
<div class="col-md-12 request_task">
<?php 
if(is_user_logged_in())
{
if($author!=get_current_user_id()) 
{
if(!in_array(get_current_user_id(), $app_arr)) 
{
if($state=="active")
{
$count=count($app_arr1);
echo '<a class="request_click model" data-authid="'.get_the_author_meta('ID').'" data-jobid="'.get_the_ID().'" data-amt="'.get_post_meta(get_the_ID(),'budget',true).'" data-authname="'.get_the_author().'">Request</a>';
echo "<br>";
echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
else
{
 $count=count($app_arr1);
 echo '<a class="request_click1">Request</a>';
 echo "<br>";
 echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
} 
else 
{
echo '<div class="req-colors">Requested </div>' ;
 }
 } 
if($author==get_current_user_id())
{
if($app_arr[0]=="")
{
$count=0;
}
else
{
$count=count($app_arr);
}
//echo '<a href="'.get_bloginfo('url').'/log-in">Requests('.$count.')</a>';
echo '<a href="'.get_bloginfo('url').'/log-in">Requests</a>';
echo "<br>";
echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
}
else
{
$count=count($app_arr1);
echo '<a class="aa1" href="'.get_bloginfo('url').'/log-in">Login for Request</a>';
echo "<br>";
echo '<div class="req-color">Requests : '.$count .'</div>' ;
}
?>
</div>
<div class="col-md-6 time_task">
<?php echo $date= human_time_diff( get_the_time('U'), current_time( 'timestamp' ) ) . ' ago';?>
</div>
<div class="col-md-6 cat_task">
<?php 
$terms=get_the_terms( $id,'types' );
foreach($terms as  $v)
{
echo str_replace('and','&',$v->name);
}
?>
</div>
</div>
</div>
<?php //}
endwhile;  
wp_reset_postdata();
}
else
{
echo '<div class="col-md-12 no-more-posts"> No More Posts Available. </div>';
}
}
add_action('wp_ajax_nopriv_load_more_post', 'load_more_post'); 
add_action('wp_ajax_load_more_post', 'load_more_post');

/* END */	


function view_site_description(){
   
     $old_app=get_post_meta($_POST['postid'],'applicants',true);
     if($old_app!="")
     {
     	$old_app_array=$old_app.','.$_POST['authid'];

       update_post_meta($_POST['postid'],'applicants',$old_app_array);
      }
      else
      {
      	update_post_meta($_POST['postid'],'applicants',$_POST['authid']);
      }
   $user = get_user_by( 'id',$_POST['authid'] );
$name= $user->first_name . ' ' . $user->last_name;
$email= $user->email;
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
$headers .= "From: Kevin Bendict <".get_option('admin_email').">" . "\r\n";
$message="Hello ".$name.",<br> <br>A new applicant has request you for your task description<br> <br>Please check it in your profile page.<br><br> Thanks";
      wp_mail($email, 'New Request On your Job', $message, $headers);
  
}
add_action( 'wp_ajax_view_site_description', 'view_site_description' );
add_action( 'wp_ajax_nopriv_view_site_description', 'view_site_description' );

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}
/* infinite scroll pagination */


/* end */
/*add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );

function wti_loginout_menu_link( $items, $args ) {
   if ($args->menu == 'login') {
     // if (is_user_logged_in()) {
  /*$items .= '<li class="right"><a href="'. wp_logout_url(home_url()) .'">'. __("Log Out") .'</a></li><li><a class="wallet">My Wallet</a></li>';*
   $item .= array(
        'title'            => 'Log Out',
        'menu_item_parent' => 204,
        'ID'               => 'log-out',
        //'db_id'            => 300 ,// a unique id #
        'url'              => wp_logout_url(home_url())
       //  'classes'          => array( 'custom-menu-item' )// optional
    );
      //} 
   }
   return $items;
}*/
function isa_dynamic_submenu_logout_link( $items, $args ) {
  
    $theme_location = 'login';// Theme Location slug
    $existing_menu_item_db_id = 204;
    $new_menu_item_db_id = 330; // unique id number
    $label = 'Sign out';
    $url = wp_logout_url(home_url());
     
   /* if ( $theme_location !== $args->theme_location ) {
        return $items;
    }*/
    $new_links = array();
  
    if ( is_user_logged_in() ) {
          
        // only if user is logged-in, do sub-menu link
        $item = array(
            'title'            => $label,
            'menu_item_parent' => $existing_menu_item_db_id,
            'ID'               => 'sign-out',
            'db_id'            => $new_menu_item_db_id,
            'url'              => $url
           // 'classes'          => array( 'custom-menu-item' )// optionally add custom CSS class
        );
      
    $items[] = (object) $item;
     }
  
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'isa_dynamic_submenu_logout_link', 10, 2 );

/*add_action( 'deleted_user', 'delete_postmeta' );
function delete_postmeta($user_id)
{

	global $wpdb;
	$sql="select * from `wp_posts` where `post_type`='task'";
	$qry =$wpdb->get_results($sql);
	foreach ($qry as  $value) {
    
		$applicants= get_post_meta($value->ID,'applicants',true);
		$arr_app=explode(',', $applicants);
		print_r($arr_app);
		if (($key = array_search($user_id, $arr_app)) != false) 
		{
			
               unset($arr_app[$key]);
         }
       //  $arr_app = array_diff($arr_app, array($user_id));
          $new_applicants= implode(',', $arr_app);
         update_post_meta($value->ID,'applicants',$new_applicants);
         

	}
	
}


/*function request_refund(){
   
    
    	update_post_meta($_POST['postid'],'request_for_refund','Yes');
     
   $user = get_user_by( 'id',$_POST['authid'] );
$name= $user->first_name . ' ' . $user->last_name;
$email= get_option('admin_email');
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
$headers .= "From: Kevin Bendict <".get_option('admin_email').">" . "\r\n";
$message="Hello admin ,<br> <br>".$name." has requested for refund his ".get_the_title($_POST['postid'])."<br> <br>Please check it in and refund his payment.<br><br> Thanks";
      wp_mail($email, 'New Request For Refund', $message, $headers);
  
}
add_action( 'wp_ajax_request_refund', 'request_refund' );
add_action( 'wp_ajax_nopriv_request_refund', 'request_refund' );*/