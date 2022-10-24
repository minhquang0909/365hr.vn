<?php
    /* @var $this ANewsCategoriesController */
    /* @var $model ANewsCategories */

    $this->breadcrumbs = array(
        Yii::t('adm/news','categories') => array('admin'),
        $model->name,
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => Yii::t('adm/news','update'), 'url' => array('update', 'id' => $model->id)),
        array('label' => Yii::t('adm/news','delete'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('adm/news','confirm_delete'))),
        array('label' => Yii::t('adm/news','manage_cate'), 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

<h1><?=Yii::t('adm/news','view')?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'name',
        array(
            'name'  => 'parent_id',
            'type'  => 'raw',
            'value' => $model->getNewsCategoriesName(),
        ),
        array(
            'name'  => 'folder_path',
            'type'  => 'raw',
            'value' => $model->getImageUrl(),
        ),
        'sort_order',
        array(
            'name'  => 'in_home_page',
            'type'  => 'raw',
            'value' => $model->getInHomePageLabel(),
        ),
        array(
            'name'  => 'status',
            'type'  => 'raw',
            'value' => $model->getStatusLabel(),
        ),
    ),
)); ?>
