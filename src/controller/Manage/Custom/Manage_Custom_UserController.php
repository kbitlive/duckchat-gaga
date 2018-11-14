<?php
/**
 * 自定义资料页面
 * Author: SAM<an.guoyue254@gmail.com>
 * Date: 06/11/2018
 * Time: 11:49 AM
 */

class Manage_Custom_UserController extends Manage_ServletController
{

    protected function doGet()
    {
        //1.siteConfig
        $config = $this->ctx->Site_Config->getAllConfig();
        $loginMiniProgramId = $config[SiteConfig::SITE_LOGIN_PLUGIN_ID];
        $enableInvitationCode = $config[SiteConfig::SITE_ENABLE_INVITATION_CODE];

        //2.loginConfig
        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $loginNameAliasConfig = isset($loginConfig[LoginConfig::LOGIN_NAME_ALIAS]) ? $loginConfig[LoginConfig::LOGIN_NAME_ALIAS] : "";
        $loginNameAlias = isset($loginNameAliasConfig["configValue"]) ? $loginNameAliasConfig["configValue"] : "";
        $passwordResetConfig = isset($loginConfig[LoginConfig::PASSWORD_RESET_WAY]) ? $loginConfig[LoginConfig::PASSWORD_RESET_WAY] : "";
        $passwordResetWay = isset($passwordResetConfig["configValue"]) ? $passwordResetConfig["configValue"] : "";

        $passwordResetRequiredConfig = isset($loginConfig[LoginConfig::PASSWORD_RESET_REQUIRED]) ? $loginConfig[LoginConfig::PASSWORD_RESET_REQUIRED] : "";
        $passwordResetRequired = isset($passwordResetRequiredConfig["configValue"]) ? $passwordResetRequiredConfig["configValue"] : "";

        //3.miniProgramName
        $miniProgramName = $this->getMiniProgramName($loginMiniProgramId);

        $params = [
            "lang" => $this->language,
            "title" => $this->language == 1 ? "用户资料配置" : "User Profile Custom",
        ];

        echo $this->display("manage_custom_user", $params);
        return;
    }

    protected function doPost()
    {
        // TODO: Implement doPost() method.
    }

    private function getMiniProgramName($miniProgramId)
    {
        $profile = $this->getMiniProgramProfile($miniProgramId);
        return $profile["name"];
    }

    private function getMiniProgramProfile($miniProgramId)
    {
        return $this->ctx->SitePluginTable->getPluginById($miniProgramId);
    }
}

