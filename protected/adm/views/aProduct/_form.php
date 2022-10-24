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
        'enableAjaxValidation' => false,
        'htmlOptions'          => array('enctype' => 'multipart/form-data', 'multiple' => 'multiple'),
    )); ?>

    <p class="note"><?= Yii::t('adm/product', 'note_required') ?></p>

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
                    echo CHtml::image('../' . $model->folder_path, "image", array("style" => "width:120px;height:100px;", "id" => "preview"));
                } else {
                    echo CHtml::image($model->folder_path, "image", array("style" => "display:none;width:120px;height:100px;", "id" => "preview"));
                } ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'title'); ?>
                <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'title'); ?>
            </div>


            <div class="row">
                <?php echo $form->labelEx($model, 'status'); ?>
                <?php echo $form->dropDownList($model, 'status', array(1 => Yii::t('adm/product', 'active'), 0 => Yii::t('adm/product', 'inactive')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => true)), 'style' => 'width:200px')); ?>
                <?php echo $form->error($model, 'status'); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <?php echo $form->labelEx($model, 'categories_id'); ?>
                <?php echo $form->dropDownList($model, 'categories_id', AProductCategories::getListNewsCategoriesName(), array('prompt' => Yii::t('adm/product', 'select_categories'), 'class' => 'form-control', 'style' => 'width:245px;')); ?>
                <?php echo $form->error($model, 'categories_id'); ?>
            </div>

            <!-- <div class="row">
                <?php /*echo $form->labelEx($model, 'sort_order'); */ ?>
                <?php /*echo $form->textField($model, 'sort_order'); */ ?>
                <?php /*echo $form->error($model, 'sort_order'); */ ?>
            </div>-->
            <div class="row">
                <?php echo $form->labelEx($model, 'area'); ?>
                <?php echo $form->textField($model, 'area'); ?>
                <?php echo $form->error($model, 'area'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'pax'); ?>
                <?php echo $form->textField($model, 'pax'); ?>
                <?php echo $form->error($model, 'pax'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'bedroom'); ?>
                <?php echo $form->textField($model, 'bedroom'); ?>
                <?php echo $form->error($model, 'bedroom'); ?>
            </div>
            <!--<div class="row">
                <?php /*echo $form->labelEx($model, 'hot'); */ ?>
                <?php /*echo $form->dropDownList($model, 'hot', array(1 => Yii::t('adm/product','yes'), 0 => Yii::t('adm/product','no')), array('options' => array(($model->isNewRecord) ? 1 : $model->status => array('selected' => TRUE)),'style'=>'width:200px')); */ ?>
                <?php /*echo $form->error($model, 'hot'); */ ?>
            </div>-->

        </div>
    </div>

    <div class="col-md-12">
        <h3>CHỌN TIỆN ÍCH</h3>
        <div class="row">
        <div class="list_gadget">
            <?php echo $form->checkboxListGroup(
                $model,
                'created_by',
                array(
                    'widgetOptions' => array(
                        'data' => (CHtml::listData(AProductGadget::getAllGadget(),'id','name'))
                    ),
                    'inline'=>true
                )
            ); ?>
        </div>
        </div>
    </div>
    <div class="col-md-12">
        <h3>Thêm THƯ VIỆN ẢNH</h3>
        <div class="row">
            <?php echo $form->labelEx($model, 'gallery_items'); ?>
            <?php echo $form->fileField($model, 'gallery_items[]', array('size' => 60, 'maxlength' => 1000, 'multiple' => 'multiple')); ?>
            <?php echo $form->error($model, 'gallery_items'); ?>
        </div>

        <div class="row" id="multi_preview">
            <?php if (isset($_REQUEST['id'])): ?>
                <?php $gallery_items = Gallery::model()->findAll('parent_id=' . $model->id); ?>
                <?php foreach ((array)$gallery_items as $row): ?>
                    <?php
                    echo "<div>";
                    echo CHtml::image('../'.$row->folder_path, "image", array("style" => '', "id" => "preview", "class" => "thumbnail"));
                    echo "</div>";
                    ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <h3>Tuỳ chỉnh ngôn ngữ</h3>
        <?php $list_language = ALanguages::getAllLanguages(); ?>
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach ((array)$list_language as $k => $row): ?>
                    <?php $key = $row->id;
                    $title     = $row->name; ?>
                    <li role="presentation" class="<?= ($k == 0) ? 'active' : ''; ?>"><a href="#tab_lang_<?= $key ?>"
                                                                                         aria-controls="home" role="tab"
                                                                                         data-toggle="tab"><?= $title ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <?php foreach ((array)$list_language as $k => $row): ?>
                    <?php $key = $row->id; ?>
                    <div role="tabpanel" class="tab-pane <?= ($k == 0) ? 'active' : ''; ?>" id="tab_lang_<?= $key ?>">
                        <?php echo $this->renderPartial('_tab_language', array('model' => $model,  'form' => $form, 'language' => $row), true); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <div class="col-md-12 buttons">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => $model->isNewRecord ? Yii::t('adm/product', 'create') : Yii::t('adm/product', 'save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/product', 'reset'))); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php $model_name = get_class($model); ?>
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
    /*Begin Multi upload images*/
    $("#<?=$model_name;?>_gallery_items").change(function () {
        alert('fuck2');
        var ext = $('#<?=$model_name;?>_gallery_items').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
            $("#error<?=$model_name;?>__gallery_items").remove();
            $('#<?=$model_name;?>_gallery_items').after('<div class="errorMessage" id="error<?=$model_name;?>_gallery_items"><?php echo Yii::t('adm/product', 'error_file_ext') ?></div>');
        } else {
            $("#error<?=$model_name;?>_gallery_items").remove();
            $('#preview').css("display", "block");
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
    /*End Begin Multi upload images*/
</script>
<style>
    .list_gadget .checkbox-inline{
        width: 200px;
        float: left;
        text-align: left;
        margin: 5px 0 !important;
    }
    .list_gadget .checkbox-inline input{
        margin-top: -6px;
    }
</style>