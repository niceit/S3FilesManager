<?php
use Aws\S3;
class Home extends Controller {

    private $array = array();
    private $connectTimeout = 300; //5 mints
    
    public function __construct () {
        parent::__construct();
        //Disable layout for some actions
        $this->actionDisableLayoutRender = array(
            'ajaxLoadFolder', 'createBucket', 'login', 'ajaxLoadFolderPrefix',
            'ajaxLoadPrefix', 'ajaxLoadSearchObjects', 'createFolder', 'listBucketFolders',
            'deleteFile', 'ajaxDetailFile', 'updatePermissions', 'updateHeaderContentType',
        );
    }

    public function installation() {

        if (!empty($_POST)) {
            $action = $_POST['action'];
            $response = array('status' => 1);
            switch ($action) {
                case 'requirements':
                    $response['html'] = '';
                    //Checking PHP version
                    $text = ' PHP Version is ' . phpversion() . ' (required version >= 5.4)<br>';
                    if (version_compare(phpversion(), '5.4')) {
                        $response['html'] .= '<i class="fa fa-check"> </i>';
                        $response['html'] .= $text;
                    }
                    else {
                        $response['html'] .= '<i class=fa fa-remove> </i>';
                        $response['html'] .= '<b style="color: red;">' . $text . '</b>';
                        $response['status'] = 0;
                    }

                    //Checking for writable configuration file
                    $configuration_directory = dirname(dirname(dirname(__FILE__))) . '/data';
                    $text = ' Make sure <b>' . $configuration_directory . '</b> is Writable';
                    if (is_writable($configuration_directory)) {
                        $response['html'] .= '<i class="fa fa-check"> </i>';
                        $response['html'] .= $text;
                    }
                    else {
                        $response['html'] .= '<i class="fa fa-remove"> </i>';
                        $response['html'] .= '<b style="color: red;">' . $text . '</b>';
                        $response['status'] = 0;
                    }

                    if (!$response['status']) {
                        $response['html'] .= '<p align="right"><button class="btn btn-primary btn-sm" onclick="handle_target_step(2)"><i class="fa fa-refresh"> </i> Re-check</button></p>';
                    }
                    break;
                case 'connect_cloud':
                    $key = $_POST['key'];
                    $secret = $_POST['secret'];
                    $region = $_POST['region'];
                    $amazonS3 = AppS3::connect($key, $secret, $region);
                    try {
                        $buckets = $amazonS3->listBuckets();
                    } catch (S3\Exception\S3Exception $e) {
                        $response['status'] = 0;
                        $response['message'] = $e->getMessage();
                    }
                    
                    if (isset($buckets) && !empty($buckets)) {
                        $response['html'] = '<option value="">-Choose available bucket-</option>';
                        foreach ($buckets['Buckets'] as $bucket) {
                            $response['html'] .= '<option value="' . $bucket['Name'] . '">' . $bucket['Name'] . '</option>';
                        }
                    }
                    break;
                case 'save_settings':
                    $settings = $_POST['setting'];

                    //Save login information
                    $member = array(
                        'username' => $settings['username'],
                        'password' => md5($settings['password'])
                    );
                    $member = base64_encode(json_encode($member));
                    $configuration_directory = dirname(dirname(dirname(__FILE__))) . '/data';
                    $config_file = fopen($configuration_directory . '/database.inc', 'w');
                    fwrite($config_file, $member, strlen($member));
                    fclose($config_file);

                    //Save site configuration
                    $config = array(
                        'siteUrl' => $settings['url'],
                        'maintenance' => 0,
                        's3' => array(
                            'appId' => $settings['app_id'],
                            'appSecret' => $settings['app_secret'],
                            'bucket' => $settings['bucket'],
                            'scheme' => 'http',
                            'region' => $settings['region'],
                            'version' => "latest",
                            'limit' => 30
                        ),
                    );
                    $config = base64_encode(json_encode($config));

                    $config_file = fopen($configuration_directory . '/configuration.inc', 'w');
                    fwrite($config_file, $config, strlen($config));
                    fclose($config_file);

                    break;
            }

            header("Content-Type: application/json");
            echo json_encode($response);
            exit();
        }

        if (Data::checkInstallationStatus()) {
            header("Location: index.php?route=home/index");
            exit();
        }

        return $this->renderInstallation();
    }

