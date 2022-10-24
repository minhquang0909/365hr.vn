<?php
/* @var $this AUsersChangeLogController */
/* @var $model AUsersChangeLog */

$this->breadcrumbs=array(
	'Ausers Change Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AUsersChangeLog', 'url'=>array('index')),
	array('label'=>'Manage AUsersChangeLog', 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1>Create AUsersChangeLog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>