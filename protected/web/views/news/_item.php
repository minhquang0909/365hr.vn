<?php
$timestamp = CFunction::convertDateTimeToTimestamp($news['created_date']);
//$timestamp2 = CFunction::convertDateTimeToTimestamp($news['updated_date']);
$tmp_time = 7 * 86400;  //7 ngày
$current_time = time();
if(($timestamp + $tmp_time) >= $current_time){
$icon_hot = '<span class="icon-hot">New</span>';
}else{
$icon_hot = '';
}
?>
<a class="post-item" href="<?=Yii::app()->createUrl('news/detail',array('id'=>$news['id']))?>">
    <div class="row">
        <div class="col-md-2">
            <div class="post-time"><?=date('Y.m.d', $timestamp)?></div>
        </div>
        <div class="col-md-10">
            <div class="post-content">
                <div class="post-title"><?=$icon_hot?><?=$news['title']?></div>
                <!-- <div class="post-desc"><?/*=$news['short_des']*/?></div>-->
            </div>
        </div>
    </div>
</a>