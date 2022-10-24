<?php
/* @var $this AFileController */
/* @var $model AFile */

$this->breadcrumbs=array(
	'File'=>array('admin'),
	'Danh sách',
);

$this->menu=array(
	array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>
<h1>Quản lý file</h1>

<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'afile-grid',
	'dataProvider'=>$model->search(),
    'type'         => 'bordered condensed striped',
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		//'size',
		//'type',
		//'path',
		'download_link',
        array(
            'name'      =>  'created_time',
            'value'     =>  'date(\'Y-m-d H:i\',$data->created_time)'
        ),
		//'note',
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'  =>  '{update}{delete}',
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
	),
)); ?>
