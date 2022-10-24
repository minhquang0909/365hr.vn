<?php

    $adm  = dirname(dirname(__FILE__));
    $base = dirname($adm);
    Yii::setPathOfAlias('adm', $adm);

    $baseArray = require($base.'/config/main.php');

// This is the main Web application backend configuration. Any writable
// CWebApplication properties can be configured here.
    $admArray = array(
        'basePath'          => $base,
        'preload'           => array(
            'log',
            'yiibooster',
        ),
        'language' => 'vi',
        'controllerPath'    => $adm.'/controllers',
        'viewPath'          => $adm.'/views',
        'runtimePath'       => $adm.'/runtime',
        'defaultController' => 'ASite',
        // autoloading model and component classes
        'import'            => array(
            'adm.models.*',
            'adm.components.*',
            'application.models.*',
            'application.components.*',
            'application.extensions.*',
            'ext.YiiMailer.YiiMailer'
        ),
        'modules'           => array(
            // uncomment the following to enable the Gii tool
            'gii' => array(
                'class'          => 'system.gii.GiiModule',
                'password'       => '123456',
                'ipFilters'      => array('127.0.0.1', '::1', '10.2.0.*', '192.168.6.*'),
                'generatorPaths' => array('bootstrap.gii'),
            ),
        ),
        // application-level parameters that can be accessed
        'params'            => require(dirname(__FILE__).'/params.php'),
        // application components
        'components'        => array(
            'user'         => array(
                'loginUrl' => array('aSite/login'),
            ),
            'errorHandler' => array(
                // use 'site/error' action to display errors
                'errorAction' => 'aSite/error',
            ),
            'yiibooster'   => array(
                'class' => 'ext.yiibooster.components.Booster', // assuming you extracted bootstrap under extensions
            ),
            'file'         => array(
                'class' => 'application.extensions.file.CFile',
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager'   => array(
                'urlFormat' => 'get', // 'path' or 'get'
                'showScriptName' => false, // show index.php
                //'caseSensitive'  => false, // case sensitive
                'rules'     => array(),
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
                if (isset($array1[$key]) && isset($array2[$key]) && is_array($array1[$key]) && is_array($array2[$key])) {
                    $retval[$key] = w3_array_union_recursive($array1[$key], $array2[$key]);
                }
            }

            return $retval;
        }
    }
    return w3_array_union_recursive($admArray, $baseArray);
?>