<?php
    $this->breadcrumbs = array(
        Yii::t('app', 'mnu_system_group'),
    );

    $this->menu = array(
        array('label' => Yii::t('group', 'mnu_create'), 'url' => array('create')),
        array('label' => Yii::t('group', 'mnu_admin'), 'url' => array('admin')),
    );
?>

<h1><?php echo Yii::t('group', 'lbl_index_title'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView'     => '_view',
)); ?>
