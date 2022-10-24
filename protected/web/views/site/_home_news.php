<?php
$list_news = WNews::getList(0,6);
$list_news = isset($list_news['list_news'])?$list_news['list_news']:array();
?>
<section data-aos="fade-up" class="post-wrapper mt30 aos-init aos-animate">
    <div class="container">
        <div class="gf-heading">
            <h2 class="heading-title accent-color"><?=Yii::t('web/app','news')?></h2>
        </div>
    </div>
    <div class="container clearfix">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="blog-grid2">
                    <div class="post-list">
                        <?php
                        if(isset($list_news) && is_array($list_news) && count($list_news) > 0){
                            $count=0;
                            foreach ($list_news as $news){
                                $count++;
                                $this->renderPartial('/news/_item', array(
                                    'count'  =>  $count,
                                    'news'  =>  $news,
                                ));
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt30">
            <a class="button" href="<?=Yii::app()->createUrl('news/index')?>"><?=Yii::t('web/app','view_more')?></a>
        </div>
    </div>
</section>