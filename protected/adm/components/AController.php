<?php

    class AController extends CController
    {

        public $layout      = '//layouts/column1';
        public $menu        = array();
        public $breadcrumbs = array();
        public $group_id;
        public $username;
        public $pageHint    = '';
        public $main_menu    = '';
        public $site_config = array();


        //public $channel_code = array();

        public function init()
        {
            $cs = Yii::app()->getClientScript();
            $cs->registerScriptFile(Yii::app()->baseUrl.'/js/global.js', CClientScript::POS_END);
            /*$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-ui.min.js');*/
            $cs->registerCssFile(Yii::app()->baseUrl.'/css/mystyle.css');
            if (Yii::app()->user->id) {
                $user                           = new ASystemUser;
                $userInfo                       = $user->getSystemUserById(Yii::app()->user->id); //var_dump($userInfo->cp_code);exit();
                $this->group_id                 = $userInfo->group_id;
                $this->username                 = $userInfo->username;
                Yii::app()->session['group_id'] = $this->group_id;
                Yii::app()->session['username'] = $this->username;
            }

            //Load Config Site
            $arr_config = Option::model()->findAll();
            foreach ($arr_config as $k => $v) {
                $this->site_config[$v['key']] = $v['value'];
            }

            Yii::$classMap = array_merge(Yii::$classMap, array(
                'CaptchaExtendedAction'    => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
                'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php',
            ));
            $this->main_menu     = array(
                /*array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => Yii::t('adm/menu', 'mnu_system_management'),
                    'items'   => array(
                        array(
                            'label'   => Yii::t('adm/menu', 'management_cache'),
                            'url'     => array('/aClearCache/index'),
                            'visible' => AUserPermission::checkUserPermission('aClearCache', 'del'),
                        ),
                        array('label' => Yii::t('adm/menu', 'mnu_system')),
                        array(
                            'label'   => Yii::t('adm/menu', 'mnu_system_account'),
                            'url'     => array('/aSystemUser/admin'),
                            'visible' => AUserPermission::checkUserPermission('aSystemUser', 'del'),
                        ),
                        '---',
                        array('label' => Yii::t('adm/menu', 'mnu_system_group')),
                        array(
                            'label'   => Yii::t('adm/menu', 'mnu_group'),
                            'url'     => array('/aSystemGroup/admin'),
                            'visible' => AUserPermission::checkUserPermission('aSystemGroup', 'del'),
                        ),
                        array(
                            'label'   => Yii::t('adm/menu', 'mnu_create_group'),
                            'url'     => array('/aSystemGroup/create'),
                            'visible' => AUserPermission::checkUserPermission('aSystemGroup', 'add'),
                        ),
                    ),
                    'visible' => !Yii::app()->user->isGuest,
                ),*/

                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => Yii::t('adm/news', 'manage_news'),
                    'items'   => array(
                        array(
                            'label'   => Yii::t('adm/news', 'categories'),
                            'url'     => array('/aNewsCategories/admin'),
                            'visible' => AUserPermission::checkUserPermission('aNewsCategories', 'view'),
                        ),
                        array(
                            'label'   => Yii::t('adm/news', 'news'),
                            'url'     => array('/aNews/admin'),
                            'visible' => AUserPermission::checkUserPermission('aNews', 'view'),
                        ),
                        array(
                            'label'   => 'Bình luận',
                            'url'     => array('/aComment/admin'),
                            'visible' => AUserPermission::checkUserPermission('aComment', 'view'),
                        ),
                    ),
                    'visible' => !Yii::app()->user->isGuest,
                ),


                /*array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => Yii::t('adm/product', 'manage_news'),
                    'items'   => array(
                        array(
                            'label'   => Yii::t('adm/product', 'categories'),
                            'url'     => array('/aProductCategories/admin'),
                            'visible' => AUserPermission::checkUserPermission('aProductCategories', 'view'),
                        ),
                        array(
                            'label'   => Yii::t('adm/product_gadget', 'news'),
                            'url'     => array('/aProductGadget/admin'),
                            'visible' => AUserPermission::checkUserPermission('aProductGadget', 'view'),
                        ),
                        array(
                            'label'   => Yii::t('adm/product', 'news'),
                            'url'     => array('/aProduct/admin'),
                            'visible' => AUserPermission::checkUserPermission('aProduct', 'view'),
                        ),
                    ),
                    'visible' => !Yii::app()->user->isGuest,
                ),*/


                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => Yii::t('adm/album', 'manage_news'),
                    'items'   => array(
                        array(
                            'label'   => Yii::t('adm/album', 'categories'),
                            'url'     => array('/aAlbum/admin'),
                            'visible' => AUserPermission::checkUserPermission('aAlbum', 'view'),
                        ),
                        array(
                            'label'   => Yii::t('adm/album', 'news'),
                            'url'     => array('/aGallery/admin'),
                            'visible' => AUserPermission::checkUserPermission('aGallery', 'view'),
                        ),
                    ),
                    'visible' => !Yii::app()->user->isGuest,
                ),
                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => 'Tùy chọn',
                    'items'   => array(
                        array(
                            'label'   => 'Nhóm tùy chọn',
                            'url'     => array('/aOptionGroup/admin'),
                            'visible' => AUserPermission::checkUserPermission('aOptionGroup', 'view'),
                        ),
                        array(
                            'label'   => 'Tùy chọn',
                            'url'     => array('/aOption/admin'),
                            'visible' => AUserPermission::checkUserPermission('aOption', 'view'),
                        ),
                    ),
                    'visible' => !Yii::app()->user->isGuest,
                ),
                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => 'Q&A',
                    'items'   => array(
                        array(
                            'label'   => 'Danh mục câu hỏi',
                            'url'     => array('/aQACategories/admin'),
                            'visible' => AUserPermission::checkUserPermission('aQACategories', 'view'),
                        ),
                        array(
                            'label'   => 'Câu hỏi',
                            'url'     => array('/aQA/admin'),
                            'visible' => AUserPermission::checkUserPermission('aQA', 'view'),
                        ),
                    ),
                    'visible' => !Yii::app()->user->isGuest,
                ),
                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => 'Các bước tuyển dụng',
                    'url'     => array('/aRecruitmentStep/admin/admin'),
                    'visible' => AUserPermission::checkUserPermission('aRecruitmentStep', 'view'),
                ),
                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => 'Quản lý Trang tĩnh',
                    'url'     => array('/aStaticPage/admin'),
                    'visible' => AUserPermission::checkUserPermission('aStaticPage', 'view'),
                ),
                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => 'Quản lý Liên hệ',
                    'url'     => array('/aContact/admin'),
                    'visible' => AUserPermission::checkUserPermission('aContact', 'view'),
                ),
                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => 'Email chưa gửi',
                    'url'     => array('/aQueueEmail/admin'),
                    'visible' => AUserPermission::checkUserPermission('aQueueEmail', 'view'),
                ),
                array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => 'Quản lý file',
                    'url'     => array('/aFile/admin'),
                    'visible' => AUserPermission::checkUserPermission('aFile', 'view'),
                ),
               /* array(
                    'icon_class'=>'fa fa-bars',
                    'label'   => 'Quản lý Menu',
                    'url'     => array('/aMenu/admin'),
                    'visible' => !Yii::app()->user->isGuest,
                ),*/
            );
        }


    }

?>