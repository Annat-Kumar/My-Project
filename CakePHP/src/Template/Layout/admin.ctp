<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
 <?= $this->element('head') ?> 
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
<div class="page-header -i navbar navbar-fixed-top">
	<?= $this->element('header') ?>
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<?= $this->element('sidebar') ?>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
		 <?= $this->fetch('content') ?>
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
	<div class="page-quick-sidebar-wrapper">
		<?= $this->element('quick-sidebar') ?>
	</div>
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<?= $this->element('footer') ?>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<?php echo $this->Html->script('/assets/global/plugins/jquery.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-migrate.min.js'); ?>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<?php echo $this->Html->script('/assets/global/plugins/jquery-ui/jquery-ui.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery.blockui.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery.cokie.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/uniform/jquery.uniform.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.resize.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/flot/jquery.flot.categories.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery.pulsate.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/moment.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<?php echo $this->Html->script('/assets/global/plugins/fullcalendar/fullcalendar.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery.sparkline.min.js'); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-markdown/lib/markdown.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js'); ?>
<?php echo $this->Html->script('/assets/global/plugins/bootstrap-summernote/summernote.min.js'); ?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php echo $this->Html->script('/assets/global/scripts/metronic.js'); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/layout.js'); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/quick-sidebar.js'); ?>
<?php echo $this->Html->script('/assets/admin/layout/scripts/demo.js'); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/index.js'); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/tasks.js'); ?>
<?php echo $this->Html->script('/assets/admin/pages/scripts/components-editors.js'); ?>
<!-- END PAGE LEVEL SCRIPTS -->

 <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   Index.init();   
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();
   
   ComponentsEditors.init();
});

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>