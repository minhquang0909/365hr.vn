<?php
    /* @var $this ANewsController */
    /* @var $model ANews */
    /* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'short_des'); ?>
        <?php echo $form->textField($model, 'short_des', array('size' => 60, 'maxlength' => 500)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'full_des'); ?>
        <?php echo $form->textArea($model, 'full_des', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'folder_path'); ?>
        <?php echo $form->textField($model, 'folder_path', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'created_date'); ?>
        <?php echo $form->textField($model, 'created_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'updated_date'); ?>
        <?php echo $form->textField($model, 'updated_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->textField($model, 'status'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->