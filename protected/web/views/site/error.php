<div class="wrap" style="margin-top: 20px;">
    <!--start-content------>
    <div class="container content page404">
        <img src="<?= $this->theme_url; ?>/images/error-img.png">
        <p style="color: orange;margin-top: 10px;">
            <?php echo CHtml::encode($message); ?>
        </p>
        <a class="btn btn-primary" href="<?=Yii::app()->createUrl('site/index');?>">ホームページに行く</a>
        <div class="copy-right">
            <p><?=(isset($this->site_config['copyright_footer'])?$this->site_config['copyright_footer']:'')?></p>
        </div>
    </div>
    <!--End-Cotent------>
</div>
