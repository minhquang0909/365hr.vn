<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php //echo $form->textField($model,'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(0 => Yii::t('adm/app', 'disable'), 1 => Yii::t('adm/app', 'Enable')), array('prompt' => '(Chọn...)')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'phonenumber'); ?>
        <?php echo $form->textField($model, 'phonenumber'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'group_id'); ?>
        <?php //echo $form->textField($model,'group_id'); ?>
        <?php echo $form->dropDownList($model, 'group_id', CHtml::listData(SystemGroup::model()->findAll(), "id", "group_title"), array('prompt' => '--Chọn nhóm--')); ?>
    </div>
    <input type="hidden" id="csrf" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('adm/app', 'search'), array('class' => 'search')); ?>
        <?php echo CHtml::resetButton(Yii::t('adm/app', 'reset'), array('class' => 'back')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->