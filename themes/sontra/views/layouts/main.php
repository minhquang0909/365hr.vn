<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:title" content="<?= $this->pageTitle; ?>"/>
    <meta property="og:url" content=""<?= $this->base_url; ?>/"/>
    <title><?= $this->pageTitle; ?></title>
    <meta name="keywords" content="<?= $this->pageKeyword; ?>"/>
    <meta name="description" content="<?= $this->pageDescription; ?>"/>
    <meta name="robots" content="index,follow" />
    <link href="<?= $this->pageUrl; ?>" rel="canonical" />
    <meta name="google-site-verification" content="HYcN9y70rtfCyQ-kpaol8UqkX9s9cLd4l9DCea_b314" />

    <link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <!--<link rel="stylesheet" href="<?/*=Yii::app()->theme->baseUrl*/?>/css/video.css?v=1"/>-->
    <link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/css/style.css?v=1"/>
    <script src="<?=Yii::app()->theme->baseUrl?>/js/jquery.min.js"></script>
    <script src="<?=Yii::app()->theme->baseUrl?>/js/common.js"></script>
    <!--<script src="<?/*=Yii::app()->theme->baseUrl*/?>/js/sweetalert2.all.min.js"></script>-->
    <script src="<?=Yii::app()->theme->baseUrl?>/js/sweetalert.min.js"></script>
    <script src="<?=Yii::app()->theme->baseUrl?>/js/video.min.js?v=1"></script>

    <?php
    $domain = CFunction::getCurrentDomain();
    $download_link =  $domain.'/uploads/files';
    $download_link2 = str_replace("https", "http", $download_link);
    ?>

    <!--<script src="<?/*=Yii::app()->theme->baseUrl*/?>/js/Youtube.min.js?v=1"></script>-->
    <link rel="shortcut icon" type="image/x-icon"  href="<?=$domain?>/favicon.ico">
    <script>
            var DOWNLOAD_LINK = '<?php echo $download_link; ?>';
            var DOWNLOAD_LINK2 = '<?php echo $download_link2; ?>';

    </script>
    <script src="<?=Yii::app()->theme->baseUrl?>/js/app.js?v=1"></script>
</head>

<body>
    <header id="header">
        <div class="topbar">
            <div class="container topbar-wrapper d-flex">
                <div class="logo">
                    <a href="<?=Yii::app()->createUrl('site/index')?>">
                        <img alt="homepage" src="<?=Yii::app()->theme->baseUrl?>/images/logo.png">
                    </a>
                </div>
                <div class="information">
                    <?php
                    if(isset($this->site_config['contact_email']) && $this->site_config['contact_email']!=''){?>
                        <div>
                            <span class="information-title"><?=Yii::t('web/app','please_contact_with_us')?></span>
                            <a class="accent-color mobile-phone">
                                <strong class="mobile-phone"><i class="fa fa-envelope"></i><?=$this->site_config['contact_email']?></strong>
                            </a>
                        </div>
                    <?php }
                    ?>
                    <div>
                        <a class="button contact-with-us" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark">
            <?php
            $controller = Yii::app()->controller->id;
            $action = Yii::app()->controller->action->id;
            ?>
            <div class="container">
                <div class="navbar-collapse">
                    <div class="gf-toggle-icon">
                        <span></span>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <b>
                                <a class="nav-link" href="<?=Yii::app()->createUrl('site/index')?>"><?=Yii::t('web/app','home_page')?></a>
                            </b>
                        </li>
                        <li class="nav-item <?=($controller=='page' && ($action=='recruitment_benefit' || $action=='recruitment_benefit_detail'))?'active':''?>">
                            <b>
                                <a class="nav-link" href="<?=Yii::app()->createUrl('page/recruitment_benefit')?>"><?=Yii::t('web/app','about_recruitment_of_foreigners')?></a>
                            </b>
                        </li>
                        <li class="nav-item <?=($controller=='page' && $action=='about')?'active':''?>">
                            <b>
                                <a class="nav-link" href="<?=Yii::app()->createUrl('page/about')?>"><?=Yii::t('web/app','about')?></a>
                            </b>
                        </li>
                        <li class="nav-item <?=($controller=='page' && $action=='jobdetails')?'active':''?>">
                            <b>
                                <a class="nav-link" href="<?=Yii::app()->createUrl('page/jobDetails')?>"><?=Yii::t('web/app','job_details')?></a>
                            </b>
                        </li>
                        <li class="nav-item <?=($controller=='page' && $action=='qa')?'active':''?>">
                            <b>
                                <a class="nav-link" href="<?=Yii::app()->createUrl('page/qa')?>"><?=Yii::t('web/app','q_a')?></a>
                            </b>
                        </li>
                        <li class="nav-item nav-item-contact-us">
                            <b>
                                <a class="nav-link btn-contact" href="<?=Yii::app()->createUrl('site/contact')?>"><i class="fa fa-envelope-o"></i> <?=Yii::t('web/app','contact_us')?></a>
                            </b>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?=$content?>
