<?php
    $this->breadcrumbs = array(
        Yii::t('adm/admin', 'manage_system_user') => array('admin'),
        $model->username,
    );

    $this->menu = array(
        array('label' => Yii::t('adm/admin', 'create_system_user'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/admin', 'update_system_user'), 'url' => array('update', 'id' => $model->id), 'linkOptions' => array('class' => 'btn btn-danger')),
        //array('label' => Yii::t('adm/app', 'delete_sysuser'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('adm/app', 'confirm'), 'class' => 'link-delete')),
        array('label' => Yii::t('adm/admin', 'manage_system_user'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );

?>


    <h3><?php echo Yii::t('adm/admin', 'view_system_user'); ?> - <?php echo CHtml::encode($model->username); ?></h3>

<?php
    $this->widget('booster.widgets.TbDetailView', array(
        'data'       => $model,
        'attributes' => array(
            'username',
            'email',
            array(
                'name'  => 'status',
                'value' => ($model->status == 1) ? Yii::t('adm/system', 'enable') : Yii::t('adm/system', 'disable'),
            ),
            'phonenumber',
            'created_date',
            'lastest_login',
            'ip',
            'groups.group_title',
        ),
    )); ?>

<?php echo $this->renderPartial('_permission', array('arrayDataProvider' => $arrayDataProvider, 'id' => $model->id)); ?>