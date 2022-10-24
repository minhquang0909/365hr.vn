<?php
$this->renderPartial('/news/_top_banner', array(
    'title' =>  Yii::t('web/app','q_a')
));
?>
<div class="container">
    <?php
    if (isset($qa_categories) && is_array($qa_categories) && count($qa_categories) > 0) {
        $qa_question_answer_arr = array();
        ?>
        <div class="row">
            <div class="col-lg-4">
                <div id="sticky-wrapper" class="sticky-wrapper sticky-menu-qa">
                    <div class="sticky-menu">
                        <ul class="list-inline" id="accordionExample">
                            <?php
                            foreach ($qa_categories as $cat){
                                $qa_question_answer = QA::getQuestionAnswerByCategoryId($cat['id']);
                                $qa_question_answer_arr[$cat['id']] = $qa_question_answer;
                                ?>
                                <li id="heading_<?=$cat['id']?>">
                                    <span data-toggle2="collapse" data-target="#collapse_<?=$cat['id']?>" aria-controls="collapse_<?=$cat['id']?>" onclick="scrollToID('qa_category_<?=$cat['id']?>')"><i class="fa fa-angle-right"></i>&nbsp;<?=$cat['name']?></span>
                                    <?php
                                    if(is_array($qa_question_answer) && count($qa_question_answer) > 0){?>
                                        <ul class="sub-menu list-inline" id="collapse_<?=$cat['id']?>" aria-labelledby="heading_<?=$cat['id']?>" data-parent="#accordionExample">
                                            <?php
                                            foreach ($qa_question_answer as $qa){?>
                                                <li>
                                                    <a onclick="scrollToID('qa_question_<?=$qa['id']?>')"><?=$qa['sort_order']?></span>.  <?=$qa['question']?></a>
                                                </li>
                                            <?php }
                                            ?>
                                        </ul>
                                    <?php }
                                    ?>
                                </li>
                            <?php }
                            ?>
                            <?php
                            if(Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='index'){

                            }else{?>
                                <li>
                                    <a class="button btn-contact" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12">
                <div class="about-wrapper aos-init aos-animate" data-aos="fade-up">
                    <?php
                    $album_slider = 'qa_banner';
                    $album = Album::model()->find("LOWER(title)='$album_slider'");
                    if($album){
                        $images = Gallery::model()->find('album_id='.$album->id);
                        echo '<img class="qa-image" src="'.$images->folder_path.'">';
                    }?>
                    <div class="question-anwser">
                        <?php
                        foreach ($qa_categories as $cat){?>
                            <div class="mt40">
                                <div class="question-item" id="qa_category_<?=$cat['id']?>">
                                    <h4 class="accent-color"><span class="htitle"><span class="number"><?=CFunction::numberToRomanRepresentation($cat['sort_order'])?></span>.<?=$cat['name']?></span></h4>
                                    <?php
                                    if( isset($qa_question_answer_arr[$cat['id']]) && is_array($qa_question_answer_arr[$cat['id']]) && count($qa_question_answer_arr[$cat['id']]) > 0){?>
                                        <div class="answer-area">
                                            <ul class="list-inline">
                                                <?php
                                                foreach ($qa_question_answer_arr[$cat['id']] as $qa){?>
                                                    <li data-question-id="<?=$qa['id']?>" id="qa_question_<?=$qa['id']?>">
                                                        <p class="question"><span class="number"><?=$qa['sort_order']?></span>. <?=$qa['question']?></p>
                                                        <div class="answer"><?=$qa['answer']?></div>
                                                    </li>
                                                <?php }
                                                ?>
                                            </ul>
                                        </div>
                                    <?php }else{
                                        echo '<div class="alert alert-warning">No question</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } else {
        echo '<div class="alert alert-warning">No data</div>';
    }
    ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        //
        $("#accordionExample > li").on("click", function() {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this).find(".sub-menu").slideUp(200);
            } else {
                $("#accordionExample > li").removeClass("active");
                $(this).addClass("active");
                $(".sub-menu").slideUp(200);
                $(this).find(".sub-menu").slideDown(200);
            }
        });
    });
</script>