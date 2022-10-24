<?php

    /**
     * LoginForm class.
     * LoginForm is the data structure for keeping
     * user login form data. It is used by the 'login' action of 'SiteController'.
     */
    class ALoginForm extends CFormModel
    {
        public $username;
        public $password;
        public $rememberMe;

        private $_identity;
        public  $captcha=0;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules()
        {
            return array(
                // username and password are required
                array('username, password', 'required'),
                // rememberMe needs to be a boolean
                array('rememberMe', 'boolean'),
                // password needs to be authenticated
                array('password', 'authenticate'),
                array('captcha', 'checkCaptcha'),
            );
        }

        public function checkCaptcha() {
            if ($this->captcha == 0) {
                $this->addError('captcha', 'Captcha không đúng');
                return false;
            }
            return true;
        }

        /**
         * Declares attribute labels.
         */
        public function attributeLabels()
        {
            return array(
                'username'   => Yii::t('common/LoginForm', 'username'),
                'password'   => Yii::t('common/LoginForm', 'password'),
                'rememberMe' => Yii::t('common/LoginForm', 'remember'),
                'captcha' => 'Captcha',
            );
        }

        /**
         * Authenticates the password.
         * This is the 'authenticate' validator as declared in rules().
         */
        public function authenticate($attribute, $params)
        {
            if (!$this->hasErrors()) {
                $this->_identity = new AUserIdentity($this->username, $this->password);
                if (!$this->_identity->authenticate())
                    $this->addError('password', Yii::t('common/LoginForm', 'incorrect_userpass'));
            }
        }

        /**
         * Logs in the user using the given username and password in the model.
         *
         * @return boolean whether login is successful
         */
        public function login()
        {
            if ($this->_identity === NULL) {
                $this->_identity = new AUserIdentity($this->username, $this->password);
                $this->_identity->authenticate();
            }
            if ($this->_identity->errorCode === AUserIdentity::ERROR_NONE) {
                $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
                Yii::app()->user->login($this->_identity, $duration);

                return TRUE;
            } else
                return FALSE;
        }

    }
