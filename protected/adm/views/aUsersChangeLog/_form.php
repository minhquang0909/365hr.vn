<?php
/* @var $this AUsersChangeLogController */
/* @var $model AUsersChangeLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ausers-change-log-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=Yii::t('adm/label','note_required')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_before'); ?>
		<?php echo $form->textArea($model,'data_before',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'data_before'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_after'); ?>
		<?php echo $form->textArea($model,'data_after',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'data_after'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_update'); ?>
		<?php echo $form->textField($model,'last_update'); ?>
		<?php echo $form->error($model,'last_update'); ?>
	</div>

	<div class="row buttons">
		<?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('adm/label','create') : Yii::t('adm/label','save'))); ?>
		<?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/label','reset'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->