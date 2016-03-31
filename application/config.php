<?php

class AppConfig {

    //Site configurations
    private $siteUrl = '';
    private $URL_Root = "/assets/";
    private $maintenance = false; //Will disable site and appear UnderConstruction Mode
    private $AppRootDir = '';

    //S3 configuration
    private $s3AppKey = ''; //Application ID Key
    private $s3AppScr = ''; //Application Secret Key
    private $s3DefaultBucket = ''; //Default Bucket
    private $s3Region = ''; //Main Region
    private $s3Scheme = ''; //Main Scheme
    private $s3Version = ''; //Main Version

    //Automatic route control
    private $controller;
    private $action;

    public function __construct() {

        if (Data::checkInstallationStatus()) {
            $config = Data::getConfiguration();
            $this->siteUrl = $config['siteUrl'];
            $this->s3AppKey = $config['s3']['appId'];
            $this->s3AppScr = $config['s3']['appSecret'];
            $this->s3DefaultBucket = $config['s3']['bucket'];
            $this->s3Region = $config['s3']['region'];
            $this->s3Scheme = $config['s3']['scheme'];
            $this->s3Version = $config['s3']['version'];
        }

        $this->AppRootDir = dirname(__FILE__) . '/';

        if (isset($_GET['route'])) {
            $route = explode("/", $_GET['route']);
            $this->controller = $route[0];

            //Parse uppercase action base on lowercase request
            $action = $route[1];
            if (strstr($action, '-')) {
                $action = explode('-', $action);
                foreach ($action as $key => $value) {
                    if ($key > 0) {
                        $first_letter = substr($value, 0, 1);
                        $action[0] .= strtoupper($first_letter) . ltrim ($value, $first_letter);
                    }
                }
                $action = $action[0];
            }

            $this->action = $action;
        }
        else {
            $this->controller = 'home';
            $this->action = 'index';
        }

        return $this;
    }

    public function params($paramName) {
        return $this->{$paramName};
    }
}