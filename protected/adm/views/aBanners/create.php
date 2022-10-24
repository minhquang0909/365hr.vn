<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */

    $this->breadcrumbs = array(
        Yii::t('common/Banners', 'banners') => array('admin'),
        Yii::t('common/Banners', 'create_banner'),
    );

    /*$this->menu=array(
        array('label'=>'Manage Banners', 'url'=>array('admin')),
    );*/
    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label'       => Yii::t('common/Banners', 'manage_banners'),
            'buttonType'  => 'link',
            'url'         => array('admin'),
            'context'     => 'danger',
            'htmlOptions' => array('style' => 'float:right;'),

        )
    );
?>

    <h1><?php echo Yii::t('common/Banners', 'create_banner'); ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>