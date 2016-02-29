<?php

class Controller {

    public $layout = 'layout';
    public $enableLayout = true;
    public $view;
    private $siteConfig;
    private $baseUrl;
    private $assetsUrl;
    public  $bucket = '';
    public  $username = '';
    public function __construct() {
        session_start();
        global $AppConfig;

        $config = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../data/configuration.inc')), true);
        $this->bucket = $config['s3']['bucket'];

        $member = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../data/database.inc')), true);
        $this->username = $member['username'];
        $this->siteConfig = $AppConfig;
        if (!isset($_SESSION) || !isset($_SESSION['member']) || $_SESSION['member'] == ''){
            if ($_GET['route'] != "home/login")
            header("location: index.php?route=home/login");
        } else {
           // header("location: index.php");
        }
    }

    private function renderLayout() {
        if ($this->enableLayout) {
            ob_start();
            include $this->siteConfig->params('AppRootDir') . 'templates/' . $this->layout . '.php';
            $layout = ob_get_contents();
            ob_end_clean();
        } else{
            $layout = '[[Content]]';
        }
        return $layout;
    }

    public function render($view, $params) {
        foreach ($params as $variable => $value) {
            ${$variable} = $value;
        }

        ${"this"}->baseUrl = $this->siteConfig->params('siteUrl');
        ${"this"}->assetsUrl = $this->siteConfig->params('siteUrl') . $this->siteConfig->params('URL_Root');

        ob_start();
        include $this->siteConfig->params('AppRootDir') .  'templates/' . $this->siteConfig->params('controller') . '/' . $view . '.php';
        $content = ob_get_contents();
        ob_end_clean();

        $content = str_replace('[[Content]]', $content, $this->renderLayout());

        return $content;
    }
}