    public function login(){
        $mgs = array();
        if (!empty($_POST)) {
            $user_name = $_POST['username'];
            $password = $_POST['password'];
            if (trim($user_name) != '' && trim($password) != "") {
                $member = Data::getUserData();
                if (trim(strtolower($member['username'])) == trim(strtolower($user_name))
                    && md5(trim($password)) == ($member['password'])) {
                    $_SESSION['member'] = $member['username'];
                    header("location: index.php");
                } else {
                    $mgs = array(
                        'status' => 'error',
                        'mgs' => 'Invalid login information'
                    );
                }
            }
        }

        return $this->render('login', array('message' => $mgs));
    }

    public function logout(){
        $_SESSION['member'] = '';
        unset($_SESSION);
        session_destroy();
        header("location: index.php?route=home/login");
    }

    public function changePassword() {
        $mgs = array();
        $members = Data::getUserData();

        if (!empty($_POST)) {
            $username = $_POST['username'];
            $password_old = $_POST['password_old'];
            $password_new = $_POST['password_new'];

            if (trim($username) != '' && md5(trim($password_old)) == trim(($members['password']))) {
                $member = array(
                    'username' => trim($username),
                    'password' => md5(trim(($password_new)))
                );
                $member = base64_encode(json_encode($member));
                Data::saveUserData($member);
                $mgs = array(
                    'status' => 'Success',
                    'mgs' => 'Information updated'
                );

            } else {
                $mgs = array(
                    'status' => 'Error',
                    'mgs' => 'Your old password does not match!'
                );
            }
        }

        $member = Data::getUserData();
        return $this->render('change_password', array('message' => $mgs , 'member' => $member));
    }

    public function setting(){
        $mgs = array();
        $config_file = Data::getConfiguration();

        if (!empty($_POST) && isset($_POST['bucket'])) {
            $config_file['s3']['bucket'] = $_POST['bucket'];
            $config = base64_encode(json_encode($config_file));
            Data::saveConfiguration($config);

            $mgs = array(
                'status' => 'Success',
                'mgs' => 'Bucket setting has been updated'
            );
        } elseif (!empty($_POST)){
            if (!empty($_POST['siteUrl']) && !empty($_POST['appId'])
                && !empty($_POST['appSecret'])) {

                $config = array(
                    'siteUrl' =>  $_POST['siteUrl'],
                    's3' => array(
                        'appId' =>  $_POST['appId'],
                        'appSecret' =>  $_POST['appSecret'],
                        'bucket' =>  $config_file['s3']['bucket'],
                        'region' =>  $_POST['region'],

                        'scheme' =>  "http",
                        'version' =>  'latest',
                        'limit' =>  30
                    ),
                );

                $config = base64_encode(json_encode($config));
                Data::saveConfiguration($config);

                $mgs = array(
                    'status' => 'Success',
                    'mgs' => 'Setting information updated.'
                );
            } else {
                $mgs = array(
                    'status' => 'Error',
                    'mgs' => 'An error occurred, unable to update settings.'
                );
            }
        }

        $config_file = Data::getConfiguration();
        try {
            $amazonS3 = AppS3::initialize();
            $buckets = $amazonS3->listBuckets();
        } catch (Exception $e) {
            $buckets = null;
        }

        $regions = AppS3::getAvailableRegions();
        return $this->render('setting', array(
            'message' => $mgs ,
            'buckets' =>  $buckets,
            'config_file' => $config_file,
            'regions' => $regions,
        ));
    }

    public function index() {
        $amazonS3 = AppS3::initialize();
        $buckets = $amazonS3->listBuckets();
        $app = new AppConfig();
        return $this->render('index', array(
            'buckets' => $buckets,
            'region' => $app->params('s3Region'),
            'bucket_default' => $this->bucket
        ));
    }

