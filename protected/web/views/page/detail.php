<?php
$this->renderPartial('/news/_top_banner', array(
    'title' =>  isset($pageData['title'])?$pageData['title']:""
));
?>

<div class="container specific_skills mt50 aos-init aos-animate" data-aos="fade-up">
    <?=isset($pageData['full_des'])?$pageData['full_des']:""?>
</div>
<div class="text-center mt30">
    <a class="button btn-contact" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
</div>