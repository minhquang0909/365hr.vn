<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-config-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'config_key'); ?>
		<?php echo $form->textField($model,'config_key',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'config_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'config_value'); ?>
		<?php echo $form->textArea($model,'config_value',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'config_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ordering'); ?>
		<?php echo $form->textField($model,'ordering'); ?>
		<?php echo $form->error($model,'ordering'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Tạo mới' : 'Lưu lại'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->