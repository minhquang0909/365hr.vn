<div id="news">
    <div class="top_nav">
        <div class="container">
            <div class="col-md-12">
                <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'       => array(Yii::t('web/home', 'news')),
                        'separator'   => '<span class="separator">&#10095;</span>',
                        'htmlOptions' => array('class' => 'breadcrumb'),
                    ));
                ?>
            </div>
        </div>
    </div>
    <div class="grid_item">
        <div class="container">
            <div class="row-fluid">
                <div class="col-md-9 col-xs-12 no_pad">
                    <div class="space_40"></div>
                    <div class="row-fluid">
                        <?php
                        if($list_news):
                            foreach($list_news as $row):?>
                                <div class="col-md-12 col-xs-12"><h3><?= CHtml::link(CHtml::encode($row['category']->name),WNewsCategories::createUrl($row['category']->id,$row['category']->slug),array('title'=>$row['category']->name))?></h3></div>
                                <div class="space_20"></div>
                                <div class="row md_no_mar_left">
                                <?php
                                    if($row['news']){
                                        foreach($row['news'] as $news){
                                            echo $this->renderPartial('_block_item_news', array('data' => $news));
                                        }
                                    }?>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
                    <div class="col-md-12 col-xs-12 no_pad_right">
                        <div class="space_20"></div>
                        <div class="line"></div>
                    </div>
                </div>
                <div class="xs_space_20"></div>
                <div class="col-md-3 col-xs-12 xs_no_pad">
                    <div class="page_sidebar">
                        <!--Top views-->
                        <?php
                            if($news_top_views) {
                                echo $this->renderPartial('_news_top_views', array('news_top_views' => $news_top_views));
                            }
                        ?>
                        <div class="space_30"></div>
                        <!--Box ads-->
                        <?php echo $this->renderPartial('_box_ads'); ?>
                        <div class="space_30"></div>
                    </div>
                </div>
            </div>
            <div class="space_30"></div>
        </div>
    </div>
    <div class="space_60"></div>
</div>