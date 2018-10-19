<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 23/08/2018
 * Time: 11:18 AM
 */

class Page_Passport_LoginController extends HttpBaseController
{

    public function index()
    {
        $cookieStr = isset($_SERVER['HTTP_COOKIE']) ? $_SERVER['HTTP_COOKIE'] : "";
        $isDuckchat = 0;
        if (strpos($cookieStr, "duckchat_sessionid") !== false) {
            $isDuckchat = 1;
        }

        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $loginNameAliasConfig = $loginConfig[LoginConfig::LOGIN_NAME_ALIAS];
        $loginNameAlias = $loginNameAliasConfig["configValue"];
        $passwordFindWayConfig = $loginConfig[LoginConfig::PASSWORD_FIND_WAY];
        $passwordFindWay = $passwordFindWayConfig["configValue"];

        $loginWelcomeTextConfig = $loginConfig[LoginConfig::LOGIN_PAGE_WELCOME_TEXT];
        $loginWelcomeText = $loginWelcomeTextConfig["configValue"];

        $loginBackgroundColorConfig = $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_COLOR];
        $loginBackgroundColor = $loginBackgroundColorConfig["configValue"];

        $loginBackgroundImageConfig = $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE];
        $loginBackgroundImage = $loginBackgroundImageConfig["configValue"];

        $loginBackgroundImageDisplayConfig = $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE_DISPLAY];
        $loginBackgroundImageDisplay = $loginBackgroundImageDisplayConfig["configValue"];

        $siteVersionName = ZalyConfig::getConfig(ZalyConfig::$configSiteVersionNameKey);

        $params = [
            'isDuckchat' => $isDuckchat,
            'loginNameAlias' => $loginNameAlias,
            'passwordFindWay' => $passwordFindWay,
            'loginWelcomeText' => $loginWelcomeText,
            'loginBackgroundColor' => $loginBackgroundColor,
            'loginBackgroundImage' => $loginBackgroundImage,
            'loginBackgroundImageDisplay' => $loginBackgroundImageDisplay,
            'siteVersionName' => $siteVersionName,
        ];

        $this->logger->error("===============", var_export($params, true));

        echo $this->display("passport_login", $params);
        return;
    }

}