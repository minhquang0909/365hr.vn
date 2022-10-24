<?php
    $this->breadcrumbs = array(
        'Bsystem User Permissions' => array('index'),
        'Create',
    );

    $this->menu = array(
        array('label' => 'List BSystemUserPermission', 'url' => array('index')),
        array('label' => 'Manage BSystemUserPermission', 'url' => array('admin')),
    );
?>

    <h1>Create BSystemUserPermission</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>