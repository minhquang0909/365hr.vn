<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        Yii::t('adm/product','news') => array('admin'),
        Yii::t('adm/product','manage'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/product','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );

    Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#anews-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?=Yii::t('adm/product','manage_news')?></h1>

<!--<p>-->
<!--You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>-->
<!--or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.-->
<!--</p>-->
<!---->
<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">-->
<?php //$this->renderPartial('_search',array(
    //	'model'=>$model,
    //)); ?>
<!--</div>--><!-- search-form -->
<div class="table-responsive">
    <?php $this->widget('booster.widgets.TbExtendedGridView', array(
        'id'           => 'anews-grid',
        'type'         => 'bordered condensed striped',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => array(
            array(
                'name'        => 'id',
                'filter'      => '<input id="csrf" type="hidden" name="YII_CSRF_TOKEN" value="' . Yii::app()->request->csrfToken . '">',
                'htmlOptions' => array('width' => '40px', 'style' => 'text-align: center;vertical-align:middle;'),
            ),
          /*  array(
                'name'        => 'folder_path',
                'type'        => 'raw',
                'value'       => '$data->imageUrl',
                'htmlOptions' => array('width' => '100px'),
            ),*/
            array(
                'name'        => 'title',
                'htmlOptions' => array('width' => '300px', 'style' => 'word-break: break-word;vertical-align:middle;'),
            ),
            array(
                'name'        => 'categories_id',
                'type'        => 'raw',
                'value'       => '$data->newsCategoriesNameByCateId',
                'htmlOptions' => array('width' => '180px', 'style' => 'word-break: break-word;vertical-align:middle;'),
            ),
            array(
                'name'        => 'public_date',
                'htmlOptions' => array('width' => '150px', 'style' => 'word-break: break-word;text-align:center;vertical-align:middle;'),
            ),
            array(
                'name'        => 'sort_order',
                'htmlOptions' => array('width' => '90px', 'style' => 'text-align: center;vertical-align:middle;'),
            ),
            array(
                'name'        => 'views',
                'htmlOptions' => array('width' => '90px', 'style' => 'text-align: center;vertical-align:middle;'),
            ),
            array(
                'name'   => 'status',
                'filter' => FALSE,
                'type'   => 'raw',
                'value'  => function ($data) {
                    return CHtml::activeDropDownList($data, 'status',
                        array(1 => Yii::t('adm/product','active'), 0 => Yii::t('adm/product','inactive')),
                        array('class' => 'form-control',
                              'onChange' => "js:changeStatus($data->id,this.value)",
                        )
                    );
                },
                'htmlOptions' => array('width' => '130px','style' => 'text-align: center;vertical-align:middle;'),
            ),
            array(
                'class'       => 'booster.widgets.TbButtonColumn',
                'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
            ),
        ),
    )); ?>
</div>
<script language="javascript">
    function changeStatus(id, status) {
        var csrf = $("#csrf").val();
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->createUrl('ANews/changeStatus')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, 'YII_CSRF_TOKEN': csrf},
            success: function (result) {
                window.location.reload(true);
            }
        });
    }
</script>