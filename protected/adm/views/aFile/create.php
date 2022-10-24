<?php
/* @var $this AFileController */
/* @var $model AFile */

$this->breadcrumbs=array(
	'File'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'Quản lý', 'url'=>array('admin')),
);
?>

<h1>Tạo mới file</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>