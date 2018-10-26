<?php
/**
 * Created by PhpStorm.
 * User: anguoyue
 * Date: 2018/10/26
 * Time: 2:52 PM
 */

// DuckChat小程序SDK位置
define('DC_SDK_PATH', __DIR__ . '/../');

//当前开发小程序的ID
define('DC_MINI_PROGRAM_ID', 100);

//小程序的秘钥，如果当前小程序没有密钥，使用站点公共密钥
define('DC_MINI_PROGRAM_SECRET_KEY', "XXXXXXXX");

//当前对接的站点服务器地址 ip:port
define('DC_SERVER_ADDRESS', "http://192.168.3.4:8888");

//curl time out,default 5s
define('DC_CURLOPT_TIMEOUT', 5);