    public function createBucket() {
        set_time_limit($this->connectTimeout);
        if (!empty($_POST)) {
            $name = $_POST['name'];
            if (empty($name)) {
                $response = array('status' => 0, 'message' => 'Bucket name can not be blank');
            }
            else {
                $amazonS3 = AppS3::initialize();
                try{
                    $amazonS3->createBucket(array('Bucket' => $name));
                    $buckets = $amazonS3->listBuckets();
                    $response = array('status' => 1, 'buckets' => $buckets['Buckets'], 'message' => 'Bucket created successfully');
                }
                catch (\Aws\S3\Exception\S3Exception $e) {
                    $response = array('status' => 0, 'message' => 'An error while creating new bucket. Error : ' . $e->getMessage());
                }
            }
        }
        else {
            $response = array('status' => 0, 'message' => 'Invalid request');
        }

        return $this->renderContent($response, 'json');
    }

    /*
    * Load folder on prefix
    */

    public function ajaxLoadFolder() {
        $response = array('status' => 0);
        if (!empty($_POST)) {
            $prefix = $_POST['frefix'];
            $bucket = $_POST['bucket'];

            if ($prefix == '/') {
                $prefix = '';
            }

            $amazonS3 = AppS3::initialize();
            try {
                $result = $amazonS3->listObjects(array('Bucket' => $bucket, 'Prefix' => $prefix, 'Delimiter' => '/'));
            }
            catch (S3\Exception\S3Exception $e) {
                $response['message'] = $e->getMessage();
                return $this->renderContent($response, 'json');
            }

            if ($prefix == '') {
                unset($result['CommonPrefixes'][0]);
            }

            $arrFolder = array();
            if (!empty($result['CommonPrefixes'])) {
                foreach ($result['CommonPrefixes'] as $file) {
                    $result_sub = $amazonS3->listObjects(array('Bucket' => $bucket, 'Prefix' => $file['Prefix'], 'Delimiter' => '/'));
                    if (!empty($result_sub['CommonPrefixes'])) {
                        $sub = true;
                    } else {
                        $sub = false;
                    }

                    $arrName = explode('/', $file['Prefix']);
                    $arrFolder[] = array(
                        'name' => $arrName[count($arrName) - 2],
                        'prefix' => $file['Prefix'],
                        'isSub' => $sub
                    );
                }
            }

            $arr = array();
            if (empty($arrFolder)) {
                $arr['folder'] = $this->render('ajax/load_folder', array(
                    'message' => 'There is no folder in this bucket'
                ));
            } else {
                $arr['folder'] = $this->render('ajax/load_folder', array(
                    'files' => $arrFolder,
                    'prefix' => $_POST['frefix']
                ));
            }

            $response['status'] = 1;
            $response['data'] = $arr;
        }
        else {
            $response['message'] = 'Invalid request';
        }

        return $this->renderContent($response, 'json');
    }

