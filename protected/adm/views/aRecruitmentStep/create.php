<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        'Các bước tuyển dụng' => array('admin'),
        Yii::t('adm/static_page','create'),
    );

    $this->menu = array(
        array('label' => 'Quản lý', 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h3>Tạo mới bước tuyển dụng</h3>

<?php $this->renderPartial('_form', array('model' => $model)); ?>