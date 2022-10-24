<?php
    /* @var $this ABannerSizesController */
    /* @var $model ABannerSizes */

    $this->breadcrumbs = array(
        Yii::t('common/BannerSizes', 'banner_sizes') => array('admin'),
        $model->name,
    );
?>
<div style="float: right;"> <!--Button-->
    <?php
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/BannerSizes', 'create_banner_size'),
                'buttonType'  => 'link',
                'url'         => array('create'),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;  margin-right: 5px;'),

            )
        );
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/BannerSizes', 'update_banner_size'),
                'buttonType'  => 'link',
                'url'         => array('update', 'id' => $model->id),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

            )
        );
        /*$this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/BannerSizes', 'delete_banner_size'),
                'buttonType'  => 'link',
                'url'         => array('delete', 'id' => $model->id),
                'htmlOptions' => array('style' => 'float:left;margin-right: 5px;', 'onclick' => 'return confirm("'.Yii::t('common/BannerSizes','delete_item').'")'),
                'context'     => 'info',

            )
        );*/
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/BannerSizes', 'manage_banner_sizes'),
                'buttonType'  => 'link',
                'url'         => array('admin'),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;'),

            )
        );
    ?>
</div><!--Button-->

<h1><?php echo Yii::t('common/BannerSizes','view_banner_size'); echo ' #';echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'name',
        'width',
        'height',
        array(
            'name'  => 'status',
            'value' => $model->status == 0 ? Yii::t('common/BannerSizes', 'inactive') : Yii::t('common/BannerSizes', 'active')
        ),
    ),
)); ?>
