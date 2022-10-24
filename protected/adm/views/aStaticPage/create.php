<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        Yii::t('adm/static_page','news') => array('admin'),
        Yii::t('adm/static_page','create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/static_page','manage_news'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/static_page','create')?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>