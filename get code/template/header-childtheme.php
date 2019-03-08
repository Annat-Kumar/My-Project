
<?php
/**
 * The header for our child-theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <!-- Required meta tags -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri() ;?>/images/favicon.ico">

   <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link rel="stylesheet" href="css/style.css">
	 <link href="<?php echo get_stylesheet_directory_uri(); ?>/raqam-style.css" rel="stylesheet">
	 <link href="<?php echo get_stylesheet_directory_uri(); ?>/raqam-responsive.css" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home | BUSINESS NAME</title>
	<?php //wp_head(); ?>
  </head>
<body <?php body_class(); ?>>
    <header>
         <div class="container">
          <div class="row">
            <div class="col-md-12">
               <div class="header-menu">
				  <nav class="navbar navbar-expand-lg navbar-light" >
  <!--a class="navbar-brand" href="#">Navbar</a-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="myNavbar">
   
		<?php wp_nav_menu('primary_menu'); ?>
  </div>
</nav>
               </div>
            </div>
          </div>
        </div>
    </header>