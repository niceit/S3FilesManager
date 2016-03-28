<?php
class Data {
    public static function getConfiguration() {
        $data = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../data/configuration.inc')), true);
        return $data;
    }

    public static function saveConfiguration($args) {
        $config_file = fopen(dirname(__FILE__) . '/../data/configuration.inc', 'w');
        fwrite($config_file, $args, strlen($args));
        fclose($config_file);
    }
    
    public static function getUserData() {
        $data = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../data/database.inc')), true);
        return $data;
    }
    
    public static function saveUserData($args) {
        $config_file = fopen(dirname(__FILE__) . '/../data/database.inc', 'w');
        fwrite($config_file, $args, strlen($args));
        fclose($config_file);
    }
}