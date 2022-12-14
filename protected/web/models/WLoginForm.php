<?php

    /**
     * LoginForm class.
     * LoginForm is the data structure for keeping
     * user login form data. It is used by the 'login' action of 'SiteController'.
     */
    class WLoginForm extends LoginForm
    {
        public  $username;
        public  $password;
        public  $rememberMe;
        private $_identity;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules()
        {
            return array(
                // username and password are required
                array('username, password', 'required', 'message' => "Vui lòng nhập {attribute}"),
                // rememberMe needs to be a boolean
                array('rememberMe', 'boolean'),
                // password needs to be authenticated
                array('password', 'authenticate'),
            );
        }

        /**
         * Declares attribute labels.
         */
        public function attributeLabels()
        {
            return array(
                'username'   => Yii::t('common/LoginForm', 'username'),
                'password'   => Yii::t('common/LoginForm', 'password'),
                'rememberMe' => Yii::t('common/LoginForm', 'rememberMe'),
            );
        }

        /**
         * Authenticates the password.
         * This is the 'authenticate' validator as declared in rules().
         */
        public function authenticate($attribute, $params)
        {
            if (!$this->hasErrors()) {
                $this->_identity = new WUserIdentity($this->username, $this->password);
                if (!$this->_identity->authenticate()) {
                    $this->addError('password', Yii::t('common/LoginForm', 'incorrect_userpass'));
                }
            }
        }

        public function login()
        {
            if($this->_identity===null)
            {
                $this->_identity=new WUserIdentity($this->username,$this->password);
                $this->_identity->authenticate();
            }
            if($this->_identity->errorCode===WUserIdentity::ERROR_NONE)
            {
                $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
                Yii::app()->user->login($this->_identity,$duration);
                return true;
            }
            else
                return false;
        }

    }
