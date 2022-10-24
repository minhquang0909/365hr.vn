<?php
    /* @var $this AUsersChangeLogController */
    /* @var $model AUsersChangeLog */

    $this->breadcrumbs = array(
        Yii::t('adm/user', 'users_change_log') => array('admin'),
        Yii::t('adm/label', 'manage'),
    );
?>

<h1><?= Yii::t('adm/user', 'manage_users_change_log') ?></h1>

<?php $this->widget('booster.widgets.TbExtendedGridView', array(
    'id'           => 'ausers-change-log-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        'id',
        array(
            'name'        => 'user_id',
            'value'       => '$data->userNameByUserId',
            'htmlOptions' => array('width' => '200px', 'style' => 'word-break: break-word;vertical-align:middle;'),
        ),
        'data_before',
        'data_after',
        'last_update',
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'    => '{view}',
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
    ),
)); ?>
