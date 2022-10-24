<?php
    $this->breadcrumbs = array(
        Yii::t('adm/system', 'manage_system_group') => array('admin'),
        $model->group_title,
    );

    $this->menu = array(
        array('label' => Yii::t('adm/system', 'create_system_group'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/system', 'update_system_group'), 'url' => array('update', 'id' => $model->id), 'linkOptions' => array('class' => 'btn btn-danger')),
        //array('label' => Yii::t('adm/group', 'mnu_delete'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('adm/app', 'confirm'), 'class' => 'link-delete', 'csrf' => true)),
        array('label' => Yii::t('adm/system', 'manage_system_group'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

<h3> <?php echo Yii::t('adm/system', 'lbl_group_title') . ': ' . CHtml::encode($model->group_title); ?></h3>

<?php $this->widget('booster.widgets.TbDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'group_title',
        'group_desc',
        array(
            'name'  => 'status',
            'value' => CHtml::encode(ASystemGroup::getStatusText($model->status)),
        ),
        'created_date',
    ),
)); ?>

<?php echo $this->renderPartial('_permission', array('arrayDataProvider' => $arrayDataProvider, 'id' => $model->id)); ?>
<div class="group-admin-view"><?php echo Yii::t('adm/system', 'lbl_user_in_group'); ?></div>
<?php
    $this->widget('booster.widgets.TbGridView', array(
        'type'         => 'bordered condensed striped',
        'id'           => 'system-user-grid',
        'dataProvider' => $bSystemUserDataProvider,
        'columns'      => array(
            array(
                "name"  => 'username',
                "type"  => 'html',
                "value" => 'Chtml::link("<b>".CHtml::encode($data->username)."</b>",array("/aSystemUser/view&id=$data->id"))',
            ),
            'fullname',
            array(
                'name'  => 'status',
                'type'  => 'raw',
                'value' => '($data->status == 0) ? "<span id=\"active_status".$data->id."\"><img onclick=\"changeStatus(\'".$data->id."\',0);\" class=\"active_status\" title=\"' . Yii::t('app', 'status_inactive') . '\" src=\"' . Yii::app()->getRequest()->baseUrl . '/images/icons/publish_x.png\" /></span>": "<span id=\"active_status".$data->id."\"><img onclick=\"changeStatus(\'".$data->id."\',1);\" class=\"active_status\" title=\"' . Yii::t('app', 'status_active') . '\" src=\"' . Yii::app()->getRequest()->baseUrl . '/images/icons/tick.png\" /></span>"',
            ),
            'created_date',
            'lastest_login',
            array(
                'class'       => 'booster.widgets.TbButtonColumn',
                'htmlOptions' => array('width' => '70px'),
            ),
        ),
    )); ?>


