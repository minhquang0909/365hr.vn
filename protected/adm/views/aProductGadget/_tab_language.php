<br>
<div class="row">
    <?php echo $form->label($model,'name')?>
    <?php echo $form->textField($model, 'lang['.$language->code_name.'][name]', array('size' => 60, 'maxlength' => 255)); ?>
</div>