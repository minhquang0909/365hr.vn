<?php
/* @var $this AQueueEmailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Aqueue Emails',
);

$this->menu=array(
	array('label'=>'Create AQueueEmail', 'url'=>array('create')),
	array('label'=>'Manage AQueueEmail', 'url'=>array('admin')),
);
?>

<h1>Aqueue Emails</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
