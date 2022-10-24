<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */

    $this->breadcrumbs = array(
        Yii::t('common/Banners', 'banners') => array('admin'),
        Yii::t('common/Banners', 'manage'),
    );

    /*$this->menu = array(
        array('label' => 'Create Banners', 'url' => array('create')),
    ); */
    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label'       => Yii::t('common/Banners', 'create_banner'),
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
	$('#abanners-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

    <h3><?php echo Yii::t('common/Banners', 'manage_banners') ?></h3>

<?php //echo CHtml::link(Yii::t('common/Banners', 'advanced_search'), '#', array('class' => 'search-button')); ?>
<!--    <div class="search-form" style="display:none">-->
<!--        --><?php //$this->renderPartial('_search', array(
//            'model' => $model,
//        )); ?>
<!--    </div><!-- search-form -->

<div class="table-responsive">
<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'           => 'abanners-grid',
    'dataProvider' => $model->search(),
    'responsiveTable' => true,
    'filter'       => $model,
    'columns'      => array(
        array(
            'name'        => 'id',
            'filter'      => '<input type="hidden" name="YII_CSRF_TOKEN" value="' . Yii::app()->request->csrfToken . '">',
            'htmlOptions' => array('width' => '60px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
        array(
            'name'        => 'folder_path',
            'type'        => 'raw',
            'value'       => 'file_exists($data->folder_path) ? CHtml::image($data->folder_path,"image",array("width"=>"100px","height"=>"60px","title"=>"banner ".$data->id)) : CHtml::image("../images/no_thumb.jpg","no image",array("width"=>"100px","height"=>"60px","title"=>"no image"))',
            'htmlOptions' => array('width' => '100px'),
        ),
        array(
            'name'        => 'file_name',
            'htmlOptions' => array('width' => '210px', 'style' => 'text-align: center;word-break: break-word;'),
        ),
        /*array(
            'name'        => 'file_ext',
            'htmlOptions' => array('width' => '70px', 'style' => 'text-align: center;padding-top: 25px;'),
        ),*/
        array(
            'name'        => 'target_link',
            'htmlOptions' => array('width' => '210px', 'style' => 'text-align: center;word-break: break-word;'),
        ),
        array(
            'name'        => 'banner_positions_id',
            'type'        => 'raw',
            'value'       => 'ABannerPositions::getBannerPositionName($data->banner_positions_id)',
            'filter'=>CHtml::activeDropDownList(
                    $model,
                    'banner_positions_id',
                    CHtml::listData(ABannerPositions::getAllBannerPositions(),
                        'id','name'),
                    array('empty'=>Yii::t('common/Banners', 'all'),'class'=>'form-control')
                ),
            'htmlOptions' => array('width' => '150px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
        array(
            'name'        => 'banner_sizes_id',
            'type'        => 'raw',
            'value'       => 'ABannerSizes::getBannerSizeName($data->banner_sizes_id)',
            'filter'=>CHtml::activeDropDownList(
                $model,
                'banner_sizes_id',
                CHtml::listData(ABannerSizes::getAllBannerSizes(),
                    'id','name'),
                array('empty'=>Yii::t('common/Banners', 'all'),'class'=>'form-control')
            ),
            'htmlOptions' => array('width' => '150px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
        array(
            'name'        => 'status',
            'type'        => 'raw',
            'value'       => 'CHtml::ajaxLink(($data->status == 1) ? CHtml::image(Yii::app()->request->baseUrl."/images/icons/tick.png") : CHtml::image(Yii::app()->request->baseUrl."/images/icons/publish_x.png"),
                        "index.php?r=ABanners/active",
                        $ajaxOptions = array(
                                 "dataType"=>"json",
                                 "data"=>array(
                                       "id"=>$data->id,
                                       "status"=>$data->status,
                                 ),
                                 "success"=>"js:function(result){
                                            alert(result.msg);
                                            if (result.status == 1) {
                                                window.location.href=\'index.php?r=ABanners/admin\'
                                            }
                                         }",
                        ),
                        array("confirm"=>"' . Yii::t('common/Banners', 'change_status') . '")
                    );',
            'filter'=>CHtml::activeDropDownList(
                $model,
                'status',
                CHtml::listData(ABanners::getStatus(),
                    'id','title'),
                array('empty'=>Yii::t('common/Banners', 'all'),'class'=>'form-control')
            ),
            'htmlOptions' => array('width' => '90px', 'style' => 'text-align: center;vertical-align:middle;'),
            'visible'     => AUserPermission::checkUserPermission('aBanners', 'edit'),
        ),
        array(
            'value'       => '$data->quickView($data->id)',
            'htmlOptions' => array('width' => '70px', 'style' => 'vertical-align:middle;',),
        ),
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'=>'{view} {update}',
            'htmlOptions' => array('width' => '80px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
    ),
)); ?>
</div>
    <!--Show popup-->
<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'myModal')
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4><?php echo Yii::t('common/Banners', 'quick_view_banner') ?></h4>
    </div>

    <div id="viewbanner" class="modal-body">
    </div>

    <div class="modal-footer">
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => 'Close',
                'url'         => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>

<?php $this->endWidget(); ?>