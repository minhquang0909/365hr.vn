<?php
/* @var $this AQueueEmailController */
/* @var $model AQueueEmail */

$this->breadcrumbs=array(
	'Aqueue Emails'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AQueueEmail', 'url'=>array('index')),
	array('label'=>'Manage AQueueEmail', 'url'=>array('admin')),
);
?>

<h1>Create AQueueEmail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>