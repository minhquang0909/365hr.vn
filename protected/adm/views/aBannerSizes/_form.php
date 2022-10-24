<?php
/* @var $this ABannerSizesController */
/* @var $model ABannerSizes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'abanner-sizes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('common/BannerSizes','required'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width'); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array(0 => Yii::t('common/BannerSizes','inactive'), 1 => Yii::t('common/BannerSizes','active')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => true)))); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

<!--	<div class="row buttons">-->
<!--		--><?php //echo CHtml::submitButton($model->isNewRecord ? Yii::t('common/BannerSizes','create') : Yii::t('common/BannerSizes','save')); ?>
<!--	</div>-->

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('common/BannerSizes','create') : Yii::t('common/BannerSizes','save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/actions', 'reset'))); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->