<?php
/* @var $this ACommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Acomments',
);

$this->menu=array(
	array('label'=>'Create AComment', 'url'=>array('create')),
	array('label'=>'Manage AComment', 'url'=>array('admin')),
);
?>

<h1>Acomments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
