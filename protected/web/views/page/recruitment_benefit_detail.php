<div class="recruitment-benefit-detail">
    <div class="container">
        <h3 class="mt50 mb10 accent-color">​​​​​​​<?= isset($stepData['question']) ? $stepData['question'] : "" ?></h3>
        <div class="gf-post-detail">
            <?= isset($stepData['answer']) ? $stepData['answer'] : "" ?>
        </div>
        <div class="text-center mt30">
            <a class="button btn-contact" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
        </div>
    </div>
</div>