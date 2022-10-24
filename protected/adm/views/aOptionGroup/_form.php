<?php
/* @var $this AOptionGroupController */
/* @var $model OptionGroup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'option-group-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort_order'); ?>
		<?php echo $form->textField($model,'sort_order',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'sort_order'); ?>
	</div>

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('adm/news','create') : Yii::t('adm/news','save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/news','reset'))); ?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->