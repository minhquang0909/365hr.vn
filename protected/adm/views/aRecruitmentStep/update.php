<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        'Các bước tuyển dụng'        => array('admin'),
        $model->question => array('view', 'id' => $model->id),
        Yii::t('adm/static_page','update'),
    );

    $this->menu = array(
        array('label' => 'Quản lý', 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h3>Cập nhật câu các bước tuyển dụng: <?php echo $model->question; ?></h3>

<?php $this->renderPartial('_form', array('model' => $model)); ?>