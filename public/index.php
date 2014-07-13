<?php

set_include_path(implode(PATH_SEPARATOR, array(
    dirname(dirname(__FILE__)) . '/lib',
    get_include_path(),
)));
require_once 'microCMS/App.php';

$app = new microCMS\App();
$app->run();
