<?php
$this->breadcrumbs=array(
	'Site Configs',
);

$this->menu=array(
	array('label'=>'Create SiteConfig', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
	array('label'=>'Manage SiteConfig', 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
?>

<h1>Site Configs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
