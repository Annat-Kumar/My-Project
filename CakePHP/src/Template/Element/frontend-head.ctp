<?php

$cakeDescription = 'CakePHP';

?>

<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

<meta charset="utf-8">
  <title>Metronic Frontend (with Top Bar)</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

	<!-- Fonts START -->
  <?php echo $this->Html->css('http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all'); ?>
	<!-- Fonts END -->

  <!-- Global styles START -->           
  <?php echo $this->Html->css('/assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>
  <?php echo $this->Html->css('/assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START --> 
  <?php echo $this->Html->css('/assets/global/plugins/fancybox/source/jquery.fancybox.css'); ?> 
  <?php echo $this->Html->css('/assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css'); ?>  
  <?php echo $this->Html->css('/assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css'); ?>
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
    <?php echo $this->Html->css('/assets/global/css/components.css'); ?>
    <?php echo $this->Html->css('/assets/frontend/layout/css/style.css'); ?>
	<?php echo $this->Html->css('/assets/frontend/pages/css/style-revolution-slider.css'); ?>
  <!-- metronic revo slider styles -->
     
    <?php echo $this->Html->css('/assets/frontend/layout/css/style-responsive.css'); ?>
    <?php echo $this->Html->css('/assets/frontend/layout/css/themes/red.css'); ?>
    <?php echo $this->Html->css('/assets/frontend/layout/css/custom.css'); ?>
  <!-- Theme styles END -->
  <?= $this->Html->css('my-app.css') ?>