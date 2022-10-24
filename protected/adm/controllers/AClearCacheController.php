<?php

    class AClearCacheController extends AController
    {
        public function __construct($id, $module = NULL)
        {
            parent::__construct($id, $module);
            $this->menu = array();

        }

        public function init()
        {
            parent::init();
            if (Yii::app()->user->isGuest) {
                $this->redirect($this->createUrl('aSite/login'));
            }
        }

        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         *
         * @return array access control rules
         */
        public function accessRules()
        {
            return array(
                array('allow', // allow all users to perform 'index' and 'view' actions
                    'actions' => array('index', 'view'),
                    'users'   => '@',
//                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"view")',
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'actions'    => array('create', 'update'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"edit")',
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions'    => array('admin', 'delete'),
                    'expression' => 'AUserPermission::checkUserPermission(Yii::app()->controller->id,"del")',
                ),
                array('deny', // deny all users
                    'users' => array('*'),
                ),
            );
        }

        /**
         * The function that do clear Cache
         *
         */
        public function actionIndex()
        {
            $this->render('index');
        }


    }