<?php
/* @var $this AOptionController */
/* @var $model Option */

$this->breadcrumbs=array(
	'Tùy chọn'=>array('admin'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'Tạo mới', 'url'=>array('create')),
);
?>

<h1>Quản lý tùy chọn</h1>

<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'option-grid',
    'type'         => 'bordered condensed striped',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
        array(
            'name'   => 'key',
            'filter'    =>  false,
            'value' =>  '$data->key',
        ),
        array(
            'name'   => 'value',
            'htmlOptions' => array('style' => 'width:200px;'),
            'value' =>  function($data){
                if(trim($data->key)=='email_password'){
                    return '******';
                }else{
                    return $data->value;
                }
            }
        ),
		//'edit_type',
        array(
            'name'   => 'group_id',
            'value'  => '$data->category->title',
            'filter' => CHtml::listData(OptionGroup::model()->findAll(), 'id', 'title'),
        ),
		'sort_order',
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'    => '{update} {delete}',
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
	),
)); ?>
