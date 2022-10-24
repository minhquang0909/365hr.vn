<?php $this->beginContent('//layouts/main'); ?>
    <div id="function">
        <fieldset style="margin-left: 10px;margin-bottom: 5px;">
            <?php
                $this->widget('zii.widgets.CMenu', array(
                    //'itemTemplate'=>'<span>{menu}</span>',
                    'items'            => $this->menu,
                    'linkLabelWrapper' => 'span',
                    'htmlOptions'      => array('class' => 'operations'),
                ));
                //$this->endWidget();
            ?>
        </fieldset>
    </div><!-- function -->
    <div id="content">
        <?php echo $content; ?>
    </div><!-- content -->
<?php $this->endContent(); ?>