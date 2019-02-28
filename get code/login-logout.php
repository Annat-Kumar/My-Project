<?php

function subscriber_no_admin_access()
{
     $redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' );
    if ( 
        current_user_can( 'subscriber' )       
    )
        exit( wp_redirect( $redirect ) );
}
add_action( 'admin_init', 'subscriber_no_admin_access', 100 );


//add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );

function wti_loginout_menu_link( $items, $args ) {
   if ($args->theme_location == 'primary') {
      if (is_user_logged_in()) {
         $items .= '<li class="right"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
      } else {
         $items .= '<li class="right"><a href="'. home_url() .'/login'.'">'. __("Log In") .'</a></li>';
      }
   }
   return $items;
}



add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}

?>