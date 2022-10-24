<?php
    /* @var $this ANewsCategoriesController */
    /* @var $model ANewsCategories */

    $this->breadcrumbs = array(
        Yii::t('adm/news','categories') => array('admin'),
        $model->name      => array('view', 'id' => $model->id),
        Yii::t('adm/news','update'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/news','manage_cate'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/news','update')?>: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>