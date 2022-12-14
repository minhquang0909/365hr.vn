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

    <p class="note"><?=Yii::t('adm/news','note_required')?></p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-6">
            <!--<div class="row">
                <?php /*echo $form->labelEx($model, 'file'); */?>
                <?php /*echo $form->fileField($model, 'file'); */?>
                <?php /*echo $form->error($model, 'file'); */?>
            </div>-->
            <div class="row">
                <?php if (isset($_REQUEST['id'])) {
                    if($model->folder_path!="") {
                        echo CHtml::image('../' . $model->folder_path, "image", array("style" => "width:120px;height:100px;", "id" => "preview"));
                    }
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
                <?php echo $form->labelEx($model, 'categories_id'); ?>
                <?php echo $form->dropDownList($model, 'categories_id', ANewsCategories::getListNewsCategoriesName(), array('prompt' => Yii::t('adm/news','select_categories'), 'class' => 'form-control', 'style' => 'width:245px;')); ?>
                <?php echo $form->error($model, 'categories_id'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <?php
            if(!$model->isNewRecord){?>
                <div class="row">
                    <?php echo $form->labelEx($model, 'public_date'); ?>
                    <?php
                    $this->widget(
                        'booster.widgets.TbDatePicker',
                        array(
                            'model' => $model,
                            'attribute' => 'public_date',
                            'options' => array(
                                'format'=> "yyyy-mm-dd",
                                'language' => 'vi',

                            ),
                            'htmlOptions' => array(),
                        )
                    );
                    ?>
                    <?php echo $form->error($model, 'public_date'); ?>
                </div>
            <?php }
            ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo $form->dropDownList($model, 'status', array(1 => Yii::t('adm/news','active'), 0 => Yii::t('adm/news','inactive')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => TRUE)),'style'=>'width:200px')); ?>
                <?php echo $form->error($model, 'status'); ?>
            </div>
           <!-- <div class="row">
                <?php /*echo $form->labelEx($model, 'sort_order'); */?>
                <?php /*echo $form->textField($model, 'sort_order'); */?>
                <?php /*echo $form->error($model, 'sort_order'); */?>
            </div>-->
           <!-- <div class="row">
                <?php /*echo $form->labelEx($model, 'views'); */?>
                <?php /*echo $form->textField($model, 'views'); */?>
                <?php /*echo $form->error($model, 'views'); */?>
            </div>-->

        </div>
    </div>
    <div class="col-md-12">
        <h3>Tu??? ch???nh ng??n ng???</h3>
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
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('adm/news','create') : Yii::t('adm/news','save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/news','reset'))); ?>
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
            $('#ANews_file').after('<div class="errorMessage" id="errorANews_file"><?php echo Yii::t('adm/news','error_file_ext') ?></div>');
        } else {
            $("#errorANews_file").remove();
            $('#preview').css("display", "block");
            readURL(this);
        }
    });
</script>