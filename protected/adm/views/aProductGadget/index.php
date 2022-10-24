<?php
    /* @var $this AProductGadgetController */
    /* @var $dataProvider CActiveDataProvider */

    $this->breadcrumbs = array(
        'News Categories',
    );

    $this->menu = array(
        array('label' => 'Create News Categories', 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
        array('label' => 'Manage News Categories', 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );
?>

<h1>News Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView'     => '_view',
)); ?>
