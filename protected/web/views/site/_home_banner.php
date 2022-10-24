<?php
$album_slider = 'home_top_banner';
$album = Album::model()->find("LOWER(title)='$album_slider'");

if($album){
    $images = Gallery::model()->findAll('album_id='.$album->id);
}?>

<?php
if(is_array($images) && count($images) > 0){?>
    <div id="home_carousel" class="carousel slide home-banner" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $count=0;
            foreach ($images as $item){
                $count++;
                if((str_replace("#","",$item->target_link)!="")){
                    $has_link = true;
                    $link = $item->target_link;
                }else{
                    $link = 'javascript:void(0);';
                    $has_link = false;
                }
                if($has_link){?>
                    <a class="<?=($has_link)?"":"no-cursor"?> carousel-item <?=($count==1)?"active":""?>" href="<?=$link?>" <?=($has_link)?'target="_blank"':""?>>
                        <img class="d-block w-100" src="<?=$item->folder_path; ?>" alt="<?=$item->title; ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <p><?=($item->title!=""?$item->title:""); ?></p>
                        </div>
                    </a>
                <?php }else{?>
                    <span class="carousel-item <?=($count==1)?"active":""?>">
                        <img class="d-block w-100" src="<?=$item->folder_path; ?>" alt="<?=$item->title; ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <p><?=($item->title!=""?$item->title:""); ?></p>
                        </div>
                    </span>
                <?php }
                ?>
            <?php }
            ?>
            <a class="carousel-control-prev" href="#home_carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#home_carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
    </div>
    <script>
        $(document).ready(function () {
            $('.carousel').carousel({
                interval: 5000
            })
        });
    </script>
<?php }
?>