<?php
    $this->breadcrumbs = array(
        Yii::t('adm/system', 'manage_system_group') => array('admin'),
        Yii::t('adm/system', 'create_system_group'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/system', 'manage_system_group'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h3><?php echo Yii::t('adm/system', 'create_system_group'); ?></h3>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>