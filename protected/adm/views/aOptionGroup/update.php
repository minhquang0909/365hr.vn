<?php
/* @var $this AOptionGroupController */
/* @var $model OptionGroup */

$this->breadcrumbs=array(
	'Nhóm tùy chọn'=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	'Cập nhật',
);

$this->menu=array(
    array('label'=>'Quản lý', 'url'=>array('admin')),
	array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Update OptionGroup <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>