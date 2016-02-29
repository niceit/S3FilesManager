<?php

    $member = array(
        'username' => 'admin',
        'password' => md5(123456)
    );
    $member = base64_encode(json_encode($member));
    $config_file = fopen(dirname(__FILE__) . '/application/data/database.inc', 'w');
    fwrite($config_file, $member, strlen($member));
    fclose($config_file);

    $members = json_decode(base64_decode(file_get_contents(dirname(__FILE__) . '/application/data/database.inc')), true);
    $config = array(
        'siteUrl' => 'http://local.s3FileManagerV2',
        'email' => 'test@gmail.com',
        'maintenance' => 0,
        's3' => array(
            'appId' => 'AKIAJIZTTG3KIQZCKILQ',
            'appSecret' => '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',
            'bucket' => 'crgtesting',
            'scheme' => 'http',
            'region' => 'ap-southeast-2',
            'version' => "latest",
            'limit' => 30
        ),
    );
    $config = base64_encode(json_encode($config));

    $config_file = fopen(dirname(__FILE__) . '/application/data/configuration.inc', 'w');
    fwrite($config_file, $config, strlen($config));
    fclose($config_file);
    die('done');

    require_once dirname(__FILE__) . '/application/core.php';
    require_once dirname(__FILE__) . '/application/modules/system/home.php';
    $home = new Home();
    $content = $home->index();
    echo $content;