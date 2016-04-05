<?php

class Controller {

    //Will handle for enable/disable layout render
    public $enableLayout = true;

    //Default layout name
    public $layout = 'layout';
    public $view;

    //Some global view configuration params
    private $siteConfig;
    private $baseUrl;
    private $assetsUrl;
    public  $username = '';

    //Action with no render layout(name of list actions will be listed here)
    public $actionDisableLayoutRender = array();
    
    public function __construct() {
        session_start();
        global $AppConfig;

        if (!Data::checkInstallationStatus() && $AppConfig->params('action') != 'installation') {
            return header("Location: index.php?route=home/installation");
        }
        else {
            if ($AppConfig->params('action') != 'installation') {
                $config = Data::getConfiguration();
                $this->bucket = $config['s3']['bucket'];

                $member = Data::getUserData();
                $this->username = $member['username'];
                $this->siteConfig = $AppConfig;

                if (!isset($_SESSION) || !isset($_SESSION['member']) || $_SESSION['member'] == ''){
                    if ($_GET['route'] != "home/login")
                    header("Location: index.php?route=home/login");
                } else {
                   // header("location: index.php");
                }
            }
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
        ${"this"}->action = $this->siteConfig->params('action');

        ob_start();
        include $this->siteConfig->params('AppRootDir') .  'templates/' . $this->siteConfig->params('controller') . '/' . $view . '.php';
        $content = ob_get_contents();
        ob_end_clean();

        if (in_array($this->siteConfig->params('action'), $this->actionDisableLayoutRender)) {
            $this->enableLayout = false;
        }

        $content = str_replace('[[Content]]', $content, $this->renderLayout());

        return $content;
    }

    public function renderContent($content, $content_type = 'plain') {
        switch ($content_type) {
            case 'plain':
                print $content;
                break;
            case 'html':
                header('ContentType: text/html');
                print $content;
                break;
            case 'json':
                header('Content-Type: application/json');
                print json_encode($content);
                break;
        }
    }
    
    public function renderInstallation() {
        $this->assetsUrl =  'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php?route=home/installation', '', $_SERVER['REQUEST_URI']) . 'assets';
        ob_start();
        include dirname(dirname(__FILE__)) .  '/templates/home/installation.php';
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}