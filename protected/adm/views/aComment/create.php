<?php
/* @var $this ACommentController */
/* @var $model AComment */

$this->breadcrumbs=array(
	'Acomments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AComment', 'url'=>array('index')),
	array('label'=>'Manage AComment', 'url'=>array('admin')),
);
?>

<h1>Create AComment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>