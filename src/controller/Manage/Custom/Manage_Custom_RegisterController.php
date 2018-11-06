<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 06/11/2018
 * Time: 11:49 AM
 */

class Manage_Custom_RegisterController extends Manage_CommonController
{

    /**
     * 处理正式的请求逻辑，比如跳转界面，post获取信息等
     */
    protected function doRequest()
    {

        $method = $_SERVER["REQUEST_METHOD"];

        if ($method == "POST") {
            try {
                $key = $_POST["key"];
                $value = $_POST["value"];

                if ($key == LoginConfig::LOGIN_PAGE_BACKGROUND_IMAGE) {
                    $fileId = $value;
                    $imageDir = WPF_LIB_DIR . "../public/site/image/";
                    $this->ctx->File_Manager->moveImage($fileId, $imageDir);
                }

                $res = $this->ctx->Site_Custom->updateLoginConfig($key, $value, "", $this->userId);
                if ($res) {
                    $result["errCode"] = "success";
                }
            } catch (Exception $e) {
                $result["errInfo"] = $e->getMessage();
                $this->logger->error($this->action, $e);

            }
            echo json_encode($result);
        } else {
            //1.siteConfig
            $config = $this->ctx->Site_Config->getAllConfig();
            $loginMiniProgramId = $config[SiteConfig::SITE_LOGIN_PLUGIN_ID];
            $enableInvitationCode = $config[SiteConfig::SITE_ENABLE_INVITATION_CODE];

            //2.loginConfig
            $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

            $loginNameAliasConfig = isset($loginConfig[LoginConfig::LOGIN_NAME_ALIAS]) ? $loginConfig[LoginConfig::LOGIN_NAME_ALIAS] : "";
            $loginNameAlias       = isset($loginNameAliasConfig["configValue"]) ? $loginNameAliasConfig["configValue"] : "";
            $passwordResetConfig  = isset($loginConfig[LoginConfig::PASSWORD_RESET_WAY]) ? $loginConfig[LoginConfig::PASSWORD_RESET_WAY] : "";
            $passwordResetWay     = isset($passwordResetConfig["configValue"]) ? $passwordResetConfig["configValue"] : "";

            $passwordResetRequiredConfig = isset( $loginConfig[LoginConfig::PASSWORD_RESET_REQUIRED]) ?  $loginConfig[LoginConfig::PASSWORD_RESET_REQUIRED] : "";
            $passwordResetRequired = isset( $passwordResetRequiredConfig["configValue"]) ?  $passwordResetRequiredConfig["configValue"] : "";

            //3.miniProgramName
            $miniProgramName = $this->getMiniProgramName($loginMiniProgramId);

            $params = [
                "lang"                  => $this->language,
                "loginPluginId"         => $loginMiniProgramId,
                "loginNameAlias"        => $loginNameAlias,
                "passwordResetWay"      => $passwordResetWay,
                "passwordResetRequired" => $passwordResetRequired,
                "miniProgramName"       => $miniProgramName . "后台",
                "enableInvitationCode"  => $enableInvitationCode,
            ];

            echo $this->display("manage_custom_register", $params);

        }

        return;
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

