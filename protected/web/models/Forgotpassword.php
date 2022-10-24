<?php
    class Forgotpassword extends CFormModel
    {
        public $username;
        public $email;
        public $verifyCode;

        public function rules()
        {
            return array(
                array('email,verifyCode', 'required','message'=>'Bạn cần nhập {attribute}'),
                array('email', 'email'),
                array('email', 'exist',
                    'className'  => 'WCustomers',
                    'allowEmpty' => 'true',
                    'message' => 'Email của bạn không tồn tại trên hệ thống',
                ),
            );
        }

        public function attributeLabels()
        {
            return array(
                'verifyCode'=>'Captcha',
            );
        }

        /**
         * @return mixed the P2User object matching these form values or null if not existant
         */
        public function getUser()
        {
            if ($this->username)
                return WCustomers::model()->findByAttributes(array('username' => $this->username));
            elseif ($this->email)
                return WCustomers::model()->findByAttributes(array('email' => $this->email));
            else
                return null;
        }


    }

?>