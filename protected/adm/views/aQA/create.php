<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        'Q&A' => array('admin'),
        Yii::t('adm/static_page','create'),
    );

    $this->menu = array(
        array('label' => 'Quản lý câu hỏi', 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1>Tạo mới câu hỏi-câu trả lời</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>