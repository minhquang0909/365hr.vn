<?php
    /* @var $this AProductGadgetController */
    /* @var $model AProductGadget */

    $this->breadcrumbs = array(
        Yii::t('adm/product_gadget','categories') => array('admin'),
        $model->name      => array('view', 'id' => $model->id),
        Yii::t('adm/product_gadget','update'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/product_gadget','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/product_gadget','view'), 'url' => array('view', 'id' => $model->id)),
        array('label' => Yii::t('adm/product_gadget','manage_cate'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

    <h1><?=Yii::t('adm/product_gadget','update')?>: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>