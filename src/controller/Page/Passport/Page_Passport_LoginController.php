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

        $siteLogo = $this->siteConfig[SiteConfig::SITE_LOGO];
        $siteName = $this->siteConfig[SiteConfig::SITE_NAME];

        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $loginNameAliasConfig = isset($loginConfig[LoginConfig::LOGIN_NAME_ALIAS]) ? $loginConfig[LoginConfig::LOGIN_NAME_ALIAS] : "";
        $loginNameAlias = isset( $loginNameAliasConfig["configValue"]) ?  $loginNameAliasConfig["configValue"] : "";
        $passwordResetWayConfig = isset($loginConfig[LoginConfig::PASSWORD_RESET_WAY]) ?  $loginConfig[LoginConfig::PASSWORD_RESET_WAY] : "";
        $passwordRestWay = isset($passwordResetWayConfig["configValue"]) ? $passwordResetWayConfig["configValue"] : "";

        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();
        $passwordResetRequiredConfig = isset($loginConfig[LoginConfig::PASSWORD_RESET_REQUIRED]) ? $loginConfig[LoginConfig::PASSWORD_RESET_REQUIRED] : "";
        $passwordResetRequired = isset($passwordResetRequiredConfig["configValue"]) ? $passwordResetRequiredConfig["configValue"] : "";

        $loginWelcomeTextConfig = isset($loginConfig[LoginConfig::LOGIN_PAGE_WELCOME_TEXT]) ? $loginConfig[LoginConfig::LOGIN_PAGE_WELCOME_TEXT] : "";
        $loginWelcomeText = isset($loginWelcomeTextConfig["configValue"]) ? $loginWelcomeTextConfig["configValue"] : "";

        $loginBackgroundColorConfig = isset($loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_COLOR]) ? $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_COLOR] : "";
        $loginBackgroundColor = isset($loginBackgroundColorConfig["configValue"]) ? $loginBackgroundColorConfig["configValue"] : "";

        $loginBackgroundImageConfig = isset($loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE]) ? $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE] : "";
        $loginBackgroundImage = isset($loginBackgroundImageConfig["configValue"]) ? $loginBackgroundImageConfig["configValue"] : "";

        $loginBackgroundImageDisplayConfig = isset($loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE_DISPLAY]) ? $loginConfig[LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE_DISPLAY] : "";
        $loginBackgroundImageDisplay = isset($loginBackgroundImageDisplayConfig["configValue"]) ? $loginBackgroundImageDisplayConfig["configValue"] : "";

        $siteVersionName = ZalyConfig::getConfig(ZalyConfig::$configSiteVersionNameKey);

        $params = [
            'siteName' => $siteName,
            'siteLogo' => $this->ctx->File_Manager->getCustomPathByFileId($siteLogo),
            'siteVersionName' => $siteVersionName,
            'isDuckchat' => $isDuckchat,
            'loginNameAlias' => $loginNameAlias,
            'passwordFindWay' => $passwordRestWay,
            'passwordResetWay' => $passwordRestWay,
            'passwordResetRequired' => $passwordResetRequired,
            'loginWelcomeText' => $loginWelcomeText,
            'loginBackgroundColor' => $loginBackgroundColor,
            'loginBackgroundImage' => $this->ctx->File_Manager->getCustomPathByFileId($loginBackgroundImage),
            'loginBackgroundImageDisplay' => $loginBackgroundImageDisplay,
            'redirect_url' => isset($_GET['redirect_url']) ? $_GET['redirect_url'] : ""
        ];

        echo $this->display("passport_login", $params);
        return;
    }

}