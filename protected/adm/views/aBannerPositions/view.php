<?php
    /* @var $this ABannerPositionsController */
    /* @var $model ABannerPositions */

    $this->breadcrumbs = array(
        Yii::t('common/BannerPosition', 'banner_position') => array('admin'),
        $model->name,
    );
?>
<div style="float: right;"> <!--Button-->
    <?php
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/BannerPosition', 'create_banner_position'),
                'buttonType'  => 'link',
                'url'         => array('create'),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;  margin-right: 5px;'),

            )
        );
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/BannerPosition', 'update_banner_position'),
                'buttonType'  => 'link',
                'url'         => array('update', 'id' => $model->id),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

            )
        );
        /*$this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/BannerPosition', 'delete_banner_position'),
                'buttonType'  => 'link',
                'url'         => array('delete', 'id' => $model->id),
                'htmlOptions' => array('style' => 'float:left;margin-right: 5px;', 'onclick' => 'return confirm("'.Yii::t('common/BannerPosition','delete_item').'")'),
                'context'     => 'info',

            )
        );*/
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label'       => Yii::t('common/BannerPosition', 'manage_banner_position'),
                'buttonType'  => 'link',
                'url'         => array('admin'),
                'context'     => 'danger',
                'htmlOptions' => array('style' => 'float:left;'),

            )
        );
    ?>
</div><!--Button-->

<h1><?php echo Yii::t('common/BannerPosition','view_banner_position'); echo ' #';echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'name',
        'code_name',
        array(
            'name'  => 'status',
            'value' => $model->status == 0 ? Yii::t('common/BannerPosition', 'inactive') : Yii::t('common/BannerPosition', 'active')
        ),
    ),
)); ?>
