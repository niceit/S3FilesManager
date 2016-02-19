<?php

class Controller {

    public $layout = 'layout';
    public $view;
    private $siteConfig;
    private $baseUrl;
    private $assetsUrl;

    public function __construct() {
        global $AppConfig;
        $this->siteConfig = $AppConfig;
    }

    private function renderLayout() {
        ob_start();
        include $this->siteConfig->params('AppRootDir') . 'templates/' . $this->layout . '.php';
        $layout = ob_get_contents();
        ob_end_clean();

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