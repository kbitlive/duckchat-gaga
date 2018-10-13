<?php
/**
 * Created by PhpStorm.
 * User: childeYin<尹少爷>
 * Date: 19/07/2018
 * Time: 10:54 AM
 */

class ZalyConfig
{
    private static $verifySessionKey = "session_verify_";

    public static $configSiteVersionNameKey = "siteVersionName";
    public static $configSiteVersionCodeKey = "siteVersionCode";

    public static $config;
    public static $sampleConfig;

    //load config.php
    public static function loadConfigFile()
    {
        $fileName = dirname(__FILE__) . "/../../config.php";
        if (!file_exists($fileName)) {
            $fileName = dirname(__FILE__) . "/../../config.sample.php";
        }

        self::$config = require($fileName);
    }

    // load sample.config.php
    public static function loadSampleConfigFile()
    {
        $sampleConfigFileName = dirname(__FILE__) . "/../../config.sample.php";

        self::$sampleConfig = require($sampleConfigFileName);
    }

    public static function getConfig($key = "")
    {
        self::loadConfigFile();
        if (isset(self::$config[$key])) {
            return self::$config[$key];
        }
        return false;
    }

    public static function getSampleConfig($key = "")
    {

        self::loadSampleConfigFile();

        if (isset(self::$sampleConfig[$key])) {
            return self::$sampleConfig[$key];
        }

        return false;
    }

    public static function getAllConfig()
    {
        self::loadConfigFile();
        return self::$config;
    }


    public static function getSessionVerifyUrl($pluginId)
    {
        self::loadConfigFile();
        $key = self::$verifySessionKey . $pluginId;
        return self::$config[$key];
    }

    public static function getApiIndexUrl()
    {
        $domain = self::getDomain();
        $pageIndexUrl = self::$config['apiPageIndex'];
        if (strpos($pageIndexUrl, "./") == 0) {
            $pageIndexUrl = str_replace("./", "/", $pageIndexUrl);
        }
        return $domain . $pageIndexUrl;
    }

    public static function getApiPageJumpUrl()
    {
        $domain = self::getDomain();
        $pageJumpUrl = self::$config['apiPageJump'];
        if (strpos($pageJumpUrl, "./") == 0) {
            $pageJumpUrl = str_replace("./", "/", $pageJumpUrl);
        }
        return $domain . $pageJumpUrl;
    }

    public static function getApiPageWidget()
    {
        $domain = self::getDomain();
        $pageWidgetUrl = self::$config['apiPageWidget'];
        if (strpos($pageWidgetUrl, "./") == 0) {
            $pageWidgetUrl = str_replace("./", "/", $pageWidgetUrl);
        }
        return $domain . $pageWidgetUrl;
    }

    public static function getDomain()
    {
        self::loadConfigFile();

        $scheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] . "://" : "http://";
        $domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : "";

        return $scheme . $domain;
    }
}