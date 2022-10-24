<?php
/* @var $this ACommentController */
/* @var $model AComment */

$this->breadcrumbs=array(
	'Acomments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AComment', 'url'=>array('index')),
	array('label'=>'Create AComment', 'url'=>array('create')),
	array('label'=>'View AComment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AComment', 'url'=>array('admin')),
);
?>

<h1>Update AComment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>