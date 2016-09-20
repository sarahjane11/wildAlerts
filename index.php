<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
 
define('pemPath',dirname(__FILE__).'/ck.pem');

define('BASE_PATH',"http://".$_SERVER['SERVER_NAME']."/wildalerts");
//define('BASE_PATH1',"http://".$_SERVER['SERVER_NAME']);

// facebook App Id

define('FB_APPID','1649354265350215');

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
