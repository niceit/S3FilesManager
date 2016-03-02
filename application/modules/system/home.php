<?php
use Aws\S3;
class Home extends Controller {
    private $array = array();

    public function login(){
        $mgs = array();
        if ($_POST){
            $user_name = $_POST['username'];
            $password = $_POST['password'];
            if (trim($user_name) != '' && trim($password) != ""){
                $member = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../../data/database.inc')), true);
                if (trim(strtolower($member['username'])) == trim(strtolower($user_name))
                    && md5(trim($password)) == ($member['password'])){
                    $_SESSION['member'] = $member['username'];
                    header("location: index.php");
                } else {
                    $mgs = array(
                        'status' => 'error',
                        'mgs' => 'Failed login'
                    );
                }
            }
        }
        $this->enableLayout = false;
        return $this->render('login', array('message' => $mgs));
    }

    public function logout(){
        $_SESSION['member'] = '';
        unset($_SESSION);
        session_destroy();
        header("location: index.php?route=home/login");
    }

    public function changepassword(){
        $mgs = array();
        $members = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../../data/database.inc')), true);
        if ($_POST){
            $username = $_POST['username'];
            $password_old = $_POST['password_old'];
            $password_new = $_POST['password_new'];
            if (trim($username) != '' && md5(trim($password_old)) == trim(($members['password']))){
                $member = array(
                    'username' => trim($username),
                    'password' => md5(trim(($password_new)))
                );
                $member = base64_encode(json_encode($member));

                $config_file = fopen(dirname(__FILE__) . '/../../data/database.inc', 'w');
                fwrite($config_file, $member, strlen($member));
                fclose($config_file);
                $mgs = array(
                    'status' => 'Success',
                    'mgs' => 'Change username and password successful'
                );

            } else {
                $mgs = array(
                    'status' => 'Error',
                    'mgs' => 'Failed change username and password'
                );
            }
        }
        $member = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../../data/database.inc')), true);

        return $this->render('changepassword', array('message' => $mgs , 'member' => $member));
    }

    public function setting(){
        $mgs = array();
        $config_file = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../../data/configuration.inc')), true);
        if ($_POST && isset($_POST['bucket'])) {
            $config_file['s3']['bucket'] = $_POST['bucket'];
            $config = base64_encode(json_encode($config_file));
            $config_file = fopen(dirname(__FILE__) . '/../../data/configuration.inc', 'w');
            fwrite($config_file, $config, strlen($config));
            fclose($config_file);
            $mgs = array(
                'status' => 'Success',
                'mgs' => 'Change settings butket successful'
            );
        } elseif($_POST){
            if ($_POST['siteUrl'] != '' && $_POST['appId'] != '' && $_POST['appSecret'] != '' && $_POST['bucket'] != ''){
                $config = array(
                    'siteUrl' =>  $_POST['siteUrl'],
                    'email' => $_POST['email'],
                    'maintenance' => $_POST['maintenance'],
                    's3' => array(
                        'appId' =>  $_POST['appId'],
                        'appSecret' =>  $_POST['appSecret'],
                        'bucket' =>  $config_file['s3']['bucket'],
                        'scheme' =>  $_POST['scheme'],
                        'region' =>  $_POST['region'],
                        'version' =>  $_POST['version'],
                        'limit' =>  $_POST['limit']
                    ),
                );
                $config = base64_encode(json_encode($config));
                $config_file = fopen(dirname(__FILE__) . '/../../data/configuration.inc', 'w');
                fwrite($config_file, $config, strlen($config));
                fclose($config_file);
                $mgs = array(
                    'status' => 'Success',
                    'mgs' => 'Change settings successful'
                );
            } else {
                $mgs = array(
                    'status' => 'Error',
                    'mgs' => 'Failed change setting'
                );
            }

        }
        $config_file = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/../../data/configuration.inc')), true);
        $buckets = array();
        try{
            $s3 = AppS3::S3();
            $buckets = $s3->listBuckets();
        } catch (Exception $e){

        }
        return $this->render('setting', array('message' => $mgs , 'buckets' =>  $buckets,'config_file' => $config_file));
    }

    public function index() {
        $s3 = AppS3::S3();
        $buckets = $s3->listBuckets();
        $app = new AppConfig();
        return $this->render('index', ['buckets' => $buckets, 'region' => $app->params('s3Region'), 'bucket_default' => $this->bucket]);
    }

