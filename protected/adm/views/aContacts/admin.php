<?php
    $this->breadcrumbs = array(
        $this->modelDisplayName => array('admin'),
        Yii::t('adm/app', 'manage'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/app', 'manage') . ' ' . $this->modelDisplayAttribute, 'url' => array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
    );
?>
<h4>Danh sách liên hệ</h4>
<?php $this->widget('booster.widgets.TbGridView', array(
    'id'           => 'acontacts-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        array(
            'header' => '#',
            'value'  => '++$row',
        ),
        'fullname',
        'email',
        'phone',
        'message',
        'time',
        /*
        'status',
        */
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 100px;text-align:center'),
            'template'    => '{delete}{update}',
        ),
    ),
)); ?>
