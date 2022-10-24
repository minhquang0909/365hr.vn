<?php
    return array(
        'mnu_system'             => 'System',
        'mnu_home'               => 'Home',
        'mnu_system_management'  => 'System Management',
        'mnu_system_account'     => 'Account Management',
        'mnu_system_group'       => 'Group Permission',
        'mnu_create_group'       => 'New Group',
        'mnu_group'              => 'Group Management',
        'mnu_login'              => 'Login',
        'mnu_language'           => 'Language',
        'mnu_language_vi'        => 'Tiếng Việt',
        'mnu_language_en'        => 'English',
        'mnu_hi'                 => 'Hi:',
        'mnu_logout'             => 'Logout',
        'mnu_create'             => 'Create',
        'mnu_admin'              => 'Management',
        'mnu_list'               => 'List',
        'mnu_update'             => 'Update',
        'mnu_delete'             => 'Delete',
        'mnu_advanced_search'    => 'Advanced search',
        'mnu_change_pass'        => 'Change password',
        'mnu_banners'            => 'Banners',
        'mnu_banner_positions'   => 'Banner Positions',
        'mnu_banner_sizes'       => 'Banner Sizes',
        'mnu_cp'                 => 'Cp Management',
        'management_cache'       => 'Management Cache',
        'menu_customer'          => 'Customers',
        'menu_customer_view_all' => 'View All',
        'menu_book_management'   => 'Books Management',
        'menu_book'              => 'Books',
        'menu_book_author'       => 'Authors',
        'menu_book_translator'   => 'Translators',
        'menu_book_publishing'   => 'Publishing houses',
        'menu_category'          => 'Categories',
        'menu_categories_view_all' => 'View All',
        'menu_language'  => 'Languages',

    );
?>


<?php
    $this->widget(
        'booster.widgets.TbNavbar',
        array(
            'type'     => 'inverse',
            'brand'    => Yii::app()->params->brand_name,
            //'fixed' => false,
            'collapse' => TRUE, // requires bootstrap-responsive.css
            'fluid'    => TRUE,
            'items'    => array(
                array(
                    'class' => 'booster.widgets.TbMenu',
                    'type'  => 'navbar',
                    'items' => array(
                        array(
                            'label'   => Yii::t('adm/menu', 'mnu_login'),
                            'url'     => Yii::app()->createUrl('/aSite/login/'),
                            'visible' => Yii::app()->user->isGuest
                        ),
                        array(
                            'label'   => Yii::t('adm/menu', 'mnu_system_management'),
                            'items'   => array(
                                array('label'   => Yii::t('adm/menu', 'management_cache'),
                                      'url'     => array('/aClearCache/index'),
                                      'visible' => AUserPermission::checkUserPermission('aClearCache', 'del')
                                ),
                                '---',
                                array('label' => Yii::t('adm/menu', 'CP')),
                                array('label'   => Yii::t('adm/menu', 'mnu_cp'),
                                      'url'     => array('/cp/admin'),
                                      'visible' => AUserPermission::checkUserPermission('cp', 'view')
                                ),
                                '---',
                                array('label' => Yii::t('adm/menu', 'mnu_system')),
                                array('label'   => Yii::t('adm/menu', 'mnu_system_account'),
                                      'url'     => array('/aSystemUser/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aSystemUser', 'del')
                                ),
                                '---',
                                array('label' => Yii::t('adm/menu', 'mnu_system_group')),
                                array('label'   => Yii::t('adm/menu', 'mnu_group'),
                                      'url'     => array('/aSystemGroup/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aSystemGroup', 'del')
                                ),
                                array('label'   => Yii::t('adm/menu', 'mnu_create_group'),
                                      'url'     => array('/aSystemGroup/create'),
                                      'visible' => AUserPermission::checkUserPermission('aSystemGroup', 'add')
                                )
                            ),
                            'visible' => !Yii::app()->user->isGuest
                        ),
                        array(
                            'label'   => Yii::t('adm/menu', 'menu_customer'),
                            'url'     => array('aCustomers/admin'),
                            'items'   => array(
                                array('label'   => Yii::t('adm/menu', 'menu_customer_view_all'),
                                      'url'     => array('aCustomers/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aCustomer', 'admin')
                                ),
                            ),
                            'visible' => !Yii::app()->user->isGuest
                        ),

                        array('label' => Yii::t('adm/menu', 'menu_book_management'),
                              'items' => array(
                                  array(
                                      'label' => Yii::t('adm/menu', 'menu_book'),
                                      'url' => array('/aBooks/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aBook', 'view')
                                  ),
                                  array(
                                      'label' => Yii::t('adm/menu', 'menu_book_author'),
                                      'url' => array('/aAuthors/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aAuthors', 'view')
                                  ),
                                  array(
                                      'label' => Yii::t('adm/menu', 'menu_book_publishing'),
                                      'url' => array('/aPublishings/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aPublishings', 'view')
                                  ),
                                  array(
                                      'label' => Yii::t('adm/menu', 'menu_book_translator'),
                                      'url' => array('/aTranslators/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aTranslators', 'view')
                                  ),
                              ),
                        ),

                        array(
                            'label'   => Yii::t('adm/menu', 'menu_category'),
                            'url'     => array('aCategories/admin'),
                            'items'   => array(
                                array('label'   => Yii::t('adm/menu', 'menu_categories_view_all'),
                                      'url'     => array('aCategories/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aCategories', 'admin')
                                ),
                            ),
                            'visible' => !Yii::app()->user->isGuest
                        ),

                        array(
                            'label'   => Yii::t('adm/menu', 'menu_language'),
                            'url'     => array('aLanguages/admin'),
                            /*'items'   => array(
                                array('label'   => Yii::t('adm/menu', 'menu_languages_view_all'),
                                      'url'     => array('aLanguages/admin'),
                                      'visible' => AUserPermission::checkUserPermission('aCategories', 'admin')
                                ),
                            ),*/
                            'visible' => !Yii::app()->user->isGuest
                        ),

                    ),
                ),
                array(
                    'class'       => 'booster.widgets.TbMenu',
                    'type'        => 'list',
                    'htmlOptions' => array('class' => 'pull-right top_menu_dropdown'),
                    'items'       => array(
                        array(
                            'label'   => Yii::t('adm/menu',
                                    'mnu_hi') . ' ' . Yii::app()->user->getState('username'),
                            'url'     => '#',
                            'visible' => !Yii::app()->user->isGuest,
                            'items'   => array(
                                array(
                                    'label'   => Yii::t('adm/menu', 'mnu_change_pass'),
                                    'url'     => Yii::app()->createUrl('/users/changepass/'),
                                    'visible' => !Yii::app()->user->isGuest
                                ),
                                array(
                                    'label'   => Yii::t('adm/menu', 'mnu_logout'),
                                    'url'     => Yii::app()->createUrl('/aSite/logout/'),
                                    'visible' => !Yii::app()->user->isGuest
                                ),
                            )
                        ),
                    ),
                ),
            ),
        )
    );
?>