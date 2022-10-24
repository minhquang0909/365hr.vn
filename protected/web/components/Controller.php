<?php

    /**
     * Controller is the customized base controller class.
     * All controller classes for this application should extend from this base class.
     */
    class Controller extends CController
    {
        /**
         * @var string the default layout for the controller view. Defaults to '//layouts/column1',
         * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
         */
        public $layout = '/layouts/main';
        public $pageTitle = '';
        public $pageUrl = '';
        public $domain_name = null;
        public $isMobile = false;
        public $mobileDir = '';
        public $pageKeyword = null;
        public $pageDescription = null;
        public $pageImage = null;
        public $base_url = null;
        public $theme_url = null;
        public $params = null;
        public $upload_url = null;
        public $site_config = array();
        public $banner_list = array();

        public function init()
        {
            /*Language*/
            if (isset(Yii::app()->session['language']) && Yii::app()->session['language'] != '') {
                Yii::app()->language = Yii::app()->session['language'];
            }else{
                Yii::app()->session['language_id'] = 1; //tiếng Nhật
            }
            /*End Language*/
            $this->theme_url   = Yii::app()->theme->baseUrl;
            $this->base_url    = Yii::app()->baseUrl;
            $this->params      = Yii::app()->params;
            $this->domain_name = isset($GLOBALS['config_common']['project']['domain_name']) ? $GLOBALS['config_common']['project']['domain_name'] : '';
            $this->upload_url  = isset($GLOBALS['config_common']['project']['upload_url']) ? $GLOBALS['config_common']['project']['upload_url'] : '';
            //Yii::app()->language = 'vi';
            //Load Config Site
            $arr_config = Option::model()->findAll();
            foreach ($arr_config as $k => $v) {
                $this->site_config[$v['key']] = $v['value'];
            }


            $this->pageTitle       = $this->site_config['site_name'];
            $this->pageUrl       = Yii::app()->createAbsoluteUrl('site/index');
            $this->pageKeyword     = $this->site_config['site_keyword'];
            $this->pageDescription = $this->site_config['site_desc'];

        }

        /**
         * @return array action filters
         */
        public function filters()
        {
            return array(
                'accessControl', // perform access control for CRUD operations,
            );
        }

        /**
         * @var array context menu items. This property will be assigned to {@link CMenu::items}.
         */
        public $menu = array();
        /**
         * @var array the breadcrumbs of the current page. The value of this property will
         * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
         * for more details on how to specify this property.
         */
        public $breadcrumbs = array();
    }