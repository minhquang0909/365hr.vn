<br>
<div class="row">
    <?php echo $form->label($model,'question')?>
    <?php echo $form->textField($model, 'lang['.$language->code_name.'][question]', array('size' => 60, 'maxlength' => 255)); ?>
</div>
<div class="row">
    <?php echo $form->label($model,'short_desc')?>
    <?php echo $form->textField($model, 'lang['.$language->code_name.'][short_desc]', array('size' => 60, 'maxlength' => 500)); ?>
</div>
<div class="row">
<div class="col-md-12">
    <?php echo $form->labelEx($model, 'answer'); ?>
    <?php
        echo $form->ckEditorGroup(
            $model,
            'lang['.$language->code_name.'][answer]',
            array(
                'wrapperHtmlOptions' => array(
                    'class' => 'col-sm-12',
                ),
                'widgetOptions'      => array(
                    'editorOptions' => array(
                        'fullpage'                  => 'js:true',
                        'width'                     => '100%',
                        'height'                     => '800',
                        'resize_maxWidth'           => '100%',
                        'resize_minWidth'           => '320',
                        'filebrowserImageBrowseUrl' => '../vendors/kcfinder/browse.php?type=images',
                    )
                ),
            )
        );
    ?>
</div>
</div>