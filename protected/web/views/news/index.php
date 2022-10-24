<?php
$this->renderPartial('/news/_top_banner', array(
    'title' =>  Yii::t('web/app','blogs')
));
?>
<div class="container clearfix mt50">
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
    <div>
       <?=$pagination?>
    </div>
</div>