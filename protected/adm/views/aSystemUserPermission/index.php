<?php
    $this->breadcrumbs = array(
        'Bsystem User Permissions',
    );

    $this->menu = array(
        array('label' => 'Create BSystemUserPermission', 'url' => array('create')),
        array('label' => 'Manage BSystemUserPermission', 'url' => array('admin')),
    );
?>

<h1>Bsystem User Permissions</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView'     => '_view',
)); ?>
