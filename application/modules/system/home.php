<?php

class Home extends Controller {

    public function index() {
        $test = '123123';

        return $this->render('index', array(
            'test' => $test,
        ));
    }
}