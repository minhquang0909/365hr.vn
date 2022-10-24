<?php
/* @var $this AFileController */
/* @var $model AFile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'afile-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions'          => array('enctype' => 'multipart/form-data', 'multiple' => 'multiple'),
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'path'); ?>
        <input size="60" maxlength="255" accept="application/msword, application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-powerpoint,text/plain, application/pdf" name="file" id="file" type="file">
        <?php
        if(!$model->isNewRecord){
            $file_link = '../uploads/files/'.$model->path;
            ?>
            <p>File đã tạo: <a target="_blank" href="<?=$file_link?>"><?php echo $model->path; ?></a></p>
        <?php }
        ?>
        <?php echo $form->error($model, 'path'); ?>
    </div>


    <div class="row buttons" style="clear: both">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'icon' => 'ok', 'label' => $model->isNewRecord ? Yii::t('adm/app', 'create') : Yii::t('adm/app', 'save'), 'context' => 'primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->