    public function ajaxLoadFolderPrefix() {
        set_time_limit($this->connectTimeout);
        if (!empty($_POST)) {
            $response = array('status' => 1);
            $prefix = $_POST['frefix'];
            $bucket = $_POST['bucket'];
            $limit = 50;
            $page = 0;

            if ($prefix == '/') {
                $prefix = '';
            }

            $amazonS3 = AppS3::initialize();
            try {
                $result = $amazonS3->listObjects(array ('Bucket' => $bucket, 'Prefix' => $prefix, 'Delimiter' => '/'));
            } catch (S3\Exception\S3Exception $e) {
                $response['status'] = 0;
                $response['message'] = $e->getMessage();

                return $this->renderContent($response, 'json');
            }

            $prefix_old = explode('/', $prefix);

            if(!empty($prefix_old) && count($prefix_old) > 2) {
                unset($prefix_old[count($prefix_old)]);
                unset($prefix_old[count($prefix_old) - 1]);
                $old_fix = implode("/", $prefix_old);
            } else {
                $old_fix = '/';
            }

            if ($prefix == '') {
                $old_fix = '';
            }

            if (isset($result['Contents'][0])) {
                unset($result['Contents'][0]);
            }

            $total = (int)round(count($result['Contents']) / $limit);
            $arrayBucket = array();
            if (!empty($result['Contents'])) {
                $result['Contents'] = array_slice($result['Contents'], $page*$limit  , $limit);
                foreach ($result['Contents'] as $object) {

                    $filename = $object['Key'];
                    $image_name_arr = explode('/', $filename);
                    $image_name = end($image_name_arr);
                    $format_arr = explode('.', $image_name);
                    $url = $amazonS3->getObjectUrl($bucket, $object['Key']);

                    $arrayBucket[] = array(
                        'key' => $object['Key'],
                        'date' => strtotime($object['LastModified']),
                        'name' => $image_name,
                        'format' => "." . end($format_arr),
                        'url' => $url,
                        'size' => AppS3::formatTotalSize($object['Size']),
                        'is_file' => AppS3::isFileImage($image_name, $url),
                        'icon' => AppS3::getFileSmallIcon(end($format_arr))
                    );
                }
            }

            if ($page < $total) {
                $load_more = $page + 1;
            } else {
                $load_more = 0;
            }

            $arr['frefix'] = $this->render("ajax/load_prefix" , array(
                'listObjects' => $arrayBucket ,
                'files' => $result['CommonPrefixes'] ,
                'old_fix' => $old_fix,
                'frefix' => $prefix,
                'sst' => $page*$limit + 1,
                'load_more' => $load_more,
                'search' => 0
            ));

            if ($prefix == '' && isset($result['CommonPrefixes'][0])) {
                unset($result['CommonPrefixes'][0]);
            }

            $arrFolder = array();
            if (!empty($result['CommonPrefixes'])) {
                foreach ($result['CommonPrefixes'] as $file) {
                    $result_sub = $amazonS3->listObjects(array('Bucket' => $bucket, 'Prefix' => $file['Prefix'], 'Delimiter' => '/'));
                    if (!empty($result_sub['CommonPrefixes'])) {
                        $sub = true;
                    } else {
                        $sub = false;
                    }

                    $arrName = explode('/', $file['Prefix']);
                    $arrFolder[] = array(
                        'name' => $arrName[count($arrName) - 2],
                        'prefix' => $file['Prefix'],
                        'isSub' => $sub
                    );
                }
            }

            if (empty($arrFolder)) {
                $arr['folder'] = $this->render('ajax/load_folder', array(
                    'message' => 'There is no folder in this bucket'
                ));
            }

            $arr['folder'] =  $this->render('ajax/load_folder', array(
                'files' => $arrFolder,
                'prefix' => $_POST['frefix']
            ));

            $arrFolder = explode("/", $_POST['frefix']);
            unset($arrFolder[count($arrFolder) - 1 ]);
            $arr['folder_breadcrumb'] = $this->render("ajax/load_breadcrumb" , array(
                'folder' => $arrFolder,
                'name' => '',
            ));

            $response['data'] = $arr;
            return $this->renderContent($response, 'json');
        }
    }

    /*
     * Load file on prefix
     */
    public function ajaxLoadPrefix(){
        $response = array('status' => 0);
        if (!empty($_POST)) {
            $limit = 50;
            $page = $_POST['page'];
            $bucket = $_POST['bucket'];
            $prefix = $_POST['frefix'];

            if ($prefix == '/') {
                $prefix = '';
            }

            $amazonS3 = AppS3::initialize();
            try {
                $result = $amazonS3->listObjects(array('Bucket' => $bucket,  'Prefix' => $prefix , 'Delimiter' => '/'));
            }
            catch (S3\Exception\S3Exception $e) {
                $response['message'] = $e->getMessage();
                return $this->renderContent($response, 'json');
            }

            $prefix_old = explode('/', $prefix);

            if(!empty($prefix_old) && count($prefix_old) > 2) {
                unset($prefix_old[count($prefix_old)]);
                unset($prefix_old[count($prefix_old) - 1]);
                $old_fix = implode("/", $prefix_old);
            } else {
                $old_fix = '/';
            }

            if ($prefix == '') {
                $old_fix = '';
            }

            if (isset($result['Contents'][0])) {
                unset($result['Contents'][0]);
            }

            $total = (int)round(count($result['Contents']) / $limit);
            $arrayBucket = array();

            if (!empty($result['Contents'])) {
                $result['Contents'] = array_slice($result['Contents'], $page*$limit  , $limit);
                foreach ($result['Contents'] as $object) {

                    $filename = $object['Key'];
                    $image_name_arr = explode('/', $filename);
                    $image_name = end($image_name_arr);
                    $format_arr = explode('.', $image_name);
                    $url = $amazonS3->getObjectUrl($bucket, $object['Key']);

                    $arrayBucket[] = array(
                        'key' => $object['Key'],
                        'date' => strtotime($object['LastModified']),
                        'name' => $image_name,
                        'format' => "." . end($format_arr),
                        'url' => $url,
                        'size' => AppS3::formatTotalSize($object['Size']),
                        'is_file' => AppS3::isFileImage($image_name, $url),
                        'icon' => AppS3::getFileSmallIcon(end($format_arr))
                    );
                }
            }

            if ($page < $total) {
                $load_more = $page + 1;
            } else {
                $load_more = 0;
            }

            if ($page == 0) {
                $file = 'ajax/load_prefix';
            }
            else {
                $file = 'ajax/load_more_prefix';
            }

            $data['prefix'] =  $this->render($file , array(
                    'listObjects' => $arrayBucket ,
                    'files' => $result['CommonPrefixes'] ,
                    'old_fix' => $old_fix,
                    'frefix' => $prefix,
                    'sst' => $page * $limit + 1,
                     'load_more' => $load_more,
                    'search' => 0
            ));

            $arr_folder = explode("/", $_POST['frefix']);
            unset($arr_folder[count($arr_folder) - 1 ]);
            $data['folder'] = $this->render("ajax/load_breadcrumb" , array(
                'folder' => $arr_folder,
                'name' => '',
            ));

            $response['status'] = 1;
            $response['data'] = $data;

            return $this->renderContent($response, 'json');
        }
        else {
            $response['message'] = 'Invalid Request';
        }

        return $this->renderContent($response, 'json');
    }

