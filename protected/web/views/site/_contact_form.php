<script src='https://www.google.com/recaptcha/api.js?hl=ja'></script>
<div data-aos="fade-up" class="contract-wrapper aos-init aos-animate">
    <div class="new_client">
        <div class="gf-heading">
            <h2 class="heading-title accent-color" id="contact_form_heading">サービスに関するお問い合わせ</h2>
        </div>
        <div class="container">
            <div class="contact-form-step-1" id="contact-form-step-1">
                <div class="row">
                    <h4 class="accent-color"> お客様のご連絡先 </h4>
                    <form onsubmit="return false;" class="form" id="contact_form" action="/contact" method="post">
                        <input type="hidden" value="<?=Yii::app()->request->csrfToken?>" name="<?=Yii::app()->request->csrfTokenName?>">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                <div class="form-group data">
                                    <label for="WContact_conpany_name">貴社名</label>
                                    <input class="form-control" size="60" maxlength="100" name="WContact[conpany_name]" id="WContact_conpany_name" type="text"> </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                <div class="form-group data">
                                    <label for="WContact_department_name">部署名</label>
                                    <input class="form-control" size="60" maxlength="100" name="WContact[department_name]" id="WContact_department_name" type="text"> </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                <div class="form-group data">
                                    <label for="WContact_contact_name" class="required">ご担当者名 <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="100" name="WContact[contact_name]" id="WContact_contact_name" type="text"> </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                <div class="form-group data">
                                    <label for="WContact_phone">電話番号</label>
                                    <input class="form-control" size="60" maxlength="255" name="WContact[phone]" id="WContact_phone" type="text"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                <div class="form-group data">
                                    <label for="WContact_email" class="required">メールアドレス <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="50" name="WContact[email]" id="WContact_email" type="text"> </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                                <div class="form-group data">
                                    <label for="WContact_district">都道府県</label>
                                    <input class="form-control" size="60" maxlength="200" name="WContact[district]" id="WContact_district" type="text"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group data">
                                    <label for="WContact_address">ご住所</label>
                                    <input class="form-control" size="60" maxlength="200" name="WContact[address]" id="WContact_address" type="text"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group data">
                                    <label for="WContact_subject" class="required">件名 <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="100" name="WContact[subject]" id="WContact_subject" type="text"> </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group data">
                                    <label for="WContact_content" class="required">お問い合わせ内容 <span class="required">*</span></label>
                                    <textarea class="form-control new-line" rows="8" size="60" maxlength="2200" name="WContact[content]" id="WContact_content"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row row-privacy">
                            <!--col-sm-12 col-md-12 col-lg-12 col-xs-12-->
                            <br>
                            <h4 class="accent-color"> 個人情報の取扱いについて </h4>
                            <div class="form-group">
                                <div class="form-control col-sm-12 col-md-12 col-lg-12 col-xs-12 privacy">
                                    <div class="privacy-body">
                                        <b>1. 利用目的について</b>
                                        <br> ご記入いただいた個人情報は、お問い合わせへの対応、および確認に利用します。また、この目的のためにお問い合わせの記録を残すことがあります。
                                        <br>
                                        <br>

                                        <b>2．個人情報の第三者提供
                                        </b>
                                        <br> 取得した個人情報は法令等による場合を除いて、第三者に提供することはありません。
                                        <br>
                                        <br>

                                        <b>3．個人情報の委託
                                        </b>
                                        <br> 取得した個人情報の取扱いを委託することはありません。 ご本人からの求めにより、私たちが保有する開示対象個人情報の利用目的の通知・開示・内容の訂正・追加または削除・利用の停止・消去および第三者への提供の停止に応じます。
                                        <br>
                                        <br>

                                        <b>4．ご記入について</b>
                                        <br> ご記入は任意ですが、不足がある場合、当社からの情報・サービス等の提供に支障が生じる場合があります。
                                        <br>
                                        <br>

                                        <b>5．クッキー（Cookie）について</b>
                                        <br> 本ページでは、クッキーやウェブ・ビーコンを使用するなどして、本人が容易に認識できない方法により個人情報を取得することはありません。
                                        <br>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons" style="margin-bottom: 10px;">
                            <input name="WContact[agree]" id="WContact_agree" type="checkbox">
                            <label for="WContact_agree">個人情報の取扱いについて同意する<span class="required">*</span></label>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <?php $google_recaptcha = Yii::app()->params['google_recaptcha'] ; ?>
                            <div data-callback="callback" id="g-recaptcha" class="g-recaptcha" data-sitekey="<?=$google_recaptcha['site_key']?>"></div>
                            <input name="WContact[captcha]" id="WContact_captcha" type="hidden">
                        </div>
                    </form>
                </div>
                <div style="margin-bottom: 30px;margin-left: -15px;">
                    <div class="text-center">
                        <input  onclick="sendContact(1);" type="button" name="commit" value="<?=Yii::t('web/app','Confirmation of input contents')?>" class="button button-large btn btn-primary" id="button-put" data-disable-with="<?=Yii::t('web/app','Confirmation of input contents')?>">
                    </div>
                </div>
            </div>
            <div class="contact-form-step-2" id="contact-form-step-2">
                <p>よろしければ「送信する」ボタンを押して下さい。</p>
                <div id="step_2_html">
                </div>
            </div>
    </div>
