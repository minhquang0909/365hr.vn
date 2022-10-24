<link rel="StyleSheet" href="<?= $this->theme_url; ?>/css/accommodation.css" type="text/css">
<div id="accommodation" class="bg-gray pd-bottom-lg-16 pd-bottom-md-10 pd-bottom-xs-3 pd-top-xs-8">
    <div class="container list-room">
        <div class="row">
            <div class="col-xs-12">
                <ul class="list-ul">
                    <?php
                        if ($news) {
                            $this->widget(
                                'booster.widgets.TbThumbnails',
                                array(
                                    'dataProvider'     => $news,
                                    'template'         => "{items} {pager}",
                                    'enablePagination' => true,
                                    'itemView'         => '/product/_block_item',
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