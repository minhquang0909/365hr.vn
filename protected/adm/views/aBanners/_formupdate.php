<?php
    /* @var $this ABannersController */
    /* @var $model ABanners */
    /* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'abanners-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => FALSE,
        'htmlOptions'          => array(
            'enctype' => 'multipart/form-data'
        )
    )); ?>

    <p class="note"><?php echo Yii::t('common/Banners', 'required'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'folder_path'); ?>
        <?php echo $form->fileField($model, 'folder_path', array('size' => 60, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'folder_path'); ?>
    </div>

    <div class="row">
        <?php if (isset($_REQUEST['id']) && file_exists($model->folder_path)) {
            echo CHtml::image($model->folder_path, "image", array("style" => "width:120px;height:100px;", "id" => "preview"));
        } else {
            echo CHtml::image("../images/no_thumb.jpg", "no image", array("width" => "120px", "height" => "100px", "title" => "no image", "id" => "preview"));
        }?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'target_link'); ?>
        <?php echo $form->textField($model, 'target_link', array('size' => 35, 'maxlength' => 1000)); ?>
        <?php echo $form->error($model, 'target_link'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'banner_positions_id'); ?>
        <?php echo $form->dropDownList($model, 'banner_positions_id', ABannerPositions::itemsBannerPosition(''), array('prompt' => Yii::t('common/Banners', 'select_position'), 'class' => 'form-control', 'style' => 'width:150px !important;')); ?>
        <?php echo $form->error($model, 'banner_positions_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'banner_sizes_id'); ?>
        <?php echo $form->dropDownList($model, 'banner_sizes_id', ABannerSizes::itemsBannerSizes(''), array('prompt' => Yii::t('common/Banners', 'select_size'), 'class' => 'form-control', 'style' => 'width:150px !important;')); ?>
        <?php echo $form->error($model, 'banner_sizes_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(0 => Yii::t('common/Banners', 'inactive'), 1 => Yii::t('common/Banners', 'active')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => TRUE)))); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('common/Banners','create') : Yii::t('common/Banners','save'),'htmlOptions' => array('onclick' => 'return validatebanner()'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/actions', 'reset'))); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#ABanners_folder_path").change(function () {
        var ext = $('#ABanners_folder_path').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg']) == -1) {
            $("#errorABanners_folder_path").remove();
            $('#ABanners_folder_path').after('<div class="errorMessage" id="errorABanners_folder_path"><?php echo Yii::t('common/Banners','error_file_ext') ?></div>');
        } else {
            $("#errorABanners_folder_path").remove();
            $('#preview').css("display", "block");
            readURL(this);
        }
    });
    function validatebanner() {
        var ext = $('#ABanners_folder_path').val().split('.').pop().toLowerCase();
        if ($('#ABanners_folder_path').val() != '') {
            if ($.inArray(ext, ['jpg', 'jpeg']) == -1) {
                $("#errorABanners_folder_path").remove();
                $('#ABanners_folder_path').after('<div class="errorMessage" id="errorABanners_folder_path"><?php echo Yii::t('common/Banners','error_file_ext') ?></div>');
                return false;
            } else {
                $("#errorABanners_folder_path").remove();
                $('#preview').css("display", "block");
                readURL(this);
            }
        }
        return true;
    }
</script>