<div class="news_sidebar">
    <div class="space_20"></div>
    <div class="col-md-12 col-xs-12">
        <div class="font_17"><?= Yii::t('web/home', 'top_views') ?></div>
        <div class="line_2"></div>
    </div>
    <div class="space_20"></div>
    <div class="col-md-12 col-xs-12 md_no_pad_right">
    <?php

    if($news_top_views):
        foreach($news_top_views as $news):
    ?>
        <div class="item">
            <div class="col-lg-4 col-md-4 thumbnail">
                <?=CHtml::link(CHtml::image(Yii::app()->request->baseUrl . '/' .$news['folder_path'], $news['title'], array()),WNews::createUrl($news['id'],$news['slug']),array('title'=>$news['title']));?>
            </div>
            <div class="title_sidebar col-lg-8 col-md-8 no_pad">
                <?=CHtml::link('<span>'.CHtml::encode($news['title']).'</span>',WNews::model()->createUrl($news['id'],$news['slug']),array('title'=>$news['title']));?>
            </div>
        </div>
        <div class="space_5"></div>
        <?php endforeach;?>
    <?php endif;?>
    </div>
</div>