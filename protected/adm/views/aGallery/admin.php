<?php
$this->breadcrumbs=array(
	$this->modelDisplayName=>array('admin'),
	Yii::t('adm/app','manage'),
);

$this->menu=array(
	array('label'=>'Tạo mới ảnh', 'url'=>array('create'), 'linkOptions' => array('class' => 'btn_create')),
);

?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'agallery-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		'header' => '#',
		'value'  => '++$row',
		),
        array(
            'header' => 'Ảnh',
            'type'=>'html',
            'value'  => function($data){
                $return = CHtml::image('../'.$data->folder_path,$data->title,array('width'=>200));
                echo $return;
            },
            'htmlOptions' => array('width' => '220px', 'style' => 'word-break: break-word;vertical-align:middle;'),
        ),
        array(
            'name' => 'title',
            'value'  => function($data){
                $return = (trim($data->title)=='')?'':$data->title;
                echo $return;
            },
        ),
		'target_link',

        array(
            'name'        => 'album_id',
            'filter'      => CHtml::activeDropDownList($model, 'album_id', AAlbum::getListCategoriesName(), array('empty' => 'Tất cả', 'class' => 'form-control')),
            'type'        => 'raw',
            'value'       => '$data->newsCategoriesNameByCateId',
            'htmlOptions' => array('width' => '180px', 'style' => 'word-break: break-word;vertical-align:middle;'),
        ),
        array(
            'name'        => 'parent_id',
            'type'        => 'raw',
            'value'       => '$data->newsProductNameByCateId',
            'htmlOptions' => array('width' => '180px', 'style' => 'word-break: break-word;vertical-align:middle;'),
        ),
        'created_time',
		/*
		'album_id',
		'parent_id',
		*/
	array(
	'class'       => 'booster.widgets.TbButtonColumn',
	'template'  =>  '{update}{delete}',
	'htmlOptions' => array('style' => 'width: 100px;text-align:center'),
	),
	),
)); ?>
