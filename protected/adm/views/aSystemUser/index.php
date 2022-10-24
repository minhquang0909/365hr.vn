<?php
    $this->breadcrumbs = array(
        Yii::t('app', 'manage_sysuser'),
    );

    $this->menu = array(
        array('label' => Yii::t('app', 'create_sysuser'), 'url' => array('create')),
        array('label' => Yii::t('app', 'manage_sysuser'), 'url' => array('admin')),
    );
?>

<h3><?php echo Yii::t('app', 'manage_sysuser'); ?></h3>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView'     => '_view',
)); ?>
