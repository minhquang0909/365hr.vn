<?php
    /* @var $this ABannerPositionsController */
    /* @var $model ABannerPositions */
    /* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'abanner-positions-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
    )); ?>

    <p class="note"><?php echo Yii::t('common/BannerPosition','required'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 40, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'code_name'); ?>
        <?php echo $form->textField($model, 'code_name', array('size' => 40, 'maxlength' => 300)); ?>
        <?php echo $form->error($model, 'code_name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php
            echo $form->dropDownList($model, 'status', array(0 => Yii::t('common/BannerPosition','inactive'), 1 => Yii::t('common/BannerPosition','active')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => TRUE))));
        ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('common/BannerPosition','create') : Yii::t('common/BannerPosition','save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/actions', 'reset'))); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->