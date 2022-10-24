<?php
    $this->breadcrumbs = array(
        'Bsystem User Permissions' => array('index'),
        'Manage',
    );

    $this->menu = array(
        array('label' => 'List BSystemUserPermission', 'url' => array('index')),
        array('label' => 'Create BSystemUserPermission', 'url' => array('create')),
    );

    Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bsystem-user-permission-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bsystem User Permissions</h1>

<p>
    <?php echo Yii::t('app', 'information_option_search'); ?>
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'           => 'bsystem-user-permission-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        'id',
        'controller',
        'user_id',
        'permission',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>
