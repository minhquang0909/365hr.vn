<?php

class SiteController extends Controller
{
    /**
     * Default action
     */
    public function actionIndex()
    {
        $this->render('index', array());

    } //end index

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    public function actionDownload(){
        $id = Yii::app()->request->getParam('id');
        $model = File::model()->findByPk($id);
        if($model){
            $base_dir = dirname(dirname(dirname(dirname(__FILE__))));
            $upload_directory = $base_dir.'/uploads/files/';
            $file = $upload_directory.$model->path;
            if (file_exists($file)) {
                $mime = $model->type;
                $filename = $model->path;
                header("Content-Description: File Transfer");
                header("Content-Type: {$mime}");
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Content-Type: application/force-download");
                header("Content-Type: application/download");
                header("Content-Disposition: attachment; filename={$filename}");
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . filesize($file));
                while(ob_get_level()) ob_end_clean();
                flush();
                readfile($file);
                exit;
            }else{
                $this->render('error', array(
                    'message'  =>  Yii::t('web/app','File not found')
                ));
            }
        }else{
            $this->render('error', array(
                'message'  =>  Yii::t('web/app','File not found')
            ));
        }
    }

    public function actionContact()
    {
        $this->pageUrl = Yii::app()->createAbsoluteUrl('site/contact');
        /*$model = new WContact();
        if (isset($_POST['WContact'])) {
            $model->attributes = $_POST['WContact'];
            if ($model->validate()) {
                CVarDumper::dump($model,10,true);
            } else {
                CVarDumper::dump($model->getErrors(),10,true);
            }
        }*/
        $this->render('contact');

    } //end index

    public function actionContactValidate(){
        $model = new WContact();
        if (isset($_POST['WContact'])) {
            $model->attributes = $_POST['WContact'];
            $model->agree = $_POST['WContact_agree'];
            $captcha = $_POST['captcha'];
            if(CFunction::checkGoogleCaptcha($captcha)){
                $model->captcha = 1;
            }else{
                $model->captcha = 0;
            }
            if ($model->validate()) {
                echo CJSON::encode(array(
                    'status'    =>  1,
                    'message'   =>  'OK',
                    'data'      =>  $model,
                    'errors'    =>  array()
                ));
            } else {
                echo CJSON::encode(array(
                    'status'    =>  -1,
                    'message'   =>  'OK',
                    'data'      =>  array(),
                    'errors'    =>  $model->getErrors()
                ));
            }
        }
    }
    public function actionContactSubmit(){
        $model = new WContact();
        if (isset($_POST['WContact'])) {
            $model->attributes = $_POST['WContact'];
            $model->created_date = time();
            $queue_id = $queue_id_2 = 0;
            $email_queue = $email_queue2 = '';

            if ($model->insert(false)) {
                $send_email_admin = true;
                //gửi email tới admin
                $contact_email = isset($this->site_config['contact_email_send_to_admin'])?trim($this->site_config['contact_email_send_to_admin']):'';
                if(CFunction::isEmail($contact_email)){
                    $title = $model->subject;
                    $body = $this->renderPartial('_email_to_admin', array('model'=>$model),true);
                    $emailQueue = new QueueEmail();
                    $emailQueue->type = QueueEmail::TYPE_CONTACT;
                    $emailQueue->email = $contact_email;
                    $emailQueue->content = CJSON::encode(array(
                        'from'     =>  (isset($this->site_config['email_name'])?$this->site_config['email_name']:""),
                        'title'     =>  '【'.$model->contact_name.'様】'.$model->subject,
                        'body'     =>  $body
                    ));
                    $emailQueue->created_date = time();
                    if($emailQueue->insert(false)){
                        $queue_id = $emailQueue->id;
                        $email_queue  = '<img width="0" height="0" src="'.Yii::app()->createUrl('site/sendEmail',array('queue_id'=>$queue_id)).'" >';
                    }
                }

                if($send_email_admin){
                    //add email queue (gửi email tới khách hàng)
                    if(isset($this->site_config['email_send_customer']) && strtolower($this->site_config['email_send_customer'])=='on'){
                        $title2 = '【イ・ジン・ザイ】お問い合わせ ありがとうございます	';
                        $body2 = $this->renderPartial('_email_to_customer', array('model'=>$model),true);
                        $emailQueue2 = new QueueEmail();
                        $emailQueue2->type = QueueEmail::TYPE_CONTACT;
                        $emailQueue2->email = $model->email;
                        $emailQueue2->content = CJSON::encode(array(
                            'from'     =>  (isset($this->site_config['email_name'])?$this->site_config['email_name']:""),
                            'title'     =>  $title2,
                            'body'     =>  $body2
                        ));
                        $emailQueue2->created_date = time();
                        if($emailQueue2->insert(false)){
                            $queue_id2 = $emailQueue2->id;
                            $email_queue2  = '<img width="0" height="0" src="'.Yii::app()->createUrl('site/sendEmail',array('queue_id'=>$queue_id2)).'" >';
                        }
                    }
                    //
                    echo CJSON::encode(array(
                        'status'    =>  1,
                        'message'   =>  Yii::t('web/app','Successful sending, we will contact you as soon as possible, thank you'),
                        'email_queue' =>  $email_queue,
                        'email_queue2' =>  $email_queue2,
                    ));
                }else{
                    echo CJSON::encode(array(
                        'status'    =>  -1,
                        'message'   =>  Yii::t('web/app','Failed to send contact, please try again later'),
                        'email_queue' =>  $email_queue,
                        'email_queue2' =>  $email_queue2,
                    ));
                }
                //end gửi email tới admin
            } else {
                echo CJSON::encode(array(
                    'status'    =>  -1,
                    'message'   =>  'Unknown error',
                    'email_queue' =>  $email_queue,
                    'email_queue2' =>  $email_queue2,
                ));
            }
        }
    }

    public function actionSendEmail(){
        $id = (int)Yii::app()->request->getParam('queue_id');
        $model = QueueEmail::model()->findByPk($id);
        if($model){
            $email = $model->email;
            $content = CJSON::decode($model['content']);
            //
            $email_config = array(
                'email_host'    =>  isset($this->site_config['email_host'])?$this->site_config['email_host']:'',
                'email_username'    =>  isset($this->site_config['email_username'])?$this->site_config['email_username']:'',
                'email_password'    =>  isset($this->site_config['email_password'])?$this->site_config['email_password']:'',
                'email_port'    =>  isset($this->site_config['email_port'])?$this->site_config['email_port']:'',
                'email_type'    =>  isset($this->site_config['email_type'])?$this->site_config['email_type']:'',
            );
            if(is_array($content) && isset($content['title']) && isset($content['body'])){
                $default_title = (isset($this->site_config['email_name'])?$this->site_config['email_name']:"IZINZAI");
                $title = isset($content['title'])?$content['title']:$default_title;
                $from = isset($content['from'])?$content['from']:$default_title;
                $rs = Utils::sendEmail($email_config, $from, $email, $title, $title, $content['body']);
                if($rs){
                    //OK
                    $model->delete();
                }else{
                    //$model->delete();
                    //failed
                }
            }
        }else{
            //echo 'Email queue not found';
        }
        CFunction::responseGifNull();
    }

    /**
     * @param $code_name
     */
    public function actionChangeLanguage($code_name)
    {
        $list_lang = Languages::model()->find("code_name ='$code_name'");
        if ($list_lang) {
            Yii::app()->session['language'] = $list_lang->code_name;
            Yii::app()->session['language_id'] = $list_lang->id;
        }

        if ($_SERVER['HTTP_REFERER'] !== null) {
            $this->redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->redirect(Yii::app()->baseUrl);
        }
    }
}