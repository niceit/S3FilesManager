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


}