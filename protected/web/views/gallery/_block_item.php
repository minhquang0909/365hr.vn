<?php $_img = Yii::app()->request->baseUrl . '/' . $data->folder_path; ?>
<div class="col-sm-4 mg-bottom-xs-3 mg-bottom-sm-6">
    <a class="gallery-item cboxElement" href="<?= $_img; ?>" title="">
        <img src="<?= $_img; ?>" data-src="<?= $_img; ?>" data-src-placeholder="/img/transparent.png" class="img-responsive lazy-image unveil-loaded">
        <noscript><img src="<?= $_img; ?>" class='img-responsive lazy-image '/>
        </noscript>
        <div class="gallery-hover"><p>ZOOM</p></div>
    </a>
</div>
