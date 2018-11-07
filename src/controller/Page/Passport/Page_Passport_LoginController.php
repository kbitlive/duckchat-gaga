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
        $tag = __CLASS__.'->'.__FUNCTION__;
        try{
            $this->checkUserCookie();
            if($this->userId) {
                $jumpPage = $this->getJumpUrlFromParams();
                $apiPageIndex = ZalyConfig::getApiIndexUrl();
                if($jumpPage) {
                    if (strpos($apiPageIndex, "?")) {
                        $apiPageIndex .= "&".$jumpPage;
                    } else {
                        header("Location:" . $apiPageIndex . "?".$jumpPage);
                        $apiPageIndex .= "?".$jumpPage;
                    }
                }
                header("Location:" . $apiPageIndex);
                exit();
            }
        } catch (Exception $ex) {
            $this->logger->error($tag, $ex);
        }

        $cookieStr = isset($_SERVER['HTTP_COOKIE']) ? $_SERVER['HTTP_COOKIE'] : "";
        $isDuckchat = 0;

        if (strpos($cookieStr, "duckchat_sessionid") !== false) {
            $isDuckchat = 1;
        }

        $siteLogo = $this->siteConfig[SiteConfig::SITE_LOGO];
        $siteName = $this->siteConfig[SiteConfig::SITE_NAME];

        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $loginNameAliasConfig = isset($loginConfig[LoginConfig::LOGIN_NAME_ALIAS]) ? $loginConfig[LoginConfig::LOGIN_NAME_ALIAS] : "";
        $loginNameAlias = isset($loginNameAliasConfig["configValue"]) ? $loginNameAliasConfig["configValue"] : "";
        $passwordResetWayConfig = isset($loginConfig[LoginConfig::PASSWORD_RESET_WAY]) ? $loginConfig[LoginConfig::PASSWORD_RESET_WAY] : "";
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

        $loginNameMinLengthConfig = isset($loginConfig[LoginConfig::LOGINNAME_MINLENGTH]) ? $loginConfig[LoginConfig::LOGINNAME_MINLENGTH] : "";
        $loginNameMinLength = isset($loginNameMinLengthConfig["configValue"]) ? $loginNameMinLengthConfig["configValue"] : 1;

        $loginNameMaxLengthConfig = isset($loginConfig[LoginConfig::LOGINNAME_MAXLENGTH]) ? $loginConfig[LoginConfig::LOGINNAME_MAXLENGTH] : "";
        $loginNameMaxLength = isset($loginNameMaxLengthConfig["configValue"]) ? $loginNameMaxLengthConfig["configValue"] : 24;

        $pwdMaxLengthConfig = isset($loginConfig[LoginConfig::PASSWORD_MAXLENGTH]) ? $loginConfig[LoginConfig::PASSWORD_MAXLENGTH] : "";
        $pwdMaxLength = isset($pwdMaxLengthConfig["configValue"]) ? $pwdMaxLengthConfig["configValue"] : 32;

        $pwdMinLengthConfig = isset($loginConfig[LoginConfig::PASSWORD_MINLENGTH]) ? $loginConfig[LoginConfig::PASSWORD_MINLENGTH] : "";
        $pwdMinLength = isset($pwdMinLengthConfig["configValue"]) ? $pwdMinLengthConfig["configValue"] : 6;

        $pwdContainCharactersConfig = isset($loginConfig[LoginConfig::PASSWORD_CONTAIN_CHARACTERS]) ? $loginConfig[LoginConfig::PASSWORD_CONTAIN_CHARACTERS] : "";
        $pwdContainCharacters = isset($pwdContainCharactersConfig["configValue"]) ? $pwdContainCharactersConfig["configValue"] : "";


        $params = [
            'siteName' => $siteName,
            'siteLogo' => $this->ctx->File_Manager->getCustomPathByFileId($siteLogo),
            'siteVersionName' => $siteVersionName,
            'isDuckchat' => $isDuckchat,
            'loginWelcomeText' => $loginWelcomeText,
            'loginBackgroundColor' => $loginBackgroundColor,
            'loginBackgroundImage' => $this->ctx->File_Manager->getCustomPathByFileId($loginBackgroundImage),

            "pwdMaxLength" => $pwdMaxLength,
            "pwdMinLength" => $pwdMinLength,
            "loginNameMinLength" => $loginNameMinLength,
            "loginNameMaxLength" => $loginNameMaxLength,
            'passwordResetRequired' => $passwordResetRequired,
            "pwdContainCharacters" => $pwdContainCharacters,

            'loginBackgroundImageDisplay' => $loginBackgroundImageDisplay,

            'loginNameAlias' => $loginNameAlias,
            'passwordFindWay' => $passwordRestWay,
            'passwordResetWay' => $passwordRestWay,
            'passwordResetRequired' => $passwordResetRequired,
            'customLoginItems' => [
                //自定义的登陆项
                [
                    'email' => "邮箱",
                    'icon' => "",
                    'placeholder' => "",
                    'isRequired' => $passwordResetRequired,
                ],

                [
                    'phone' => "手机号",
                    'icon' => "",
                    'placeholder' => "",
                    'isRequired' => $passwordResetRequired,
                ],

                [
                    'name' => "姓名",
                    'icon' => "",
                    'placeholder' => "",
                    'isRequired' => $passwordResetRequired,
                ],
            ],
        ];

        echo $this->display("passport_login", $params);
        return;
    }

}