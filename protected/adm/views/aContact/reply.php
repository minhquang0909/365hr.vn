<?php
$this->breadcrumbs=array(
    'Liên hệ'=>array('admin'),
    'Trả lời nhanh',
);

$this->menu=array(
    array('label'=>'Quản lý liên hệ', 'url'=>array('admin')),
);
?>

<div class="row"><h3>Trả lời nhanh: </h3></div>
<?php
if(isset($error) && $error!=""){?>
    <div class="alert alert-danger"><?=$error?></div>
<?php }
?>

<form class="form" method="post">
    <input type="hidden" name="<?=Yii::app()->request->csrfTokenName?>" value="<?=Yii::app()->request->csrfToken?>"/>
    <div class="row">
        <div class="col-md-8">
            <!--<div class="row">
                <label>Người nhận:</label>
                <input class="form-control" readonly value="<?/*=$model->contact_name*/?>"/>
            </div>-->
            <div class="row">
                <label class="mt-5">Email người nhận:</label>
                <input class="form-control" name="email" type="email" value="<?=isset($email)?$email:''?>"/>
            </div>
            <div class="row">
                <label class="mt-5">Tiêu đề: <span class="required">*</span></label>
                <input class="form-control" type="text" name="title" id="title" value="<?=isset($title)?$title:""?>"/>
            </div>
            <div class="row">
                <label class="mt-5">Nội dung: <span class="required">*</span></label>
                <textarea class="form-control" rows="10" id="content" name="content"><?=isset($content)?$content:""?></textarea>
            </div>
            <div class="buttons" style="margin-top: 10px;">
                <button class="btn btn-primary">Gửi tin nhắn</button>
            </div>
        </div>
    </div>
</form>