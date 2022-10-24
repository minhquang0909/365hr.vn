<?php
    /* @var $this ANewsController */
    /* @var $model ANews */
    /* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'                   => 'anews-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => FALSE,
        'htmlOptions'          => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note"><?=Yii::t('adm/product','note_required')?></p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <?php echo $form->labelEx($model, 'file'); ?>
                <?php echo $form->fileField($model, 'file'); ?>
                <?php echo $form->error($model, 'file'); ?>
            </div>
            <div class="row">
                <?php if (isset($_REQUEST['id'])) {
                    echo CHtml::image('../'.$model->folder_path, "image", array("style" => "width:120px;height:100px;", "id" => "preview"));
                } else {
                    echo CHtml::image($model->folder_path, "image", array("style" => "display:none;width:120px;height:100px;", "id" => "preview"));
                }?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'title'); ?>
                <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'title'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'short_des'); ?>
                <?php echo $form->textArea($model, 'short_des', array('maxlength' => 500, 'rows' => 6, 'cols' => 62)); ?>
                <?php echo $form->error($model, 'short_des'); ?>
            </div>
            <div class="row">
                <label>Tags</label>
                <?php $this->widget(
                    'booster.widgets.TbSelect2',
                    array(
                        'asDropDownList' => false,
                        'name' => 'tags_name',
                        'options' => array(
                            'tags' => ATags::getAllTagsName(),
                            'placeholder' => Yii::t('adm/product','placeholder_tags'),
                            'width' => '83%',
                            'tokenSeparators' => array(',')
                        )
                    )
                );?>
                <div style="margin: 10px 0;">
                    <label><?=Yii::t('adm/product','tags_selected')?></label>
                    <?php
                        echo ($tags_news)? CHtml::encode($tags_news):'<span class="hint">'.Yii::t("adm/news","no_select").'</span>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <?php echo $form->labelEx($model, 'categories_id'); ?>
                <?php echo $form->dropDownList($model, 'categories_id', AProductCategories::getListNewsCategoriesName(), array('prompt' => Yii::t('adm/product','select_categories'), 'class' => 'form-control', 'style' => 'width:245px;')); ?>
                <?php echo $form->error($model, 'categories_id'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'public_date'); ?>
                <?php
                    $this->widget(
                        'booster.widgets.TbDatePicker',
                        array(
                            'model' => $model,
                            'attribute' => 'public_date',
                            'options' => array(
                                'language' => 'en'
                            ),
                            'htmlOptions' => array(),
                        )
                    );
                ?>
                <?php echo $form->error($model, 'public_date'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'sort_order'); ?>
                <?php echo $form->textField($model, 'sort_order'); ?>
                <?php echo $form->error($model, 'sort_order'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'views'); ?>
                <?php echo $form->textField($model, 'views'); ?>
                <?php echo $form->error($model, 'views'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'hot'); ?>
                <?php echo $form->dropDownList($model, 'hot', array(1 => Yii::t('adm/product','yes'), 0 => Yii::t('adm/product','no')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => TRUE)),'style'=>'width:200px')); ?>
                <?php echo $form->error($model, 'hot'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo $form->dropDownList($model, 'status', array(1 => Yii::t('adm/product','active'), 0 => Yii::t('adm/product','inactive')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => TRUE)),'style'=>'width:200px')); ?>
                <?php echo $form->error($model, 'status'); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <?php
            echo $form->ckEditorGroup(
                $model,
                'full_des',
                array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-12',
                    ),
                    'widgetOptions'      => array(
                        'editorOptions' => array(
                            'fullpage'                  => 'js:true',
                            'width'                     => '100%',
                            'resize_maxWidth'           => '100%',
                            'resize_minWidth'           => '320',
                            'filebrowserImageBrowseUrl' => '../vendors/kcfinder/browse.php?type=images',
                        )
                    )
                )
            );
        ?>
    </div>
    <div class="col-md-12 buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('adm/product','create') : Yii::t('adm/product','save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/product','reset'))); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#ANews_file").change(function () {
        var ext = $('#ANews_file').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
            $("#errorANews_file").remove();
            $('#ANews_file').after('<div class="errorMessage" id="errorANews_file"><?php echo Yii::t('adm/product','error_file_ext') ?></div>');
        } else {
            $("#errorANews_file").remove();
            $('#preview').css("display", "block");
            readURL(this);
        }
    });
</script>