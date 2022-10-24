<?php
    /* @var $this ANewsCategoriesController */
    /* @var $model ANewsCategories */

    $this->breadcrumbs = array(
        'Danh mục câu hỏi' => array('admin'),
        Yii::t('adm/news','manage'),
    );

    $this->menu = array(
        array('label' => Yii::t('adm/news','create'), 'url' => array('create'), 'linkOptions' => array('class' => 'btn btn-danger')),
    );

?>

<h1>Quản lý danh mục câu hỏi</h1>

<div class="table-responsive">
    <?php $this->widget('booster.widgets.TbExtendedGridView', array(
        'id'           => 'anews-categories-grid',
        'type'         => 'bordered condensed striped',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => array(
            array(
                'name'        => 'id',
                'filter'      => '<input id="csrf" type="hidden" name="YII_CSRF_TOKEN" value="' . Yii::app()->request->csrfToken . '">',
                'htmlOptions' => array('width' => '40px', 'style' => 'text-align: center;vertical-align:middle;'),
            ),
      /*      array(
                'name'        => 'folder_path',
                'type'        => 'raw',
                'value'       => '$data->imageUrl',
                'htmlOptions' => array('width' => '100px'),
            ),*/
            array(
                'name'        => 'name',
                'htmlOptions' => array('width' => '300px', 'style' => 'word-break: break-word;vertical-align:middle;'),
            ),
            array(
                'name'        => 'parent_id',
                'type'        => 'raw',
                'value'       => '$data->newsCategoriesName',
                'htmlOptions' => array('width' => '300px', 'style' => 'text-align: center;word-break: break-word;vertical-align:middle;'),
            ),
            array(
                'name'        => 'sort_order',
                'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;word-break: break-word;vertical-align:middle;'),
            ),
            /*array(
                'name'        => 'in_home_page',
                'value'       => '$data->inHomePageLabel',
                'htmlOptions' => array('width' => '150px', 'style' => 'text-align: center;word-break: break-word;vertical-align:middle;'),
            ),*/
            array(
                'name'   => 'status',
                'filter' => FALSE,
                'type'   => 'raw',
                'value'  => function ($data) {
                    return CHtml::activeDropDownList($data, 'status',
                        array(1 => Yii::t('adm/news','active'), 0 => Yii::t('adm/news','inactive')),
                        array('class' => 'form-control',
                              'onChange' => "js:changeStatus($data->id,this.value)",
                        )
                    );
                },
                'htmlOptions' => array('width' => '130px','style' => 'text-align: center;vertical-align:middle;'),
            ),
            array(
                'class'       => 'booster.widgets.TbButtonColumn',
                'template'  =>  '{update}{delete}',
                'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
            ),
        ),
    )); ?>
</div>
<script language="javascript">
    function changeStatus(id, status) {
        var csrf = $("#csrf").val();
        $.ajax({
            type: "POST",
            url: '<?=Yii::app()->createUrl('aQACategories/changeStatus')?>',
            crossDomain: true,
            dataType: 'json',
            data: {id: id, status: status, 'YII_CSRF_TOKEN': csrf},
            success: function (result) {
                window.location.reload(true);
            }
        });
    }
</script>