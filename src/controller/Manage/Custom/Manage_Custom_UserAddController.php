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
        $result = [
            'errCode' => "error",
        ];

        error_log("================" . var_export($_POST, true));


        $keySort = trim($_POST['keySort']);
        if (!is_numeric($keySort)) {
            $keySort = 10;
        }

        $customs = [
            'customKey' => $_POST['customKey'],
            'keyName' => $_POST['keyName'],
            'keyIcon' => $_POST['keyIcon'],
            'keySort' => $_POST['keySort'],
            'status' => $_POST['status'],
            'isOpen' => $_POST['isOpen'],
            'isRequired' => $_POST['isRequired'],
        ];

        if ($this->addUserCustomKey($customs)) {
            $result['errCode'] = "success";
        }

        echo json_encode($result);
        return;
    }

    private function addUserCustomKey(array $customArr)
    {
        return $this->ctx->SiteCustomTable->insertUserCustomKeys($customArr);
    }

}

