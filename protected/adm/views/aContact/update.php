<?php
/* @var $this AContactController */
/* @var $model AContact */

$this->breadcrumbs=array(
	'Acontacts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AContact', 'url'=>array('index')),
	array('label'=>'Create AContact', 'url'=>array('create')),
	array('label'=>'View AContact', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AContact', 'url'=>array('admin')),
);
?>

<h1>Update AContact <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>