    public function createbucket() {
        header ("Content-Type: application/json");
        $this->enableLayout = false;
        if ($_POST) {
            $name = $_POST['name'];

            if (empty($name)) {
                $response = ['status' => 0, 'message' => 'Bucket name can not be blank'];
            }
            else {
                $s3 = AppS3::S3();
                try{
                    $s3->createBucket(array('Bucket' => $name));
                    $s3 = AppS3::S3();
                    $buckets = $s3->listBuckets();
                    $response = ['status' => 1, 'buckets' => $buckets['Buckets'], 'message' => 'Bucket created successfully'];
                }
                catch (\Aws\S3\Exception\S3Exception $e) {
                    $response = ['status' => 0, 'message' => 'An error while creating new bucket. Please try with a different name!'];
                }
            }
        }
        else {
            $response = ['status' => 0, 'message' => 'Invalid request'];
        }
        echo json_encode($response);
        die();
    }
    /*
    * Load folder on prefix
    */

    public function ajaxloadfolder() {
        $this->enableLayout = false;
        if ($_POST) {
        $frefix = $_POST['frefix'];
        if ($frefix == '/')
            $frefix = '';

            $s3 = AppS3::S3();
            $result = $s3->listObjects(array('Bucket' => $this->bucket, 'Prefix' => $frefix, 'Delimiter' => '/'));

            if ($frefix == '')
                unset($result['CommonPrefixes'][0]);
            $arrForder = array();
            if (!empty($result['CommonPrefixes'])) {
                foreach ($result['CommonPrefixes'] as $file) {
                    $result_sub = $s3->listObjects(array('Bucket' => $this->bucket, 'Prefix' => $file['Prefix'], 'Delimiter' => '/'));
                    if (!empty($result_sub['CommonPrefixes'])) {
                        $sub = 1;
                    } else $sub = 0;

                    $arrName = explode('/', $file['Prefix']);
                    $arrForder[] = array(
                        'name' => $arrName[count($arrName) - 2],
                        'prefix' => $file['Prefix'],
                        'isSub' => $sub
                    );
                }
            }

            if (empty($arrForder)) {
                echo $this->render('ajaxloadfolder', array( 'message' => 'There is no folder in this bucket'));
                die();
            }
            echo $this->render('ajaxloadfolder', array( 'files' => $arrForder));
        }
        die();
    }
    /*
     * Load file on prefix
     */
    public function ajaxloadfrefix(){
        $this->enableLayout = false;
        if ($_POST) {
            $limit = 50;
            $page = $_POST['page'];
            $frefix = $_POST['frefix'];
            if ($frefix == '/')
                $frefix = '';
            $s3 = AppS3::S3();
            $result = $s3->listObjects(array('Bucket' => $this->bucket,  'Prefix' => $frefix , 'Delimiter' => '/'));
            $frefix_old = explode('/', $frefix);
            if(!empty($frefix_old) && count($frefix_old) > 2){
                unset($frefix_old[count($frefix_old)]);
                unset($frefix_old[count($frefix_old) - 1]);
                $old_fix = implode("/", $frefix_old);
            }   else {
                $old_fix = '/';
            }

            if ($frefix == '')
                $old_fix = '';

            unset($result['Contents'][0]);
            $total = (int)round(count($result['Contents']) / $limit);
            $aryBucket = array();
            if (!empty($result['Contents'])):
                $result['Contents'] = array_slice($result['Contents'], $page*$limit  , $limit);
                foreach ($result['Contents'] as $object) {
                    $filename = $object['Key'];
                    $image_name_arr = explode('/', $filename);
                    $image_name = end($image_name_arr);
                    $format_arr = explode('.', $image_name);
                    $url = $s3->getObjectUrl($this->bucket, $object['Key']);
                    $aryBucket[] = array(
                        'key' => $object['Key'],
                        'date' => strtotime($object['LastModified']),
                        'name' => $image_name,
                        'format' => "." . end($format_arr),
                        'url' => $url,
                        'size' => AppS3::formatBytes($object['Size'], 0),
                        'is_file' => AppS3::isFileImage($image_name, $url),
                        'icon' => AppS3::getFileSmallIcon(end($format_arr))
                    );
                }
            endif;
            if ($page < $total){
                $load_more = $page + 1;
            } else  {
                $load_more = 0;
            }
            if ($page == 0)
                $file = 'ajaxloadfrefix';
            else
                $file = 'ajaxloadmorefrefix';
            echo $this->render($file , array('listObjects' => $aryBucket ,
                'files' => $result['CommonPrefixes'] ,
                'old_fix' => $old_fix,
                'frefix' => $frefix,
                'sst' => $page*$limit + 1,
                 'load_more' => $load_more,
                'search' => 0
                )
            );
        }
        die();
    }

