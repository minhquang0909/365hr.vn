<?php
$this->breadcrumbs=array(
	$this->modelDisplayName=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('adm/app','update'),
);
$this->menu=array(
	array('label'=>'Tạo mới', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn_create')),
	array('label'=>'Quản lý', 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>