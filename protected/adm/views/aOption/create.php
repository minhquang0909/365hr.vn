<?php
/* @var $this AOptionController */
/* @var $model Option */

$this->breadcrumbs=array(
	'Tùy chọn'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'Quản lý', 'url'=>array('admin')),
);
?>

<h1>Thêm mới tùy chọn</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>