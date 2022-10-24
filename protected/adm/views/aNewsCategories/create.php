<?php
    /* @var $this ANewsCategoriesController */
    /* @var $model ANewsCategories */

    $this->breadcrumbs = array(
        Yii::t('adm/news','categories') => array('admin'),
        Yii::t('adm/news','create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','manage_cate'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/news','create')?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>