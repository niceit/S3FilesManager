<?php

class Languages {

    private static $INVALID_CONFIGURATION = 'Configuration file is not existed or site was not installed properly';
    private static $UPDATED_FILE_PERMISSION = 'File permission updated successfully';

    /*
     * Popup stuffs
     * */
    private static $HEADER_OBJECT_PROPERTIES = 'Object Properties';
    private static $HEADER_FILE_TABLE = 'Available Files in Folder';
    private static $HEADER_FOLDER_TABLE = 'Available Folders';
    private static $HEADER_BUCKET_TABLE = 'Your Buckets';
    private static $HEADER_IMAGE_POPUP = 'Photo Preview';
    private static $HEADER_CREATE_BUCKET_POPUP = 'Create a new bucket';
    private static $HEADER_CREATE_FOLDER_POPUP = 'Create a new folder';

    public static function Text ($ERROR_CODE) {
        return self::${$ERROR_CODE};
    }
}