<?php
/* @var $this ABannersController */
/* @var $model ABanners */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'file_name'); ?>
		<?php echo $form->textField($model,'file_name',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'file_ext'); ?>
		<?php echo $form->textField($model,'file_ext',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'folder_path'); ?>
		<?php echo $form->textField($model,'folder_path',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'target_link'); ?>
		<?php echo $form->textField($model,'target_link',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'banner_positions_id'); ?>
		<?php echo $form->textField($model,'banner_positions_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'banner_sizes_id'); ?>
		<?php echo $form->textField($model,'banner_sizes_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('common/Banners','search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->