<?php
/* @var $this AQueueEmailController */
/* @var $model AQueueEmail */

$this->breadcrumbs=array(
    'Email chưa gửi'=>array('admin'),
    'Quản lý',
);
?>

<h3>Danh sách email chưa gửi</h3>

<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'aqueue-email-grid',
    'type'         => 'bordered condensed striped',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'type',
		'email',
		//'content',
        array(
            'name'      =>  'created_date',
            'value'     =>  'date(\'Y-m-d H:i\',$data->created_date)'
        ),
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'  =>  '{view}{delete}',
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
	),
)); ?>