    /*
     * Search-----
     */
    public function ajaxloadsearchobjects(){
        $this->enableLayout = false;
        if ($_POST) {
            $page = $_POST['page'];
            $key = trim($_POST['name']);
            $limit =  50;

            $s3 = AppS3::S3();
            $result = $s3->listObjects(array('Bucket' => $this->bucket));
            $aryBucket = array();

            foreach ($result['Contents'] as $object) {
                $filename = $object['Key'];
                $image_name_arr = explode('/', $filename);
                $image_name = end($image_name_arr);

                if (preg_match('#^.*'.$key.'.*$#', $image_name)) {
                    $format_arr = explode('.', $image_name);
                    $url = $s3->getObjectUrl($this->bucket, $object['Key']);

                    $aryBucket[] = array(
                        'key' => $object['Key'],
                        'date' => strtotime($object['LastModified']),
                        'name' => $image_name,
                        'format' => "." . end($format_arr),
                        'url' => $url,
                        'size' => AppS3::formatBytes($object['Size'], 0),
                        'is_file' => AppS3::isFileImage($image_name, $url),
                        'icon' => AppS3::getFileSmallIcon(end($format_arr))
                    );
                }
            }
            $total = (int)round(count($aryBucket) / $limit);
            $aryBucket = array_slice($aryBucket, $page*$limit  , $limit);
        }

        if ($page < $total){
            $load_more = $page + 1;
        } else  {
            $load_more = 0;
        }
        if ($page == 0)
            $file = 'ajaxloadfrefix';
        else
            $file = 'ajaxloadmorefrefix';
        echo $this->render($file , array('listObjects' => $aryBucket ,
                'sst' => $page*$limit + 1,
                'load_more' => $load_more,
                'text' => $key,
                'search' => 1
            )
        );
        die();
    }

    /*
    * Upload files to Cloud page
    * */
    public function upload() {
        $s3 = AppS3::S3();
        $buckets = $s3->listBuckets();
        $app = new AppConfig();
        return $this->render('upload', ['buckets' => $buckets, 'region' => $app->params('s3Region')]);
    }

    /*
    * Create new folder
    * */
    public function createfolder() {
        $this->enableLayout = false;
        header("Content-Type: application/json");
        if ($_POST) {
            $bucket = $this->bucket;
            $path = $_POST['path'];
            $name = $_POST['name'];

            if ($path == '/') {
                $path = '';
            }
            $key = $path . $name . '/';
            $s3 = AppS3::S3();
            try {
                $s3->putObject(array(
                    'Bucket' => $bucket,
                    'Key'    => $key,
                    'Body'   => "",
                    'ACL'    => 'public-read',
                    'ContentLength' => 0
                ));
                $response = ['status' => 1, 'key' => md5($path)];
            }
            catch (\Aws\S3\Exception\S3Exception $e) {
                $response = ['status' => 0, 'message' => 'There is an error while creating new folder, please try with a different name'];
            }
        }
        else {
            $response = ['status' => 0, 'message' => 'Invalid request'];
        }
        echo json_encode($response);
        die();
    }

    /*
     * List available bucket folders for user can choose path
     * */
    public function listbucketfolders() {
        $this->enableLayout = false;
        header("Content-Type: application/html");
        if ($_POST) {
            $bucket = $this->bucket; //$_POST['bucket'];
            $root = $_POST['frefix'];
            $add_folder_option = $_POST['add-folder'];
            if (empty($add_folder_option)) {
                $add_folder_option = 0;
            }

            if ($root == '/') {
                $root = '';
            }

            $s3 = AppS3::S3();
            $result = $s3->listObjects(array('Bucket' => $bucket,  'Prefix' => $root , 'Delimiter' => '/'));

            if( $root == '') {
                if (isset($result['CommonPrefixes'])) {
                    unset($result['CommonPrefixes'][0]);
                }
            }

            $arrForder = array();
            if (!empty($result['CommonPrefixes'])){
                foreach ($result['CommonPrefixes'] as $file){
                    $result_sub = $s3->listObjects(array('Bucket' => $bucket ,  'Prefix' => $file['Prefix'] , 'Delimiter' => '/'));
                    if (!empty($result_sub['CommonPrefixes'])){
                        $sub = 1;
                    } else $sub = 0;

                    $arrName = explode('/',  $file['Prefix']);
                    $arrForder[] = array(
                        'name' => $arrName[count($arrName)-2],
                        'prefix' => $file['Prefix'],
                        'isSub' => $sub
                    );
                }
            }

            if (empty($arrForder)) {
                die('There is no folder in this bucket');
            }

            echo $this->render('load-bucket-folders', array( 'files' => $arrForder, 'add_folder_option' => $add_folder_option, 'path'=> $root ));
            die();
        }
        else {
            die("Invalid request");
        }
    }

