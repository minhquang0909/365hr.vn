<?php

    /**
     * UserIdentity represents the data needed to identity a user.
     * It contains the authentication method that checks if the provided
     * data can identity the user.
     */
    class WUserIdentity extends CUserIdentity
    {
        private $_id;
        public  $fullname = '';

        /**
         * Constructor.
         *
         * @param string $username username
         * @param string $password password
         */
        public function __construct($username, $password)
        {
            $this->username = $username;
            $this->password = $password;
        }

       /* /**
         * Authenticates a user.
         * The example implementation makes sure if the username and password
         * are both 'demo'.
         * In practical applications, this should be changed to authenticate
         * against some persistent user identity storage (e.g. database).
         *
         * @return boolean whether authentication succeeds.
         */

        public function authenticate()
        {
            // login by username

            $user = WCustomers::model()->find('LOWER(username)=:user_name or LOWER(email)=:user_name', array(':user_name' => strtolower($this->username)));
            if ($user===null) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            } else if (!$user->validatePassword($this->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $user->login_count +=1;
                $user->update();
                $this->_id = $user->id;
                $this->setState('id', $user->id);
                $this->setState('role', 'user');
                $this->setState('username', $user->username);
                $this->setState('first_name', $user->first_name);
                $this->errorCode = self::ERROR_NONE;

            }
            return $this->errorCode==self::ERROR_NONE;
        }

        /* /*
          * Login Via Facebook
          */

        public function authenticate_social()
        {
            $user = WCustomers::model()->find('LOWER(username)=?', array(strtolower($this->username)));
            if ($user===null) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            } else {
                $this->_id = $user->id;
                $this->setState('id', $user->id);
                $this->setState('role', 'user');
                $this->setState('username', $user->username);
                $this->setState('first_name', $user->first_name);
                $this->errorCode = self::ERROR_NONE;
            }

            return $this->errorCode==self::ERROR_NONE;
        }

        /**
         * @return integer the ID of the user record
         */
        public function getId()
        {
            return $this->_id;
        }
    }