<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'bsystem-user-permission-form',
        'enableAjaxValidation' => FALSE,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'controller'); ?>
        <?php echo $form->textField($model, 'controller', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'controller'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'permission'); ?>
        <?php echo $form->textArea($model, 'permission', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'permission'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->