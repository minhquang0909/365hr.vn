<?
    //$image_url  = $data->getImage();;
    $total_page = $data->total_page;
?>
<li>
    <a href="<?=$data->createUrl()?>" title="<?=$data->title?>">
        <span><em class="doc_type_3"><?=$data->file_type?></em></span>
        <div>
            <h2><?=$data->title?></h2>

            <p>
                <span><em class="icon i_numPage"></em><?=$data->total_page?> trang</span>
                <span><em class="icon i_numView"></em><?=$data->views?></span>
                <span><em class="icon i_numDown"></em><?=$data->total_download?></span>
            </p>
        </div>
    </a>
</li>