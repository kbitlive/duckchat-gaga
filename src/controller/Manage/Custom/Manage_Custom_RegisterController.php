<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 06/11/2018
 * Time: 11:49 AM
 */

class Manage_Custom_RegisterController extends Manage_ServletController
{

    protected function doGet()
    {
        $loginConfig = $this->ctx->Site_Custom->getLoginAllConfig();

        $loginNameAliasConfig = isset($loginConfig[LoginConfig::LOGIN_NAME_ALIAS]) ? $loginConfig[LoginConfig::LOGIN_NAME_ALIAS] : "";
        $loginNameAlias = isset($loginNameAliasConfig["configValue"]) ? $loginNameAliasConfig["configValue"] : "";

        $userCustomsForRegister = $this->getUserCustomForRegister();

        $params = [
            "lang" => $this->language,
            "loginNameAlias" => $loginNameAlias,
            "userCustoms" => $userCustomsForRegister,
        ];

        echo $this->display("manage_custom_register", $params);
        return;
    }

    protected function doPost()
    {
        $result = [
            "errCode" => "error",
        ];

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
        return;
    }

    private function getUserCustomForRegister()
    {
        return $this->ctx->SiteUserCustomTable->getColumnInfosForRegister();
    }
}

