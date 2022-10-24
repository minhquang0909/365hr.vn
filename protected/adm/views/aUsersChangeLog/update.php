<?php
/* @var $this AUsersChangeLogController */
/* @var $model AUsersChangeLog */

$this->breadcrumbs=array(
	'Ausers Change Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AUsersChangeLog', 'url'=>array('index')),
	array('label'=>'Create AUsersChangeLog', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
	array('label'=>'View AUsersChangeLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AUsersChangeLog', 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1>Update AUsersChangeLog <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>