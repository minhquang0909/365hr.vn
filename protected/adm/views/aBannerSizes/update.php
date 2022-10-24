<?php
    /* @var $this ABannerSizesController */
    /* @var $model ABannerSizes */

    $this->breadcrumbs = array(
        Yii::t('common/BannerSizes', 'banner_sizes') => array('admin'),
        $model->id                                 => array('view', 'id' => $model->id),
        Yii::t('common/BannerSizes', 'update_banner_size'),
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
                    'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

                )
            );
            $this->widget(
                'booster.widgets.TbButton',
                array(
                    'label'       => Yii::t('common/BannerSizes', 'view_banner_size'),
                    'buttonType'  => 'link',
                    'url'         => array('view', 'id' => $model->id),
                    'context'     => 'danger',
                    'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

                )
            );
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
    </div>  <!--Button-->

    <h1><?php echo Yii::t('common/BannerSizes', 'update_banner_size');
            echo ' ';
            echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>