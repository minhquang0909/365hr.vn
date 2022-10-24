<?php
    date_default_timezone_set("Asia/Tokyo");

    $url = $_SERVER['SCRIPT_URI'];
    $config_path              = dirname(dirname(__FILE__)) . "/config/config.ini";
    $GLOBALS['config_common'] = parse_ini_file($config_path, TRUE);

    $yii    = dirname(dirname(__FILE__)) . $GLOBALS['config_common']['project']['framework'];

    $config = dirname(__FILE__) . '/../protected/adm/config/main.php';
    ini_set('display_errors', $GLOBALS['config_common']['debug_mode']['display_errors']);
    error_reporting($GLOBALS['config_common']['debug_mode']['display_errors']);
    /*ini_set('upload_max_filesize ', '100M');
    ini_set('post_max_size', '100M');*/
    defined('YII_DEBUG') or define('YII_DEBUG', $GLOBALS['config_common']['debug_mode']['state']);

    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

    require_once($yii);
    Yii::createWebApplication($config)->run();
?>
