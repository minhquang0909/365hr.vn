<?php
    /* @var $this AProductCategoriesController */
    /* @var $model AProductCategories */

    $this->breadcrumbs = array(
        Yii::t('adm/product','categories') => array('admin'),
        $model->name      => array('view', 'id' => $model->id),
        Yii::t('adm/product','update'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/product','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/product','view'), 'url' => array('view', 'id' => $model->id)),
        array('label' => Yii::t('adm/product','manage_cate'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/product','update')?>: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>