<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'news_comment_form',
    'enableAjaxValidation' => false,
    'action' => $this->createUrl('news/detail',array('id'=>$news_id,'#'=>'post_form')),
    'htmlOptions' => array(
        'class' => 'form'
    ),
));
?>
<?php /*echo $form->errorSummary($modelComment); */?>
<div class="row">
    <div class="col-md-6">
        <?php echo $form->labelEx($modelComment, 'fullname'); ?>
        <?php echo $form->textField($modelComment, 'fullname', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($modelComment,'fullname'); ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->labelEx($modelComment, 'email'); ?>
        <?php echo $form->textField($modelComment, 'email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($modelComment,'email'); ?>
    </div>
</div>
<div class="row2" style="margin-top: 10px;">
    <?php echo $form->labelEx($modelComment, 'content'); ?>
    <?php echo $form->textArea($modelComment, 'content', array('class' => 'form-control new-line', 'rows' => 6, 'style' => 'min-width: 100%')); ?>
    <?php echo $form->error($modelComment,'content'); ?>
</div>
<div class="row btn-comment-post">
    <input type="submit" name="commit" value="<?= Yii::t('web/app', 'comment') ?>" class="button" />
</div>
<?php $this->endWidget(); ?>
