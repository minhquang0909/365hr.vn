<?php
    /* @var $this AProductGadgetController */
    /* @var $model AProductGadget */

    $this->breadcrumbs = array(
        Yii::t('adm/product_gadget','categories') => array('admin'),
        Yii::t('adm/product_gadget','create'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/product_gadget','manage_cate'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/product_gadget','create')?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>