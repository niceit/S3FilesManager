<?php
/*
 * Pre-config all require parameters
 * */
require_once dirname(__FILE__) . '/data/languages.php';
require_once dirname(__FILE__) . '/config.php';

global $AppConfig;
$AppConfig = new AppConfig();

require_once dirname(__FILE__) . '/modules/exception.php';
if ($AppConfig->params('action') != 'installation') {
    require_once dirname(__FILE__) . '/modules/extensions/aws/aws-autoloader.php';
    require_once dirname(__FILE__) . '/modules/AppS3.php';
}
require_once dirname(__FILE__) . '/modules/Data.php';
require_once dirname(__FILE__) . '/modules/helpers.php';
require_once dirname(__FILE__) . '/modules/controller.php';

$controller = $AppConfig->params('controller');
$action = $AppConfig->params('action');
$route = AppException::preCheckRouteRequest($AppConfig);

//Run the application
print $route->{$action}();
