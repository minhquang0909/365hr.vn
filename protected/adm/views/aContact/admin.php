<?php
/* @var $this AContactController */
/* @var $model AContact */

$this->breadcrumbs=array(
	'Liên hệ'=>array('admin'),
	'Quản lý',
);

?>

<h3>Quản lý liên hệ</h3>
<a class="btn btn-danger" onclick="deleteContact();">Xóa liên hệ</a>
<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'acontact-grid',
    'type'         => 'bordered condensed striped',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate'=>false,
	'columns'=>array(
		//'department_name',
        array(
            'header' => '<input type="checkbox" class="check-all" id="selectAllContact" name="selectAll"/>',
            'type'   => 'raw',
            'value'  => 'AContact::createCheckBox($data->id)',
        ),
        //'id',
		'contact_name',
		'phone',
		'email',
        'subject',
        //'conpany_name',

		/*
		'district',
		'address',
		'subject',*/
        array(
            'name'      =>  'created_date',
            'value'     =>  'date(\'Y-m-d H:i\',$data->created_date)'
        ),
		/*'content',
		'note',
		*/
        array(
            'header' => '<a href="javascript:void(0);">Trả lời nhanh</a>',
            'type'   => 'raw',
            'value'  => 'CHtml::link("Trả lời nhanh","".Yii::app()->createUrl(\'aContact/reply\', array(\'id\'=>$data->id))."", array("class"=>"btn btn-success","target"=>"_self"))',
        ),

        array(
            'class'       => 'booster.widgets.TbButtonColumn',
            'template'  =>  '{view}{delete}',
            'htmlOptions' => array('width' => '100px', 'style' => 'text-align: center;vertical-align:middle;'),
        ),
	),
)); ?>
<input type="hidden" id="csrfToken" name="<?=Yii::app()->request->csrfTokenName?>" value="<?=Yii::app()->request->csrfToken?>"/>

<script>
    $(document).ready(function () {
        //disable ajax panigation
        $(document).on("click", ".pagination a", function(e){
        });
        //

        $('#selectAllContact').click (function () {
            var checkedStatus = this.checked;
            $('#acontact-grid table tbody tr').find('td:first :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
            });
        });
    });


    function deleteContact() {
        var checkValues = $('input[name="checkContact"]:checked').map(function()
        {
            return $(this).val();
        }).get();
        var csrfToken = $('#csrfToken').val();

        $.ajax({
            url: '<?=Yii::app()->createUrl('aContact/deleteAll')?>',
            type: 'post',
            dataType:'json',
            data: { ids: checkValues ,YII_CSRF_TOKEN:csrfToken},
            success:function(res){
                if(res.status==1){
                    //$('#acontact-grid').yiiGridView('update');
                    window.location.reload();
                }else{
                    alert(res.message);
                }
            }
        });
    }
</script>

