<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        Yii::t('adm/static_page','news')        => array('admin'),
        $model->title => array('view', 'id' => $model->id),
        Yii::t('adm/static_page','update'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/static_page','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/static_page','view'), 'url' => array('view', 'id' => $model->id)),
        array('label' => Yii::t('adm/static_page','manage_news'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h2><?=Yii::t('adm/static_page','update')?>: <?php echo $model->title; ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>