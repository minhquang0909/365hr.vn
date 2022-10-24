<?php
    $this->breadcrumbs=array(
        $this->modelDisplayName=>array('admin'),
        Yii::t('adm/app','create'),
    );

    $this->menu=array(
        array('label'=>Yii::t('adm/app','manage').' '.$this->modelDisplayAttribute, 'url'=>array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
    );
?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>