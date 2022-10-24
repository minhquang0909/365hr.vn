<?php
/* @var $this AOptionGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Option Groups',
);

$this->menu=array(
	array('label'=>'Create OptionGroup', 'url'=>array('create')),
	array('label'=>'Manage OptionGroup', 'url'=>array('admin')),
);
?>

<h1>Option Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