    /*
   * S3 signature and policy
   * */
    public function generateS3Signature(){
        header("Content-Type: application/json");
        if ($_POST) {
            $app = new AppConfig();
            $bucket = $_POST['bucket'];
            $s3_app_id = $app->params('s3AppKey');
            $s3_app_secret = $app->params("s3AppScr");

            $policy = $this->getS3Policy($bucket);
            $hmac = $this->hmacsha1($s3_app_secret, $policy);
            $response = [
                'status' => 1,
                'accessKey' => $s3_app_id,
                'policy' => $policy,
                'signature' => $this->hex2b64($hmac)
            ];
        }
        else {
            $response = ['status' => 0, 'message' => 'Invalid request'];
        }

        echo json_encode($response);
        die();
    }

    private function getS3Policy($bucket)
    {
        $now = strtotime(date("Y-m-d\TG:i:s"));
        $expire = date('Y-m-d\TG:i:s\Z', strtotime('+30 minutes', $now));
        $policy='{
                    "expiration": "' . $expire . '",
                    "conditions": [
                        {
                            "bucket": "' . $bucket . '"
    					},
                        {
                            "acl": "public-read"
                        },
                        [
                            "starts-with",
                            "$key",
                            ""
                        ],
                        {
                            "success_action_status": "201"
                        },
                        ["starts-with", "$Content-Type", ""],
                        ["content-length-range", 0, 5000000000],
                    ]
                }';

