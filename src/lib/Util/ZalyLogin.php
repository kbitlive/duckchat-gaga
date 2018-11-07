<?php
/**
 * read thirdParty login file,thirdPartyLogin.php
 * User: anguoyue
 * Date: 2018/11/7
 * Time: 6:03 PM
 */

class ZalyLogin
{

    public static $loginConfig;

    private static function loadLoginConfig()
    {
        $fileName = WPF_ROOT_DIR . "/thirdPartyLogin.php";
        if (!file_exists($fileName)) {
            throw new Exception("site login by thirdParty error,as file not exists");
        }

        self::$loginConfig = require($fileName);

        return self::$loginConfig;
    }


    public static function getConfig($loginKey)
    {
        self::loadLoginConfig();
        return self::$loginConfig[$loginKey];
    }

    public static function getVerifyUrl($loginKey)
    {
        return self::getConfig($loginKey)['verifyUrl'];
    }

}