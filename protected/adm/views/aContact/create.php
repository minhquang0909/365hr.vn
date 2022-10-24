<?php
/* @var $this AContactController */
/* @var $model AContact */

$this->breadcrumbs=array(
	'Acontacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AContact', 'url'=>array('index')),
	array('label'=>'Manage AContact', 'url'=>array('admin')),
);
?>

<h1>Create AContact</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>