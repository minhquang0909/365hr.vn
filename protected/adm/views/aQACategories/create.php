<?php
    /* @var $this ANewsCategoriesController */
    /* @var $model ANewsCategories */

    $this->breadcrumbs = array(
        'Danh mục câu hỏi',
        Yii::t('adm/news','create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','manage_cate'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1>Tạo mới danh mục câu hỏi</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>