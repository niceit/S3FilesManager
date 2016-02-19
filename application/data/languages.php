<?php

class Languages {

    private static $INVALID_CONFIGURATION = 'Configuration file is not existed or site was not installed properly';

    public static function Text ($ERROR_CODE) {
        return self::${$ERROR_CODE};
    }
}