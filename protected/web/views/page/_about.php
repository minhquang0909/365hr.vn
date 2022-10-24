<?php
$this->renderPartial('/news/_top_banner', array(
    'title' =>  Yii::t('web/app','about')
));
?>

<div class="container about-page">
    <div class="row">
        <div class="col-lg-3">
            <div id="sticky-wrapper" class="sticky-wrapper" style="height: 182px;">
                <div class="sticky-menu" style="width: 255px;">
                    <ul class="list-inline">
                        <li>
                            <span onclick="scrollToID('about1')">
                                <i class="fa fa-angle-right"></i> 代表挨拶
                            </span>
                        </li>
                        <li>
                            <span onclick="scrollToID('about2')">
                                <i class="fa fa-angle-right"></i> <?=(isset($this->site_config['company_name']) && $this->site_config['company_name']!='')?$this->site_config['company_name']:''?>概要
                            </span>
                        </li>

                        <li>
                            <span onclick="scrollToID('about3')">
                                <i class="fa fa-angle-right"></i> 私たちの記念
                            </span>
                        </li>
                        <li>
                            <a class="button btn-contact" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-12">
            <div class="about-wrapper">
                <div data-aos="fade-up" id="about1" class="clearfix aos-init aos-animate">
                    <div class="info-title">
                        <h2 class="accent-color">代表挨拶</h2>
                    </div>
                    <div>
                        <div>
                            <p>
                                <img class="alignright" height="230px" sizes="(max-width: 430px) 100vw, 430px" src="<?=Yii::app()->theme->baseUrl?>/images/32.png">
                                イジンザイのホームページをご覧いただき、誠にありがとうございます。<br>
                                私は、ダオ・ヴァン・ハイと申します。国籍はベトナムです。<br>
                                私は2011年にハノイ工業大学を卒業しました。<br>
                                その後は日本の会社に勤めています。大手車部品メーカで品質管理として働き、その後はIT企業でエンジニアとして働きました。
                                <br><br>
                                <p>
                                日本で数年間働き、日本のことがとても好きになり、またいつも日本人の方にお世話になっております。そのため、母国のベトナムはもちろん、日本にも貢献したいと思っています。
                                </p>
                                <p>
                                    日本は現在少子高齢化社会の真っただ中にあり、労働者不足が大きな問題になっています。国内で技術者を採用したくても、なかなか応募者が集まらないことも多いです。
                                </p>
                                <p>
                                一方で、ベトナムには若者が多く、真面目で技術の知識や日本語を一所懸命勉強していま&nbsp;
                                す。大学を卒業している人も多いです。しかし、良い大学を卒業していても、ベトナムでは&nbsp;
                                自分に最適な仕事を見つからない人もたくさんいます。近年では、技術を活かせる先進国の&nbsp;
                                日本で働きたい若者が増えています。&nbsp;
                                </p>
                                人材サービスのエージェント経由で、外国人の労働者を採用できた企業様もいますが、仲介&nbsp;
                                手数料の壁や人材の品質（日本語の会話能力、業務経験または技術の知識など）が低く、良い人材を採用できない企業様も多いです。&nbsp;
                                &nbsp;
                                上記の課題を解決できるように、&nbsp;
                                私たちは、無償でご紹介しており、紹介する前にきちんと応募者の日本語能力と技術知識な&nbsp;
                                どをチェックしています。こちらで慎重に選考した良い人材しか紹介しません。&nbsp;
                                ブリッジとして、日本の企業様とベトナムの人材コネクションします。&nbsp;
                                <p>&nbsp;</p>
                                <p>イジンザイの代表者　ダオ・ヴァン・ハイ</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix" id="about2">
                    <div class="info-title">
                        <h2 class="accent-color"><?=(isset($this->site_config['company_name']) && $this->site_config['company_name']!='')?$this->site_config['company_name']:''?>概要</h2>
                    </div>
                    <?php
                    if(isset($this->site_config['company_name']) && $this->site_config['company_name']!=''){?>
                        <div class="info-wrapper">
                            <div class="row no-mar">
                                <div class="col-4 col-md-3">
                                    <label class="lbl-about-us">団体名</label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <h5 class="company-name">
                                        <?=(isset($this->site_config['company_name']) && $this->site_config['company_name']!='')?$this->site_config['company_name']:''?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>

                    <?php
                    if(isset($this->site_config['company_address']) && $this->site_config['company_address']!="") {?>
                        <div class="info-wrapper">
                            <div class="row no-mar">
                                <div class="col-4 col-md-3">
                                    <label class="lbl-about-us">住所</label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <h5><?=$this->site_config['company_address']?></h5>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>

                    <?php
                    if(isset($this->site_config['company_phone']) && $this->site_config['company_phone']!="") {?>
                        <div class="info-wrapper">
                            <div class="row no-mar">
                                <div class="col-4 col-md-3">
                                    <label class="lbl-about-us">TEL / FAX</label>
                                </div>
                                <div class="col-8 col-md-9">
                                    <h5><?=$this->site_config['company_phone']?></h5>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>

                    <?php
                    if(isset($this->site_config['company_email']) && $this->site_config['company_email']!="") {?>
                        <div class="info-wrapper">
                            <div class="row no-mar">
                                <div class="col-4 col-md-3"><label class="lbl-about-us">Email</label></div>
                                <div class="col-8 col-md-9"><h5><?=$this->site_config['company_email']?></h5></div>
                            </div>
                        </div>
                    <?php }
                    ?>

                    <?php
                    if(isset($this->site_config['founding_date']) && $this->site_config['founding_date']!="") {?>
                        <div class="info-wrapper">
                            <div class="row no-mar">
                                <div class="col-4 col-md-3"><label class="lbl-about-us">設立</label></div>
                                <div class="col-8 col-md-9"><h5><?=$this->site_config['founding_date']?></h5></div>
                            </div>
                        </div>
                    <?php }
                    ?>

                    <?php
                    if(isset($this->site_config['company_capital']) && $this->site_config['company_capital']!=""){?>
                        <div class="info-wrapper">
                            <div class="row no-mar">
                                <div class="col-4 col-md-3"><label class="lbl-about-us">資本金</label></div>
                                <div class="col-8 col-md-9"><h5><?=$this->site_config['company_capital']?></h5></div>
                            </div>
                        </div>
                    <?php }
                    ?>


                    <div class="info-wrapper">
                        <div class="row no-mar">
                            <div class="col-4 col-md-3"><label class="lbl-about-us">代表者</label></div>
                            <div class="col-8 col-md-9"><h5>ダオ・ヴァン・ハイ</h5></div>
                        </div>
                    </div>

                    <div class="info-wrapper multiple">
                        <div class="row no-mar">
                            <div class="col-4 col-md-3"><label class="lbl-about-us">主な事業の内容</label></div>
                            <div class="col-8 col-md-9">
                                <h5>① 無料人材紹介
                                    <ul style="margin-bottom: 5px;">
                                        <li><h5 style="margin-bottom: 0;">・エンジニア（技術・人文知識・国際業務)</h5></li>
                                        <li><h5>・特定技能</h5></li>
                                    </ul>
                                </h5>
                                <h5>② ソフトアウトソーシング
                                    <ul style="margin-bottom: 5px;">
                                        <li><h5 style="margin-bottom: 0;">・WEBサイトやホームページをデザイン・製造・テスター</h5></li>
                                        <li><h5 style="margin-bottom: 0;">・アプリケーション設計・製造・テスター</h5></li>
                                        <li><h5>・データ入力</h5></li>
                                    </ul>
                                </h5>
                                <h5>③ 管理団体様にサポート
                                    <ul style="margin-bottom: 5px;">
                                        <li><h5 style="margin-bottom: 0;">・通訳</h5></li>
                                        <li><h5>・ドキュメント翻訳</h5></li>
                                    </ul>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="info-wrapper">
                        <div class="row no-mar">
                            <div class="col-4 col-md-3"><label class="lbl-about-us">言語対応</label></div>
                            <div class="col-8 col-md-9"><h5>日本語・ベトナム語</h5></div>
                        </div>
                    </div>
                    <?php
                    if(isset($this->site_config['company_license']) && $this->site_config['company_license']!=""){?>
                        <div class="info-wrapper">
                            <div class="row no-mar">
                                <div class="col-4 col-md-3"><label class="lbl-about-us">許可番号</label></div>
                                <div class="col-8 col-md-9"><h5><?=$this->site_config['company_license']?></h5></div>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>

                <div class="info-icon clearfix" id="about3">
                    <div class="info-title">
                        <h2 class="accent-color">私たちの記念</h2>
                        <div class="content-wrapper">
                            <div class="d-flex info-icon mb50">
                                <div class="content">
                                    <img alt="お客様は第一" src="<?=Yii::app()->theme->baseUrl?>/images/hand.png">
                                    <p class="mb0">お客様は第一</p>
                                </div>
                                <div class="content">
                                    <img alt="人は発展の中心" src="<?=Yii::app()->theme->baseUrl?>/images/people.png">
                                    <p class="mb0">即戦力人材提供</p>
                                </div>
                                <div class="content">
                                    <img alt="win-win" src="<?=Yii::app()->theme->baseUrl?>/images/hi-five.png">
                                    <p class="mb0">ウィン・ウィン</p>
                                </div>
                            </div>

                            <h3 class="accent-color"><strong>理念</strong></h3>
                            <p class="mb0" style="font-size: 1.5em;">&nbsp;&nbsp;&nbsp;私たちは、いい人材を通じてお客様の事業繁栄に貢献させて頂きます。</p>
                        </div>
                    </div>
                </div>

                <div class="info-manager">
                    <div class="info-title">
                        <h2 class="mb0 accent-color">ビジョン</h2>
                    </div>
                    <div class="d-flex info-image aos-init" data-aos="fade-up">
                        <div class="bg-image"></div>
                        <div class="content">
                            <p class="mb0">
                                イジンザイは日本の企業様にたいして信頼パートナーできるし、高い評価を頂くように人材の向上品質をご紹介させて頂きます。現在、エンジニア・特定技能の労働者がメインとしてご紹介しておりますが将来、実習生、留学生関係の事業にもサポートできるようにします。お客様のご成功と繁栄は私たちの努力目標です。
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>