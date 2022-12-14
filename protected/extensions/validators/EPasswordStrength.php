<?php

    /**
     *
     * EPasswordStrength class
     *
     * Validate if password is strong enought
     *
     * The validator check if password has at least min characters,
     * and if password contain at least one lower case letter, at least one upper case letter,
     * and at least one number
     *
     *
     *
     *
     * @see      http://www.yiiframework.com
     * @version  1.0
     * @access   public
     * @author   ivica Nedeljkovic (ivica.nedeljkovic@gmail.com)
     */
    class EPasswordStrength extends CValidator
    {

        //Minimum password length
        public $min = 7;

        /**
         * (non-PHPdoc)
         *
         * @see CValidator::validateAttribute()
         */
        protected function validateAttribute($object, $attribute)
        {
            if (!$this->checkPasswordStrength($object->$attribute)) {
                $message = $this->message !== null ? $this->message : Yii::t("EPasswordStrength", "{attribute} yếu. {attribute} phải chứa ít nhất {$this->min} kí tự, ít nhất phải chứa 1 kí tự thường, ít nhất phải chứa 1 kí tự hoa, và ít nhất chứa 1 số.");
                $this->addError($object, $attribute, $message);
            }
        }

        /**
         * Check if password is strong enought
         *
         * @param string $password
         *
         * @return boolean
         */
        protected function checkPasswordStrength($password)
        { //var_dump($repassword); exit();
            if (preg_match("/^.*(?=.{" . $this->min . ",})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password)) {
                return true;
            } else {
                return false;
            }
        }

    }

