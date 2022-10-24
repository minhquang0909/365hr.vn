<?php
/* @var $this ABannerSizesController */
/* @var $model ABannerSizes */

$this->breadcrumbs=array(
    Yii::t('common/BannerSizes','banner_sizes')=>array('admin'),
    Yii::t('common/BannerSizes','manage'),
);

    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label'       => Yii::t('common/BannerSizes','create_banner_size'),
            'buttonType'  => 'link',
            'url'         => array('create'),
            'context'     => 'danger',
            'htmlOptions' => array('style' => 'float:right;'),
        )
    );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#abanner-sizes-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><?php echo Yii::t('common/BannerSizes','manage_banner_sizes') ?></h3>
<?php //echo CHtml::link(Yii::t('common/BannerSizes','advanced_search'),'#',array('class'=>'search-button')); ?>
<!--<div class="search-form" style="display:none">-->
<?php //$this->renderPartial('_search',array(
//	'model'=>$model,
//)); ?>
<!--</div><!-- search-form -->
<div class="table-responsive">
<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'abanner-sizes-grid',
	'dataProvider'=>$model->search(),
    'responsiveTable' => true,
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'   => 'id',
            'filter' => '<input type="hidden" name="YII_CSRF_TOKEN" value="' . Yii::app()->request->csrfToken . '">',
            'htmlOptions' => array('width' => '100px'),
        ),
        array(
            'name'   => 'name',
            'htmlOptions' => array('width' => '400px'),
        ),
        array(
            'name'   => 'width',
            'htmlOptions' => array('width' => '100px'),
        ),
        array(
            'name'   => 'height',
            'htmlOptions' => array('width' => '100px'),
        ),
        array(
            'name'   => 'status',
            'type'   => 'raw',
            'value'=>'CHtml::ajaxLink(($data->status == 1) ? CHtml::image(Yii::app()->request->baseUrl."/images/icons/tick.png") : CHtml::image(Yii::app()->request->baseUrl."/images/icons/publish_x.png"),
                        "index.php?r=ABannerSizes/active",
                        $ajaxOptions = array(
                                 "dataType"=>"json",
                                 "data"=>array(
                                       "id"=>$data->id,
                                       "status"=>$data->status,
                                 ),
                                 "success"=>"js:function(result){
                                            alert(result.msg);
                                            if (result.status == 1) {
                                                window.location.href=\'index.php?r=ABannerSizes/admin\'
                                            }
                                         }",
                        ),
                        array("confirm"=>"'.Yii::t('common/BannerSizes','change_status').'")
                    );',
            'filter'=>CHtml::activeDropDownList(
                $model,
                'status',
                CHtml::listData(ABanners::getStatus(),
                    'id','title'),
                array('empty'=>Yii::t('common/Banners', 'all'),'class'=>'form-control')
            ),
            'htmlOptions' => array('width' => '120px','style' => 'text-align: center;'),
            'visible' => AUserPermission::checkUserPermission('BannerSizes', 'edit'),
        ),
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'=>'{view} {update}',
            'htmlOptions' => array('width' => '70px'),
        ),
	),
)); ?>
</div>
