<?php
    $this->breadcrumbs = array(
        $categories->name,
    );
?>
<div class="container">
    <div id="news">
        <?php
            if ($news) {
                $this->widget(
                    'booster.widgets.TbThumbnails',
                    array(
                        'dataProvider'     => $news,
                        'template'         => "{items} {pager}",
                        'enablePagination' => true,
                        'itemView'         => '_block_item',
                        'ajaxType'         => 'POST',
                        'emptyText'        => Yii::t('web/lang', 'no_post'),
                    )
                );
            } ?>
    </div>
</div>
<br>
<br>