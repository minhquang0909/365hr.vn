
<div id="gallery" class="gallery_list">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $data_list,
        'itemView'     => '_block_item',
        'template'         => "{items} <br>{pager}",
        'pager'        => array(
            'header'        => '',

            'htmlOptions' => array(
                'class' => 'pagination',
                'style' => '',
                'id'    => 'pagination'
            )
        )
    )); ?>
</div>
