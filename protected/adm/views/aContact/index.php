<?php
/* @var $this AContactController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Acontacts',
);

$this->menu=array(
	array('label'=>'Create AContact', 'url'=>array('create')),
	array('label'=>'Manage AContact', 'url'=>array('admin')),
);
?>

<h1>Acontacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
