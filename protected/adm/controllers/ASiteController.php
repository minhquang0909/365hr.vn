<?php

    class ASiteController extends AController
    {
        public function init()
        {
            parent::init();
            $this->pageTitle = Yii::app()->params->project_name;

        }

        public function actionIndex()
        {

            if (Yii::app()->user->isGuest) {
                $this->redirect(array('login'));
            } else {
                $this->render('index');
            }
        }

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

        /**
         * Displays the contact page
         */
        public function actionContact()
        {
            $model = new ContactForm;
            if (isset($_POST['ContactForm'])) {
                $model->attributes = $_POST['ContactForm'];
                if ($model->validate()) {
                    $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                    mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                    Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                    $this->refresh();
                }
            }
            $this->render('contact', array('model' => $model));
        }

        /**
         * Displays the login page
         */
        public function actionLogin()
        {
            //ini_set('display_errors', 1);
            $year  = date("Y");
            $month = date("m");

            $this->layout    = '//layouts/mainlogin';
            $this->pageTitle = Yii::t('adm/app', 'mnu_login');
            $google_recaptcha = Yii::app()->params['google_recaptcha'];

            $model = new ALoginForm;
            // if it is ajax validation request
            if (isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if (isset(Yii::app()->session['last_login']) && (time() - Yii::app()->session['last_login']) / 60 <= 60) {  //60 phút
                $this->redirect(array('alert'));
            } else {
                unset(Yii::app()->session['last_login']);
                //unset(Yii::app()->session['incorrect']);
            }

            if (isset(Yii::app()->session['incorrect']) && Yii::app()->session['incorrect'] >= 2) {
                Yii::app()->session['last_login'] = time();
            }

            // collect user input data
            if (isset($_POST['ALoginForm'])) { //echo 't2';
                $user              = $_POST['ALoginForm']['username'];
                $logs              = array(
                    array('Success', $user.': Login success', 'I'),
                    //array('Fail', 'Commit Transaction', 'I')
                );
                $model->attributes = $_POST['ALoginForm'];
                // validate user input and redirect to the previous page if valid
                $captcha = $_REQUEST['g-recaptcha-response'];
                if(CFunction::checkGoogleCaptcha($captcha)){
                    $model->captcha = 1;
                }else{
                    $model->captcha = 0;
                }
                if ($model->validate() && $model->login()) { //echo 't3';
                    unset(Yii::app()->session['last_login']);
                    unset(Yii::app()->session['incorrect']);
                    $this->redirect(Yii::app()->user->returnUrl);
                } else { //echo 't4';
                    if (!isset(Yii::app()->session['incorrect']) && !Yii::app()->session['incorrect']) { //echo 't5';
                        Yii::app()->session['incorrect'] = 1;
                    } else { //echo 't6';
                        Yii::app()->session['incorrect'] += 1;
                    }

                }
            }
            // display the login form
            $this->render('login', array(
                'google_recaptcha'  =>  $google_recaptcha,
                'model' => $model
            ));
        }

        public function actionAlert()
        {
            $this->layout = '//layouts/mainlogin';
            $this->render('alert');
        }

        /**
         * Logs out the current user and redirect to homepage.
         */
        public function actionLogout()
        {
            Yii::app()->user->logout();
            unset(Yii::app()->session['incorrect']);
            $this->redirect(Yii::app()->createUrl('/aSite/login'));
        }
    }