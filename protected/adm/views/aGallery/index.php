<?php
/* @var $this AGalleryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Agalleries',
);

$this->menu=array(
	array('label'=>'Create AGallery', 'url'=>array('create')),
	array('label'=>'Manage AGallery', 'url'=>array('admin')),
);
?>

<h1>Agalleries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
