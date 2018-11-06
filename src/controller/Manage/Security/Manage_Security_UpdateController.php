<?php
/**
 * Created by PhpStorm.
 * User: zhangjun
 * Date: 06/11/2018
 * Time: 10:52 AM
 */

class Manage_Security_UpdateController extends Manage_CommonController
{
    private $pwdMinLength = 6;
    private $pwdMaxLength = 6;

    public function doRequest()
    {

        $result = [
            'errCode' => "error.alert",
            'errInfo' => "",
        ];

        try {

            $key = $_POST['key'];
            $value = "";
            switch ($key) {
                case LoginConfig::LOGINNAME_MINLENGTH:
                    $loginNameMinLength = $_POST['login_name_min_length'];
                    $value = $loginNameMinLength;
                    $this->checkLoginNameLength();
                    break;
                case LoginConfig::LOGINNAME_MAXLENGTH:
                    $loginNameMaxLength = $_POST['login_name_max_length'];
                    $value = $loginNameMaxLength;
                    $this->checkLoginNameLength();
                    break;
                case LoginConfig::PASSWORD_MINLENGTH:
                    $pwdMinLength = $_POST['pwd_min_length'];
                    $value = $pwdMinLength;
                    $this->checkPwdLength();
                    break;
                case LoginConfig::LOGINNAME_MAXLENGTH:
                    $pwdMaxLength = $_POST['pwd_max_length'];
                    $value = $pwdMaxLength;
                    $this->checkPwdLength();
                    break;
                case LoginConfig::PASSWORD_ERROR_NUM:
                    $value = (int)$_POST['value'];
                    break;
            }
            $res = $this->ctx->Site_Custom->updateLoginConfig($key, $value, "", $this->userId);
            if ($res) {
                $result["errCode"] = "success";
            }

        } catch (Throwable $e) {
            $this->logger->error("manage.miniprogram.delete", $e);
            $result["errInfo"] = $e->getMessage();
        }

        echo json_encode($result);
        return;
    }

    private function checkLoginNameLength( )
    {
        $loginNameMinLength = $_POST['login_name_min_length'];
        $loginNameMaxLength = $_POST['login_name_max_length'];
        if($loginNameMaxLength<$loginNameMinLength) {
            $info = ZalyText::getText('text.loginName.MaxLengthLessThanMinLength', $this->language);
            throw new Exception($info);
        }
    }

    private function checkPwdLength()
    {
        $pwdMinLength = $_POST['pwd_min_length'];
        $pwdMaxLength = $_POST['pwd_max_length'];
        if($pwdMinLength < $this->pwdMinLength) {
            $info = ZalyText::getText('text.pwd.minLength', $this->language);
            throw new Exception($info);
        }

        if ($pwdMaxLength > $this->pwdMaxLength) {
            $info = ZalyText::getText('text.pwd.maxLength', $this->language);
            throw new Exception($info);
        }

        if($pwdMaxLength<$pwdMinLength) {
            $info = ZalyText::getText('text.pwd.MaxLengthLessThanMinLength', $this->language);
            throw new Exception($info);
        }

    }
}