</body>

<?php
$style = '';
$album_slider = 'footer_banner';
$album = Album::model()->find("LOWER(title)='$album_slider'");
if($album){
    $images = Gallery::model()->find('album_id='.$album->id);
    $style = 'style="background-image: url('.'/'.$images->folder_path.');"';
}?>
<footer <?php echo  $style;?> >
    <div class="footer-content">
        <div class="container">

            <div class="text-center">
                <?php
                if(isset($this->site_config['site_name']) && $this->site_config['site_name']!=''){?>
                    <h3 class="accent-color"><?=(isset($this->site_config['site_name'])?$this->site_config['site_name']:"")?></h3>
                <?php }
                ?>
                <div class="content-wrapper">
                    <div class="content">
                        <?php
                        if(isset($this->site_config['contact_address']) && $this->site_config['contact_address']!=''){?>
                            <p><strong>住所:</strong> <?=(isset($this->site_config['contact_address'])?$this->site_config['contact_address']:"")?></p>
                        <?php }
                        ?>
                        <?php
                        if(isset($this->site_config['contact_email']) && $this->site_config['contact_email']!=''){?>
                            <p><strong>メールアドレス:</strong> <a class="__cf_email__" style="color: #fff;"><?=(isset($this->site_config['contact_email'])?$this->site_config['contact_email']:"")?></a></p>
                        <?php }
                        ?>
                        <?php
                        if(isset($this->site_config['contact_phone']) && $this->site_config['contact_phone']!=''){?>
                            <p><strong>電話番号:</strong> <?=(isset($this->site_config['contact_phone'])?$this->site_config['contact_phone']:"")?></p>
                        <?php }
                        ?>
                    </div>
                </div>
                <div class="social">
                    <?php
                    if(isset($this->site_config['contact_fb_fanpage'])&&str_replace("#","",$this->site_config['contact_fb_fanpage'])!=''){?>
                        <a target="_blank" href="<?=$this->site_config['contact_fb_fanpage']?>">
                            <img alt="homepage" src="<?=Yii::app()->theme->baseUrl?>/images/fb.png" />
                        </a>
                    <?php }else{?>
                        <a href="javascript:void(0);" class="no-cursor">
                            <img alt="homepage" src="<?=Yii::app()->theme->baseUrl?>/images/fb.png" />
                        </a>
                    <?php }
                    ?>
                    <?php
                    if(isset($this->site_config['contact_youtube_channel'])&&str_replace("#","",$this->site_config['contact_youtube_channel'])!=''){?>
                        <a target="_blank" href="<?=$this->site_config['contact_youtube_channel']?>">
                            <img alt="homepage" src="<?=Yii::app()->theme->baseUrl?>/images/youtube.png" />
                        </a>
                    <?php }else{?>
                        <a href="javascript:void(0);" class="no-cursor">
                            <img alt="homepage" src="<?=Yii::app()->theme->baseUrl?>/images/youtube.png" />
                        </a>
                    <?php }
                    ?>
                    <?php
                    if(isset($this->site_config['contact_skype'])&&str_replace("#","",$this->site_config['contact_skype'])!=''){?>
                        <a  target="_blank"href="skype:<?=$this->site_config['contact_skype']?>?chat">
                            <img alt="homepage" src="<?=Yii::app()->theme->baseUrl?>/images/skype.png" />
                        </a>
                    <?php }else{?>
                        <a href="javascript:void(0);" class="no-cursor">
                            <img alt="homepage" src="<?=Yii::app()->theme->baseUrl?>/images/skype.png" />
                        </a>
                    <?php }
                    ?>

                </div>
            </div>
            <?php
            if(isset($this->site_config['copyright_text_footer']) && trim($this->site_config['copyright_text_footer'])!=''){
                echo '<div class="copyright text-center">
                        <p>'.$this->site_config['copyright_text_footer'].'</p>
                    </div>';
            }
            ?>
        </div>

    </div>
    <script>
        $(document).ready(function () {
            <?php
            if(Yii::app()->session['otm']!=""){?>
                Swal.fire(
                    '',
                    '<?=Yii::app()->session['otm']?>',
                    'success'
                );
            <?php
                Yii::app()->session['otm'] = '';
            }
            ?>
        });
    </script>
</footer>
<a class="back-to-top" id="scroll" href="javascript:;"> <i class="fa fa-angle-up"></i> </a>
<?php
if(CFunction::isIE()){?>
    <style>
        header nav.navbar-dark .navbar-nav .nav-link{
            padding: 20px 2px 10px 2px;
        }
    </style>
<?php }
?>
<script>
    $(document).ready(function () {
        //download file
        $("a[href^='"+DOWNLOAD_LINK+"']").attr('href', function (i, attr) {
            $(this).addClass('download-button');
        });
        $("a[href^='"+DOWNLOAD_LINK2+"']").attr('href', function (i, attr) {
            $(this).addClass('download-button');
        });
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-149945125-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-149945125-1');
</script>

</html>