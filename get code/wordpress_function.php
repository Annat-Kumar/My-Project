<?php

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

add_action('widgets_init', 'awesome_register_sidebars');
function awesome_register_sidebars()
{
 register_sidebar(array(
        'id' => 'emailsubscriber_sidebar',
        'name' => __('Email Subscriber Sidebar', 'alor'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}	
	
	
	
?>