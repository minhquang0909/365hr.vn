<?php
	/*if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
        $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $location);
        exit;
    }*/
    $dev_mode = 0;
    if ($dev_mode==1) {
        function compress_code($code)
        {
            $search = array(
                '/\>[^\S ]+/s',  // remove whitespaces after tags
                '/[^\S ]+\</s',  // remove whitespaces before tags
                '/(\s)+/s'       // remove multiple whitespace sequences
            );

            $replace = array('>', '<', '\\1');
            $code    = preg_replace($search, $replace, $code);
            return $code;
        }
        ob_start("compress_code");
    }
?>
<?php
    session_start();
    date_default_timezone_set('Asia/Tokyo');
    // All(prject name,db connection...etc) config should be in "config/config.ini"
    $config_path              = dirname(__FILE__) . "/config/config.ini";
    $GLOBALS['config_common'] = parse_ini_file($config_path, true);


    $yii    = dirname(__FILE__) . $GLOBALS['config_common']['project']['framework'];
    $config = dirname(__FILE__) . '/protected/web/config/main.php';

    error_reporting($GLOBALS['config_common']['debug_mode']['display_errors']);
    defined('YII_DEBUG') or define('YII_DEBUG', $GLOBALS['config_common']['debug_mode']['state']);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

    require_once($yii);
    Yii::createWebApplication($config)->run();
    if ($dev_mode) {
        ob_end_flush();
    }
?>
