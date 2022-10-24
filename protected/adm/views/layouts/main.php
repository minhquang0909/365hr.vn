<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$this->pageTitle;?> </title>
    <link rel="shortcut icon" type="image/x-icon"  href="<?=Yii::app()->theme->baseUrl?>/favicon.png?v=1">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/icheck/flat/green.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/floatexamples.css" rel="stylesheet" />
   <!-- <script src="js/jquery.min.js"></script>-->
    <!--[if lt IE 9]>
    <script src="../assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php $this->renderPartial('/layouts/_sidebar'); ?>
        <?php $this->renderPartial('//layouts/_top_nav'); ?>
        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->breadcrumbs)): ?>
                <?php $this->widget('booster.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                )); ?><!-- breadcrumbs -->
            <?php endif ?>
            <?php $this->widget('booster.widgets.TbAlert'); ?>
            <?=$content;?>
            <?php $this->renderPartial('//layouts/_footer'); ?>
        </div>
        <!-- /page content -->
    </div>
</div>
<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!--<script src="js/bootstrap.min.js"></script>-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- chart js -->
<!--<script src="js/chartjs/chart.min.js"></script>-->
<!-- bootstrap progress js -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/progressbar/bootstrap-progressbar.min.js"></script>
<!-- icheck -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment.min2.js"></script>
<!--<script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>-->
<!-- sparkline -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>
<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.time.min.js"></script>
<!--<script type="text/javascript" src="js/flot/date.js"></script>-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/curvedLines.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/flot/jquery.flot.resize.js"></script>
</body>
</html>