</div>
    <script type="text/javascript">
        
        function callback() {
            $('#WContact_captcha').next('.errorMessage').remove();
        }
        function sendContact(scroll) {
            var isChecked = $('#WContact_agree').is(':checked');
            if(isChecked){
                $('#WContact_agree').val(1);
            }else{
                $('#WContact_agree').val(0);
            }
            $("#contact_form").serialize();
            var data=$("#contact_form").serialize()+ '&WContact_agree=' + $('#WContact_agree').val()+ '&captcha=' + grecaptcha.getResponse();

            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createAbsoluteUrl("site/contactValidate"); ?>',
                data:data,
                dataType: 'json',
                success:function(res){
                    if(res.status==1){
                        $('#contact_form .errorMessage').remove();
                        $('#contact_form .form-control.error').removeClass('error');
                        $('#map').hide();
                        show_contact_form_info();
                    }else{
                        resetGoogleCaptcha();

                        addFormError('contact_form',res);
                        //scroll
                        if(scroll==1){
                            var tmp_top = $('.navbar-nav').outerHeight();
                            if($("#contact_form .error").length > 0) {
                                $('html, body').animate({
                                    scrollTop: $("#contact_form .error").offset().top - tmp_top - 60
                                }, 500);
                            }
                        }
                        //end scroll
                        $('#contact_form .form-control.error').each(function (i) {
                            if(i==0){
                                $(this).focus();
                            }
                        });
                    }
                },
                error: function(data) { // if error occured
                    console.log("Error occured.please try again");
                    console.log(data);
                },
            });
        }
        
        function show_contact_form_info() {
            var step_2_html = '';
            $('#contact-form-step-1').hide();
            $('#contact-form-step-2').show();
            var d=0;
            var total = $('#contact-form-step-1 .form-group.data').length;
            $('#contact-form-step-1 .form-group.data').each(function (index) {
                d++;
                if(d==total){
                    var last_child=1;
                }else{
                    var last_child=0;
                }
                var _this = $(this);
                var label = $(_this).find('label').html();
                var name = label.split("<span");
                name = name[0];
                //
                var input = $(_this).find('.form-control');
                var input_name = input.attr('name');
                var input_value = input.val();
                var _item = '<div class="row rcontent '+(last_child==1?"last":"")+' ">\n' +
                                '<div class="col col-md-2"><b>'+name+'</b></div>\n' +
                                '<div class="col col-md-10 new-line">'+input_value+'</div>\n' +
                            ' </div>';
                step_2_html+=_item;
            });
            step_2_html+='<h4><?=Yii::t('web/app','If you are unable to send a message from the form, email it to the following address')?>&nbsp;<span class="email-address"><?=(isset($this->site_config['contact_email'])?$this->site_config['contact_email']:"")?></span></h4>';
            step_2_html+='<div class="text-center" style="margin: 20px 0;">\n' +
                        '<a onclick="submitContact(this);" id="submit_contact" class="btn btn-success"><?=Yii::t('web/app','sent')?></a>\n' +
                        '<a onclick="backToStepOne();"id="back_to_step_1" class="btn btn-danger back"><?=Yii::t('web/app','back')?></a>\n' +
                    '</div>'
            $('#step_2_html').html(step_2_html);
        }

        function backToStepOne() {
            //grecaptcha.reset();
            resetGoogleCaptcha();

            $("#contact_form input").removeClass('error');
            $("#contact_form textarea").removeClass('error');
            $("#WContact_agree").removeClass('error');
            $('.errorMessage').remove();
            //
            $('#contact-form-step-2').hide();
            $('#contact-form-step-1').show();
        }

        var clickSumit=0;

        function submitContact(btn) {
            var data=$("#contact_form").serialize();
            if(clickSumit==0){
                clickSumit=1;
                $.ajax({
                        type: 'POST',
                        url: '<?php echo Yii::app()->createAbsoluteUrl("site/contactSubmit"); ?>',
                        data:data,
                        dataType: 'json',
                        success:function(res){
                            //grecaptcha.reset();
                            resetGoogleCaptcha();
                            clickSumit=0;
                            if(res.status==1){
                                $('#contact-form-step-1').show();
                                $('#contact-form-step-2').hide();
                                $("#contact_form input[type=text]").val('');
                                $("#contact_form input[type=email]").val('');
                                $("#contact_form input[type=number]").val('');
                                $("#contact_form textarea").val('');
                                $("#contact_form input").removeClass('error');
                                $("#contact_form textarea").removeClass('error');
                                $("#WContact_agree").removeClass('error');
                                $('.errorMessage').remove();
                                $("#WContact_agree").prop("checked", false);
                                $('#map').show();
                                //send email
                                $('body').append(res.email_queue);
                                $('body').append(res.email_queue2);
                                /*Swal.fire(
                                    '',
                                    ''+res.message+'',
                                    'success'
                                );*/
                                swal('', ''+res.message+'','success');
                                scrollToID('contact_form_heading');
                            }else{
                                swal('', ''+res.message+'','error');
                            }
                        },
                        error: function(data) { // if error occured
                            console.log("Error occured.please try again");
                            console.log(data);
                        },
                    });
                }
        }

        function resetGoogleCaptcha() {
            if(typeof grecaptcha !== 'undefined' && grecaptcha && grecaptcha.reset) {
                grecaptcha.reset();
            }
        }
    </script>