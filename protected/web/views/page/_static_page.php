<section data-aos="fade-up" class="aos-init aos-animate mb30">
    <div class="container">
        <div class="row">
            <?php
            $static_page_list = StaticPage::getList();
            $static_page_list = isset($static_page_list['list_page'])?$static_page_list['list_page']:array();
            if(is_array($static_page_list) && count($static_page_list) > 0){
                if(count($static_page_list) >= 4){
                    $class = 'col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12';
                }else{
                    $class = 'col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12';
                }
                foreach ($static_page_list as $page){
                    ?>
                    <article class="clearfix gf-banner <?=$class?>">
                        <div class="gf-heading">
                            <h5 class="heading-title accent-color"><a href="<?=Yii::app()->createUrl('page/detail',array('id'=>$page['id']))?>"><?=$page['title']?></a></h5>
                        </div>
                        <div class="gf-banner-inner clearfix">
                            <div class="entry-thumb-wrap">
                                <div class="entry-thumbnail">
                                    <a class="entry-thumbnail-overlay" href="<?=Yii::app()->createUrl('page/detail',array('id'=>$page['id']))?>">
                                        <img class="img-banner" src="<?=$page['folder_path']?>">
                                    </a>                </div>
                            </div>
                        </div>
                    </article>
                <?php }
            }else{
                echo '<div class="alert alert-warning">No data</div>';
            }
            ?>
        </div>
    </div>
</section>