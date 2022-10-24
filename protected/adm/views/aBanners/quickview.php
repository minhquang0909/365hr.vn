<style>
    .modal-open {
        overflow: visible;!important;
    }
</style>
<?php
/* @var $this ABannersController */
/* @var $model ABanners */
?>
<div class="row quickview_img">
    <div class="col-md-10 col-md-offset-1 col-xs-12">
        <?php echo CHtml::image($model->folder_path, $model->file_name, array("class"=>"img-responsive","style" => "width:500px;height:270px;"));?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="quickview_text"><span><?php  echo Yii::t('common/Banners','file_name');?>: </span><?php echo $model->file_name; ?></div>
        <div class="quickview_text"><span><?php  echo Yii::t('common/Banners','banner_positions_id');?>: </span><?php echo ABannerPositions::getBannerPositionName($model->banner_positions_id); ?></div>
    </div>
    <div class="col-md-6">
        <div class="quickview_text"><span><?php  echo Yii::t('common/Banners','target_link');?>: </span><?php echo $model->target_link; ?></div>
        <div class="quickview_text"><span><?php  echo Yii::t('common/Banners','banner_sizes_id'); ?>: </span><?php echo ABannerSizes::getBannerSizeName($model->banner_sizes_id); ?></div>
    </div>
</div>