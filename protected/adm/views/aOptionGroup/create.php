<?php
/* @var $this AOptionGroupController */
/* @var $model OptionGroup */

$this->breadcrumbs=array(
	'Nhóm tùy chọn'=>array('admin'),
	'Thêm mới',
);

$this->menu=array(
	array('label'=>'Quản lý', 'url'=>array('admin')),
);
?>

<h1>Tạo mới nhóm tùy chọn</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>