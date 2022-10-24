<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'amenu-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    )); ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
        <?php echo $form->dropDownList($model, 'parent_id', AMenu::model()->findAll('parent_id=0'), array('prompt' => Yii::t('adm/news', 'select_categories'), 'class' => 'form-control', 'options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'type_menu'); ?>
                <?php echo $form->dropDownList($model, 'type_menu', AMenu::getType(), array('class' => 'form-control', 'options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => true)))); ?>
                <?php echo $form->error($model, 'type_menu'); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'link'); ?>
        <?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'link'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'ordering'); ?>
        <?php echo $form->textField($model, 'ordering'); ?>
        <?php echo $form->error($model, 'ordering'); ?>
    </div>

    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo $form->dropDownList($model, 'status', AMenu::getStatusList(), array('class' => 'form-control', 'options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => true)))); ?>
                <?php echo $form->error($model, 'status'); ?>
            </div>
        </div>
    </div>
    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'icon' => 'ok', 'label' => $model->isNewRecord ? Yii::t('adm/app', 'create') : Yii::t('adm/app', 'save'), 'context' => 'primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->