<?php

class AppException {

    public static function throwExceptionMessage ($message) {
        echo $message;
    }

    public static function debugVar($variable) {
        echo '<pre>'; print_r($variable); echo '</pre>';
        die();
    }

    /*
     * PreCheck for valid route request from client
     * */
    public static function preCheckRouteRequest($AppConfig) {
        $controller = $AppConfig->params('controller');
        $action = $AppConfig->params('action');
        if (!file_exists($AppConfig->params('AppRootDir') . 'modules/system/' . $controller . '.php')) {
            return self::display404Page($AppConfig);
        }
        else {
            require_once $AppConfig->params('AppRootDir') . 'modules/system/' . $controller . '.php';
            $controller = new $controller();
            $action_exist = method_exists($controller, $action);
            if (!$action_exist) {
                return self::display404Page($AppConfig);
            }

            return $controller;
        }
    }

    private static function display404Page($AppConfig) {
        ob_start();
        include ($AppConfig->params('AppRootDir') .  'templates/default/404.php');
        $content = ob_get_contents();
        ob_end_clean();

        print ($content);
        exit();
    }
}