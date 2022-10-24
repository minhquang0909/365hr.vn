<?php $data_detail = $data->getDetailLang(); ?>

<?php if($data_detail):?>
    <?php
    $_link          = $data->createUrl();
    $_title         = $data_detail->title;
    $get_list_price = $data->lang_detail;
    $list_price     = array();
    foreach ((array)$get_list_price as $srow) {
        $list_price[$srow->language_id] = $srow->price;
    }
    ?>
<li>
    <div class="item-room"><a title="<?= $_title; ?>"
                              href="<?= $_link; ?>"><img
                    class="img-responsive" alt="<?= $_title; ?>" width="360" height="230"
                    src="<?= Yii::app()->request->baseUrl . '/' . $data['folder_path'] ?>"> </a>
        <a href="tel:<?=trim($this->site_config['support_hotline'])?>" class="link_call_sp">
            <div title="Book now" data-room-id="8" class="item-price">
                    <div class="none-loader">
                        <p class="starting-from">
                            <?= Yii::t('web/lang', 'from'); ?></p>
                        <p class="show-price show-price-0">$<?= $list_price[1]; ?></p>
                        <p class="show-price-vnd show-priceVND-0"><?= CFunction::number_format($list_price[2], 0, '.'); ?>  <?= Yii::t('web/lang', 'VNĐ'); ?></p>
                        <p class="book-now"><?= Yii::t('web/lang', 'booknow'); ?></p>

                    </div>
                    <div class="sp-loader hidden"></div>
            </div>
        </a>
        <div class="room-infomation"><a title="<?= $_title; ?>"
                                        href="<?= $_link; ?>"><span
                        class="room-title"><?= $_title; ?></span></a>

        </div>
    </div>
</li>
<?php endif;?>