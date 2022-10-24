<?php
/* @var $this ACommentController */
/* @var $model AComment */

$this->breadcrumbs=array(
	'Bình luận'=>array('admin'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'Bình luận', 'url'=>array('admin')),
);

?>

<h3>Danh sách bình luận</h3>

<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'acomment-grid',
    'type'         => 'bordered condensed striped',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'fullname',
		'email',
        array(
            'name'   => 'content',
            'type'   => 'html',
            'value'  => '$data->content',
            'htmlOptions' => array('class' => 'text-left new-line'),
        ),
        array(
            'name'   => 'news_id',
            'filter' => FALSE,
            'type'   => 'html',
            'value'  => function ($data) {
                return "<a href='".str_replace('/adm','',Yii::app()->createAbsoluteUrl('news/detail',array('id'=>$data->news_id)))."' target='_blank'>$data->news_id</a>";
            },
            'htmlOptions' => array('width' => '130px','style' => 'text-align: center;vertical-align:middle;'),
        ),
		array(
		        'name'      =>  'created_date',
                'value'     =>  'date(\'Y-m-d H:i\',$data->created_date)'
        ),
        array(
            'name'   => 'status',
            'filter' => FALSE,
            'type'   => 'raw',
            'value'  => function ($data) {
                return CHtml::activeDropDownList($data, 'status',
                    array(1 => Yii::t('adm/news','active'), 0 => Yii::t('adm/news','inactive')),
                    array('class' => 'form-control',
                        'onChange' => "js:changeStatus($data->id,this.value)",
                    )
                );
            },
            'htmlOptions' => array('width' => '130px','style' => 'text-align: center;vertical-align:middle;'),
        ),
		//'note',
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'  =>  '{delete}',
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
	),
)); ?>

<input id="csrf" type="hidden" name="<?=Yii::app()->request->csrfTokenName ?>" value="<?=Yii::app()->request->csrfToken ?>">

<script language="javascript">
    function changeStatus(id, status) {
        var csrf = $("#csrf").val();
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->createUrl('aComment/changeStatus')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, 'YII_CSRF_TOKEN': csrf},
            success: function (result) {
                window.location.reload(true);
            }
        });
    }
</script>
