<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'agallery-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions'          => array('enctype' => 'multipart/form-data', 'multiple' => 'multiple'),
    )); ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    <div class="col col-xs-6">
        <div class="row">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 500)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'gallery_items'); ?>
            <?php echo $form->fileField($model, 'gallery_items[]', array('size' => 60, 'maxlength' => 1000, 'multiple' => 'multiple')); ?>
            <?php echo $form->error($model, 'gallery_items'); ?>
        </div>
        <div class="row" id="multi_preview">
            <?php if (isset($_REQUEST['id'])) {
                echo CHtml::image('../' . $model->folder_path, "image", array("style" => "width:120px;height:100px;", "id" => "preview"));
            } else {
                echo CHtml::image($model->folder_path, "image", array("style" => "display:none;width:120px;height:100px;", "id" => "preview"));
            } ?>
        </div>


        <div class="row">
            <?php echo $form->labelEx($model, 'target_link'); ?>
            <?php echo $form->textField($model, 'target_link', array('size' => 60, 'maxlength' => 1000)); ?>
            <?php echo $form->error($model, 'target_link'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'album_id'); ?>
            <?php echo $form->dropDownList($model, 'album_id', AAlbum::getListCategoriesName(), array('prompt' => Yii::t('adm/album', 'select_categories'), 'class' => 'form-control', 'style' => 'width:480px;')); ?>
            <?php echo $form->error($model, 'album_id'); ?>
        </div>
    </div>
    <div class="col col-xs-6">
        <?php if (isset($_REQUEST['id'])) {
            echo CHtml::link(CHtml::image('../' . $model->folder_path, "image", array("style" => "width:100%;height:auto", "id" => "")), '../' . $model->folder_path, array('target' => '_blank'));
        } ?>
    </div>


    <div class="row buttons" style="clear: both">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'icon' => 'ok', 'label' => $model->isNewRecord ? Yii::t('adm/app', 'create') : Yii::t('adm/app', 'save'), 'context' => 'primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php $model_name = get_class($model); ?>
<script>
    /*Begin Multi upload images*/
    $("#<?=$model_name;?>_gallery_items").change(function () {
        var ext = $('#<?=$model_name;?>_gallery_items').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {

            $('#<?=$model_name;?>_gallery_items').after('<div class="errorMessage" id="error<?=$model_name;?>_gallery_items"><?php echo Yii::t('adm/product', 'error_file_ext') ?></div>');
        } else {
            $("#error<?=$model_name;?>_gallery_items").remove();
            $('#multi_preview').css("display", "block");
            readURL_multi(this);
        }
    });
    function readURL_multi(input) {
        //Check File API support
        if (input.files) {
            var files = input.files; //FileList object
            var output = document.getElementById("multi_preview");
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                //Only pics
                if (!file.type.match('image')) continue;

                var picReader = new FileReader();
                picReader.onload = function (e) {
                    var picFile = event.target;
                    var div = document.createElement("div");
                    div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" + "title='" + picFile.name + "'/>";
                    output.insertBefore(div, null);
                }
                //Read the image
                picReader.readAsDataURL(file);
            }
        } else {
            console.log("Your browser does not support File API");
        }
    }
</script>