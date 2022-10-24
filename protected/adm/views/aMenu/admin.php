<?php
    $this->breadcrumbs = array(
        $this->modelDisplayName => array('admin'),
        Yii::t('adm/app', 'manage'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/app', 'create') . ' ' . $this->modelDisplayAttribute, 'url' => array('create'), 'linkOptions' => array('class' => 'btn_create')),
        array('label' => Yii::t('adm/app', 'manage') . ' ' . $this->modelDisplayAttribute, 'url' => array('admin'), 'linkOptions' => array('class' => 'btn_admin')),
    );

    Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#amenu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', array(
    'id'           => 'amenu-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        array(
            'header' => '#',
            'value'  => '++$row',
        ),
        array(
            'name'  => 'parent_id',
            'value' => function ($data) {
                $return = 'Không có';
                if ($data->parent_menu) {
                    $return = $data->parent_menu->title;
                }
                return $return;
            }
        ),
        array(
            'name'  => 'type_menu',
            'filter'      => CHtml::activeDropDownList($model, 'type_menu', AMenu::getType(), array('empty' => 'Tất cả', 'class' => 'form-control')),
            'value' => function ($data) {
                $return = AMenu::getType()[$data->type_menu];
                return $return;
            }
        ),
        'title',
        'link',
        'ordering',
        array(
            'name'        => 'status',
            'type'        => 'raw',
            'filter'      => CHtml::activeDropDownList($model, 'status', AMenu::getStatusList(), array('empty' => 'Tất cả', 'class' => 'form-control')),
            'value'       => function ($data) {
                $icon   = $data->status == AMenu::ACTIVE ? "<i class=\"fa fa-check-circle\"></i>" : "<i class=\"fa fa-times-circle\"></i>";
                $status = $data->status == AMenu::ACTIVE ? AMenu::INACTIVE : AMenu::ACTIVE;

                return CHtml::link($icon, "javascript:;", array(
                    'title'               => '',
                    'class'               => '',
                    'data-toggle'         => 'tooltip',
                    'data-original-title' => 'Thay đổi trạng thái',
                    'onclick'             => 'changeStatus(' . $data->id . ',' . $status . ');',
                ));

            },
            'htmlOptions' => array('nowrap' => 'nowrap', 'width' => '115', 'style' => 'text-align:center'),
        ),
        /*
        'created_at',
        */
        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 100px;text-align:center'),
        ),
    ),
)); ?>
<script>
    function changeStatus(id, status) {
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->createUrl('aMenu/changeStatus')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken?>'},
            success: function (result) {
                if (result === true) {
                    $('#amenu-grid').yiiGridView('update', {
                        data: $(this).serialize()
                    });
                    return false;
                }
            }
        });
    }
</script>
