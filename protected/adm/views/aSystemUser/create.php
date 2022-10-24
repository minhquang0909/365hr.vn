<?php
    $this->breadcrumbs = array(
        Yii::t('adm/admin', 'manage_system_user') => array('admin'),
        Yii::t('adm/admin', 'create_system_user'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/admin', 'manage_system_user'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h3><?php echo Yii::t('adm/admin', 'create_system_user') ?></h3>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>