<?php

$cakeDescription = 'CakePHP: Admin';

?>

<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
   </title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->

<?= $this->Html->css('/assets/global/plugins/font-awesome/css/font-awesome.min.css') ?>
<?= $this->Html->css('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') ?>
<?= $this->Html->css('/assets/global/plugins/bootstrap/css/bootstrap.min.css') ?>
<?= $this->Html->css('/assets/global/plugins/uniform/css/uniform.default.css') ?>
<?= $this->Html->css('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') ?>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<?= $this->Html->css('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') ?>
<?= $this->Html->css('/assets/global/plugins/fullcalendar/fullcalendar.min.css') ?>
<?= $this->Html->css('/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') ?>

<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<?= $this->Html->css('/assets/admin/pages/css/tasks.css') ?>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<?= $this->Html->css('/assets/global/css/components.css') ?>
<?= $this->Html->css('/assets/global/css/plugins.css') ?>
<?= $this->Html->css('/assets/admin/layout/css/layout.css') ?>
<?= $this->Html->css('/assets/admin/layout/css/themes/darkblue.css') ?>
<?= $this->Html->css('/assets/admin/layout/css/custom.css') ?>
<!-- END THEME STYLES -->
<!-- editior theme style -->

<?= $this->Html->css('/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') ?>
<?= $this->Html->css('/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') ?>
<?= $this->Html->css('/assets/global/plugins/bootstrap-summernote/summernote.css') ?>
<!--editior theme style end -->

 
   <?= $this->Html->meta('favicon.ico','/favicon.ico');?>
   
   
	<?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
	
	