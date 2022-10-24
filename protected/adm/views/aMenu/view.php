<?php
$this->breadcrumbs=array(
	$this->modelDisplayName=>array('admin'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('adm/app','create').' '.$this->modelDisplayAttribute, 'url'=>array('create'), 'linkOptions' => array('class' => 'btn_create')),
	array('label'=>Yii::t('adm/app','update').' '.$this->modelDisplayAttribute, 'url'=>array('update', 'id'=>$model->id), 'linkOptions' => array('class' => 'btn_update')),
	array('label'=>Yii::t('adm/app','delete').' '.$this->modelDisplayAttribute, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'linkOptions' => array('class' => 'btn_delete')),
	array('label'=>Yii::t('adm/app','manage').' '.$this->modelDisplayAttribute, 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
);
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'type_menu',
		'title',
		'link',
		'ordering',
		'status',
		'created_at',
	),
)); ?>
