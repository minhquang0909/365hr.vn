<?php
/* @var $this AOptionGroupController */
/* @var $model OptionGroup */

$this->breadcrumbs=array(
	'Nhóm tùy chọn'=>array('admin'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Quản lý nhóm tùy chọn</h1>

<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'           => 'option-group-grid',
    'type'         => 'bordered condensed striped',
    'dataProvider' => $model->search(),
    'filter'       => $model,
	'columns'=>array(
		'id',
		'title',
		'sort_order',
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'    => '{update} {delete}',
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
	),
)); ?>
