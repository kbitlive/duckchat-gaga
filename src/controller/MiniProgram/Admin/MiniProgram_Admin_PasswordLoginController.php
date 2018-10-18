<?php
/**
 *
 * 小程序管理后台，登陆小程序自身管理
 *
 * User: anguoyue
 * Date: 17/10/2018
 * Time: 12:28 PM
 */

class MiniProgram_Admin_PasswordLoginController extends MiniProgramController
{

    protected function getMiniProgramId()
    {
        $loginMiniProgramId = $this->ctx->Site_Config->getConfigValue(SiteConfig::SITE_LOGIN_PLUGIN_ID);

        return $loginMiniProgramId;
    }

    /**
     * 在处理正式请求之前，预处理一些操作，比如权限校验
     * @return bool
     */
    protected function preRequest()
    {
        // 权限校验，只允许管理员
        $currentUserId = $this->userId;

        if (!$this->ctx->Site_Config->isManager($currentUserId)) {

            echo $this->language == 1 ? "仅站点管理员可用" : "only site managers can use";
            return false;
        }

        return true;
    }

    /**
     * 处理正式的请求逻辑，比如跳转界面，post获取信息等
     */
    protected function doRequest()
    {
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method == "GET") {

            //1.siteConfig
            $config = $this->ctx->Site_Config->getAllConfig();

            $loginMiniProgramId = $config[SiteConfig::SITE_LOGIN_PLUGIN_ID];
            $enableInvitationCode = $config[SiteConfig::SITE_ENABLE_INVITATION_CODE];

            //2.loginConfig
            $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();
            
            $loginNameAliasConfig = $loginConfig[LoginConfig::LOGIN_NAME_ALIAS];
            $loginNameAlias = $loginNameAliasConfig["configValue"];
            $passwordFindWayConfig = $loginConfig[LoginConfig::PASSWORD_FIND_WAY];
            $passwordFindWay = $passwordFindWayConfig["configValue"];

            //3.miniProgramName
            $miniProgramName = $this->getMiniProgramName($loginMiniProgramId);

            $params = [
                "lang" => $this->language,
                "loginPluginId" => $loginMiniProgramId,
                "loginNameAlias" => $loginNameAlias,
                "passwordFindWay" => $passwordFindWay,
                "miniProgramName" => $miniProgramName . "后台",
                "enableInvitationCode" => $enableInvitationCode,
            ];

            echo $this->display("miniProgram_admin_passwordLogin", $params);

        } elseif ($method == "POST") {


        } else {
            echo $this->language == 1 ? "不支持的请求方法" : "unSupport request method";
        }

        return;
    }

    /**
     * preRequest && doRequest 发生异常情况，执行
     * @param $ex
     * @return mixed
     */
    protected function requestException($ex)
    {
        $this->logger->error("miniProgram.admin.login", $ex);
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