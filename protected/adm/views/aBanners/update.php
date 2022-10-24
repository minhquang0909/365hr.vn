<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */

    $this->breadcrumbs = array(
        Yii::t('common/Banners','banners') => array('admin'),
        $model->id => array('view', 'id' => $model->id),
        Yii::t('common/Banners','update_banner'),
    );

    /*$this->menu = array(
        array('label' => 'Create Banners', 'url' => array('create')),
        array('label' => 'View Banners', 'url' => array('view', 'id' => $model->id)),
        array('label' => 'Manage Banners', 'url' => array('admin')),
    ); */
    ?>
    <div style="float: right;"> <!--Button-->
    <?php
    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => Yii::t('common/Banners','create_banner'),
            'buttonType'=>'link',
            'url' => array('create'),
            'context' => 'danger',
            'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

        )
    );
    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => Yii::t('common/Banners','view_banner'),
            'buttonType'=>'link',
            'url' => array('view','id'=>$model->id),
            'context' => 'danger',
            'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

        )
    );
    $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => Yii::t('common/Banners','manage_banners'),
            'buttonType'=>'link',
            'url' => array('admin'),
            'context' => 'danger',
            'htmlOptions' => array('style' => 'float:left;'),

        )
    );
?>
    </div>  <!--Button-->

    <h1><?php echo Yii::t('common/Banners','update_banner'); echo " "; echo $model->id; ?></h1>

<?php $this->renderPartial('_formupdate', array('model' => $model)); ?>