<?php
/* @var $this AQueueEmailController */
/* @var $model AQueueEmail */

$this->breadcrumbs=array(
	'Aqueue Emails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AQueueEmail', 'url'=>array('index')),
	array('label'=>'Create AQueueEmail', 'url'=>array('create')),
	array('label'=>'View AQueueEmail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AQueueEmail', 'url'=>array('admin')),
);
?>

<h1>Update AQueueEmail <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>