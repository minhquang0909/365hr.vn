<?php
$this->renderPartial('/news/_top_banner', array(
    'title' =>  Yii::t('web/app','contact_us')
));
?>

<div class="container mt50">
    <div class="contact-info aos-init aos-animate" data-aos="fade-up">
        <div class="row">
            <?php
            if((isset($this->site_config['contact_email'])?$this->site_config['contact_email']:"")){?>
                <div class="col-lg-4 col-md-12 content-wrapper">
                    <div class="info-content">
                        <div class="left">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="right">
                            <h6 class="mb10">メールアドレス</h6>
                            <p class="mb0"><?=$this->site_config['contact_email']?></p>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
            <?php
            if((isset($this->site_config['contact_phone'])?$this->site_config['contact_phone']:"")){?>
                <div class="col-lg-4 col-md-12 content-wrapper">
                    <div class="info-content">
                        <div class="left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="right">
                            <h6 class="mb10">電話番号</h6>
                            <p class="mb0"><?=$this->site_config['contact_phone']?></p>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
            <?php
            if((isset($this->site_config['contact_address'])?$this->site_config['contact_address']:"")){?>
                <div class="col-lg-4 col-md-12 content-wrapper">
                    <div class="info-content">
                        <div class="left">
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="right">
                            <h6 class="mb10">住所</h6>
                            <p class="mb0"><?=$this->site_config['contact_address']?></p>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
    <?php
    $this->renderPartial('_contact_form', array());
    ?>
    <?php
    if((isset($this->site_config['contact_address'])?$this->site_config['contact_address']:"")){?>
        <div id="map" class="mb30">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3246.3251165848737!2d139.6899952152551!3d35.54567198022611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601860800c2b5a87%3A0x190eaf0d0e974a07!2s2-ch%C5%8Dme-5-4%20Tote%2C%20Saiwai-ku%2C%20Kawasaki%2C%20Kanagawa%20212-0005%2C%20Japan!5e0!3m2!1sen!2s!4v1568820289566!5m2!1sen!2s&language=ja&region=JP" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
    <?php }
    ?>
</div>
</div>
