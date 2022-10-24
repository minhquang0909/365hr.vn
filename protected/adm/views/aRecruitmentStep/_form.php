<?php
    /* @var $this ANewsController */
    /* @var $model ANews */
    /* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'                   => 'arecruitmentstep-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions'          => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note"><?= Yii::t('adm/static_page', 'note_required') ?></p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <?php echo $form->labelEx($model, 'question'); ?>
                <?php echo $form->textField($model, 'question', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'question'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo $form->dropDownList($model, 'status', array(1 => Yii::t('adm/static_page', 'active'), 0 => Yii::t('adm/static_page', 'inactive')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => true)), 'style' => 'width:200px')); ?>
                <?php echo $form->error($model, 'status'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'sort_order'); ?>
                <?php echo $form->textField($model, 'sort_order'); ?>
                <?php echo $form->error($model, 'sort_order'); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <h3>Tuỳ chỉnh ngôn ngữ</h3>
        <?php $list_language = ALanguages::getAllLanguages();?>
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach ((array)$list_language as $k=>$row):?>
                    <?php  $key = $row->id;$title= $row->name;?>
                    <li role="presentation" class="<?=($k==0)?'active':'';?>"><a href="#tab_lang_<?=$key?>" aria-controls="home" role="tab" data-toggle="tab"><?=$title?></a></li>
                <?php endforeach;?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ((array)$list_language as $k=>$row):?>
                    <?php  $key = $row->id;?>
                    <div role="tabpanel" class="tab-pane <?=($k==0)?'active':'';?>" id="tab_lang_<?=$key?>">
                        <?php echo $this->renderPartial('_tab_language', array('model' => $model,'form'=>$form, 'language' => $row), TRUE);?>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>

    <div class="col-md-12 buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('adm/static_page', 'create') : Yii::t('adm/static_page', 'save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/static_page', 'reset'))); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->