<?php
    /* @var $this ANewsController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs = array(
        Yii::t('adm/news','news'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/news','manage_news'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

<h1><?=Yii::t('adm/news','news')?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView'     => '_view',
)); ?>
