<?php
    $this->breadcrumbs = array(
        Yii::t('adm/system', 'manage_system_user') => array('admin'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/system', 'create_system_user'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

<h3><?php echo Yii::t('adm/system', 'manage_system_user'); ?></h3>

<?php
    $this->widget('booster.widgets.TbGridView', array(
        'id'           => 'system-user-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'type'         => 'bordered condensed',
        'columns'      => array(
            array(
                'name'  => 'username',
                "type"      => 'html',
                'value' => 'CHtml::link(CHtml::encode($data->username),array("/aSystemUser/view&id=$data->id"))',
            ),
            array(
                'name'   => 'status',
                'type'   => 'raw',
                // 'value'=>'Lookup::item("CategorynewsActive",$data->status)',
                'value'  => 'CHtml::link(($data->status == 1) ? CHtml::image(Yii::app()->request->baseUrl.\'/images/icons/tick.png\',\'image\') : CHtml::image(Yii::app()->request->baseUrl.\'/images/icons/publish_x.png\',\'image\'),"javascript:void();",array(\'onclick\'=>"changeStatus($data->status,\'$data->id\')"))',
                "filter" => '<input type="hidden" id="all_time" name="YII_CSRF_TOKEN" value="' . Yii::app()->request->csrfToken . '">',
            ),
            'created_date',
            'phonenumber',
            array(
                'name'  => 'email',
                'type'  => 'raw',
                'value' => 'CHtml::link(CHtml::encode($data->email), "mailto:".$data->email)',
            ),
            array(
                'name'  => 'group_id',
                'value' => '$data->groups->group_title',
            ),
            array(
                'class'       => 'booster.widgets.TbButtonColumn',
                'template'    => '{view} {update}',
                'htmlOptions' => array('width' => '70px'),
            ),
        ),
    )); ?>
