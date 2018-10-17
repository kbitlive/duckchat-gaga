<?php
/**
 *
 * 小程序管理后台，登陆小程序自身管理
 *
 * User: anguoyue
 * Date: 17/10/2018
 * Time: 12:28 PM
 */

class MiniProgram_Admin_LoginController extends MiniProgramController
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
        // TODO: Implement doRequest() method.
    }

    /**
     * preRequest && doRequest 发生异常情况，执行
     * @param $ex
     * @return mixed
     */
    protected function requestException($ex)
    {
        // TODO: Implement requestException() method.
    }
}