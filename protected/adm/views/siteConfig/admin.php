<?php
    $this->breadcrumbs = array(
        $this->modelDisplayName => array('admin'),
        Yii::t('adm/app', 'manage'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/app', 'create') . ' ' . $this->modelDisplayAttribute, 'url' => array('create'), 'linkOptions' => array('class' => 'btn_create')),
        array('label' => Yii::t('adm/app', 'manage') . ' ' . $this->modelDisplayAttribute, 'url' => array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
    );
?>
<?php $row = 0;
    $this->widget('booster.widgets.TbGridView', array(
        'id'           => 'site-config-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => array(
            array(
                'header'      => '#',
                'value'       => '++$row',
                'htmlOptions' => array('width' => '20px'),
            ),
            array(
                'header' => 'Key',
                'name'   => 'config_key',
            ),
            array(
                'header' => 'Giá trị',
                'name'   => 'config_value',
                'value'=>function($data){
                    return substr($data->config_value,0,100);
                }
            ),
            array(
                'header' => 'Thứ tự',
                'name'   => 'ordering',
            ),
            array(
                'class'       => 'booster.widgets.TbButtonColumn',
                'template'    => '{view}{update}{delete}',
                'htmlOptions' => array('width' => '100px'),
            ),
        ),
    )); ?>
