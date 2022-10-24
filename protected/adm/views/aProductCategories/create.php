<?php
    /* @var $this AProductCategoriesController */
    /* @var $model AProductCategories */

    $this->breadcrumbs = array(
        Yii::t('adm/product','categories') => array('admin'),
        Yii::t('adm/product','create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/product','manage_cate'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/product','create')?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>