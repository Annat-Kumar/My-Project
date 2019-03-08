<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'twentyseventeen' ),
		'social' => __( 'Social Links Menu', 'twentyseventeen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'twentyseventeen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'twentyseventeen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );
	
	//wp_enqueue_script( 'twentyseventeen-datatables', get_theme_file_uri( '/assets/js/wpdatatables.js' ), array(), '1.0', true );

	$twentyseventeen_l10n = array(
		'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
add new row request

*/
add_action('wp_ajax_nopriv_add_row', 'add_row'); 
add_action('wp_ajax_add_row', 'add_row');

function add_row(){
global $wpdb;
$datatable_id = $_POST['table_id'];
$row_id = $_POST['row_id'];	

$datatable = $wpdb->prefix . 'wpdatatables';
$select_table = $wpdb->get_row( "SELECT mysql_table_name FROM $datatable WHERE id = $datatable_id");	
$table_name = $select_table->mysql_table_name ;

$results = $wpdb->get_results( "SELECT * FROM $table_name");	
$all_colm = $wpdb->get_col( "DESC " . $table_name, 0 );
$count = count($all_colm);
$i=1;
?>
<input type="hidden" value="<?php echo $count ;?>" name="count_col" id="count_col">
<?php	
foreach($results[0] as $rt => $val)
{


if($i==1){} else {?>
<span><?php echo $rt;?></span>
<textarea id="col_<?php echo $i;?>" name="col_<?php echo $i;?>"></textarea>
<span>comment (if any)</span>
<input type="text" id="cmt_<?php echo $i;?>" name="cmt_<?php echo $i;?>" value="">
<br/><br/>
<?php
}
$i++;
}

 
die(0);
}

/**
Insert new row on ajax request

*/
add_action('wp_ajax_nopriv_insert_row', 'insert_row'); 
add_action('wp_ajax_insert_row', 'insert_row');

function insert_row(){
	
global $wpdb;
$datatable_id = $_POST['table_id'];
$all_comnt = $_POST['cmt'];
$all_col = $_POST['col'];
$total_colm = $_POST['count_col'];


$col = [];
$cmt = [];
$a=0;
for($i=2; $i <= $total_colm ; $i++,$a++)
{
	$col[$a] = $all_col[$i];
	$cmt[$a] = $all_comnt[$i];
	
	$column_value[] = trim($col[$a].'<div class="CellComment">'.$cmt[$a].'</div>') ;
}

		
$datatable = $wpdb->prefix . 'wpdatatables';
$select_table = $wpdb->get_row( "SELECT mysql_table_name FROM $datatable WHERE id = $datatable_id");	
$table_name = $select_table->mysql_table_name ;

$results = $wpdb->get_row("SELECT * FROM $table_name");	
foreach($results as $rt => $val)
{
		
$arr[] = $rt;	

$arrval[] = $val;

}

$a=1;
$cnt_lp = $total_colm - 1 ;
for($i=0;$i < $cnt_lp; $i++,$a++)
{
	$col_name[] = $arr[$a];
	$col_value[] = $column_value[$i];
}
	 $insert_value = array_combine($col_name,$col_value);


 $insert = $wpdb->insert( 
	$table_name, 
		$insert_value,
		array( 
		'%s', 
	) 
	);
if($insert)
{
	echo "success";
}
else { 
	echo "fail";
}

die(0);
}

/**
edit table ajax request

*/
add_action('wp_ajax_nopriv_edit_data', 'edit_data'); 
add_action('wp_ajax_edit_data', 'edit_data');

function edit_data(){
global $wpdb;
$datatable_id = $_POST['table_id'];
$row_id = $_POST['row_id'];	

$datatable = $wpdb->prefix . 'wpdatatables';
$select_table = $wpdb->get_row( "SELECT mysql_table_name FROM $datatable WHERE id = $datatable_id");	
$table_name = $select_table->mysql_table_name ;

$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE wdt_ID = $row_id");	
$all_colm = $wpdb->get_col( "DESC " . $table_name, 0 );
$count = count($all_colm);
?>
<input type="hidden" value="<?php echo $count ;?>" name="total_col" id="total_col">
<?php
$i=1;	
foreach($results[0] as $rt => $val)
{
		
$arr[] = $rt;	

$arrval[] = $val;

if (strpos($val, '<div class="CellComment">') !== false) {
	$first_col = explode('<div class="CellComment">',$val);
	$col = trim(strip_tags($first_col[0]));
	$cmt = trim(strip_tags($first_col[1]));
}
else {
	$col = trim(strip_tags($val));
	$cmt = '';
}

if($i==1){} else {?>
<span><?php echo $rt;?></span>
<textarea id="editcol_<?php echo $i;?>" name="editcol_<?php echo $i;?>"><?php echo $col;?></textarea>
<span>comment (if any)</span>
<input type="text" id="editcmt_<?php echo $i;?>" name="editcmt_<?php echo $i;?>" value="<?php echo $cmt;?>">
<br/><br/>
<?php
}
$i++;
}


die(0);
}

/**
update table ajax request

*/
add_action('wp_ajax_nopriv_update_table_name', 'update_table_name'); 
add_action('wp_ajax_update_table_name', 'update_table_name');

function update_table_name()
{ 
global $wpdb;
$change_name = $_POST['table_name'];	
$table_id = $_POST['table_id'];

$table_name = $wpdb->prefix . 'wpdatatables';
$update_value = array('title' => $change_name);
$update =  $wpdb->update( 
	$table_name, 
	$update_value,
	array( 'id' => $table_id ), 
	array( 
		'%s'	
	), 
	array( '%s' ) 
);


if($update){
	echo "success";
}else {
	echo "fail";
}

die(0);
}
/**
update table ajax request

*/
add_action('wp_ajax_nopriv_update_table', 'update_table'); 
add_action('wp_ajax_update_table', 'update_table');

function update_table()
{
global $wpdb;

$datatable_id = $_POST['table_id'];
$wdt_id = $_POST['row_id'];
$total_col = $_POST['total_col'];
$all_comnt = $_POST['cmt'];
$all_col = $_POST['col'];

$col = [];
$cmt = [];
$a=0;
for($i=2; $i <= $total_col ; $i++,$a++)
{
	$col[$a] = $all_col[$i];
	$cmt[$a] = $all_comnt[$i];
	
	$column_value[] = trim($col[$a].'<div class="CellComment">'.$cmt[$a].'</div>') ;
}


$datatable = $wpdb->prefix . 'wpdatatables';
$select_table = $wpdb->get_row( "SELECT mysql_table_name FROM $datatable WHERE id = $datatable_id");	
$table_name = $select_table->mysql_table_name ;
				
$results = $wpdb->get_results( "SELECT * FROM $table_name WHERE wdt_ID = $wdt_id");	
				
foreach($results[0] as $rt => $val)
{
			
	$arr[] = $rt;	
	
	$arrval[] = $val;
	
}

$a=1;
$cnt_lp = $total_col - 1 ;
for($i=0;$i < $cnt_lp; $i++,$a++)
{
	$col_name[] = $arr[$a];
	$col_value[] = $column_value[$i];
}
	 $update_value = array_combine($col_name,$col_value);
  
$update =  $wpdb->update( 
	$table_name, 
	$update_value,
	array( 'wdt_ID' => $wdt_id ), 
	array( 
		'%s'	
	), 
	array( '%s' ) 
);


if($update){
	echo "success";
}else {
	echo "fail";	
	/* echo "<br>Last query is ".$wpdb->last_query;
	echo "<br>Error is ".$wpdb->last_error; 
	$wpdb->show_errors(); */

	}
		
die(0);
}


/**
delete row ajax request

*/
add_action('wp_ajax_nopriv_delete_data', 'delete_data'); 
add_action('wp_ajax_delete_data', 'delete_data');

function delete_data(){
	
	$row_id = $_POST['row_id'];	
	$datatable_id = $_POST['table_id'];
	global $wpdb;
		
		$datatable = $wpdb->prefix . 'wpdatatables';
		$select_table = $wpdb->get_row( "SELECT mysql_table_name FROM $datatable WHERE id = $datatable_id");	
		$table_name = $select_table->mysql_table_name ;		
		//$table_name = $wpdb->prefix . 'wpdatatable_'.$datatable_id;
		$delete = $wpdb->delete( $table_name, array( 'wdt_ID' => $row_id ) );
		if($delete)
		{
			echo "deleted";
		}else {
			echo "not delete";
		}
die(0);
}

/**
send mail when new post create
*/
function post_published_notification( $ID, $post ) {
	$media = get_attached_media('text/csv',$ID );
	$m_id = $media[$ID+1]->post_title;
    $author = $post->post_author; /* Post author ID. */
    $name = get_the_author_meta( 'display_name', $author );
    $email = get_the_author_meta( 'user_email', $author );
    $title = $post->post_title;
    $permalink = get_permalink( $ID );
    $edit = get_edit_post_link( $ID, '' );
    $to[] = sprintf( '%s <%s>', $name, $email );
    $subject = sprintf( 'Published: %s', $title );
    $message = sprintf ('Congratulations, %s! Your article “%s” has been published.' . "\n\n", $name, $title );
    $message .= sprintf( 'View: %s', $permalink );
    $message .="<br>".$m_id;
    $headers[] = ''; 
	/*$to = 'sanjay@bytecodetechnologies.in';
	$subject = 'new post has published';
	$message = 'you can see new post published by admin.';*/
   // wp_mail( $to, $subject, $message, $headers );

}
//add_action( 'publish_post', 'post_published_notification', 10, 2 );
add_action( 'publish_post', 'impport_data_csv', 10, 2 );
function impport_data_csv( $ID, $post ) {
		
	global $wpdb;
	
	$author = $post->post_author;		
	$name = get_the_author_meta( 'display_name', $author );
    $email = get_the_author_meta( 'user_email', $author );
    $title = $post->post_title;
    $post_content = $post->post_content;
    $post_date = $post->post_date;
    $permalink = get_permalink( $ID );
    $edit = get_edit_post_link( $ID, '' );
   // $to[] = sprintf( '%s <%s>', $name, $email );
	$to = 'sanjay@bytecodetechnologies.in';
    $subject = sprintf( 'Published: %s', $title );
    $message = sprintf ('Congratulations, %s! Your data “%s” has been imported sucessfully.' . "\n\n", $name, $title );
    $message .= sprintf( 'View: %s', $permalink );
  
    $headers[] = ''; 
	$cat = get_the_category($ID);
	$cat_name = $cat[0]->name ;
	if($cat[0]->term_id ==2)
	{	
		//$tags = wp_get_post_tags($ID);
		$tags = 9;
		if($tags)
		{
		//preg_match_all('!\d+!', $tags, $matches);
		$datatable = $wpdb->prefix . 'wpdatatables';
		$select_table = $wpdb->get_row("SELECT mysql_table_name FROM $datatable WHERE id = $tags");
		if($select_table){	
		$table_name = $select_table->mysql_table_name ;		
		$date = date("Y.m.d");
		$insert = 	$wpdb->insert( 
			$table_name, 
			array( 
				'postid' => $ID, 
				'posttype' => 'post', 
				'poststatus' => 'publish', 
				'posttitle' => $title ,
				'postcontent' => $post_content ,
				'postcategory' => $cat_name,
			), 
			array( 
				'%s', 
			) 
		);
		if($insert){
				$subject = 'Scraped data published sucessfully';
				$message = sprintf ('Congratulation, %s! Your scraped data “%s” has been published sucessfully.' . "\n\n", $name, $title );
				$headers[] = ''; 
				
				wp_mail( $to, $subject, $message, $headers );					
				 
			}else{				
				$subject = 'Unable to import scraped data';
				$message = sprintf ('Sorry, %s! Your data “%s” is unable to published right now! Please try again later' . "\n\n", $name, $title );
				$message .= "\n\n".$wpdb->last_error;
				$message .= "id =>".$ID."title =>".$title."cate =>".$cat_name."date =>".$date;
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
			}
		}
		else{
				$subject = 'Unable to import scraped data';
				$message = sprintf ('Sorry, %s! Your data “%s” is unable to published right now! Your table id is not correct' . "\n\n", $name, $title );				
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
		}
		}
		else{
				$subject = 'Unable to import scraped data';
				$message = sprintf ('Sorry, %s! Your data “%s” is unable to published right now! Your tag id is not correct' . "\n\n", $name, $title );				
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
		}
			
	}
	else if($cat[0]->term_id ==3)
	{
		
	if(!has_excerpt($ID)){		
		$subject = 'Unable to import CSV data';
		$message = 'Sorry you have not mention table id! Without table name it is unable to import data';
		
		$headers[] = ''; 
		wp_mail( $to, $subject, $message, $headers );

	}
	else {
	$expcerpt = strip_tags(get_the_excerpt($ID));
	$datatable = $wpdb->prefix . 'wpdatatables';
	$select_table = $wpdb->get_row("SELECT mysql_table_name FROM $datatable WHERE id = $expcerpt");
	if($select_table){	
	$table_name = $select_table->mysql_table_name ;

	$media = get_attached_media('text/csv',$ID );
	$mylink = $wpdb->get_row( "SELECT *  FROM `wp_posts` WHERE `post_parent` = $ID" );
	$guid = $media[$mylink->ID]->guid;
	$site_url = site_url();
	$path = str_replace($site_url,'',$guid);
	$full_url = ABSPATH.$path;
	
	$file = fopen($full_url,"r"); 
		$row=0;
		$count=0;
		while(! feof($file))
		{
			$count++;
			fgetcsv($file);			
		}
		fclose($file);	
		
		if (($handle = fopen($full_url, "r")) !== FALSE) 
		{
		  while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
			{
				$row++;
				if($row)
				{
					$result[]=$data;
				}
				
			}
			$key = array();
			$key = $result[0];
			unset($result[0]);
			$new_array = array();
			foreach($result as $results){
				for($i=0;$i <= count($results)-1;$i++){
					
					$new_arrays[str_replace('_','',$key[$i])] = trim($results[$i]);										
				}
				
				$insert = $wpdb->insert($table_name,$new_arrays,array('%s') );	
				
			}
			if($insert){
				
				wp_mail( $to, $subject, $message, $headers );					
				 
			}else{
				//$to = 'sanjay@bytecodetechnologies.in';
				$subject = 'Unable to import CSV data';
				$message = sprintf ('Sorry, %s! Your article “%s” has not published.' . "\n\n", $name, $title );
				//$message .= 'table id is not correct';
				$message .= "\n\n".$wpdb->last_error;
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
			}				
		}
	  }
	  else {
				$subject = 'Unable to import CSV data';		
				$message = 'table id is not correct';
				//$message .= "\n\n".$wpdb->last_error;
				$headers[] = ''; 
				wp_mail( $to, $subject, $message, $headers );
	  }
	 }
	}
		
}
/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );
