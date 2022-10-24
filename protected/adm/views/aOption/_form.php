<?php
/* @var $this AOptionController */
/* @var $model Option */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'option-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <div class="col-md-6">
            <div class="row">
                <?php echo $form->labelEx($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'title'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'key'); ?>
                <?php echo $form->textField($model,'key',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'key'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'edit_type'); ?>
                <?php echo $form->dropDownList($model, 'edit_type', CHtml::listData(array(
                    array(
                        'id'    =>  'text',
                        'name'    =>  'text',
                    ),array(
                        'id'    =>  'textarea',
                        'name'    =>  'textarea',
                    )
                ), "id", "name"), array('class' => 'form-control disabled')); ?>
                <?php echo $form->error($model, 'edit_type'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model,'value'); ?>
                <?php
                if($model->key=='email_password'){
                    echo $form->passwordField($model,'value',array('size'=>60));
                }else {
                    if (!$model->isNewRecord) {
                        if ($model->edit_type == 'text') {
                            ?>
                            <?php echo $form->textField($model, 'value', array('size' => 60)); ?>
                        <?php } else {  //textarea
                            ?>
                            <?php echo $form->textArea($model, 'value', array('size' => 60)); ?>
                        <?php }
                    }
                }
                ?>
                <?php echo $form->error($model,'key'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'group_id'); ?>
                <?php echo $form->dropDownList($model, 'group_id', CHtml::listData(OptionGroup::model()->findAll(), "id", "title"), array('class' => 'form-control')); ?>
                <?php echo $form->error($model,'group_id'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'sort_order'); ?>
                <?php echo $form->textField($model,'sort_order'); ?>
                <?php echo $form->error($model,'sort_order'); ?>
            </div>

            <div class="row buttons">
                <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('adm/news','create') : Yii::t('adm/news','save'))); ?>
                <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/news','reset'))); ?>
            </div>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->