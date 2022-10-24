<?php
$this->breadcrumbs=array(
	$this->modelDisplayName=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('adm/app','update'),
);
$this->menu=array(
	array('label'=>Yii::t('adm/app','create').' '.$this->modelDisplayAttribute, 'url'=>array('create'), 'linkOptions' => array('class' => 'btn_create')),
	array('label'=>Yii::t('adm/app','view').' '.$this->modelDisplayAttribute, 'url'=>array('view', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn_view')),
	array('label'=>Yii::t('adm/app','manage').' '.$this->modelDisplayAttribute, 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
);
?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>