    /*
     * Search-----
     */
    public function ajaxLoadSearchObjects() {
        $response = array('status' => 0);
        if (!empty($_POST)) {
            $page = $_POST['page'];
            $key = trim($_POST['name']);
            $bucket = trim($_POST['bucket']);
            $limit =  50;

            $amazonS3 = AppS3::initialize();
            try {
                $result = $amazonS3->listObjects(array('Bucket' => $bucket));
            }
            catch (S3\Exception\S3Exception $e) {
                $response['message'] = $e->getMessage();
                return $this->renderContent($response, 'json');
            }
            $arrayBucket = array();

            foreach ($result['Contents'] as $object) {
                $filename = $object['Key'];
                $image_name_arr = explode('/', $filename);
                $image_name = end($image_name_arr);

                if (preg_match('#^.*' . $key . '.*$#', $image_name)) {
                    $format_arr = explode('.', $image_name);
                    $url = $amazonS3->getObjectUrl($bucket, $object['Key']);

                    $arrayBucket[] = array(
                        'key' => $object['Key'],
                        'date' => strtotime($object['LastModified']),
                        'name' => $image_name,
                        'format' => "." . end($format_arr),
                        'url' => $url,
                        'size' => AppS3::formatTotalSize($object['Size']),
                        'is_file' => AppS3::isFileImage($image_name, $url),
                        'icon' => AppS3::getFileSmallIcon(end($format_arr))
                    );
                }
            }
            $total = (int)round(count($arrayBucket) / $limit);
            $arrayBucket = array_slice($arrayBucket, $page*$limit  , $limit);
        }
        else {
            $response['message'] = 'Invalid request';
            return $this->renderContent($response, 'json');
        }

        if ($page < $total){
            $load_more = $page + 1;
        } else {
            $load_more = 0;
        }

        if ($page == 0) {
            $file = 'ajax/load_prefix';
        }
        else {
            $file = 'ajax/load_more_prefix';
        }

        $response['status'] = 1;
        $response['data'] = $this->render($file , array(
            'listObjects' => $arrayBucket ,
            'sst' => $page * $limit + 1,
            'load_more' => $load_more,
            'text' => $key,
            'search' => 1
        ));

        return $this->renderContent($response, 'json');
    }

    /*
    * Upload files to Cloud page
    * */
    public function upload() {
        $amazonS3 = AppS3::initialize();
        $buckets = $amazonS3->listBuckets();
        $app = new AppConfig();

        return $this->render('upload', ['buckets' => $buckets, 'region' => $app->params('s3Region')]);
    }

