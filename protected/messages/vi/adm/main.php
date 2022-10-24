<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.alerts.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

    <div id="header">
        <a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mgame_logo.png" height="50"
                        alt="MGAME CONTROL PANEL"/></a>
    </div>

    <div id="mainmenu">
        <?php $this->widget('application.extensions.mbmenu.MbMenu', array(
            'items' => array(
                array('label' => Yii::t('adm/admin', 'mnu_home'), 'url' => array('/aDefault/index'),),
                array('label' => Yii::t('adm/admin', 'mnu_system_config'),
                      'items' => array(
                          array('label' => Yii::t('adm/admin', 'mnu_system_setting'), 'url' => array('/aSystemSetting/admin'), 'visible' => AUserPermission::checkUserPermission('aSystemSetting', 'del')),
                          array('label' => Yii::t('adm/admin', 'mnu_system_user'), 'url' => array('/aSystemUser/admin'), 'visible' => AUserPermission::checkUserPermission('aSystemUser', 'del')),
                          //array('label'=>Yii::t('adm/user','change_pass'), 'url'=>array('/aSystemUser/changepassword'),'visible'=>AUserPermission::checkUserPermission('aSystemUser','del')),
                          array(
                              'label'         => Yii::t('adm/admin', 'mnu_system_group'),
                              NULL, 'visible' => AUserPermission::checkUserPermission('aSystemgroup', 'view'),

                              'items'         => array(
                                  array('label' => Yii::t('adm/admin', 'mnu_group'), 'url' => array('/aSystemGroup/admin'), 'visible' => AUserPermission::checkUserPermission('aSystemGroup', 'del')),
                                  array('label' => Yii::t('adm/admin', 'mnu_create_group'), 'url' => array('/aSystemGroup/create'), 'visible' => AUserPermission::checkUserPermission('aSystemGroup', 'add'))
                              )
                          ),
                      ),
                ),
                array('label' => Yii::t('adm/game', 'mnu_channel1'),
                      'items' => array(
                          array('label' => Yii::t('adm/game', 'mnu_channel'), 'url' => array('/aChannel/admin'), 'visible' => AUserPermission::checkUserPermission('aChannel', 'del')),
                          array('label' => Yii::t('adm/game', 'mnu_channel_history'), 'url' => array('/aGamesChannel/admin'), 'visible' => AUserPermission::checkUserPermission('aGamesChannel', 'del')),
                      ),
                ),
                array('label' => Yii::t('adm/admin', 'mnu_game'),
                      'items' => array(
                          array('label' => yii::t('adm/category', 'manage_game_category'), 'url' => array('/aGamesCategories/admin'), 'visible' => AUserPermission::checkUserPermission('aGamesCategories', 'view')),
                          array(
                              'label' => Yii::t('adm/game', 'manager'),
                              //'url'=>array('/aGames/index'),'visible'=>AUserPermission::checkUserPermission('aGames','view'),
                              'items' => array(
                                  array('label' => Yii::t('adm/game', 'game_list'), 'url' => array('/aGames/admin'), 'visible' => AUserPermission::checkUserPermission('aGames', 'del')),
                                  array('label' => Yii::t('adm/game', 'game_create'), 'url' => array('/aGames/create'), 'visible' => AUserPermission::checkUserPermission('aGames', 'add'))
                              )
                          ),
                          array('label' => Yii::t('adm/game', 'mnu_gamepr_type'), 'url' => array('/aGamesPrType/admin'), 'visible' => AUserPermission::checkUserPermission('aGamesPrType', 'del')),
                          array('label' => Yii::t('adm/game', 'mnu_gamepr_item'), 'url' => array('/aGamesPrItems/admin'), 'visible' => AUserPermission::checkUserPermission('aGamesPrItems', 'del')),
                          array(
                              'label' => Yii::t('adm/game', 'advertise'),
                              'url'   => '', 'visible' => AUserPermission::checkUserPermission('aAdvertise', 'view'),
                              'items' => array(
                                  array('label' => Yii::t('adm/game', 'advertise_pos'), 'url' => array('/AAdvertisePosition/admin'), 'visible' => AUserPermission::checkUserPermission('aAdvertisePosition', 'del')),
                                  array('label' => Yii::t('adm/game', 'advertise_manage'), 'url' => array('/AAdvertise/admin'), 'visible' => AUserPermission::checkUserPermission('aAdvertise', 'add'))
                              )
                          ),
                      ),

                ),
                array('label' => Yii::t('adm/admin', 'mnu_cp'),
                      'items' => array(
                          array('label' => Yii::t('adm/admin', 'mnu_connection_type'), 'url' => array('/aConnectionType/admin'), 'visible' => AUserPermission::checkUserPermission('aConnectionType', 'del')),
                          array('label' => Yii::t('adm/admin', 'mnu_cp_method'), 'url' => array('/aConnectionMethod/admin'), 'visible' => AUserPermission::checkUserPermission('aConnectionMethod', 'del')),
                          array('label' => Yii::t('adm/cp', 'listcp'), 'url' => array('/aContentProvider/admin'), 'visible' => AUserPermission::checkUserPermission('aContentProvider', 'del')),
                          array('label' => Yii::t('adm/admin', 'mnu_connection_cp'), 'url' => array('/aConnectionCp/admin'), 'visible' => AUserPermission::checkUserPermission('aConnectionCp', 'del')),
                      ),
                ),
                array('label' => Yii::t('adm/news', 'mnu_info'),
                      'items' => array(
                          array('label' => Yii::t('adm/news', 'mnu_cate_news'), 'url' => array('/aNewsCategories/admin'), 'visible' => AUserPermission::checkUserPermission('aNewsCategories', 'del')),
                          array('label' => Yii::t('adm/news', 'mnu_news'), 'url' => array('/aNews/admin'), 'visible' => AUserPermission::checkUserPermission('aNews', 'del')),
                          //array('label'=>Yii::t('adm/cp','mnu_banner'), 'url'=>array('/aContentProvider/admin'),'visible'=>AUserPermission::checkUserPermission('aContentProvider','del')),
                      ),
                ),
                //array('label'=>Yii::t('adm/admin','mnu_report'), 'url'=>"http://mgame.vn:8072/"),
                array('label' => Yii::t('adm/admin', 'mnu_report'), 'url' => CFunction::getUrlReport()),
                array('label' => Yii::t('adm/admin', 'mnu_customercare'),
                      'items' => array(
                          array('label' => Yii::t('adm/admin', 'mnu_customer_info'), 'url' => array('/aCustomerStatistic/search'), 'visible' => AUserPermission::checkUserPermission('aCustomerStatistic', 'del')),
                          //array('label'=>Yii::t('adm/admin','mnu_customer_process'), 'url'=>array('/aCustomerStatistic/resolution'),'visible'=>AUserPermission::checkUserPermission('aCustomerStatistic','del')),
                      ),
                ),
                array('label' => Yii::t('adm/admin', 'mnu_change_password'),
                      'items' => array(
                          array('label' => Yii::t('adm/admin', 'mnu_change_password'), 'url' => array('/aSystemUser/changepass&id=' . Yii::app()->user->id)),
                          //array('label'=>Yii::t('adm/admin','mnu_customer_process'), 'url'=>array('/aCustomerStatistic/resolution'),'visible'=>AUserPermission::checkUserPermission('aCustomerStatistic','del')),
                      ),
                ),
                array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/aDefault/logout'), 'visible' => !Yii::app()->user->isGuest)
            ),
        )); ?>

    </div>
    <!-- mainmenu -->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif ?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div class="clear"></div>
</div>
<!-- page -->

<div id="footer">
    Supported By Thinknet (<?php echo date('Y'); ?>).<br/>
    All Rights Reserved.<br/>
    <?php //echo Yii::powered(); ?>
</div>
<!-- footer -->
</body>
</html>
