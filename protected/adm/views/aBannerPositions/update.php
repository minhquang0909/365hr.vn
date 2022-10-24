<?php
    /* @var $this ABannerPositionsController */
    /* @var $model ABannerPositions */

    $this->breadcrumbs = array(
        Yii::t('common/BannerPosition', 'banner_position') => array('admin'),
        $model->id       => array('view', 'id' => $model->id),
        Yii::t('common/BannerPosition', 'update_banner_position'),
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
                    'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

                )
            );
            $this->widget(
                'booster.widgets.TbButton',
                array(
                    'label'       => Yii::t('common/BannerPosition', 'view_banner_position'),
                    'buttonType'  => 'link',
                    'url'         => array('view', 'id' => $model->id),
                    'context'     => 'danger',
                    'htmlOptions' => array('style' => 'float:left;margin-right: 5px;'),

                )
            );
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
    </div>  <!--Button-->

    <h1><?php echo Yii::t('common/BannerPosition', 'update_banner_position'); echo ' '; echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>