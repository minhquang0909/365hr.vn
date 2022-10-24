<?php
$this->renderPartial('/news/_top_banner', array(
    'title' =>  Yii::t('web/app','About us')
));
?>
<div class="container mt50 aos-init aos-animate job-details" data-aos="fade-up">
    <div class="row">
        <div class="col-lg-4 col-12">
            <div id="sticky-wrapper" class="sticky-wrapper" style="height: 351px;"><div class="sticky-menu" style="width: 255px;">
                    <ul class="list-inline">
                        <li>
                            <span onclick="scrollToID('jobDetail1')">
                                <i class="fa fa-angle-right"></i>&nbsp;無料職業紹介事業</span>
                        </li>
                        <li>
                            <span onclick="scrollToID('jobDetail2')">
                                <i class="fa fa-angle-right"></i>&nbsp;なぜイジンザイを選ぶのか？</span>
                        </li>
                        <li>
                            <a class="button btn-contact" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
                        </li>
                    </ul>
                </div></div>
        </div>

        <div class="col-lg-8 col-12">
            <div class="about-wrapper">
                <div id="jobDetail1" class="clearfix">
                    <div class="info-title">
                        <h2 class="accent-color">無料職業紹介事業</h2>
                    </div>
                    <div class="info-wrapper">
                        <div>
                            <div class="content">
                                <p>ベトナムの技術者がますます日本で働けるように、</p>
                                <p>私たちは無料人材紹介活動を行っております。</p>
                                <p>貴社が人材を求めていましたら、人材をご紹介させて頂きたいと思います。</p>
                                <p>私たちは、いい人材を通じてお客様の事業繁栄に貢献させて頂きます。</p>
                                <p></p>
                                <p>技術（エンジニア）労働ビザでもいいし、</p>
                                <p>2019年4月より、認められた新しい「特定技術」ビザとして、</p>
                                <p>現場作業者でもご紹介可能です。</p>
                                <p>技術・人文知識・国際業務（エンジニア）との労働ビザ を中心に</p>
                                <p>ベトナムに在住者をご紹介しております。これは私たちの強みです。</p>
                                <p></p>
                                <p>ご紹介できる職種は様々ございます</p>
                                <ul class="list-inline">
                                    <li>・　エンジニア（機械・電気・電子・金属加工（CNC機械）・溶接・自動車技術等）</li>
                                    <li>・　設計業務（機械設計、電気回路、住宅設計など）</li>
                                    <li>・　ITエンジニア（システム開発)</li>
                                    <li>・　建築・土木技術職</li>
                                    <li>・　農林水産・食品処理・家畜</li>
                                    <li>・　観光、ホテル・外食業系</li>
                                    <li>・　オッフィス系、文系（受付、コールセンタ等）</li>
                                </ul>
                                <p>日本で働き、転職活動をしている技術者や、</p>
                                <p>ベトナムに住んでいる技術者をご紹介することができます。</p>
                                <p>新卒・未経験者も提供できますし、経験者も多数おります。</p>
                                <p>ベトナム人材の日本語能力に対してご心配があると思われますが、日本語が話せる人材の</p>
                                <p>みをご紹介しますのでご安心ください。</p>
                                <p>企業様のお仕事に対して、応募者は初期は色々な事を勉強することになりますが</p>
                                <p>積極的に新しい技術も取得しますので早々仕事に対応できると思います。</p>
                                <p></p>
                                <p>ご不明な点等ございましたら、お気軽にお問い合わせください。</p>
                                <p class="email-address">メール：contact@izinzai.com</p>

                                <div id="jobDetail2" class="pt-20">
                                    <h4 class="accent-color">なぜイジンザイを選ぶのか？</h4>
                                    <div class="content-box">
                                        <ul>
                                            <li>紹介無料（仲介手数料0円)</li>
                                            <li>通訳無料<br>
                                                &nbsp;&nbsp;&nbsp;面接の時、通訳が必要場合、無料で対応させて頂きます。
                                            </li>
                                            <li>人材の質が高い</li>
                                            <li class="no-list-style">
                                                <ul>
                                                    <li class="no-list-style">- 10年程業務経験がある私は工場のお仕事の知識もあるし、技術的なお仕事（IT系、設計）などの知識がありますので貴社のお仕事に一番適切な人材をご紹介しております。</li>
                                                    <li class="no-list-style">- 紹介する前に、私が直接日本語や技術知識などを慎重にチェックします。</li>
                                                    <li class="no-list-style">- 在留資格認定書証明書申請関係の手続きが分からなくてもコンサルタントができます。</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <?php $this->renderPartial('/page/_static_page', array()); ?>

                                <p><strong></strong></p>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>

        <strong><strong>
            </strong></strong></div><strong><strong>
        </strong></strong></div>