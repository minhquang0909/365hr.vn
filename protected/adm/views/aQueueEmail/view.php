<?php
$this->breadcrumbs=array(
    'Email chưa gửi'=>array('admin'),
    "Chi tiết",
);

$this->menu=array(
    array('label' => 'Quản lý', 'url' => array('admin'), 'linkOptions' => array('class' => 'btn btn-danger')),
);
$content = CJSON::decode($model->content);
?>

<h3>Chi tiết email chưa gửi</h3>

<table class="table table-bordered table-condensed">
    <tbody>
        <tr class="odd">
            <th>ID</th>
            <td class="text-left"><?=$model->id?></td>
        </tr>
        <tr class="even">
            <th>Email nhận</th>
            <td class="text-left"><?=$model->email?></td>
        </tr>
        <tr class="odd">
            <th>Tiêu đề email</th>
            <td class="text-left"><?=$content['title']?></td>
        </tr>
        <tr class="even">
            <th>Ngày tạo</th>
            <td class="text-left"><?=date('Y-m-d H:i',$model->created_date)?></td>
        </tr>
        <tr class="odd">
            <th>Nội dung email</th>
            <td class="text-left"><?=$content['body']?></td>
        </tr>
    </tbody>
</table>
<!--
<h5>Nội dung email:</h5>
<div><?/*=$content['body']*/?></div>
-->