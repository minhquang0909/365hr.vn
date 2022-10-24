<?php
    /* @var $this ANewsController */
    /* @var $model ANews */

    $this->breadcrumbs = array(
        Yii::t('adm/news','news') => array('admin'),
        $model->title,
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/news','update'), 'url' => array('update', 'id' => $model->id)),
        array('label' => Yii::t('adm/news','delete'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('adm/news','confirm_delete'))),
        array('label' => Yii::t('adm/news','manage_news'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

<h2><?=Yii::t('adm/news','view')?> #<?php echo $model->title; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'title',
        'short_des',
        array(
            'name'  => 'folder_path',
            'type'  => 'raw',
            'value' => $model->getImageUrl(),
        ),
        'created_date',
        'updated_date',
        'sort_order',
        'views',
        array(
            'name'  => 'status',
            'type'  => 'raw',
            'value' => $model->getStatusLabel(),
        ),
    ),
)); ?>
