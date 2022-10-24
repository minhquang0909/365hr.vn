<?php
    /* @var $this ABannerPositionsController */
    /* @var $model ABannerPositions */

    $this->breadcrumbs = array(
        Yii::t('common/BannerPosition', 'banner_position') => array('admin'),
        Yii::t('common/BannerPosition', 'create_banner_position'),
    );

    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label'       => Yii::t('common/BannerPosition', 'manage_banner_position'),
            'buttonType'  => 'link',
            'url'         => array('admin'),
            'context'     => 'danger',
            'htmlOptions' => array('style' => 'float:right;'),

        )
    );
?>

    <h1><?php echo Yii::t('common/BannerPosition', 'create_banner_position'); ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>