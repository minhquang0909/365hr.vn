<?php $this->beginContent('//layouts/main'); ?>

    <div class="span-6 last col-md-2 col-xs-12 no_pad">
        <div id="sidebar">
            <fieldset>
                <?php
                    $this->beginWidget('zii.widgets.CPortlet',
                        array('title' => Yii::t('adm/common', 'operations'),)
                    );
                    $this->widget('booster.widgets.TbMenu', array(
                        //'itemTemplate'=>'<span>{menu}</span>',
                        'items'       => $this->menu,
//                        'type'  => 'list',
//                        'linkLabelWrapper' => 'span',
                        'htmlOptions' => array('class' => 'operations'),
                    ));
                    $this->endWidget();
                ?>
            </fieldset>
        </div>
        <!-- sidebar -->

    </div>
    <div class="span-22 col-md-10 col-xs-12">
        <fieldset>
            <div id="content">
                <?php echo $content; ?>
            </div>
            <!-- content -->
        </fieldset>
    </div>
<?php $this->endContent(); ?>