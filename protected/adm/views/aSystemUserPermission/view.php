<?php
    $this->breadcrumbs = array(
        'Bsystem User Permissions' => array('index'),
        $model->id,
    );

    $this->menu = array(
        array('label' => 'List BSystemUserPermission', 'url' => array('index')),
        array('label' => 'Create BSystemUserPermission', 'url' => array('create')),
        array('label' => 'Update BSystemUserPermission', 'url' => array('update', 'id' => $model->id)),
        array('label' => 'Delete BSystemUserPermission', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage BSystemUserPermission', 'url' => array('admin')),
    );
?>

<h1>View BSystemUserPermission #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'controller',
        'user_id',
        'permission',
    ),
)); ?>
