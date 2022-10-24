<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        Yii::t('adm/product','news') => array('admin'),
        Yii::t('adm/product','create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/product','manage_news'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/product','create')?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>