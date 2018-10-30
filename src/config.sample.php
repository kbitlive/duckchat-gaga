<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 03/09/2018
 * Time: 1:41 PM
 */

return array(
    'siteVersionName' => '1.0.15',
    'siteVersionCode' => '10015',
    'apiPageIndex' => './index.php?action=page.index',
    'apiPageLogin' => './index.php?action=page.login',
    'apiPageLogout' => './index.php?action=page.logout',
    'apiPageJump' => "./index.php?action=page.jump",
    'loginPluginId' => '102',
    'apiPageWidget' => './index.php?action=page.widget',
    'apiPageSiteInit' => "./index.php?action=installDB",
    'sessionVerify102' => './index.php?action=api.session.verify&body_format=base64pb',
    'testCurl' => "./index.php?action=installDB&for=test_curl",
    'sessionVerify106' => 'http://127.0.0.1:8081/plugin.php?id=duckchat&action=api.session.verify&body_format=base64pb',
    'errorLog' => '',
    'mail' =>
        array(
            'host' => 'smtp.126.com',
            'SMTPAuth' => true,
            'emailAddress' => 'xxxx@126.com',
            'password' => '',
            'SMTPSecure' => '',
            'port' => 25,
        ),
    'dbType' => 'sqlite',
    'dbVersion' => '2',
    'sqlite' =>
        array(
            'sqliteDBPath' => '.',
            'sqliteDBName' => '',
        ),
    'mysql' =>
        array(
            'dbName' => 'duckchat_site',
            'dbHost' => '127.0.0.1',
            'dbPort' => '3306',
            'dbUserName' => 'duckchat',
            'dbPassword' => '1234567890',
        ),
    'mysqlSlave' => array(
//        'slave_0' => array(
//            'dbName' => 'duckchat_site',
//            'dbHost' => '127.0.0.1',
//            'dbPort' => '3306',
//            'dbUserName' => 'duckchat',
//            'dbPassword' => '1234567890',
//        ),
//        'slave_1' => array(
//            'dbName' => 'duckchat_site',
//            'dbHost' => '127.0.0.1',
//            'dbPort' => '3306',
//            'dbUserName' => 'duckchat',
//            'dbPassword' => '1234567890',
//        ),
//        'slave_2' => array(
//            'dbName' => 'duckchat_site',
//            'dbHost' => '127.0.0.1',
//            'dbPort' => '3306',
//            'dbUserName' => 'duckchat',
//            'dbPassword' => '1234567890',
//        ),
    ),
    'logPath' => '.',
    "debugMode" => false,
    'msectime' => 1535945699185.0,
);
