<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>
    <div class="row">
        <?php echo $form->label($model, 'group_title'); ?>
        <?php echo $form->textField($model, 'group_title', array('size' => 61, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'group_desc'); ?>
        <?php echo $form->textArea($model, 'group_desc', array('rows' => 3, 'cols' => 46)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php //echo $form->dropDownList($model,'status',$model->getStatusOptions()); ?>
        <?php //echo $form->textField($model,'status'); ?>
        <?php //echo $form->textField($model,'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(0 => Yii::t('adm/app', 'disable'), 1 => Yii::t('adm/app', 'Enable')), array('prompt' => '(Chọn...)')); ?>
    </div>

    <div style="float: left;">
        <div class="row">
            <?php echo $form->label($model, 'from'); ?>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker', array(
                    'model'       => $model, //Model object
                    'language'    => '',
                    'attribute'   => 'from', //attribute name
                    'mode'        => 'datetime', //use "time","date" or "datetime" (default)
                    'options'     => array(), // jquery plugin options
                    'htmlOptions' => array(
                        'dateFormat' => 'Y-m-d H:i',
                        'style'      => 'width:125px;vertical-align:top;',
                        'value'      => date("m/d/Y H:i", $model->from),
                    ),
                ));
            ?>
        </div>
    </div>

    <div style="float: left;">
        <div class="row">
            <?php echo $form->label($model, 'to'); ?>
            <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                $this->widget('CJuiDateTimePicker', array(
                    'model'       => $model, //Model object
                    'language'    => '',
                    'attribute'   => 'to', //attribute name
                    'mode'        => 'datetime', //use "time","date" or "datetime" (default)
                    'options'     => array(), // jquery plugin options
                    'htmlOptions' => array(
                        'dateFormat' => 'Y-m-d H:i',
                        'style'      => 'width:125px;vertical-align:top;',
                        'value'      => date("m/d/Y H:i", $model->to),
                    ),
                ));
            ?>
        </div>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('adm/app', 'search'), array('class' => 'search')); ?>
        <?php echo CHtml::resetButton(Yii::t('adm/app', 'reset'), array('class' => 'back')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->