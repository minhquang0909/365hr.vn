<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<?php
$text_default = 'なし';
$two_dots= '<b>&#65306;</b>';
?>

<p>お問合わせいただいた方へ自動返信しております。</p>
<p><?=isset($model->contact_name)?($model->contact_name."様"):""?></p>
<p>
    この度はイ・ジン・ザイにお問合わせいただき、<br>
    誠にありがとうございます。<br>
    以下の内容で承りましたのでご確認ください。<br>
</p>
<h3>お問合わせ内容</h3>

<table>
    <tr>
        <td><?=Yii::t('web/app','conpany_name')?><?=$two_dots?></td>
        <td><?=isset($model->conpany_name)?$model->conpany_name:$text_default?></td>
    </tr>
    <tr>
        <td><?=Yii::t('web/app','department_name')?><?=$two_dots?></td>
        <td><?=isset($model->department_name)?$model->department_name:$text_default?></td>
    </tr>
    <tr>
        <td><?=Yii::t('web/app','contact_name')?><?=$two_dots?></td>
        <td><?=isset($model->contact_name)?$model->contact_name:$text_default?></td>
    </tr>
    <tr>
        <td><?=Yii::t('web/app','phone')?><?=$two_dots?></td>
        <td><?=isset($model->phone)?$model->phone:$text_default?></td>
    </tr>
    <tr>
        <td><?=Yii::t('web/app','email')?><?=$two_dots?></td>
        <td><?=isset($model->email)?$model->email:$text_default?></td>
    </tr>
    <tr>
        <td><?=Yii::t('web/app','district')?><?=$two_dots?></td>
        <td><?=isset($model->district)?$model->district:$text_default?></td>
    </tr>
    <tr>
        <td><?=Yii::t('web/app','address')?><?=$two_dots?></td>
        <td><?=isset($model->address)?$model->address:$text_default?></td>
    </tr>
    <tr>
        <td><?=Yii::t('web/app','subject')?><?=$two_dots?></td>
        <td><?=isset($model->subject)?$model->subject:$text_default?></td>
    </tr>
    <tr>
        <td colspan="2" class=""><?=Yii::t('web/app','content')?><?=$two_dots?></td>
    </tr>
    <tr>
        <td colspan="2" style="white-space: pre-wrap;"><?=isset($model->content)?$model->content:$text_default?></td>
    </tr>
    <tr>
        <td>【 個人情報保護方針 】</td>
        <td>同意する</td>
    </tr>
</table>
