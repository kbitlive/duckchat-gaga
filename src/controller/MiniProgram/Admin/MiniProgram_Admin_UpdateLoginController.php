<?php
/**
 *
 * 小程序管理后台，登陆小程序自身管理
 *
 * User: anguoyue
 * Date: 17/10/2018
 * Time: 12:28 PM
 */

class MiniProgram_Admin_UpdateLoginController extends MiniProgramController
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

        //response
        $result = [
            'errCode' => "error",

        ];

        try {
            $key = $_POST["key"];
            $value = $_POST["value"];
            $res = $this->ctx->Site_Custom->updateLoginConfig($key, $value, "", $this->userId);
            if ($res) {
                $result["errCode"] = "success";
            }
        } catch (Exception $e) {
            $result["errInfo"] = $e->getMessage();
            $this->logger->error($this->action, $e);

        }

        echo json_encode($result);
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