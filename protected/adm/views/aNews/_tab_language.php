<br>
<div class="row">
    <?php echo $form->label($model,'title')?>
    <?php echo $form->textField($model, 'lang['.$language->code_name.'][title]', array('size' => 60, 'maxlength' => 255)); ?></div>
<div class="row">
    <?php echo $form->labelEx($model, 'short_des'); ?>
    <?php echo $form->textArea($model, 'lang['.$language->code_name.'][short_des]', array('maxlength' => 500, 'rows' => 6, 'cols' => 100, 'style' => "width:100%")); ?>
    <?php echo $form->error($model, 'short_des'); ?>
</div>
<div class="row">
<div class="col-md-12">
    <?php echo $form->labelEx($model, 'full_des'); ?>
    <?php
        echo $form->ckEditorGroup(
            $model,
            'lang['.$language->code_name.'][full_des]',
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