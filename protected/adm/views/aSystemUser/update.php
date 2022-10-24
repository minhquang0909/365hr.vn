<?php
    $this->breadcrumbs = array(
        Yii::t('adm/system', 'manage_system_user') => array('admin'),
        $model->username                           => array('view', 'id' => $model->id),
        Yii::t('adm/system', 'update_system_user'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/system', 'create_system_user'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/system', 'view_system_user'), 'url' => array('view', 'id' => $model->id), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/system', 'manage_system_user'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h3><?php echo Yii::t('adm/system', 'update_system_user'); ?> : <?php echo CHtml::encode($model->username); ?></h3>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>