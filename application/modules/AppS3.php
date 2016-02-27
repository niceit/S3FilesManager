<?php
use Aws\S3;

class AppS3{

    public static function S3() {
        $app = new AppConfig();

      return  \Aws\S3\S3Client::factory([
            'version' => $app->params('s3Version'),
            'region' => $app->params('s3Region'),
            'scheme' => $app->params('s3Scheme'),
            'credentials' => [
            'key' => $app->params('s3AppKey'),
            'secret' => $app->params("s3AppScr")
            ]
      ]);
   }

    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size) / log(1024);
        return round(pow(1024, $base - floor($base)), $precision);
    }

    public static function isFileImage($filename, $url_image){
        $is_value = false;
        $ext = explode(".", $filename);
        $ext = $ext[count($ext) - 1];
        switch ($ext) {
            //Image files
            case 'jpg' :
            case 'jpeg' :
            case 'bmp' :
            case 'gif' :
            case 'png' :
                $is_value = true ;
                break;
        }
        try {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            if (!$is_value) {
                $getimage = getimagesize($url_image);
                switch ($getimage['mime']) {
                    //Image files
                    case 'image/jpeg' :
                    case 'image/pjpeg' :
                    case 'image/bmp' :
                    case 'image/x-windows-bmp' :
                    case 'image/gif' :
                    case 'image/png' :
                        $is_value = true;
                        break;
                }
            }
        } catch(Exception $e){

        }
        return $is_value;

    }

    public static function getFileSmallIcon($filename){
        $ext = explode(".", $filename);
        $ext = $ext[count($ext) - 1];

        switch ($ext) {

            //Image files
            case 'jpg' :
            case 'jpeg' :
            case 'bmp' :
            case 'gif' :
            case 'png' :
                return '<i class="fa fa-file-image-o"></i>';
                break;

            //Document files
            case 'doc' :
            case 'docx' :
                return '<i class="fa fa-file-word-o"></i>';
                break;
            case 'xls' :
            case 'xlsx' :
                return '<i class="fa fa-file-excel-o"></i>';
                break;
            case 'ppt' :
            case 'pptx' :
                return '<i class="fa fa-file-powerpoint-o"></i>';
                break;
            case 'txt' :
                return '<i class="fa fa-file-text-o"></i>';
                break;
            case 'pdf' :
                return '<i class="fa fa-file-pdf-o"></i>';
                break;

            //Video files
            case 'mp4' :
            case 'wmv' :
            case 'ogg' :
            case 'flv' :
                return '<i class="fa fa-file-video-o"></i>';
                break;

            //Compress files
            case 'rar' :
            case 'zip' :
            case 'tar' :
            case 'gz' :
            case '7zip' :
                return '<i class="fa fa-file-zip-o"></i>';
                break;

            case 'css':
                return '<i class="fa fa-css3"></i>';
                break;
            default : return '<i class="fa fa-file-o"></i>';
        }
    }

}