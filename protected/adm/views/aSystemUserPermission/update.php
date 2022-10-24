<?php
    $this->breadcrumbs = array(
        'Bsystem User Permissions' => array('index'),
        $model->id                 => array('view', 'id' => $model->id),
        'Update',
    );

    $this->menu = array(
        array('label' => 'List BSystemUserPermission', 'url' => array('index')),
        array('label' => 'Create BSystemUserPermission', 'url' => array('create')),
        array('label' => 'View BSystemUserPermission', 'url' => array('view', 'id' => $model->id)),
        array('label' => 'Manage BSystemUserPermission', 'url' => array('admin')),
    );
?>

    <h1>Update BSystemUserPermission <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>