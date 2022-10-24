<?php
/* @var $this AFileController */
/* @var $model AFile */

$this->breadcrumbs=array(
	'File'=>array('admin'),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'Quản lý file', 'url'=>array('admin')),
);
?>

<h1>Cập nhật file</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>