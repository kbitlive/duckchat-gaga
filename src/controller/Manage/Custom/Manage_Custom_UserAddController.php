<?php
/**
 * 增加用户自定义字段
 * Author: SAM<an.guoyue254@gmail.com>
 * Date: 06/11/2018
 * Time: 11:49 AM
 */

class Manage_Custom_UserAddController extends Manage_ServletController
{

    protected function doGet()
    {
        $params = [
            "lang" => $this->language,
            "title" => $this->language == 1 ? "添加用户字段" : "Add User Field",
        ];

        echo $this->display("manage_custom_userAdd", $params);
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

