<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        'Q&A'        => array('admin'),
        $model->question => array('view', 'id' => $model->id),
        Yii::t('adm/static_page','update'),
    );

    $this->menu = array(
        array('label' => 'Quản lý câu hỏi', 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h2>Cập nhật câu hỏi-câu trả lời: <?php echo $model->question; ?></h2>

<?php $this->renderPartial('_form', array('model' => $model)); ?>