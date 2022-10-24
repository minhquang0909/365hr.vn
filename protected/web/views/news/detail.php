<?php
$public_date = CFunction::convertDateTimeToTimestamp($news['public_date']);
$news_id = $news['id'];
?>
<div class="container gf-post-detail">
    <div class="row post">
        <h3 class="mt50 mb10 accent-color">​​​​​​​<?= isset($newsData['title']) ? $newsData['title'] : "" ?></h3>
        <div class="gf-post-detail">
            <ul class="gf-post-meta list-inline">
                <li class="meta-date"><?= date('Y.m.d', $public_date) ?></li>
                <li><?= isset($news['comment_count']) ? $news['comment_count'] : "0" ?> comments</li>
            </ul>
            <!--<img class="post-image mb10" src="/uploads/post/image/1/123.jpeg">-->
            <div class="clearfix gf-entry-content">
                <?= isset($newsData['full_des']) ? $newsData['full_des'] : "" ?>
            </div>

            <div class="recent-posts mt30">
                <h3 class="ml15 accent-color"><?= Yii::t('web/app', 'related_news') ?></h3>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="blog-grid2">
                            <div class="post-list">
                                <?php
                                if (isset($news_related) && is_array($news_related) && count($news_related) > 0) {
                                    $count = 0;
                                    foreach ($news_related as $news) {
                                        $count++;
                                        $this->renderPartial('/news/_item', array(
                                            'count' => $count,
                                            'news' => $news,
                                        ));
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="comment-wrapper">
                <?php
                if(isset($list_comment) && is_array($list_comment) && count($list_comment) > 0){?>
                    <h3 class="accent-color"><?= Yii::t('web/app', 'comment') ?></h3>
                    <?php foreach ($list_comment as $c){
                        if($c['created_date'] > 0){
                            $ctime = date('Y.m.d',$c['created_date']).' at '.date('H:i',$c['created_date']);
                        }else{
                            $ctime = '';
                        }
                        ?>
                        <div class="comment-item">
                            <div class="gf-comment-inner clearfix">
                                <div class="comment-avatar">
                                    <img alt="user-image" src="<?=Yii::app()->theme->baseUrl?>/images/user.png">
                                    <div>
                                        <h5 class="mb0"></h5>
                                        <span class="meta-date"><?=$ctime?></span>
                                    </div>
                                </div>
                                <div class="gf-comment-content">
                                    <p class="mb0 new-line"><?=$c['content']?></p>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
                ?>
                <?=$pagination?>
            </div>
            <div class="gf-post-comments">
                <div class="new-comment-form pt30 aos-init" data-aos="fade-up">
                    <a class="mt30" name="post_form">&nbsp;</a>
                    <?php
                    foreach(Yii::app()->user->getFlashes() as $key => $message) {
                        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
                    }
                    ?>
                    <h3 class="ml15 accent-color"><?= Yii::t('web/app', 'comment') ?></h3>
                    <?php $this->renderPartial('_news_comment_form',array(
                            'news_id'       =>  $news_id,
                            'modelComment'=>$modelComment,
                    )); ?>
                </div>
            </div>
        </div>
        </div>
    </div>
<div class="text-center mt30">
    <a class="button btn-contact" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
</div>