    /*
    * Create new folder
    * */
    public function createFolder() {
        set_time_limit($this->connectTimeout);
        if (!empty($_POST)) {
            $bucket = $_POST['bucket'];
            $path = $_POST['path'];
            $name = $_POST['name'];

            if ($path == '/') {
                $path = '';
            }

            $key = $path . $name . '/';
            $amazonS3 = AppS3::initialize();
            try {
                $amazonS3->putObject(array(
                    'Bucket' => $bucket,
                    'Key'    => $key,
                    'Body'   => "",
                    'ACL'    => 'public-read',
                    'ContentLength' => 0
                ));
                $response = array('status' => 1, 'key' => md5($path), 'path' => $path);
            }
            catch (\Aws\S3\Exception\S3Exception $e) {
                $response = array(
                    'status' => 0,
                    'message' => 'There is an error while creating new folder, please try with a different name. Error: <br>' .
                        $e->getMessage()
                );
            }
        }
        else {
            $response = array('status' => 0, 'message' => 'Invalid request');
        }

        return $this->renderContent($response, 'json');
    }

    /*
     * List available bucket folders for user can choose path
     * */
    public function listBucketFolders() {
        $response = array('status' => 0);
        if (!empty($_POST)) {
            $popup_type = $_POST['popup_type'];
            $bucket = $_POST['bucket'];
            $root = $_POST['frefix'];
            $add_folder_option = isset($_POST['add-folder']) ? $_POST['add-folder'] : '';
            if (empty($add_folder_option)) {
                $add_folder_option = 0;
            }

            if ($root == '/') {
                $root = '';
            }

            $amazonS3 = AppS3::initialize();
            try {
                $result = $amazonS3->listObjects(array('Bucket' => $bucket,  'Prefix' => $root , 'Delimiter' => '/'));
            }
            catch (S3\Exception\S3Exception $e) {
                $response['message'] = $e->getMessage();
                return $this->renderContent($response, 'json');
            }

            if( $root == '') {
                if (isset($result['CommonPrefixes'])) {
                    unset($result['CommonPrefixes'][0]);
                }
            }

            $arrayFolder = array();
            if (!empty($result['CommonPrefixes'])){
                foreach ($result['CommonPrefixes'] as $file){
                    $result_sub = $amazonS3->listObjects(array('Bucket' => $bucket ,  'Prefix' => $file['Prefix'] , 'Delimiter' => '/'));
                    if (!empty($result_sub['CommonPrefixes'])){
                        $sub = 1;
                    } else $sub = 0;

                    $arrName = explode('/',  $file['Prefix']);
                    $arrayFolder[] = array(
                        'name' => $arrName[count($arrName)-2],
                        'prefix' => $file['Prefix'],
                        'isSub' => $sub
                    );
                }
            }

            $response['status'] = 1;
            if (empty($arrayFolder)) {
                $response['data'] = 'There is no folder in this bucket';
            }
            else {
                $response['data'] = $this->render('load-bucket-folders', array(
                    'files' => $arrayFolder,
                    'add_folder_option' => $add_folder_option,
                    'path'=> $root,
                    'popup_type' => $popup_type,
                ));
            }
        }
        else {
            $response['message'] = "Invalid request";
        }

        return $this->renderContent($response, 'json');
    }

    /*
   * S3 signature and policy
   * */
    public function generateS3Signature(){
        set_time_limit($this->connectTimeout);
        if (!empty($_POST)) {
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
            $response = array('status' => 0, 'message' => 'Invalid request');
        }

        return $this->renderContent($response, 'json');
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
        for ($i=0; $i < strlen($str); $i+=2) {
            $raw .= chr(hexdec(substr($str, $i, 2)));
        }

        return base64_encode($raw);
    }


