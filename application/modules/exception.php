<?php

class AppException {

    public static function throwExceptionMessage ($message) {
        echo $message;
    }

    public static function debugVar($variable) {
        echo '<pre>'; print_r($variable); echo '</pre>';
        die();
    }
}