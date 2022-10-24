<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        Yii::t('adm/product','news')        => array('admin'),
        $model->title => array('view', 'id' => $model->id),
        Yii::t('adm/product','update'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/product','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/product','view'), 'url' => array('view', 'id' => $model->id)),
        array('label' => Yii::t('adm/product','manage_news'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h2><?=Yii::t('adm/product','update')?>: <?php echo $model->title; ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
<?php //$this->renderPartial('_form_update', array('model' => $model,'tags_news' => $tags_news)); ?>