<div class="tabList">
    <a href="javascript:;" class="active" title="view" data-tab="#tab_view"><span>XEM NHIỀU</span></a>
    <a href="javascript:;" title="down" data-tab="#tab_down"><span>TẢI NHIỀU</span></a>
    <a href="javascript:;" title="new" data-tab="#tab_hot"><span>MỚI NHẤT</span></a>
</div>
<div class="box_content main">
    <ul class="doc_list" id="tab_view">

        <?php
            $this->widget('booster.widgets.TbListView', array(
                'dataProvider'       => $data_hot,
                'itemView'           => '/site/mobile/_home_grid_item',
                //'ajaxUpdate'=>false,
                'summaryText'        => 'Hiển thị: {start}-{end}/{count} tin đăng',
                'template'           => '<div class="property-grid"><ul class="grid-holder col-3">{items}</ul></div><div class="paging-navigation">{pager}</div>',
                'enableSorting'      => true,
                'sortableAttributes' => array(
                    'news_title' => 'Tiêu đề',
                ),
                /*//    'emptyText'          => 'Nội dung đang được cập nhật....',
                'pagerCssClass'      => 'paging-navigation',
                'pager'              => array(
                    'htmlOptions'    => array('class' => 'pagination'),
                    'maxButtonCount' => 5,
                    'firstPageLabel' => '|<<',
                    'nextPageLabel'  => 'Trang tiếp >>',
                    'prevPageLabel'  => '<< Trang sau',
                    'lastPageLabel'  => '>>|',
                    'header'         => '',

                ),*/
            ));
        ?>
    </ul>
    <p class="btn_white"><a href="javascript:;" p-id="2" t-id='view' onclick="showMore(this);">Xem thêm ...</a></p>
</div>
<div class="box_content main mhide">
    <ul class="doc_list" id="tab_down"></ul>
    <p class="btn_white"><a href="javascript:;" p-id="2" t-id='down' onclick="showMore(this);">Xem thêm ...</a></p>
</div>
<div class="box_content main mhide">
    <ul class="doc_list" id="tab_hot"></ul>
    <p class="btn_white"><a href="javascript:;" p-id="2" t-id='new' onclick="showMore(this);">Xem thêm ...</a></p>
</div>