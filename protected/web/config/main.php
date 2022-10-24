<?php
    $web  = dirname(dirname(__FILE__));
    $base = dirname($web);
    Yii::setPathOfAlias('web', $web);
    $baseArray = require($base . '/config/main.php');

    $webArray = array(
        'basePath'          => $base,
        'preload'           => array(
            'log',
            'yiibooster',
        ),
        'theme'             => 'sontra',
        'controllerPath'    => $web . '/controllers',
        'viewPath'          => $web . '/views',
        'runtimePath'       => $web . '/runtime',
        'defaultController' => 'site',
        'import'            => array(
            'web.models.*',
            'web.components.*',
            'application.models.*',
            'application.components.*',
            'application.extensions.*',
            'ext.YiiMailer.YiiMailer'
            //'application.vendors.facebook-sdk.*',
        ),
        'language'          => 'ja',
        'params'            => require(dirname(__FILE__) . '/params.php'),
        'components'        => array(
            'errorHandler' => array(
                'errorAction' => 'site/error',
            ),
            /*'yiibooster'   => array(
                'class' => 'ext.yiibooster.components.Booster', // assuming you extracted bootstrap under extensions
            ),*/
            'user'         => array(
                'class'          => 'WebUser',
                'allowAutoLogin' => true,  // enable cookie-based authentication
                //'loginUrl'       => array('customer/login'),
            ),

            'class'      => 'system.caching.CFileCache',
            // uncomment the following to enable URLs in path-format
            'urlManager' => array(
                'urlFormat'      => 'path', // 'path' or 'get'
                'showScriptName' => false, // show index.php
                'caseSensitive'  => false, // case sensitive
                //'urlSuffix'      => '.html',
                'rules'          => array(
                    ''                                => 'site/index',
                    'posts'                           => 'news/index',
                    'posts/<id:\d+>'                  => 'news/detail',
                    //
                    'contact'                           => 'site/contact',
                    'recruitment_step'                  => 'page/recruitment_benefit',
                    'recruitment_step_<id:\d+>'         => 'page/recruitment_benefit_detail',
                    'about'                             => 'page/about',
                    'job-details'                       => 'page/jobDetails',
                    'q&a'                               => 'page/qa',
                    'download'                          => 'site/download',

                    'about/terms'                     => 'site/about',
                    'language/<code_name:.*>'         => 'site/changeLanguage',
                    //'<alias:.*>-<id:\d+>'           =>  array('page/detail'),
                    '<controller:\w+>/<action:\w+>'   => '<controller>/<action>',
                ),
            ),

        ),
    );
    if (!function_exists('w3_array_union_recursive')) {
        /**
         * This function does similar work to $array1+$array2,
         * except that this union is applied recursively.
         *
         * @param array $array1 - more important array
         * @param array $array2 - values of this array get overwritten
         *
         * @return array
         */
        function w3_array_union_recursive($array1, $array2)
        {
            $retval = $array1 + $array2;
            foreach ($array1 as $key => $value) {
                if (is_array($array1[$key]) && isset($array2[$key]) && is_array($array2[$key])) {
                    $retval[$key] = w3_array_union_recursive($array1[$key], $array2[$key]);
                }
            }

            return $retval;
        }

    }
    return w3_array_union_recursive($webArray, $baseArray);
?>