    public function fix() {

        $test = '123123';
        $amazonS3 = AppS3::initialize();
        $result = $amazonS3->listObjects(array('Bucket' => $this->bucket,  'Prefix' => 'products/' , 'Delimiter' => '/'));
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
                    'url' => $amazonS3->getObjectUrl($this->bucket, $object['Key']),
                    'size' => AppS3::formatTotalSize($object['Size'])
                );
            }
        }
        return $this->render('index', array(
            'files' => $aryBucket,
            'test' => $test
        ));
    }

    public function deleteFile(){
        set_time_limit($this->connectTimeout);
        if (!empty($_POST)) {
            $key = base64_decode($_POST['key']);
            $bucket = $_POST['bucket'];
            $return = json_encode(array('status' => 1));
            $amazonS3 = AppS3::initialize();
            try {
                $amazonS3->deleteObject(array(
                    'Bucket' => $bucket,
                    'Key'    => $key
                ));
            } catch(Aws\S3\Exception\S3Exception $e){
                $message = $e->message();
                $return = json_encode(array('status' => 0, 'message' => $message));
            }
        }
        else {
            $return = json_encode(array('status' => 0, 'message' => 'Invalid request'));
        }

        return $this->renderContent($return, 'json');
    }


    public function deleteFolder(){
        set_time_limit($this->connectTimeout);
        if (!empty($_POST)) {
            $key = base64_decode($_POST['key']);
            $bucket = $_POST['bucket'];
            $parent_key = explode("/", $key);
            unset($parent_key[count($parent_key) - 2]);
            $parent_key = implode("/", $parent_key);
            $amazonS3 = AppS3::initialize();
            $is_object = true;
            if ($_POST['object_sub'] == 0) {
                $result = $amazonS3->listObjects(array('Bucket' => $bucket, 'Prefix' => $key, 'Delimiter' => '/'));
                if (isset($result['Contents'][0])) {
                    unset($result['Contents'][0]);
                }
                if (!empty($result['Contents']) || !empty($result['CommonPrefixes'])) {
                    $is_object = false;
                }

            }

            if ($is_object){
                $return = json_encode(array('status' => 1, 'parent_key' => $parent_key, 'id' => md5($parent_key), 'curent_id' => md5($key)));
                try {
                    $amazonS3->deleteMatchingObjects($bucket,$key);
                } catch (Aws\S3\Exception\S3Exception $e) {
                    $message = $e->message();
                    $return = json_encode(array('status' => 0, 'message' => $message));
                }
            } else {
                $return = json_encode(array('status' => 2));
            }
        }
        else {
            $return = json_encode(array('status' => 0, 'message' => 'Invalid request'));
        }

        return $this->renderContent($return, 'json');
    }


    public function ajaxDetailFile(){
        $response = array('status' => 0);
        if (!empty($_POST)) {
            $key = base64_decode($_POST['key']);
            $url = $_POST['url'];
            $bucket = $_POST['bucket'];
            $amazonS3 = AppS3::initialize();

            try{
                $result = $amazonS3->getObjectAcl(array(
                    'Bucket' => $bucket,
                    'Key' => $key
                ));    
            }
            catch (S3\Exception\S3Exception $e) {
                $response['message'] = $e->getMessage();
                return $this->renderContent($response, 'json');
            }

            $permission = AppS3::parsePermissions($result);

            $property = $amazonS3->getObject(array(
                'Bucket' => $bucket,
                'Key' => $key
            ));

            $content = $this->render('ajax/detail_file', array(
                "permissions" => $permission ,
                "owner" => $result['Owner'] ,
                "header" => $property['@metadata']['headers'] ,
                "property" => $property ,
                'key' => $key,
                'url' => $url
            ));
            
            $response['status'] = 1;
            $response['data'] = $content;
        }
        else {
            $response['message'] = 'Invalid request';
        }
        
        return $this->renderContent($response, 'json');
    }

    function recursiveObject($array, $amazonS3, $Prefix){
        $object = $amazonS3->getObject(array(
            'Bucket' => $this->bucket,
            'Key'    => $Prefix
        ));
        $owner = $amazonS3->getObjectAcl(array(
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

        $result_verssion = $amazonS3->listObjectVersions(array(
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
                $this->recursiveObject($array, $amazonS3, $row['Prefix']);
            }
        }

        return $array;
    }

    public function updatePermissions(){
        set_time_limit($this->connectTimeout);
        $return = array('status' => 1);
        if (!empty($_POST)) {
            $amazonS3 = AppS3::initialize();
            $data = $_POST['data'];
            if (isset($data['permission'])) {
                $permissions = $data['permission'];
                $bucket = $data['bucket'];
                $permission_update = array(
                    'full' => '',
                    'read' => '',
                    'write' => '',
                );

                foreach ($permissions as $grant => $permission) {
                    switch ($grant) {
                        case 'owner':
                            //Get server object permission
                            try {
                                $s3_permission = $amazonS3->getObjectAcl(array(
                                    'Bucket' => $bucket,
                                    'Key' => base64_decode($data['key'])
                                ));
                            } catch (S3\Exception\S3Exception $e) {
                                $message = $e->getMessage();
                                $return = array(
                                    'status' => 0,
                                    'message' => $message,
                                );

                                return $this->renderContent($return, 'json');
                            }

                            if (array_key_exists('full', $permission)) {
                                $permission_update['full'] .= 'ID="' . $s3_permission['Owner']['ID'] . '"';
                            }
                            if (array_key_exists('read', $permission)) {
                                $permission_update['read'] .= 'ID="' . $s3_permission['Owner']['ID'] . '"';
                            }
                            if (array_key_exists('write', $permission)) {
                                $permission_update['write'] .= 'ID="' . $s3_permission['Owner']['ID'] . '"';
                            }
                            break;
                        case 'authenticated':
                            if (array_key_exists('full', $permission)) {
                                $permission_update['full'] .= (!empty($permission_update['full']) ? ', ' : '') . 'uri="http://acs.amazonaws.com/groups/global/AuthenticatedUsers"';
                            }
                            if (array_key_exists('read', $permission)) {
                                $permission_update['read'] .= (!empty($permission_update['read']) ? ', ' : '') . 'uri="http://acs.amazonaws.com/groups/global/AuthenticatedUsers"';
                            }
                            if (array_key_exists('write', $permission)) {
                                $permission_update['write'] .= (!empty($permission_update['write']) ? ', ' : '') . 'uri="http://acs.amazonaws.com/groups/global/AuthenticatedUsers"';
                            }
                            break;
                        case 'all':
                            if (array_key_exists('full', $permission)) {
                                $permission_update['full'] .= (!empty($permission_update['full']) ? ', ' : '') . 'uri="http://acs.amazonaws.com/groups/global/AllUsers"';
                            }
                            if (array_key_exists('read', $permission)) {
                                $permission_update['read'] .= (!empty($permission_update['read']) ? ', ' : '') . 'uri="http://acs.amazonaws.com/groups/global/AllUsers"';
                            }
                            if (array_key_exists('write', $permission)) {
                                $permission_update['write'] .= (!empty($permission_update['write']) ? ', ' : '') . 'uri="http://acs.amazonaws.com/groups/global/AllUsers"';
                            }
                            break;
                    }
                }

                //Update object ACL
                try {
                    $amazonS3->putObjectAcl(array(
                        'Bucket' => $data['bucket'],
                        'Key' => base64_decode($data['key']),
                        'GrantFullControl' => $permission_update['full'],
                        'GrantRead' => $permission_update['read'],
                        'GrantWrite' => $permission_update['write'],
                    ));
                    $return['message'] = Languages::Text('UPDATED_FILE_PERMISSION');
                }catch (S3\Exception\S3Exception $e) {
                    $message = $e->getMessage();
                    $return = array(
                        'status' => 0,
                        'message' => $message,
                    );
                }
            }
        }
        else {
            $return = array('status' => 0, 'message' => 'Invalid Request');
        }

        return $this->renderContent($return, 'json');
    }

    public function updateHeaderContentType(){
        set_time_limit($this->connectTimeout);
        if (!empty($_POST)) {
            $key = base64_decode($_POST['key']);
            $contentType  = $_POST['contentType'];
            $bucket  = $_POST['bucket'];
            $amazonS3 = AppS3::initialize();
            $amazonS3->putObject(array(
                'Bucket' => $bucket,
                'Key'    => $key,
                'ContentType' => $contentType
            ));
            return $this->renderContent($contentType, 'html');
        }
        else {
            return $this->renderContent('Invalid request', 'html');
        }
    }

    public function basecode(){
        if ($_POST) {
            return $this->renderContent(array("key" => base64_encode($_POST['key']), "id" => $_POST['id']), 'json');
        }
        else {
            return $this->renderContent(array('status' => 0, 'message' => 'Invalid request'));
        }
    }
}