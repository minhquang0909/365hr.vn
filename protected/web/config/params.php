<?php
    return array(
        //'baseUrl'               => 'http://vovthethao.vn/',
        'baseUrl'               => 'http://localhost/zepdoc/',
        'facebook_sdk_path'     => dirname(__DIR__).'/../../vendors/facebook-sdk/autoload.php',
        'facebook'              => array(
            'app_id'       => '999794056738192',
            'app_secret'   => 'a008ec9afd31dca15704182227b3b417',
            'cookie'       => true,
            'url_callback' => 'http://localhost/zepdoc/customer/loginFacebookSuccess',
        ),
        'facebookPermissions'   => array('email', 'public_profile', 'user_birthday', 'user_friends'),
        'collection_categories' => array(
            'uncategory' => 0,
            'hot'        => 8888,
        ),
        'price'                 => array(
            '0'     => 'Miễn phí',
            '2000'  => '2.000đ',
            '3000'  => '3.000đ',
            '4000'  => '4.000đ',
            '5000'  => '5.000đ',
            '6000'  => '6.000đ',
            '7000'  => '7.000đ',
            '10000' => '10.000đ',
            '15000' => '15.000đ',
            '20000' => '20.000đ',
            '50000' => '50.000đ',
            '-1'    => 'Tự đặt giá',

        ),
        /*Begin Google anaylytics code */
        'google_analytics_code' => '',
        /*End Google anaylytics code */
        'reCapcha'              => array(
            'url'        => 'https://www.google.com/recaptcha/api/siteverify?',
            'secret_key' => '6LdyDw8TAAAAAAWpKojGxSK5_AFXZQilwR26hu7S',
            'site_key'   => '6LdyDw8TAAAAAM9f5aeTkh99z7PHeampZvkxxW8j',
        ),
    );