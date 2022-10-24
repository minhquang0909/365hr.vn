<!--end heading-->
<div class="container aos-init aos-animate" data-aos="fade-up">
    <div class="recruiment">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div id="sticky-wrapper" class="sticky-wrapper" style="height: 174px;"><div class="sticky-menu" style="width: 255px;">
                        <ul class="list-inline">
                            <li>
                                <span onclick="scrollToID('recruiment_1')">
                                    <i class="fa fa-angle-right"></i>&nbsp;ご紹介可能な職種一覧</span>
                            </li>
                            <li>
                                <span onclick="scrollToID('recruiment_2')">
                                    <i class="fa fa-angle-right"></i>&nbsp;外国人採用の流れ</span>
                            </li>
                            <li>
                                <span onclick="scrollToID('recruiment_3')">
                                    <i class="fa fa-angle-right"></i>&nbsp;面接の雰囲気</span>
                            </li>
                            <li>
                                <a class="button btn-contact" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
                            </li>
                        </ul>
                    </div></div>
            </div>
            <div class="col-lg-9 col-12">
                <div id="recruiment_1">
                    <div class="recruiment-1">
                        <p class="htitle">ご紹介可能な職種一覧</p>
                        <p>ご紹介できる職種は様々ございます。</p>
                        <ul>
                            <li>エンジニア（設計・機械・電気・電子・加工・溶接等）</li>
                            <li>ITエンジニア（システム開発)</li>
                            <li>建築・土木技術職</li>
                            <li>農林水産・食品処理・家畜</li>
                            <li>観光、ホテル・外食業系</li>
                            <li>オッフィス系、文系（受付、コールセンタ等）</li>
                        </ul>
                    </div>
                </div>

                <div id="recruiment_2">
                    <div class="recruiment-2">
                        <h3 class="accent-color htitle">採用の流</h3>
                        <div class="r-step-list">
                            <?php
                            $step_list = RecruitmentStep::getAll();
                            if(is_array($step_list) && count($step_list) > 0){
                                $total_step = count($step_list);
                                $dd=0;
                                foreach ($step_list as $step){
                                    $dd++; ?>
                                        <a href="<?=Yii::app()->createUrl('page/recruitment_benefit_detail',array('id'=>$step['id']))?>" class="step-item <?=($dd==$total_step)?"step-item-last":""?>">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="step-text">step <?=$step['sort_order']?></div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="step-info">
                                                        <div class="step-title"><?=$step['question']?></div>
                                                        <div class="step-desc"><?=$step['short_desc']?></div>
                                                    </div>
                                                </div>
                                            </div>
                                    </a>
                                <?php }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div id="recruiment_3">
                    <div class="recruiment-3">
                        <?php
                        $album_slider = 'interview_banner';
                        $album = Album::model()->find("LOWER(title)='$album_slider'");

                        if($album) {
                            $images = Gallery::model()->findAll('album_id=' . $album->id);
                        }
                        ?>
                        <div class="images-list">
                            <div class="row">
                                <?php
                               if(is_array($images) && count($images) > 0){
                                    foreach ($images as $item){ ?>
                                        <div class="col-6 col-md-3">
                                            <div class="item">
                                                <img class="thumb" src="<?=$item->folder_path; ?>">
                                            </div>

                                        </div>
                                    <?php }
                                } ?>
                                <div class="col-6 col-md-3 item">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>