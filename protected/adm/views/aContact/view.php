<style>
    table tr td{
        white-space: pre-wrap;
    }
</style>
<?php
/* @var $this AContactController */
/* @var $model AContact */

$this->breadcrumbs=array(
	'Liên hệ'=>array('admin'),
	$model->id,
);
$this->menu=array(
	array('label'=>'Danh sách', 'url'=>array('admin')),
);
?>
<style>
    table tr td{
        white-space: pre-wrap;
    }
</style>
<h3>Chi tiết liên hệ #<?php echo $model->id; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'conpany_name',
		'department_name',
		'contact_name',
		'phone',
		'email',
		'district',
		'address',
		'subject',
		array(
		        'name'      =>  'created_date',
                'value'     =>  ($model->created_date > 0)?date('Y-m-d H:i:s',$model->created_date):"",
        ),
        'content'
		//'note',
	),
)); ?>
