<?php

    /**
     * Add information to Yii::app()->user by extending CWebUser
     */
    class WebUser extends CWebUser
    {
      //  private $_model;
        public function init()
        {
            parent::init();
        }

        /**
         * Load user model.
         */
        protected function loadUser($id = NULL)
        {
            if ($this->_model === NULL) {
                if ($id !== NULL)
                    $this->_model = WCustomers::model()->findByAttributes(array('id' => $id));
            }

            return $this->_model;
        }
    }