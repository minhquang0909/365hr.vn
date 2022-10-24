<?php
/* @var $this ACommentController */
/* @var $model AComment */

$this->breadcrumbs=array(
	'Acomments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AComment', 'url'=>array('index')),
	array('label'=>'Create AComment', 'url'=>array('create')),
	array('label'=>'Update AComment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AComment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AComment', 'url'=>array('admin')),
);
?>

<h1>View AComment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fullname',
		'email',
		'content',
		'created_date',
		'note',
	),
)); ?>
