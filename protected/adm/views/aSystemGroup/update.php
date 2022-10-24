<?php
    $this->breadcrumbs = array(
        Yii::t('adm/system', 'manage_system_group') => array('admin'),
        $model->group_title                         => array('view', 'id' => $model->id),
        Yii::t('adm/system', 'update_system_group'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/system', 'create_system_group'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/system', 'view_system_group'), 'url' => array('view', 'id' => $model->id), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/system', 'manage_system_group'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h3><?php echo Yii::t('adm/system', 'update_system_group'); ?> <b><?php echo $model->group_title; ?></b></h3>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>