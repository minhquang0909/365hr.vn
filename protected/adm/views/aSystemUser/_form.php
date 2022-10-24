<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/system_user.js'); ?>
<div class="form wide">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'system-user-form',
        'enableAjaxValidation' => TRUE,
    )); ?>

    <p class="note"><?php echo Yii::t('adm/system', 'field_required'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php
            if (isset($model->username)) {
                echo $form->textField($model, 'username', array('size' => 50, 'maxlength' => 50, 'disabled' => 'disabled', 'style' => 'font-weight:bold'));
            } else {
                echo $form->textField($model, 'username', array('size' => 50, 'maxlength' => 50));
            }
        ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php
            if (isset($model->username)) {
            echo '<a class="btn btn-success" href="'.Yii::app()->createUrl('aSystemUser/changePassword',array('id'=>$model->id)).'">Đổi mật khẩu</a>';
        } else {
            echo $form->passwordField($model, 'password', array('size' => 50, 'maxlength' => 255));
            echo $form->error($model, 'password');
        ?>
    </div>
    <div class="row">
        <?php
            echo $form->labelEx($model, 'confirmPassword');
            echo $form->passwordField($model, 'confirmPassword', array('size' => 50, 'maxlength' => 255));
        ?>
    </div>
<?php } ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 50, 'maxlength' => 50)); ?>
        <span class="note"><?php echo Yii::t('adm/app', 'format_email'); ?></span>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phonenumber'); ?>
        <?php echo $form->textField($model, 'phonenumber', array('size' => 50, 'maxlength' => 50)); ?>
        <span class="note"><?php echo Yii::t('adm/app', 'format_phonnumber'); ?></span>
        <?php echo $form->error($model, 'phonenumber'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->checkbox($model, 'status'); ?>
        <span class="note"><?php echo Yii::t('adm/system', 'note_checked'); ?></span>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'group_id'); ?>
        <?php echo $form->dropDownList($model, 'group_id', CHtml::listData(SystemGroup::model()->findAll(), "id", "group_title")); ?>
        <?php echo $form->error($model, 'group_id'); ?>
    </div>
    <!--<div class="row">
        <?php /*echo $form->labelEx($model, 'cp_code'); */?>
        <?php /*echo $form->dropDownList($model, 'cp_code', CHtml::listData(Cps::model()->findAll(), "id", "cp_name")); */?>
        <?php /*echo $form->error($model, 'cp_code'); */?>
    </div>-->
    <div class="row"></div>
    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? 'Thêm mới' : 'Cập nhật')); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => 'Làm lại')); ?>
    </div>

    <?php $this->endWidget(); ?>

    <!--    change password form modal -->
    <?php $this->beginWidget('booster.widgets.TbModal', array('id' => 'myModal')); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Đổi mật khẩu</h4>
    </div>

    <div class="modal-body">
        <?php
            $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
                'id'                   => 'system-user-form-change-password',
                'enableAjaxValidation' => FALSE,
                'type'                 => 'horizontal',
            ));
        ?>
        <?php echo $form->hiddenField($model, 'id'); ?>
        <?php echo $form->label($model, 'password') ?>
        <?php echo $form->passwordField($model, 'password', array('class' => 'span3')); ?>
        <?php echo $form->label($model, 'confirmPassword') ?>
        <?php echo $form->passwordField($model, 'confirmPassword', array('class' => 'span3')); ?>
        <?php echo CHtml::tag('div', array('id' => 'display_message_area', 'class' => 'errorMessage')) ?>

        <?php $this->endWidget(); ?>
    </div>

    <div class="modal-footer">
        <?php $this->widget('booster.widgets.TbButton', array(
                'context'     => 'success',
                'label'       => 'Thay đổi',
                'url'         => '#',
                'htmlOptions' => array(
//                    'data-dismiss' => 'modal',
                    'onclick' => "ChangePassword();",
                )
            )
        ); ?>
        <?php $this->widget('booster.widgets.TbButton', array(
            'label'       => 'Kết thúc',
            'url'         => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
