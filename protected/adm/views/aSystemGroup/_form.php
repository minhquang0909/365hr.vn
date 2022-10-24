<div class="form wide">

    <?php $form = $this->beginWidget('CActiveForm', array(
//	'id'=>'bsystem-group-form',
        'id'                   => 'asystemgroup-form',
        'enableAjaxValidation' => FALSE,
    )); ?>

    <p class="note"><?php echo Yii::t('adm/system', 'field_required'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'group_title'); ?>
        <?php echo $form->textField($model, 'group_title', array('size' => 30, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'group_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'group_desc'); ?>
        <?php echo $form->textArea($model, 'group_desc', array('rows' => 4, 'cols' => 35)); ?>
        <?php echo $form->error($model, 'group_desc'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', $model->getStatusOptions()); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>
    <!--
	<div class="row">
		<?php echo $form->labelEx($model, 'created_date'); ?>
		<?php echo $form->textField($model, 'created_date'); ?>
		<?php echo $form->error($model, 'created_date'); ?>
	</div>
-->
    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('adm/system', 'submit') : Yii::t('adm/system', 'save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/system', 'reset'))); ?>    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->