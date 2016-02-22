<?php

class Home extends Controller {
    private  $bucket = 'crgtesting';

    public function index() {
        $test = '123123';
        $s3 = AppS3::S3();
        $result = $s3->listObjects(array('Bucket' => $this->bucket,  'Prefix' => '' , 'Delimiter' => '/'));
        $aryBucket = array();
        if (!empty($result['Contents'])) {
            foreach ($result['Contents'] as $object) {
                $filename = $object['Key'];
                $image_name_arr = explode('/', $filename);
                $image_name = end($image_name_arr);
                $format_arr = explode('.', $image_name);
                $aryBucket[] = array(
                    'key' => $object['Key'],
                    'date' => strtotime($object['LastModified']),
                    'name' => $image_name,
                    'format' => "." . end($format_arr),
                    'url' => $s3->getObjectUrl($this->bucket, $object['Key']),
                    'size' => AppS3::formatBytes($object['Size'], 0)
                );
            }
        }
        return $this->render('index', array(
            'files' => $aryBucket,
            'test' => $test
        ));
    }
    public function ajaxloadfolder() {
        $this->enableLayout = false;
        echo $this->render('ajaxloadfolder', array());
        die();
    }
}