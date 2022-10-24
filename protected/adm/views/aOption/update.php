<?php
/* @var $this AOptionController */
/* @var $model Option */

$this->breadcrumbs=array(
	'Tùy chọn'=>array('admin'),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'Quản lý', 'url'=>array('admin')),
);
?>

<h1>Cập nhật tùy chọn <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>