<script src='https://www.google.com/recaptcha/api.js?hl=vi'></script>
<?php
    $this->pageTitle = Yii::app()->name.Yii::t('adm/common', 'title_site');
    /*$this->breadcrumbs=array(
        'Login',
    );*/
?>
<section class="login_content">
    <h1>Đăng nhập</h1>
    <?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
        'id'                     => 'login-form',
        'enableClientValidation' => true,
        'clientOptions'          => array(
            'validateOnSubmit' => true,
        ),

    )); ?>
    <?php echo $form->errorSummary($model); ?>
    <div>
        <?php echo $form->textFieldGroup($model, 'username',array('label'=>false)); ?>
    </div>
    <div>
        <?php echo $form->passwordFieldGroup($model, 'password',array('label'=>false)); ?>
    </div>

    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="<?=$google_recaptcha['site_key']?>"></div>
    </div>

    <div class="row buttons">
        <?php
            $this->widget('booster.widgets.TbButton', array('buttonType' => 'submit', 'label' => Yii::t('common/LoginForm', 'login'), 'context' => 'primary', 'icon' => 'lock'));
        ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType' => 'reset', 'label' => Yii::t('common/LoginForm', 'reset'), 'icon' => 'remove',)); ?>
    </div>
    <?php $this->endWidget(); ?>


    <div class="clearfix"></div>
    <div class="separator">
        <div class="clearfix"></div>
        <br/>

        <div>
            <h1><i class="fa fa-paw" style="font-size: 26px;"></i> Admin CP</h1>
        </div>
    </div>

    <!-- form -->
</section>


