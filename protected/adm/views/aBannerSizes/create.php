<?php
    /* @var $this ABannerSizesController */
    /* @var $model ABannerSizes */

    $this->breadcrumbs = array(
        Yii::t('common/BannerSizes', 'banner_sizes') => array('admin'),
        Yii::t('common/BannerSizes','create_banner_size'),
    );

    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label'       => Yii::t('common/BannerSizes', 'manage_banner_sizes'),
            'buttonType'  => 'link',
            'url'         => array('admin'),
            'context'     => 'danger',
            'htmlOptions' => array('style' => 'float:right;'),

        )
    );
?>

    <h1><?php echo Yii::t('common/BannerSizes','create_banner_size'); ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>