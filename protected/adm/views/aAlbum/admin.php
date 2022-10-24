<?php
$this->breadcrumbs=array(
	$this->modelDisplayName=>array('admin'),
	Yii::t('adm/app','manage'),
);

$this->menu=array(
	array('label'=>Yii::t('adm/app','create').' '.$this->modelDisplayAttribute, 'url'=>array('create'), 'linkOptions' => array('class' => 'btn_create')),
	array('label'=>Yii::t('adm/app','manage').' '.$this->modelDisplayAttribute, 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
);

?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'aalbum-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		'header' => '#',
		'value'  => '++$row',
		),
		'desc',
		'title',
        array(
            'name'   => 'status',
            'filter' => FALSE,
            'type'   => 'raw',
            'value'  => function ($data) {
                if($data==1){
                    $txt = Yii::t('adm/news','active');
                }else{
                    $txt = Yii::t('adm/news','inactive');
                }
                return $txt;
            }
        ),
        array(
            'header' => 'Tổng số ảnh',
            'value'  => function($data){
                $return = AGallery::model()->count('album_id='.$data->id);
                return $return;
            },
        ),
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'  =>  '{delete}',
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
	),
)); ?>
