<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        Yii::t('adm/news','news')        => array('admin'),
        Yii::t('adm/news','update'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/news','manage_news'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h2><?=Yii::t('adm/news','update')?>: <?php echo $model->title; ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
<?php //$this->renderPartial('_form_update', array('model' => $model,'tags_news' => $tags_news)); ?>