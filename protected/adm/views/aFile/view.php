<?php
/* @var $this AFileController */
/* @var $model AFile */

$this->breadcrumbs=array(
	'Afiles'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AFile', 'url'=>array('index')),
	array('label'=>'Create AFile', 'url'=>array('create')),
	array('label'=>'Update AFile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AFile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AFile', 'url'=>array('admin')),
);
?>

<h1>View AFile #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'size',
		'type',
		'path',
		'download_link',
		'created_time',
		'note',
	),
)); ?>
