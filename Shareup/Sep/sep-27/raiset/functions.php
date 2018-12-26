<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen' );

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	/*
	 * Enable support for custom logo.
	 *
	 * @since Twenty Fifteen 1.5
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.

	/**
	 * Filter Twenty Fifteen custom-header support arguments.
	 *
	 * @since Twenty Fifteen 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-color     		Default color of the header.
	 *     @type string $default-attachment     Default attachment of the header.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
/* Dynamic footer*/
function tutsplus_widgets_init() {
 
    // First footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'tutsplus' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    // Second Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Second Footer Widget Area', 'tutsplus' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    // Third Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', 'tutsplus' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    // Fourth Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Fourth Footer Widget Area', 'tutsplus' ),
        'id' => 'fourth-footer-widget-area',
        'description' => __( 'The fourth footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
     // Fifth Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Fifth Footer Widget Area', 'tutsplus' ),
        'id' => 'Fifth-footer-widget-area',
        'description' => __( 'The Fifth footer widget area', 'tutsplus' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
         
}

// Register sidebars by running tutsplus_widgets_init() on the widgets_init hook.
add_action( 'widgets_init', 'tutsplus_widgets_init' );

/***************** PAGINATION CODE START HERE **************/


/***************** PAGINATION CODE END HERE **************/

/*********** FORGET PASSWORD START CODE HERE***************/


add_action('wp_ajax_nopriv_forget_password', 'forget_password');
add_action('wp_ajax_forget_password', 'forget_password');

function forget_password(){
	 $user_email = $_POST['user_login'];
	 $pie_register_base = new PieReg_Base();
	/*
		*	Sanitizing post data
	*/
	$pie_register_base->piereg_sanitize_post_data( ( (isset($_POST) && !empty($_POST))?$_POST : array() ) );
	$option = get_option('pie_register_2');
	 if(isset($_POST['user_login']) and trim($_POST['user_login']) == ""){
		echo $error[] = '<strong>'.ucwords(__("error:","piereg")).'</strong> '.__('Invalid Username or Email, try again!','piereg');

	}
	 else{
			global $wpdb,$wp_hasher;
			$error 		= array();
			$username = trim($_POST['user_login']);
			$user_exists = false;
			// First check by username
			if ( username_exists( $username ) ){
				$user_exists = true;
				$user = get_user_by('login', $username);
			}
			// Then, by e-mail address
			elseif( email_exists($username) ){
					$user_exists = true;
					$user = get_user_by_email($username);
			}
			else{
			echo	$error[] = '<strong>'.ucwords(__("error :","piereg")).'</strong> '.__('Username or Email was not found, try again!','piereg');
			}
			if ($user_exists){
				
				$user_login = $user->user_login;
				$user_email = $user->user_email;
		
				$allow = apply_filters( 'allow_password_reset', true, $user->ID );
				if($allow){
					//Generate something random for key...
					$key = wp_generate_password( 20, false );
					
					//let other plugins perform action on this hook
					do_action( 'retrieve_password_key', $user_login, $key );
					
					//Generate something random for a hash...
					if ( empty( $wp_hasher ) ) {
						require_once ABSPATH . 'wp-includes/class-phpass.php';
						$wp_hasher = new PasswordHash( 8, true );
					}
					
					//$hashed = $wp_hasher->HashPassword( $key );
					$hashed = time() . ':' . $wp_hasher->HashPassword( $key );
					
					// Now insert the new md5 key into the db
					$wpdb->update($wpdb->users, array('user_activation_key' => $hashed), array('user_login' => $user_login));
		
					
					$message_temp = "";
					if($option['user_formate_email_forgot_password_notification'] == "0"){
						$message_temp	= nl2br(strip_tags($option['user_message_email_forgot_password_notification']));
					}else{
						$message_temp	= $option['user_message_email_forgot_password_notification'];
					}
					
					$message		= $pie_register_base->filterEmail($message_temp,$user->user_login, '',$key );
					$from_name		= $option['user_from_name_forgot_password_notification'];
					$from_email		= $option['user_from_email_forgot_password_notification'];					
					$reply_email 	= $option['user_to_email_forgot_password_notification'];
					$subject 		= html_entity_decode($option['user_subject_email_forgot_password_notification'],ENT_COMPAT,"UTF-8");
					
					//Headers
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				
					if(!empty($from_email) && filter_var($from_email,FILTER_VALIDATE_EMAIL))//Validating From
					$headers .= "From: ".$from_name." <".$from_email."> \r\n";
					if($reply_email){
						$headers .= "Reply-To: {$reply_email}\r\n";
						$headers .= "Return-Path: {$from_name}\r\n";
					}else{
						$headers .= "Reply-To: {$from_email}\r\n";
						$headers .= "Return-Path: {$from_email}\r\n";
					}
			
			 $subject='Forgot Password Notification';
			
			
				$message .= "<html>
				          <body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'>
				          <div style='color: #444444;font-weight: normal;'>
				            <div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div>
				           <div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Dear,','piereg')." %s ", $user_login) . 
				           "</div>
                       
				     </div> 
                     <div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>
				     ";
				$message .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;"> We’re told you forgot your password to your RaiseIT account. Dont worry, it happens to the best of us!<br>Please click this link to reset your password.','piereg</div>') . "</br></br>";
			   $message .= "<a  href=".network_site_url("login/?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "&redirect_to=".urlencode(get_option('siteurl')).">Click </a></br></br> </div>";
			
					$message .='</div>
                         <div style=color: #999;padding: 50px 30px">
                           <br>
						<div style="">Regards,</div>
						<div style="">RaiseIT Team</div>
						
						
					</div>
					</body></html>';

					//send email meassage
					if (FALSE == wp_mail($user_email, $subject, $message,$headers)){
					echo	$error[] =  '<strong>'.ucwords(__("error :","piereg")).'</strong> '.__('The e-mail could not be sent.','piereg') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...','piereg') ;
					}
					
					unset($key);
					unset($hashed);
					unset($_POST['user_login']);
				}else{
				echo 	$error[] = apply_filters('piereg_password_reset_not_allowed_text',__("Password reset is not allowed for this user","piereg"));
				}
			 
				if (count($error) == 0 )
				{
					echo $success =  '<b>'.ucwords(__("success :","piereg")).'</b> '.apply_filters("piereg_message_will_be_sent_to_your_email",__('A message will be sent to your email address.','piereg'));
				}	
			}
		}

	die();
}

/**************** FORGET PASSWORD END **************************/

function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/*code add theme logo upload option*/

/*add_action( 'customize_register', 'themename_customize_register' );
function themename_customize_register($wp_customize) {

    $wp_customize->add_section( 'ignite_custom_logo', array(
        'title'          => 'Logo',
        'description'    => 'Display a custom logo?',
        'priority'       => 25,
    ) );

    $wp_customize->add_setting( 'custom_logo', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo', array(
        'label'   => 'Custom logo',
        'section' => 'ignite_custom_logo',
        'settings'   => 'custom_logo',
    ) ) );
}
*/
/*end code*/

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Fifteen 1.7
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */

function twentyfifteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyfifteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyfifteen_resource_hints', 10, 2 );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';


/****************************************Code for ajax user login************************************/

add_action('wp_ajax_nopriv_check_user_login', 'check_user_login');
add_action('wp_ajax_check_user_login', 'check_user_login');


function check_user_login()
{
  
	$credentials=array();
	$user_login = $_POST['user_login'];
	$user_pass  = $_POST['user_pass'];
	
	$credentials['user_login'] = $user_login;
	$credentials['user_password'] = $user_pass;
	$credentials['remember'] = true;

	$userdata = get_user_by('email', $credentials['user_login']);
    $result   = wp_check_password($credentials['user_password'], $userdata->data->user_pass, $userdata->data->ID);

	$user_id = $userdata->data->ID;
	
	$code = get_user_meta( $user_id, 'acc_activate', true );
	
	if(!$result)
	{
		   
		echo '1';
		  
	}elseif(isset($code) && $code == '0' )
	{	
		echo '3';
		
	}elseif(isset($code) && $code == '1')
	{	
		if ( $result ) 
		{
			auto_login( $userdata );
			
			//echo "<pre>";
			//print_r($userdata);
			
			echo $userdata->data->display_name;
			echo '-';
			echo '2';

		} 
	}

    die();
			
}

function auto_login( $user ) 
{
    if ( !is_user_logged_in() ) 
	{
        $user_id = $user->data->ID;
        $user_login = $user->data->user_login;

        wp_set_current_user( $user_id, $user_login );
        wp_set_auth_cookie( $user_id );

    } 
}

/******************** Login Process code ends here ************************/


/************** /////////////////////Sing up Ajax Process///////////////// ************/
function my_email_content_type() 
{
	return "text/html";
}
add_filter ("wp_mail_content_type", "my_email_content_type");

add_action('wp_ajax_nopriv_check_user_signup', 'check_user_signup');
add_action('wp_ajax_check_user_signup', 'check_user_signup');

function check_user_signup()
{
    //Getting personal details 
    $user_login = $_POST['user_login'];
    $user_pass  = $_POST['user_pass'];
	$user_email = $_POST['user_email'];
	$user_type  = $_POST['user_type'];
	$user_zip   = $_POST['user_zip'];
	$user_phone = $_POST['user_phone'];
	$user_adres = $_POST['user_adres'];
	
	//Getting Retailer form post data
	$buis_name          = $_POST['buis_name'];
	$buis_address       = $_POST['buis_address'];
	$buis_address_other = $_POST['buis_address_other'];
	$buis_description   = $_POST['buis_description'];
	$buis_img           = $_POST['buis_img'];
	
	//Getting Fundraiser form post data
	$fund_name          = $_POST['fund_name'];
	$fund_address       = $_POST['fund_address'];
	$fund_address_other = $_POST['fund_address_other'];
	$fund_description   = $_POST['fund_description'];
	$fund_cat_name      = $_POST['fund_cat_name'];
	$fund_s_date        = $_POST['fund_s_date'];
	$fund_s_time        = $_POST['fund_s_time'];
	$fund_e_time        = $_POST['fund_e_time'];
	
    $info = array();
  	$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($user_login) ;
    $info['user_pass']     = sanitize_text_field($user_pass);
	$info['user_email']    = sanitize_email( $user_email );
	
	// Register the user
    $user_register = wp_insert_user( $info );
	
	//Check if any error while signing up
	if ( is_wp_error($user_register) )
	{	
		$error  = $user_register->get_error_codes()	;
		
		if(in_array('empty_user_login', $error))
		{
			//***********Empty_user_login**************
			
			echo '0';
		}
		elseif(in_array('existing_user_login',$error))
		{
			//**********Username is already registered**********
			echo '1';
		}
		elseif(in_array('existing_user_email',$error))
		{
           //***********Email address is already registered***************
		   
		   echo '2';
		   
		}else{
			
			echo '4';
		}
		
    }else{
		    //************* If sign up is successful then add usermeta and posts as retailer/fundraiser****************
		
			$user_id_role = new WP_User($user_register);
			
			// Check User Type to set Role
			if($user_type == 'fundraiser')
			{
			 $user_id_role->set_role('fundraiser');
			 
			}elseif($user_type == 'retailer')
			{
				$user_id_role->set_role('retailer');
			}
			
			//Add user profile information
			update_user_meta( $user_register, 'user_type', $user_type );
			update_user_meta( $user_register, 'user_zip', $user_zip );
			update_user_meta( $user_register, 'user_phone', $user_phone );
			update_user_meta( $user_register, 'user_adres', $user_adres );
			
			//Sign Up Notifications For admin and User
			if($user_register && !is_wp_error( $user_register ))
			{
				$user = new WP_User($user_register);
				
				$user_login = stripslashes($user->user_login);
				$user_email = stripslashes($user->user_email);
				
				// Email Notification For Admin
				
				$message .= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
					<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ", "ADMIN") . 
					"</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
				$message .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;"> New user registration on RaiseIt','piereg</div>') . "</br>";
				$message .= sprintf(__('Username: %s'), $user_login) . "<br/>";
				$message .= sprintf(__('E-mail: %s'), $user_email) . "<br/></div>";
				$message .='</div></body></html>';

		/*		$message  = sprintf(__('New user registration on RaiseIt %s:'), get_option('blogname')) . "<br/>";
				$message .= sprintf(__('Username: %s'), $user_login) . "<br/>";
				$message .= sprintf(__('E-mail: %s'), $user_email) . "<br/>";*/
		  
				wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

				// Email Notification For Users
				
				$code = sha1( $user_register . time() );
				//Activation Link Page
				$activation_link = add_query_arg( array( 'key' => $code, 'user' => $user_register ), get_permalink(337));
				add_user_meta( $user_register, 'has_to_be_activated', $code, true );
				add_user_meta( $user_register, 'acc_activate', 0, true );
				
				$message1= "<html><body style='background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;'> <div style='max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;'><div style='color: #444444;font-weight: normal;'>
					<div style='text-align: center;font-weight:600;font-size:26px;padding: 10px 0;border-bottom: solid 3px #eeeeee;'> RaiseIT</div><div style='clear:both'></div><div style='padding: 30px 30px;font-size: 18px;line-height: 10px;'>".sprintf(__('Hi,')." %s ", $user_login) . 
					"</div></div><div style='padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;'>";
				$message1 .= __('<div style="padding: 30px 0;font-size: 18px;line-height: 40px;"> Welcome to Raise It! Here your log in details:','piereg</div>') . "</br>";
				$message1 .= sprintf(__('Username: %s'), $user_login) . "<br/>";
				$message1 .= sprintf(__('Password: %s'), $user_pass) . "<br/>";
				$message1 .= "<p>Click on below link to activate your account with RaiseIt</p>" . "<br/>";
				$message1 .= "<a href=".$activation_link."> Activate </a>" . "<br/>";
				$message1 .= sprintf(__('If you have any problems, please contact us at %s.'), get_option('admin_email')) . "<br/></div>";
				$message1.='</div>
								<div style=color: #999;padding: 50px 30px">
								<br>
								<div style="">Regards,</div>
								<div style="">RaiseIT Team</div>						
								</div>
								</body></html>';
				wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option('blogname')), $message1);	
			}
			
			// Creating/Adding Retailr/Fundraiser Type Posts
			
			if($user_type == 'retailer')
			{
				$user_post = array(
					'post_title'   => $buis_name,
					'post_content' => $buis_description,
					'post_status'  => 'publish',
					'post_type'    => 'retailer',
					'post_author'    => $user_register,
				);
				// Insert the post into the database
				$post_id = wp_insert_post( $user_post );
				
				//update_post_meta( $post_id, 'buis_name', $user_info->group );
				update_post_meta( $post_id, 'address', $buis_address );
				update_post_meta( $post_id, 'correspondence_address', $buis_address_other );
				update_post_meta( $post_id, 'rel_start_date', $buis_s_date );
				update_post_meta( $post_id, 'rel_end_date', $buis_e_date );
				//update_post_meta( $post_id, 'company_web', $user_info->company_web );
				
				/*$filename = $buis_img ;
				$parent_post_id = $post_id;
				$filetype = wp_check_filetype( basename( $filename ), null );
				$wp_upload_dir = wp_upload_dir();
				$attachment = array(
					'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
					'post_mime_type' => $filetype['type'],
				);
                $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
				wp_update_attachment_metadata( $attach_id, $attach_data );

				set_post_thumbnail( $parent_post_id, $attach_id );*/
				
			}elseif($user_type == 'fundraiser')
			{
				$user_post = array(
					'post_title'   => $fund_name,
					'post_content' => $fund_description,
					'post_status'  => 'draft',
					'post_type'    => 'fundraiser',
					'post_author'    => $user_register,
					
				);
				// Insert the post into the database
				$post_id = wp_insert_post( $user_post );
				
				$cat_ids[] = $fund_cat_name;
				$cat_ids = array_map( 'intval', $cat_ids );
				$cat_ids = array_unique( $cat_ids );
				
				$taxonomy = 'fund_cate';
				//Add selected category to this current post
				wp_set_object_terms($post_id, $cat_ids, $taxonomy , true );
			
				//update_post_meta( $post_id, 'fund_name', $user_info->group );
				update_post_meta( $post_id, 'fund_address', $fund_address );
				update_post_meta( $post_id, 'fund_correspondence_address', $fund_address_other );		
				update_post_meta( $post_id, 'select_date', $fund_s_date );
				update_post_meta( $post_id, 'start_time', $fund_s_time );
				update_post_meta( $post_id, 'end_time', $fund_e_time );
					
			}
		
		// Sign up Scuusessfully
		echo '3'; 
	}
  
  die();

}

/**************Sign Up Process Code Ends Here***********************/



/************** Adding Custom Roles *******************************/

add_role('retailer', __(
    'Retailer'),
    array(
        'read'              => true, // Allows a user to read
        'create_posts'      => true, // Allows user to create new posts
        'edit_posts'        => true, // Allows user to edit their own posts
        //'edit_others_posts' => true, // Allows user to edit others posts too
        'publish_posts'     => true, // Allows the user to publish posts
        'manage_categories' => true, // Allows user to manage post categories
        )
);

add_role('fundraiser', __(
    'Fundraiser'),
    array(
        'read'              => true, // Allows a user to read
        'create_posts'      => true, // Allows user to create new posts
        'edit_posts'        => true, // Allows user to edit their own posts
        //'edit_others_posts' => true, // Allows user to edit others posts too
        'publish_posts'     => true, // Allows the user to publish posts
        'manage_categories' => true, // Allows user to manage post categories
        )
); 


/**************** Permission to Users to Access admin Menus*****************/

function remove_menus(){
	
	if(is_user_logged_in())
	{
		
		$user = wp_get_current_user();
		
		//echo $user->roles[0];
        
		if($user->roles[0] == "fundraiser")
		{
  
		  remove_menu_page( 'index.php' );                  //Dashboard
		  remove_menu_page( 'jetpack' );                    //Jetpack* 
		  remove_menu_page( 'edit.php' );                   //Posts
		  remove_menu_page( 'upload.php' );                 //Media
		  remove_menu_page( 'edit.php?post_type=page' );    //Pages
		  remove_menu_page( 'edit-comments.php' );          //Comments
		  remove_menu_page( 'themes.php' );                 //Appearance
		  remove_menu_page( 'plugins.php' );                //Plugins
		  remove_menu_page( 'users.php' );                  //Users
		  remove_menu_page( 'tools.php' );                  //Tools
		  remove_menu_page( 'options-general.php' );        //Settings
		  remove_menu_page( 'page=wpcf7' ); 		  
		  remove_menu_page( 'edit.php?post_type=retailer' );
	      remove_menu_page( 'post-new.php?post_type=retailer' );
		  
		  //remove_submenu_page( 'index.php', 'wpcf7' );
		  
		  remove_menu_page( 'wpcf7' );
		  
		}elseif ($user->roles[0] == "retailer")
		{
		  remove_menu_page( 'index.php' );                  //Dashboard
		  remove_menu_page( 'jetpack' );                    //Jetpack* 
		  remove_menu_page( 'edit.php' );                   //Posts
		  remove_menu_page( 'upload.php' );                 //Media
		  remove_menu_page( 'edit.php?post_type=page' );    //Pages
		  remove_menu_page( 'edit-comments.php' );          //Comments
		  remove_menu_page( 'themes.php' );                 //Appearance
		  remove_menu_page( 'plugins.php' );                //Plugins
		  remove_menu_page( 'users.php' );                  //Users
		  remove_menu_page( 'tools.php' );                  //Tools
		  remove_menu_page( 'options-general.php' );        //Settings
		  remove_menu_page( 'page=wpcf7' ); 		  
		  remove_menu_page( 'edit.php?post_type=fundraiser' );
	      remove_menu_page( 'post-new.php?post_type=fundraiser' );
		  
		  //remove_submenu_page( 'index.php', 'wpcf7' );
		  
		  remove_menu_page( 'wpcf7' );
		}
    }
}
add_action( 'admin_menu', 'remove_menus' );


function set_default_admin_color($user_id) {
	$args = array(
		'ID' => $user_id,
		'admin_color' => 'Sunrise'
	);
	wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');

if ( !current_user_can('manage_options') )
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
?>