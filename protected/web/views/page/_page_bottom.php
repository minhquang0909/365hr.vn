<?php
if(Yii::app()->controller->action->id=='qa' || Yii::app()->controller->action->id=='jobdetails'){
    $left_class = 'col-lg-4 col-12';
    $right_class = 'col-lg-8 col-12 blue';
}else{
    $left_class = 'col-lg-3 col-12';
    $right_class = 'col-lg-9 col-12 blue';
}
?>
<div class="contact-us">
    <div class="container">
        <div class="row">
            <div class="<?=$left_class?>"></div>
            <div class="<?=$right_class?>">
                <div class="blue-inner">
                    <div class="justify-content-md-center">
                        <div class="text-content">
                            <ul style="margin-bottom: 0;">
                                <li>企業様は人材募集を考えていますか？</li>
                                <li>外国人を募集しようと考えているが、文化の違いやコミュニケーションに不安を感じていませんか？</li>
                                <li>人材募集したいですが、仲介手数料が高いと感じていませんか？</li>
                            </ul>
                            <div>全てiZINZAIにお任せください。</div>
                            <div>私たちは、無料で人材をご紹介させて頂きます。</div>
                            <div>いい人材を通じてお客様の事業繁栄に貢献させて頂きます。</div>
                            <div>お気軽にお問い合わせください。</div>
                            <p class="email-address" style="margin-bottom: 5px;">メール：<?=(isset($this->site_config['contact_email'])?$this->site_config['contact_email']:"")?></p>
                        </div>
                    </div>
                    <strong><strong>
                        </strong></strong>
                </div>
            </div>
        </div>
    </div>
</div>