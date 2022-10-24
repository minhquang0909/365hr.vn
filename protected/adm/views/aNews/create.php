<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        Yii::t('adm/news','news') => array('admin'),
        Yii::t('adm/news','create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','manage_news'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/news','create')?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>