<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */

    $this->breadcrumbs = array(
        Yii::t('common/Banners','banners') => array('admin'),
        $model->id,
    );

    /*$this->menu=array(
        array('label'=>'Create Banners', 'url'=>array('create')),
        array('label'=>'Update Banners', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Delete Banners', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>'Manage Banners', 'url'=>array('admin')),
    ); */
?>
<div style="float: right;"> <!--Button-->
    <?php
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/Banners','create_banner'),
                'buttonType'  => 'link',
                'url'         => array('create'),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;  margin-right: 5px;'),

            )
        );
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/Banners','update_banner'),
                'buttonType'  => 'link',
                'url'         => array('update', 'id' => $model->id),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

            )
        );
        /*$this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/Banners','delete_banner'),
                'buttonType'  => 'link',
                'url'         => array('delete', 'id' => $model->id),
                'htmlOptions' => array('style' => 'float:left;margin-right: 5px;', 'onclick' => 'return confirm("'.Yii::t('common/Banners','delete_item').'")'),
                'context'     => 'info',

            )
        );*/
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/Banners','manage_banners'),
                'buttonType'  => 'link',
                'url'         => array('admin'),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;'),

            )
        );
    ?>
</div><!--Button-->

<h1><?php echo Yii::t('common/Banners','view_banner'); echo ' #';echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'file_name',
        'file_ext',
        array(
            'name'  => 'folder_path',
            'type'  => 'raw',
            'value' => file_exists($model->folder_path) ? CHtml::image($model->folder_path, "image", array("width" => "100px", "height" => "60px", "title" => "banner " . $model->id)) : CHtml::image("../images/no_thumb.jpg", "no image", array("width" => "100px", "height" => "60px", "title" => "no image")),
        ),
        'target_link',
        array(
            'name'  => 'banner_positions_id',
            'value' => ABannerPositions::getBannerPositionName($model->banner_positions_id)
        ),
        array(
            'name'  => 'banner_sizes_id',
            'value' => ABannerSizes::getBannerSizeName($model->banner_sizes_id)
        ),
        array(
            'name'  => 'status',
            'value' => $model->status == 0 ? Yii::t('common/Banners','inactive') : Yii::t('common/Banners','active')
        ),
    ),
)); ?>
