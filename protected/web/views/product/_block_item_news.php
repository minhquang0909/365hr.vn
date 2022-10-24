<div class="col-lg-12 col-md-12 col-xs-12">
    <div class="item_row">
        <div class="thumbnail no-pad">
            <?= CHtml::link(CHtml::image(Yii::app()->request->baseUrl. '/' . $data['folder_path'], $data['title']), WNews::createUrl($data['id'],$data['slug']), array('title' => CHtml::encode($data['title']))) ?>
        </div>
        <div class="news_row_title">
            <div class="news_title"><?= CHtml::link(CHtml::encode($data['title']), WNews::createUrl($data['id'],$data['slug']), array('title' => CHtml::encode($data['title']))) ?></div>
        </div>
        <div class="news_short_des"><?=CHtml::encode($data['short_des'])?></div>
        <div class="space_5"></div>
    </div>
</div>