        return base64_encode($policy);
    }

    /*
    * Calculate HMAC-SHA1 according to RFC2104
    * See http://www.faqs.org/rfcs/rfc2104.html
    */
    private function hmacsha1($key,$data) {
        $blocksize=64;
        $hashfunc='sha1';
        if (strlen($key)>$blocksize)
            $key=pack('H*', $hashfunc($key));
        $key=str_pad($key,$blocksize,chr(0x00));
        $ipad=str_repeat(chr(0x36),$blocksize);
        $opad=str_repeat(chr(0x5c),$blocksize);
        $hmac = pack(
            'H*',$hashfunc(
                ($key^$opad).pack(
                    'H*',$hashfunc(
                        ($key^$ipad).$data

                    )
                )
            )
        );
        return bin2hex($hmac);
    }

    /*
     * Used to encode a field for Amazon Auth
     * (taken from the Amazon S3 PHP example library)
     */
    private function hex2b64($str){
        $raw = '';
        for ($i=0; $i < strlen($str); $i+=2)
        {
            $raw .= chr(hexdec(substr($str, $i, 2)));
        }
        return base64_encode($raw);
    }


    public function fix() {

        $test = '123123';
        $s3 = AppS3::S3();
        $result = $s3->listObjects(array('Bucket' => $this->bucket,  'Prefix' => 'products/' , 'Delimiter' => '/'));
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


    public function deletefile(){
        if ($_POST) {
            $key = base64_decode($_POST['key']);
            try{
            $s3 = AppS3::S3();
             $result = $s3->deleteObject(array(
                 'Bucket' => $this->bucket,
                 'Key'    => $key
             ));
            } catch(Aws\S3\Exception\S3Exception $e){
                echo $e->getAwsErrorCode();
                die();
            }
            echo "0";
            die();
        }
    }

    public function ajax_detail_file(){
        $this->enableLayout = false;
        header("Content-Type: application/html");
        if ($_POST) {
            $key = base64_decode($_POST['key']);
            $url = $_POST['url'];
            $s3 = AppS3::S3();

            $result = $s3->getObjectAcl(array(
                'Bucket' => $this->bucket,
                'Key' => $key
            ));
            $result_http = $s3->getObject(array(
                'Bucket' => $this->bucket,
                'Key' => $key
            ));

            echo $this->render('ajax_detail_file', array(
                "grants" => $result['Grants'] ,
                "owner" => $result['Owner'] ,
                "header" => $result_http['@metadata']['headers'] ,
                "property" => $result_http ,
                'key' => $key, 'url' => $url ));
            die();
        }
    }


    function recursiveObject($array, $s3, $Prefix){
        $object = $s3->getObject(array(
            'Bucket' => $this->bucket,
            'Key'    => $Prefix
        ));
        $owner = $s3->getObjectAcl(array(
            'Bucket' => $this->bucket,
            'Key' => $Prefix
        ));
        $this->array[] = array(
            'ETag' => $object['ETag'],
            'Size' => 0,
            'StorageClass' => $object['StorageClass'],
            'Key' => $Prefix,
            'VersionId' => $object['VersionId'],
            'IsLatest' => 1,
            'LastModified' => date_format(date_create($object['@metadata']['headers']['last-modified']), "Y-m-d H:i:s"),
            'Owner' => $owner['Owner']
        );
        $result_verssion = $s3->listObjectVersions(array(
            // Bucket is required
            'Bucket' => $this->bucket,
            'Delimiter' => '/',
            'MaxKeys' => 1000,
            'Prefix' => $Prefix
        ));
        if (!empty($result_verssion['Versions'])){
            foreach ($result_verssion['Versions'] as $row){
                $this->array[] = array(
                    'ETag' => $row['ETag'],
                    'Size' => $row['Size'],
                    'StorageClass' => $row['StorageClass'],
                    'Key' => $row['Key'],
                    'VersionId' => $row['VersionId'],
                    'IsLatest' => $row['IsLatest'],
                    'LastModified' => date_format(date_create($row['LastModified']->date), "Y-m-d H:i:s"),
                    'Owner' => $row['Owner'],
                );
            }
        }
        if (!empty($result_verssion['CommonPrefixes'])) {
            foreach ($result_verssion['CommonPrefixes'] as $row) {
                $this->recursiveObject($array, $s3, $row['Prefix']);
            }
        }
        return $array;
    }


    public function update_permissions(){
        $this->enableLayout = false;
        header("Content-Type: application/html");
        if ($_POST) {
            // (string: private | public-read | public-read-write | authenticated-read | bucket-owner-read | bucket-owner-full-control )
            $s3 = AppS3::S3();
            $key = base64_decode($_POST['key']);
            $grant  = $_POST['grant'];
            $arr = explode(",", $grant);
            sort($arr);
            if (!empty($arr)){
                foreach ($arr as $row){
                    if ($row != ''){
                        $s3->putObjectAcl(array(
                            'Bucket' => $this->bucket,
                            'Key' => $key,
                            'ACL' => $row
                        ));
                    }
                }
            }
            echo "1";
        }
        die();
    }

    public function update_header_content_type(){
        $this->enableLayout = false;
        header("Content-Type: application/html");
        if ($_POST) {
            $key = base64_decode($_POST['key']);
            $contentType  = $_POST['contentType'];
            $s3 = AppS3::S3();
            $s3->putObject(array(
                'Bucket' => $this->bucket,
                'Key'    => $key,
                'ContentType' => $contentType
            ));
            echo $contentType;
        }
        die();
    }

    public function basecode(){
        if ($_POST) {
            echo json_encode(array("key" => base64_encode($_POST['key']), "id" => $_POST['id']));
            die();
        }
    }

    public function TEST() {

        // (string: private | public-read | public-read-write | authenticated-read | bucket-owner-read | bucket-owner-full-control )
        $s3 = AppS3::S3();

        echo '<pre>';
        $result = $s3->getBucketCors(array('Bucket' => $this->bucket));

        print_r($result);
        die();


        try {
            $result = $s3->listObjects(array('Bucket' => "crgtestingbucket2", 'Prefix' => "/", 'Delimiter' => '/'));
        }catch (  \Aws\S3\Exception $e ){

            print_r($e->getMessage());
        }



        // Getverssion
        $result_verssion = $s3->listObjectVersions(array(
            // Bucket is required
            'Bucket' => $this->bucket,
            'Delimiter' => '/',
            'MaxKeys' => 1000,
            'Prefix' => "test1/"
        ));

        // Getverssion
        $result_verssion = $s3->listObjectVersions(array(
            // Bucket is required
            'Bucket' => $this->bucket,
            'Delimiter' => '/',
            'MaxKeys' => 1000,
            'Prefix' => "test1/"
        ));
        $array = array();
        $array[] = array(
            'ETag' => $result_http['ETag'],
            'Size' => 0,
            'StorageClass' => $result_http['StorageClass'],
            'Key' => $key,
            'VersionId' => $result_http['VersionId'],
            'IsLatest' => 1,
            'LastModified' => date_format(date_create($result_http['@metadata']['headers']['last-modified']), "Y-m-d H:i:s"),
            'Owner' => $result['Owner']
        );
        foreach ($result_verssion['Versions'] as $row){
            $array[] = array(
                'ETag' => $row['ETag'],
                'Size' => $row['Size'],
                'StorageClass' => $row['StorageClass'],
                'Key' => $row['Key'],
                'VersionId' => $row['VersionId'],
                'IsLatest' => $row['IsLatest'],
                'LastModified' => date_format(date_create($row['LastModified']->date), "Y-m-d H:i:s"),
                'Owner' => $row['Owner'],
            );
        }

        foreach ($result_verssion['CommonPrefixes'] as $row){
            $array =  $this->recursiveObject($array, $s3, $row['Prefix']);
        }


        foreach ($result_verssion['Versions'] as $row){
            $this->array[] = array(
                'ETag' => $row['ETag'],
                'Size' => $row['Size'],
                'StorageClass' => $row['StorageClass'],
                'Key' => $row['Key'],
                'VersionId' => $row['VersionId'],
                'IsLatest' => $row['IsLatest'],
                'LastModified' => date_format(date_create($row['LastModified']->date), "Y-m-d H:i:s"),
                'Owner' => $row['Owner'],
            );
        }

        foreach ($result_verssion['CommonPrefixes'] as $row){
            $this->recursiveObject($array, $s3, $row['Prefix']);
        }

        echo '<pre>';
        print_r($array);
        die();

        $result = $s3->getObject(array(
            'Bucket' => $this->bucket,
            'Key'    => "test1/123/"
        ));


        echo '<pre>';
        print_r($result);

        $result = $s3->listObjectVersions(array(
            // Bucket is required
            'Bucket' => $this->bucket,
            'Delimiter' => '/',
            'MaxKeys' => 1000,
            'Prefix' => "test1/"
        ));
        echo '<pre>';
        print_r($result);
        die();


        $result = $s3->getObjectAcl(array(
            // Bucket is required
            'Bucket' => $this->bucket,
            'Key' => "test1/"
        ));
        echo '<pre>';
        print_r($result);
        print_r($result['Grants']);



        $result = $s3->getObject(array(
            'Bucket' => $this->bucket,
            'Key'    => "test1/Chrysanthemum.jpg"
        ));

        echo '<pre>';
        print_r($result);
        die();

        $result = $s3->putObject(array(
            'Bucket' => $this->bucket,
            'Key'    => "test1/Chrysanthemum.jpg",
            'AcceptRanges' => 'mega',
            'ContentType' => 'stdsfsgring'
        ));




        $result = $s3->putObjectAcl(array(
            'ACL' => "authenticated-read",
            'Bucket' => $this->bucket,
            'Key'    => "test1/Chrysanthemum.jpg"
        ));


        $result = $s3->putObjectAcl(array(
            'ACL' => "private",
            'Bucket' => $this->bucket,
            'Key'    => "test1/Chrysanthemum.jpg"
        ));






        die();
        // Type is required
      //  'Type' => 'string',
       //                 'URI' => 'string',
//



        $result = $s3->putObjectAcl(array(
            'ACL' => "private",
            'Grants' => array(
                array(
                    'Grantee' => array(
                        // Type is required
                        'Type' => 'Group',
                        'URI' => 'http://acs.amazonaws.com/groups/global/AllUsers',
                    ),
                    'Permission' => 'WRITE',
                ),
                // ... repeated
            ),
            'Owner' => array(
                'DisplayName' => 'rr',
                'ID' => '5c84fc713145a6e5cec39a353a739cef5649caa3d77d092c4385ac7a4b8ff95f',
            ),
            // Key is required
            'Bucket' => $this->bucket,
            'Key'    => "test1/Chrysanthemum.jpg"
        ));

        die();



    }

}