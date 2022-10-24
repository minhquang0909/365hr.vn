<?php $data_detail = $news->getDetailLang(); ?>
<?php
    $this->breadcrumbs = array(
        $category->name => $category->createUrl(),
        $data_detail->title
    );
    $_link             = $news->createUrl();
    $_title            = $data_detail->title;
    $get_list_price    = $news->lang_detail;
    $list_price        = array();
    foreach ((array)$get_list_price as $srow) {
        $list_price[$srow->language_id] = CFunction::number_format($srow->price,0,'.');
    }
?>
<link rel="StyleSheet" href="<?= $this->theme_url; ?>/css/accommodation.css" type="text/css">
<link rel="stylesheet" href="<?= $this->theme_url; ?>/css/colorbox.css">
<section id="accommodation-detail" class="mg-bottom-xs-2 mg-bottom-sm-0 pd-top-xs-8">
    <div class="container">
        <div class="row">
            <div class="col-sm-8"><h2 class="title"><?= $_title; ?> </h2>
                <div class="row">
                    <?= $data_detail->full_des; ?>

                    <div class="" id="gallery"><h2 class="title mg-bottom-xs-10" style="border-bottom:none;"><?= Yii::t('web/lang', 'gadget');?> <p></p></h2>

                        <div class="room-description">
                            <!--/*Gadget*/-->
                            <?php $list_gadget = $news->getGadgetList();?>
                            <ul>
                                <?php foreach ((array)$list_gadget as $row): ?>
                                    <?php if(in_array($row->category_id,explode(',',$news->created_by))):?>
                                        <?php $_img = Yii::app()->request->baseUrl . '/' . $row->folder_path; ?>
                                        <li><img src="<?=$_img;?>"><?=$row->name;?></li>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </ul>

                            <!--/*End Gadget*/-->

                        </div>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="bg-primary pd-v-xs-6">
                    <form method="get" action="#">
                        <div class="box-title"><?= Yii::t('web/lang', 'introduction'); ?> </div>
                        <?= $data_detail->short_des; ?>
                        <br>
                        <div class="bg-primary-dark">
                            <h4 class="text-center text-bold"><?= strtoupper(Yii::t('web/lang', 'from')); ?></h4>
                            <div class="row">
                                <div class="col-md-12 text-center price-min-height"><p class="acc-detail-price">$<?=$list_price[1] ;?></p>
                                    <p class="acc-detail-priceVND"><?=$list_price[2] ;?> VND</p><span
                                            class="sp-loader hidden"></span></div>
                            </div>
                        </div>
                        <?php WContacts::getContactPhoneList($this->site_config['support_phone'],'btn btn-light btn-lg btn-block mg-top-xs-4 mg-top-sm-6',Yii::t('web/lang', 'callnow'))?>

                        <a href="mailto:<?= $this->site_config['support_email'] ?>" title="BOOK NOW"
                           class="btn btn-light btn-lg btn-block mg-top-xs-4 mg-top-sm-6"><?= Yii::t('web/lang', 'Email'); ?>: <?= $this->site_config['support_email'] ?>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container" id="gallery"><h2 class="title mg-bottom-xs-10"><?= Yii::t('web/lang', 'gallery');?></h2>
    <?php $gallery = Gallery::model()->findAll('parent_id=' . $news->id);?>
    <div class="row">
        <?php foreach ((array)$gallery as $row): ?>
            <?php $_img = Yii::app()->request->baseUrl . '/' . $row->folder_path; ?>
            <div class="col-sm-3 text-center mg-bottom-xs-3">
                <a class="gallery-item cboxElement" href="<?= $_img; ?>"
                   title=""><img
                            src="<?= $_img; ?>"
                            data-src="<?= $_img; ?>"
                            data-src-placeholder="/img/transparent.png" alt="/files/accommodation/veranda/veranda-1.jpg"
                            class="img-responsive lazy-image unveil-loaded">
                    <noscript><img
                                src="<?= $_img; ?>"
                                alt='/files/accommodation/veranda/veranda-1.jpg' class='img-responsive lazy-image '/>
                    </noscript>
                    <div class="gallery-hover"><p>ZOOM</p></div>
                </a></div>
        <?php endforeach; ?>
    </div>
</div>
<section class="section" id="see-more-title">
    <div class="container list-room"><h2 class="title mg-bottom-xs-10"><?= Yii::t('web/lang', 'viewmore');?></h2>
        <link rel="StyleSheet" href="<?= $this->theme_url; ?>/css/accommodation.css" type="text/css">
        <div id="accommodation" class="pd-bottom-lg-16 pd-bottom-md-10 pd-bottom-xs-3">
            <div class="container list-room">
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-ul">
                            <?php
                                if ($news_related) {
                                    $this->widget(
                                        'booster.widgets.TbThumbnails',
                                        array(
                                            'dataProvider'     => $news_related,
                                            'template'         => "{items} {pager}",
                                            'enablePagination' => true,
                                            'itemView'         => '_block_item',
                                            'ajaxType'         => 'POST',
                                            'emptyText'        => Yii::t('web/lang', 'no_post'),
                                        )
                                    );
                                } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>