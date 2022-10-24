<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bsystemgroup.js'); ?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'                   => 'bsystem-group-form',
        'enableAjaxValidation' => FALSE,
        'action'               => $this->createUrl('permission') //create URL
    )); ?>

    <?php
        $this->widget('booster.widgets.TbGridView', array(
            'type'         => 'bordered condensed striped',
            'dataProvider' => $arrayDataProvider,
            'columns'      => array(
                array(
                    'name'  => Yii::t('adm/system', 'lbl_controller'),
                    'type'  => 'html',
                    'value' => Yii::t('adm/controller', 'CHtml::encode($data["name"])')
                ),
                array(
                    'name'  => Yii::t('adm/system', 'lbl_description'),
                    'value' => 'ASystemGroup::getDescriptionController($data["name"])',
                ),
                array(
                    'name'        => Yii::t('adm/system', 'lbl_view'),
                    'value'       => 'CHtml::checkBox($data["name"]."[]",$data["permission"]["view"],array("value"=>"view","id"=>"view_id_".$data["name"]))',
                    'type'        => 'raw',
                    'htmlOptions' => array('width' => 5),
                ),
                array(
                    'name'        => Yii::t('adm/system', 'lbl_publish'),
                    'value'       => 'CHtml::checkBox($data["name"]."[]",$data["permission"]["publish"],array("value"=>"publish","id"=>"publish_id_".$data["name"]))',
                    'type'        => 'raw',
                    'htmlOptions' => array('width' => 5),
                ),
                array(
                    'name'        => Yii::t('adm/system', 'lbl_add'),
                    'value'       => 'CHtml::checkBox($data["name"]."[]",$data["permission"]["add"],array("value"=>"add","id"=>"add_id_".$data["name"]))',
                    'type'        => 'raw',
                    'htmlOptions' => array('width' => 5),
                ),
                array(
                    'name'        => Yii::t('adm/system', 'lbl_edit'),
                    'value'       => 'CHtml::checkBox($data["name"]."[]",$data["permission"]["edit"],array("value"=>"edit","id"=>"edit_id_".$data["name"]))',
                    'type'        => 'raw',
                    'htmlOptions' => array('width' => 5),
                ),
                array(
                    'name'        => Yii::t('adm/system', 'lbl_del'),
                    'value'       => 'CHtml::checkBox($data["name"]."[]",$data["permission"]["del"],array("value"=>"del","id"=>"del_id_".$data["name"]))',
                    'type'        => 'raw',
                    'htmlOptions' => array('width' => 5),
                ),
                array(
                    'name'        => Yii::t('adm/system', 'lbl_all'),
                    'value'       => 'CHtml::checkBox("all_id[]",null,array("value"=>$data["name"],"id"=>"all_id_".$data["name"],"onchange"=>"selectAllPermission(this);"))',
                    'type'        => 'raw',
                    'htmlOptions' => array('width' => 5),
                ),
            ),
        ));
    ?>
    <div class="row buttons">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'context' => 'primary', 'icon' => 'ok white', 'label' => Yii::t('adm/system', 'save'))); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'icon' => 'remove', 'label' => Yii::t('adm/system', 'reset'))); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->