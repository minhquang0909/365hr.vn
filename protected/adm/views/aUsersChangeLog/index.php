<?php
/* @var $this AUsersChangeLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ausers Change Logs',
);

$this->menu=array(
	array('label'=>'Create AUsersChangeLog', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
	array('label'=>'Manage AUsersChangeLog', 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1>Ausers Change Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
