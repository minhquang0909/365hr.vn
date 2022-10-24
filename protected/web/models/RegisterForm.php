<?php

    /**
     * LoginForm class.
     * LoginForm is the data structure for keeping
     * user login form data. It is used by the 'login' action of 'SiteController'.
     */
    class RegisterForm extends Customers
    {
        public $rememberMe;
        public $repassword;
        private $_identity;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules()
        {
            return array(
                array('username,email,password,repassword', 'required','message'=>'Vui lòng nhập {attribute}'),
                array('username,email', 'unique'),

                array('repassword', 'compare', 'compareAttribute'=>'password'),

                array('password', 'length', 'min'=>6),
                array('status, login_count,googleplus_id', 'numerical', 'integerOnly'=>true),
                array('email', 'length', 'max'=>50),
                array('msisdn', 'length', 'max'=>50),
                array('username', 'length', 'max'=>100),
                array('password, email, token_key, first_name, last_name', 'length', 'max'=>255),
                array('address, avatar', 'length', 'max'=>1000),
                array('googleplus_id', 'length', 'max'=>50),
                array('gender', 'length', 'max'=>10),
                array('birthday, last_update, expire_date, bio', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, msisdn, username, password, email, birthday, address, create_time, last_update, expire_date, token_key, first_name, last_name, bio, status, facebook_id, googleplus_id, avatar, gender, login_count', 'safe', 'on'=>'search'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'id' => 'ID',
                'msisdn' => 'Điện thoại',
                'username' => 'Tài khoản',
                'password' => 'Mật khẩu',
                'email' => 'Điện thoại',
                'birthday' => 'Birthday',
                'address' => 'Address',

                'create_time' => 'Create Time',
                'last_update' => 'Last Update',
                'expire_date' => 'Expire Date',
                'token_key' => 'Token Key',
                'first_name' => 'Tên',
                'last_name' => 'Họ',
                'bio' => 'Bio',
                'status' => 'Trạng thái',
                'facebook_id' => 'Facebook ID',
                'googleplus_id' => 'Googleplus ID',
                'avatar' => 'Avatar',
                'gender' => 'Gender',
                'repassword' => 'Nhập lại mật khẩu',
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
            $user = NULL;
            if ($this->_identity === NULL) {
                $this->_identity = new WUserIdentity($this->username, $this->password);
                $user            = $this->_identity->authenticate();
            }

            if ($user) {
                return $user;
            } else
                return FALSE;
        }
        public function beforeSave()
        {
            if ($this->scenario=='insert') {
                $this->password = CPasswordHelper::hashPassword($this->password);
            }
            $this->last_update = date('Y-m-d H:i:s');

            return true;
        }
    }
