<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'aalbum-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textField($model,'desc',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(1 => Yii::t('adm/news','active'), 0 => Yii::t('adm/news','inactive')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => TRUE)),'style'=>'width:200px')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>


	<div class="row buttons">
		<?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'icon' => 'ok', 'label' => $model->isNewRecord ? Yii::t('adm/app', 'create') : Yii::t('adm/app', 'save'), 'context' => 'primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->