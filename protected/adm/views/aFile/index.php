<?php
/* @var $this AFileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Afiles',
);

$this->menu=array(
	array('label'=>'Create AFile', 'url'=>array('create')),
	array('label'=>'Manage AFile', 'url'=>array('admin')),
);
?>

<h1>Afiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
