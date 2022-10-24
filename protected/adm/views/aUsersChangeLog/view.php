<?php
/* @var $this AUsersChangeLogController */
/* @var $model AUsersChangeLog */

$this->breadcrumbs=array(
    Yii::t('adm/user', 'users_change_log')=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('adm/user', 'manage_users_change_log'), 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1><?=Yii::t('adm/label', 'view')?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'data_before',
		'data_after',
		'last_update',
	),
)); ?>
