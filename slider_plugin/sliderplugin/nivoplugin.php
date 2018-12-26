<?php
/*
    Plugin Name: Custome Slider Plugin
    Description: Simple implementation of a nivo slideshow into WordPress
    Author: Sanjay Singh
    Version: 1.0
*/

add_action('wp_print_scripts', 'np_register_scripts');
add_action('wp_print_styles', 'np_register_styles');

/* call plugin scripts */
function np_register_scripts() {
    if (!is_admin()) {
        // register
        wp_register_script('np_nivo-script', plugins_url('nivo-slider/jquery.nivo.slider.js', __FILE__), array( 'jquery' ));
        wp_register_script('np_script', plugins_url('script.js', __FILE__));
 
        // enqueue
        wp_enqueue_script('np_nivo-script');
        wp_enqueue_script('np_script');
    }
}
 /* get plugin stylesheet */
function np_register_styles() {
    // register
    wp_register_style('np_styles', plugins_url('nivo-slider/nivo-slider.css', __FILE__));
    wp_register_style('np_styles_theme', plugins_url('nivo-slider/themes/default/default.css', __FILE__));
 
    // enqueue
    wp_enqueue_style('np_styles');
    wp_enqueue_style('np_styles_theme');
}

/* slide show script get from custome post type */
function np_function($type='np_function') {
    $args = array(
        'post_type' => 'np_images',
        'posts_per_page' => 5,
		'orderby' =>'post',
		'order' => 'ASC'
    );
    $result = '<div class="slider-wrapper theme-default">';
    $result .= '<div id="slider" class="nivoSlider">';
 
    //the loop
    $loop = new WP_Query($args);
    while ($loop->have_posts()) {
        $loop->the_post();
 
        $the_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $type);
        $result .='<img title="'.get_the_title().'" src="' . $the_url[0] . '" data-thumb="' . $the_url[0] . '" alt=""/>';
    }
    $result .= '</div>';
    $result .='<div id = "htmlcaption" class = "nivo-html-caption">';
    $result .='<strong>This</strong> is an example of a <em>HTML</em> caption with <a href = "#">a link</a>.';
    $result .='</div>';
    $result .='</div>';
    return $result;
}
?>