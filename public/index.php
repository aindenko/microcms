<?php

session_start();

ini_set('display_errors',1);
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(dirname(__FILE__)) . '/lib',
    get_include_path(),
)));

set_include_path(implode(PATH_SEPARATOR, array(
    dirname(dirname(__FILE__)) . '/app',
    get_include_path(),
)));

define('PATH',implode(PATH_SEPARATOR, array(dirname(dirname(__FILE__)) )));
define('LIB_PATH', PATH . '/lib');
define('APP_PATH', PATH . '/app');

require_once 'microCMS/Autoloader.php';



try{
    $app = new microCMS\App(APP_PATH , '/cfg/config.ini');

} catch (\microCMS\Exception $e) {
} catch(Exception $e){
}
$app->run();
